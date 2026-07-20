<?php

namespace App\Controllers;

use App\Models\EtudiantModel;

class Etudiant extends BaseController
{
    public function index(){
        $model = new EtudiantModel();

        $data['etudiant'] = $model->getAllEtudiants();
        return view('etudiants', $data);
    }
    // $model = new EtudiantModel();
}