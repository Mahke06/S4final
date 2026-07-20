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
        return view('login');
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
                'rules'  => 'required|exact_length[10]|numeric|regex_match[/^03[2-4]\d{7}$/]',
                'errors' => [
                    'required'    => 'Le téléphone est obligatoire.',
                    'exact_length'=> 'Le téléphone doit avoir 10 chiffres.',
                    'numeric'     => 'Ne doit contenir que des chiffres.',
                    'regex_match' => 'Numéro invalide (032/033/034 requis).',
                ],
            ],
        ];
        if (! $this->validate($regles)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new ClientModel();
        $client = $model->where('telephone', $telephone)->first();
        $operateur = $model->getOperateur($telephone);

        if (! $client) {
            return redirect()->back()->withInput()->with('errors',['Numero non existant.']);
        }

        session()->set('client_id', $client['id']);
        session()->set('operateur', $operateur);

        return redirect()->to('/client');
    }

     public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}