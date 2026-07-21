<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\FraisModel;

class DepotController extends BaseController
{
    public function index()
    {
        if (! session()->get('client_id')) {
            return redirect()->to('/login');
        }

        $fraisModel = new FraisModel();
        $data['frais'] = $fraisModel->where('idoperation', 1)
            ->where('idnotreoperateur', 1)
            ->orderBy('montantmin')
            ->findAll();

        $model = new ClientModel();
        $client = $model->find(session()->get('client_id'));
        $data['solde'] = $client ? $client['solde'] : 0;

        return view('depot', $data);
    }

    public function faireDepot()
    {
        $clientModel = new ClientModel();
        $clientId    = session()->get('client_id');
        $montant     = $this->request->getPost('montant');

        if (! $clientId) {
            return redirect()->to('/login');
        }
        if (! is_numeric($montant) || $montant <= 0) {
            return redirect()->back()->withInput()->with('errors', ['Montant invalide.']);
        }
        $client = $clientModel->find($clientId);
        if (! $client) {
            return redirect()->to('/login')->with('error', 'Client introuvable.');
        }
        $fraisModel = new FraisModel();
        $frais      = $fraisModel->where('idoperation', 1)
            ->where('idnotreoperateur', session()->get('operateur')['id'])
            ->where('montantmin <=', $montant)
            ->where('montantmax >=', $montant)
            ->first();

        $fraisMontant = $frais ? $frais['frais'] : 0;
        $nouveauSolde = $client['solde'] + $montant - $fraisMontant;

        $clientModel->update($clientId, ['solde' => $nouveauSolde]);

        $db = \Config\Database::connect();
        $db->table('Historique')->insert([
            'idclient'    => $clientId,
            'idoperation' => 1,
            'montant'     => $montant,
            'frais'       => $fraisMontant,
        ]);

        return redirect()->to('/client')->with('success', 'Depot effectue avec succes.');
    }
}
