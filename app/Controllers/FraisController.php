<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FraisModel;

class FraisController extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }
        $model = new FraisModel();
        $all   = $model->select('Frais.*, Operations.nom AS operation_nom')
            ->join('Operations', 'Operations.id = Frais.idoperation')
            ->orderBy('Frais.montantmin')
            ->findAll();
        $data['depot']     = array_filter($all, fn($f) => $f['idoperation'] == 1);
        $data['retrait']   = array_filter($all, fn($f) => $f['idoperation'] == 2);
        $data['transfert'] = array_filter($all, fn($f) => $f['idoperation'] == 3);
        return view('admin/page_frais', $data);
    }

    public function create()
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }
        $regles = [
            'idoperation' => 'required|integer',
            'montantmin'  => 'required|numeric',
            'montantmax'  => 'required|numeric',
            'frais'       => 'required|numeric',
        ];

        if (! $this->validate($regles)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $montantmin = (float) $this->request->getPost('montantmin');
        $montantmax = (float) $this->request->getPost('montantmax');

        if ($montantmin >= $montantmax) {
            return redirect()->back()->withInput()->with('errors', ['Le montant min doit être inferieur au montant max.']);
        }

        $model    = new FraisModel();
        $existing = $model->where('idoperation', $this->request->getPost('idoperation'))
            ->where('idnotreoperateur', 1)
            ->groupStart()
            ->where('montantmin <', $montantmax)
            ->where('montantmax >', $montantmin)
            ->groupEnd()
            ->first();

        if ($existing) {
            return redirect()->back()->withInput()->with('errors', ['Cet intervalle chevauche un existant.']);
        }

        $model->save([
            'idoperation' => $this->request->getPost('idoperation'),
            'idnotreoperateur' => 1,
            'montantmin'  => $montantmin,
            'montantmax'  => $montantmax,
            'frais'       => (float) $this->request->getPost('frais'),
        ]);

        return redirect()->to('/admin/frais');
    }

    public function edit($id)
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }
        $model = new FraisModel();
        $frais = $model->find($id);
        if (! $frais) {
            return redirect()->to('/admin/frais')->with('error', 'Frais introuvable.');
        }

        $data['frais']      = $frais;
        $db                 = \Config\Database::connect();
        $data['operations'] = $db->table('Operations')->get()->getResultArray();
        return view('admin/page_form', $data);
    }

    public function update($id)
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }
        $model = new FraisModel();
        $frais = $model->find($id);
        if (! $frais) {
            return redirect()->to('/admin/frais')->with('error', 'Frais introuvable.');
        }

        $regles = [
            'idoperation' => 'required|integer',
            'montantmin'  => 'required|numeric',
            'montantmax'  => 'required|numeric',
            'frais'       => 'required|numeric',
        ];

        if (! $this->validate($regles)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $montantmin = (float) $this->request->getPost('montantmin');
        $montantmax = (float) $this->request->getPost('montantmax');

        if ($montantmin >= $montantmax) {
            return redirect()->back()->withInput()->with('errors', ['Le montant min doit être inferieur au montant max.']);
        }

        $existing = $model->where('idoperation', $this->request->getPost('idoperation'))
            ->where('idnotreoperateur', 1)
            ->where('id !=', $id)
            ->groupStart()
            ->where('montantmin <', $montantmax)
            ->where('montantmax >', $montantmin)
            ->groupEnd()
            ->first();

        if ($existing) {
            return redirect()->back()->withInput()->with('errors', ['Cet intervalle chevauche un existant.']);
        }

        $model->update($id, [
            'idoperation' => $this->request->getPost('idoperation'),
            'idnotreoperateur' => 1,
            'montantmin'  => $montantmin,
            'montantmax'  => $montantmax,
            'frais'       => (float) $this->request->getPost('frais'),
        ]);

        return redirect()->to('/admin/frais');
    }

    public function delete($id)
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }
        $model = new FraisModel();
        $frais = $model->find($id);
        if (! $frais) {
            return redirect()->to('/admin/frais')->with('error', 'Frais introuvable.');
        }

        $model->delete($id);
        return redirect()->to('/admin/frais');
    }

    public function gains()
    {
        if (!session()->get('admin_id')) { return redirect()->to('/loginOp'); }
        $db = \Config\Database::connect();

        $gains = $db->query("
            SELECT
                CASE WHEN o.id = 4 THEN 'Autre' ELSE 'Nous' END AS type,
                o.nom AS operation,
                SUM(h.frais) AS total
            FROM Historique h
            JOIN Client c ON c.id = h.idclient
            JOIN Operations o ON o.id = h.idoperation
            GROUP BY type, h.idoperation
            ORDER BY type, o.nom
        ")->getResultArray();

        $nos    = array_filter($gains, fn($g) => $g['type'] === 'Nous');
        $autres = array_filter($gains, fn($g) => $g['type'] === 'Autre');
        $totalGlobal = array_sum(array_column($gains, 'total'));

        return view('admin/page_gains', [
            'nos'          => $nos,
            'autres'       => $autres,
            'totalGlobal'  => $totalGlobal,
        ]);
    }
}
