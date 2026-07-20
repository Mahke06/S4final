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
        $fraisModel = new FraisModel();
        $clientId = session()->get('client_id');
        $montant = $this->request->getPost('montant');
        $telephoneDestinataire = $this->request->getPost('telephone_destinataire');
        $inclureFrais = $this->request->getPost('inclure_frais');

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

        $destinataire = $clientModel->where('telephone', $telephoneDestinataire)->first();
        if (!$destinataire) {
            return redirect()->back()->withInput()->with('errors', ['Destinataire introuvable.']);
        }

        $operateurSession = session()->get('operateur')['id'];
        $operateurDest = $clientModel->getOperateur($telephoneDestinataire);
        $memeOperateur = $operateurDest && $operateurDest['id'] == $operateurSession;

        $montantEnvoye = $montant;
        $fraisRetrait = 0;

        $fraisRow = $fraisModel
            ->where('idoperation', 3)
            ->where('idoperateur', $operateurSession)
            ->where('montantmin <=', $montant)
            ->where('montantmax >=', $montant)
            ->first();
        $fraisTransfert = $fraisRow ? $fraisRow['frais'] : 0;

        if ($inclureFrais && $memeOperateur) {
            $fraisRetraitRow = $fraisModel
                ->where('idoperation', 2)
                ->where('idoperateur', $operateurSession)
                ->where('montantmin <=', $montant)
                ->where('montantmax >=', $montant)
                ->first();
            $fraisRetrait = $fraisRetraitRow ? $fraisRetraitRow['frais'] : 0;

            $montantEnvoye = $montant + $fraisRetrait;

            $fraisRow = $fraisModel
                ->where('idoperation', 3)
                ->where('idoperateur', $operateurSession)
                ->where('montantmin <=', $montantEnvoye)
                ->where('montantmax >=', $montantEnvoye)
                ->first();
            $fraisTransfert = $fraisRow ? $fraisRow['frais'] : 0;
        } elseif ($inclureFrais) {
            session()->setFlashdata('warning',
                'Option inclure frais disponible uniquement pour le même opérateur.');
        }

        $totalADebiter = $montantEnvoye + $fraisTransfert;

        if ($client['solde'] < $totalADebiter) {
            return redirect()->back()->withInput()->with('errors', [
                'Solde insuffisant. Requis : ' . number_format($totalADebiter, 0, ',', ' ') . ' Ar'
            ]);
        }

        $clientModel->update($clientId, ['solde' => $client['solde'] - $totalADebiter]);
        $clientModel->update($destinataire['id'], ['solde' => $destinataire['solde'] + $montantEnvoye]);

        $db = \Config\Database::connect();
        $db->table('Historique')->insert([
            'idclient'    => $clientId,
            'idoperation' => 3,
            'montant'     => $montantEnvoye,
            'frais'       => $fraisTransfert,
        ]);
    
        if ($fraisRetrait > 0) {
            $db->table('Historique')->insert([
                'idclient'    => $clientId,
                'idoperation' => 2,
                'montant'     => $fraisRetrait,
                'frais'       => 0,
            ]);
        }

        $msg = 'Transfert effectué avec succès.';
        if ($fraisRetrait > 0) {
            $msg .= ' (Frais retrait inclus : ' . number_format($fraisRetrait, 0, ',', ' ') . ' Ar)';
        }

        return redirect()->to('/client')->with('success', $msg);
    }
}
