<?php

namespace App\Controllers;

use App\Models\ProduitModel;

class Produit extends BaseController
{
    public function index()
    {
        $model = new ProduitModel();
        $data['produit'] = $model->findAll();

        return view('produits', $data);
        // return "Liste des Produits";
    }   

    public function show($id)
    {
        return "Produit ID : " . $id; 
    }

    public function store()
    {
        $nom = $this->request->getPost('nom');

        return redirect()->to('/produits');
    }
}