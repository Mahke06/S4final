<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FraisController extends BaseController
{
    public function index()
    {
        $model = new FraisModel();
        $data['frais'] = $model->findAll();
        return view('frais/index', $data);
    }
}
