<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        if (session()->get('admin_id')) {
            return redirect()->to('/admin');
        }
        return view('admin/login');
    }

    public function login()
    {
        if (session()->get('admin_id')) {
            return redirect()->to('/admin');
        }

        $login    = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $db    = \Config\Database::connect();
        $admin = $db->table('Admin')->where('login', $login)->get()->getRowArray();

        if (!$admin || !password_verify($password, $admin['password'])) {
            return redirect()->back()->withInput()->with('errors', ['Identifiants incorrects.']);
        }

        session()->set('admin_id', $admin['id']);
        return redirect()->to('/admin');
    }

    public function choix()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/loginOp');
        }
        return view('admin/choix');
    }

    public function commission()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/loginOp');
        }
        $db = \Config\Database::connect();
        $data['autreOperateurs'] = $db->table('AutreOperateur')->get()->getResultArray();
        return view('admin/commission', $data);
    }

    public function ajoutCommission()
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }

        $idautreoperateur = $this->request->getPost('idautreoperateur');
        $pourcentage      = $this->request->getPost('pourcentage');

        if (!is_numeric($pourcentage) || $pourcentage < 0) {
            return redirect()->back()->withInput()->with('errors', ['Pourcentage invalide.']);
        }

        $db = \Config\Database::connect();
        $db->table('Commission')->insert([
            'idautreoperateur' => $idautreoperateur,
            'pourcentage'      => (float) $pourcentage,
        ]);

        return redirect()->to('/admin/commission');
    }

    public function updateCommission($id)
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }

        $pourcentage = $this->request->getPost('pourcentage');

        if (!is_numeric($pourcentage) || $pourcentage < 0) {
            return redirect()->back()->withInput()->with('errors', ['Pourcentage invalide.']);
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('Commission');
        $builder->where('id', $id);
        $builder->update(['pourcentage' => (float) $pourcentage]);

        return redirect()->to('/admin/commission');
    }

    public function deleteCommission($id)
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }

        $db = \Config\Database::connect();
        $db->table('Commission')->delete(['id' => $id]);

        return redirect()->to('/admin/commission');
    }

    public function prefixe()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/loginOp');
        }
        return view('admin/prefixe');
    }

    public function updatePrefixe()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/loginOp');
        }

        $prefixe = $this->request->getPost('prefixe');

        if (!preg_match('/^03\d$/', $prefixe)) {
            return redirect()->back()->withInput()->with('errors', ['Prefixe invalide (ex: 032).']);
        }

        $db = \Config\Database::connect();
        $db->table('NosPrefixes')->insert([
            'idnotreoperateur' => 1,
            'prefixe'          => $prefixe,
        ]);

        return redirect()->to('/admin/prefixe');
    }

    public function logout()
    {
        session()->remove('admin_id');
        return redirect()->to('/loginOp');
    }
}
