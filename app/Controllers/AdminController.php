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

        $db = \Config\Database::connect();
        $data['nb_frais']     = $db->table('Frais')->countAllResults();
        $data['nb_commission'] = $db->table('Commission')->countAllResults();
        $data['nb_clients']   = $db->table('Client')
            ->join('NosPrefixes', 'SUBSTR(Client.telephone, 1, 3) = NosPrefixes.prefixe')
            ->countAllResults();
        $data['total_gains']  = $db->table('Historique')
            ->selectSum('frais')
            ->get()->getRow()->frais ?? 0;

        return view('admin/choix', $data);
    }

    public function clients()
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }
        $db = \Config\Database::connect();
        $data['clients'] = $db->query("
            SELECT c.* FROM Client c
            JOIN NosPrefixes np ON SUBSTR(c.telephone, 1, 3) = np.prefixe
            ORDER BY c.nom
        ")->getResultArray();
        return view('admin/page_clients', $data);
    }

    public function commission()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/loginOp');
        }
        $db = \Config\Database::connect();
        $data['commissions'] = $db->table('Commission')
            ->select('Commission.*, AutreOperateur.nom as operateur_nom')
            ->join('AutreOperateur', 'AutreOperateur.id = Commission.idautreoperateur', 'left')
            ->get()->getResultArray();
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

    public function promotion()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/loginOp');
        }
        $db = \Config\Database::connect();
        $data['promotion'] = $db->table('Promotion')
            ->select('Promotion.*')
            ->get()->getResultArray();
        return view('admin/promotion', $data);
    }

    public function ajoutPromo()
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }

        $promotion      = $this->request->getPost('promotion');

       

        $db = \Config\Database::connect();
        $db->table('Promotion')->insert([
            'promotion'      => (float) $promotion,
        ]);

        return redirect()->to('/admin/promotion');
    }

     public function updatePromotion($id)
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }

        $promotion = $this->request->getPost('promotion');

        if (!is_numeric($promotion) || $promotion < 0) {
            return redirect()->back()->withInput()->with('errors', ['PROMO invalide.']);
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('Promotion');
        $builder->where('id', $id);
        $builder->update(['promotion' => (float) $promotion]);

        return redirect()->to('/admin/promotion');
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
        $db = \Config\Database::connect();
        $tous = $db->table('NosPrefixes')
            ->select('NosPrefixes.*, NotreOperateur.nom AS operateur')
            ->join('NotreOperateur', 'NotreOperateur.id = NosPrefixes.idnotreoperateur')
            ->orderBy('NosPrefixes.id', 'DESC')
            ->get()->getResultArray();
        $data['actuel'] = $tous[0] ?? null;
        $data['anciens'] = array_slice($tous, 1);
        return view('admin/prefixe', $data);
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
