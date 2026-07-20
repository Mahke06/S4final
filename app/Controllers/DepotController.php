<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClientModel;

class DepotController extends BaseController
{
    public function index()
    {
        if (! session()->get('client_id')) {
            return redirect()->to('/login');
        }

        return view('depot');
    }

    public function faireDepot()
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
        
        $nouveauSolde = $client['solde'] + $montant;

        $clientModel->update($clientId, ['solde' => $nouveauSolde]);

        return redirect()->to('/client/' . $clientId)->with('success', 'Depot effectué avec succès.');
    }
}
