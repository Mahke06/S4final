<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FraisModel;

class FraisController extends BaseController
{
    public function index()
    {
        $model              = new FraisModel();
        $data['frais']      = $model->Operateursetoperation();
        $db                 = \Config\Database::connect();
        $data['operateurs'] = $db->table('Operateurs')->get()->getResultArray();
        $data['operations'] = $db->table('Operations')->get()->getResultArray();
        return view('frais/index', $data);
    }

    public function add()
    {
        $db                 = \Config\Database::connect();
        $data['operateurs'] = $db->table('Operateurs')->get()->getResultArray();
        $data['operations'] = $db->table('Operations')->get()->getResultArray();
        return view('frais/form', $data);
    }

    public function create()
    {
        $regles = [
            'idoperation' => 'required|integer',
            'idoperateur' => 'required|integer',
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
            ->where('idoperateur', $this->request->getPost('idoperateur'))
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
            'idoperateur' => $this->request->getPost('idoperateur'),
            'montantmin'  => $montantmin,
            'montantmax'  => $montantmax,
            'frais'       => (float) $this->request->getPost('frais'),
        ]);

        return redirect()->to('/frais');
    }

    public function edit($id)
    {
        $model = new FraisModel();
        $frais = $model->find($id);
        if (! $frais) {
            return redirect()->to('/frais')->with('error', 'Frais introuvable.');
        }

        $data['frais']      = $frais;
        $db                 = \Config\Database::connect();
        $data['operateurs'] = $db->table('Operateurs')->get()->getResultArray();
        $data['operations'] = $db->table('Operations')->get()->getResultArray();
        return view('frais/form', $data);
    }

    public function update($id)
    {
        $model = new FraisModel();
        $frais = $model->find($id);
        if (! $frais) {
            return redirect()->to('/frais')->with('error', 'Frais introuvable.');
        }

        $regles = [
            'idoperation' => 'required|integer',
            'idoperateur' => 'required|integer',
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
            ->where('idoperateur', $this->request->getPost('idoperateur'))
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
            'idoperateur' => $this->request->getPost('idoperateur'),
            'montantmin'  => $montantmin,
            'montantmax'  => $montantmax,
            'frais'       => (float) $this->request->getPost('frais'),
        ]);

        return redirect()->to('/frais');
    }

    public function delete($id)
    {
        $model = new FraisModel();
        $frais = $model->find($id);
        if (! $frais) {
            return redirect()->to('/frais')->with('error', 'Frais introuvable.');
        }

        $model->delete($id);
        return redirect()->to('/frais');
    }

    public function gains()
    {
        $db = \Config\Database::connect();
        $gains = $db->table('Historique')
            ->select('Operations.nom, SUM(Historique.frais) AS total')
            ->join('Operations', 'Operations.id = Historique.idoperation')
            ->groupBy('Historique.idoperation')
            ->get()
            ->getResultArray();

        $totalGlobal = array_sum(array_column($gains, 'total'));

        return view('frais/gains', ['gains' => $gains, 'totalGlobal' => $totalGlobal]);
    }
}
