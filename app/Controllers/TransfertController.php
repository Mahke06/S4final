<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClientModel;
use App\Models\FraisModel;

class TransfertController extends BaseController
{
    public function index()
    {
        if (! session()->get('client_id')) {
            return redirect()->to('/login');
        }

        return view('transfert');
    }

    public function faireTransfert()
    {
        $clientModel = new ClientModel();
        $clientId = session()->get('client_id');
        $montant = $this->request->getPost('montant');
        $telephoneDestinataire = $this->request->getPost('telephone_destinataire');

        if (!$clientId) {
            return redirect()->to('/login');
        }
        if (!is_numeric($montant) || $montant <= 0) {
            return redirect()->back()->withInput()->with('errors', ['Montant invalide.']);
        }
        $client = $clientModel->find($clientId);
        if (!$client) {
            return redirect()->to('/login')->with('error', 'Client introuvable.');
        }
        
        $fraisModel = new FraisModel();
        $frais = $fraisModel->where('idoperation', 3)
                            ->where('idoperateur', $client['idoperateur'])
                            ->where('montantmin <=', $montant)
                            ->where('montantmax >=', $montant)
                            ->first();

        if (!$frais) {
            $frais['frais'] = 0;
        }

        $destinataire = $clientModel->where('telephone', $telephoneDestinataire)->first();
        if (!$destinataire) {
            return redirect()->back()->withInput()->with('errors', ['Destinataire introuvable.']);
        }

        $nouveauSolde = $client['solde'] - ($montant + $frais['frais']); 

        if ($nouveauSolde < 0) {
            return redirect()->back()->withInput()->with('errors',['Solde insuffisant pour effectuer ce transfert.']);
        }

        $clientModel->update($clientId, ['solde' => $nouveauSolde]);

        $nouveauSoldeDestinataire = $destinataire['solde'] + $montant;

        $clientModel->update($destinataire['id'], ['solde' => $nouveauSoldeDestinataire]);

        return redirect()->to('/client')->with('success', 'Transfert effectue avec succes.');
    }
}
