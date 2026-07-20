<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClientModel;


class ClientController extends BaseController
{
    public function index()
    {
        if (session()->get('client_id')) {
            return redirect()->to('/client');
        }
        return view('login', ['hideNavbar' => true]);
    }

    public function accueil()
    {
        $clientId = session()->get('client_id');
        if (! $clientId) {
            return redirect()->to('/login');
        }

        $model = new ClientModel();
        $client = $model->find($clientId);

        if (! $client) {
            session()->destroy();
            return redirect()->to('/login');
        }

        return view('client', ['client' => $client]);
    }

    public function login()
    {
        $telephone = $this->request->getPost('telephone');

        $regles = [
            'telephone' => [
                'rules'  => 'required|exact_length[10]|numeric',
                'errors' => [
                    'required'    => 'Le téléphone est obligatoire.',
                    'exact_length'=> 'Le téléphone doit avoir 10 chiffres.',
                    'numeric'     => 'Ne doit contenir que des chiffres.',
                ],
            ],
        ];
        if (! $this->validate($regles)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $prefixe = substr($telephone, 0, 3);
        $db = \Config\Database::connect();
        $estNotrePrefixe = $db->table('NosPrefixes')->where('prefixe', $prefixe)->countAllResults() > 0;

        if (! $estNotrePrefixe) {
            return redirect()->back()->withInput()->with('errors', ['Verifier numero.']);
        }

        $model = new ClientModel();
        $client = $model->where('telephone', $telephone)->first();

        if (! $client) {
            return redirect()->back()->withInput()->with('errors',['Verifier numero.']);
        }

        $operateur = $model->getOperateur($telephone);

        session()->set('client_id', $client['id']);
        session()->set('operateur', $operateur);

        return redirect()->to('/client');
    }

    public function historique()
    {
        $clientId = session()->get('client_id');
        if (!$clientId) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $historique = $db->table('Historique')
            ->select('Historique.*, Operations.nom as operation_nom')
            ->join('Operations', 'Operations.id = Historique.idoperation')
            ->where('Historique.idclient', $clientId)
            ->orderBy('Historique.date', 'DESC')
            ->get()
            ->getResultArray();

        return view('historique', ['historique' => $historique]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}