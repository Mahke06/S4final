<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClientModel;
use App\Models\FraisModel;

class RetraitController extends BaseController
{
    public function index()
    {
        if (! session()->get('client_id')) {
            return redirect()->to('/login');
        }

        return view('retrait');
    }

    public function faireRetrait()
    {
        $clientModel = new ClientModel();
        $clientId = session()->get('client_id');
        $montant = $this->request->getPost('montant');

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
        $frais = $fraisModel->where('idoperation', 2)
                            ->where('idoperateur', session()->get('operateur')['id'])
                            ->where('montantmin <=', $montant)
                            ->where('montantmax >=', $montant)
                            ->first();

        if (!$frais) {
            $frais['frais'] = 0;
        }

        $nouveauSolde = $client['solde'] - ($montant + $frais['frais']);

        if ($nouveauSolde < 0) {
            return redirect()->back()->withInput()->with('errors',['Solde insuffisant pour effectuer ce retrait.']);
        }

        $clientModel->update($clientId, ['solde' => $nouveauSolde]);

        $db = \Config\Database::connect();
        $db->table('Historique')->insert([
            'idclient'    => $clientId,
            'idoperation' => 2,
            'montant'     => $montant,
            'frais'       => $frais ? $frais['frais'] : 0,
        ]);

        return redirect()->to('/client')->with('success', 'Retrait effectue avec succes.');
    }
}
