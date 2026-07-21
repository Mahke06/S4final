<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClientModel;
use App\Models\FraisModel;

class TransfertController extends BaseController
{
    public function index()
    {
        if (! session()->get('client_id')) {
            return redirect()->to('/login');
        }

        return view('transfert');
    }

    public function faireTransfert()
    {
        $clientModel = new ClientModel();
        $fraisModel = new FraisModel();
        $clientId = session()->get('client_id');
        $montant = $this->request->getPost('montant');
        $telephoneDestinataire = $this->request->getPost('telephone_destinataire');
        $inclureFrais = $this->request->getPost('inclure_frais');

        if (!$clientId) {
            return redirect()->to('/login');
        }
        if (!is_numeric($montant) || $montant <= 0) {
            return redirect()->back()->withInput()->with('errors', ['Montant invalide.']);
        }
        $client = $clientModel->find($clientId);
        if (!$client) {
            return redirect()->to('/login')->with('error', 'Client introuvable.');
        }

        $destinataire = $clientModel->where('telephone', $telephoneDestinataire)->first();
        if (!$destinataire) {
            return redirect()->back()->withInput()->with('errors', ['Destinataire introuvable.']);
        }

        $operateurSession = session()->get('operateur')['id'];
        $operateurDest = $clientModel->getOperateur($telephoneDestinataire);
        $memeOperateur = $operateurDest && $operateurDest['type'] === 'nous';

        $montantEnvoye = $montant;
        $fraisRetrait = 0;

        $fraisRow = $fraisModel
            ->where('idoperation', 3)
            ->where('idnotreoperateur', $operateurSession)
            ->where('montantmin <=', $montant)
            ->where('montantmax >=', $montant)
            ->first();
        $fraisTransfert = $fraisRow ? $fraisRow['frais'] : 0;

        if ($inclureFrais && $memeOperateur) {
            $fraisRetraitRow = $fraisModel
                ->where('idoperation', 2)
                ->where('idnotreoperateur', $operateurSession)
                ->where('montantmin <=', $montant)
                ->where('montantmax >=', $montant)
                ->first();
            $fraisRetrait = $fraisRetraitRow ? $fraisRetraitRow['frais'] : 0;

            $montantEnvoye = $montant + $fraisRetrait;

            $fraisRow = $fraisModel
                ->where('idoperation', 3)
                ->where('idnotreoperateur', $operateurSession)
                ->where('montantmin <=', $montantEnvoye)
                ->where('montantmax >=', $montantEnvoye)
                ->first();
            $fraisTransfert = $fraisRow ? $fraisRow['frais'] : 0;
        } elseif ($inclureFrais) {
            session()->setFlashdata('warning',
                'Option inclure frais disponible uniquement pour le même opérateur.');
        }

        $commission = 0;
        if ($operateurDest && $operateurDest['type'] === 'autre') {
            $db = \Config\Database::connect();
            $commissionRow = $db->table('Commission')
                ->where('idautreoperateur', $operateurDest['id'])
                ->get()->getRowArray();
            if ($commissionRow) {
                $commission = $montantEnvoye * $commissionRow['pourcentage'] / 100;
            }
        }

        $promotion = 0;
        if ($operateurDest && $operateurDest['type'] === 'nous') {
            $db = \Config\Database::connect();
            $promotionRow = $db->table('Promotion')
                ->get()->getRowArray();
            if ($promotionRow) {
                $promotion = $fraisTransfert * $promotionRow['promotion'] / 100;
            }
        }

        $totalADebiter = $montantEnvoye + $fraisTransfert + $commission - $promotion;

        if ($client['solde'] < $totalADebiter) {
            return redirect()->back()->withInput()->with('errors', [
                'Solde insuffisant'
            ]);
        }

        $clientModel->update($clientId, ['solde' => $client['solde'] - $totalADebiter]);
        $clientModel->update($destinataire['id'], ['solde' => $destinataire['solde'] + $montantEnvoye]);

        $db = \Config\Database::connect();
        $db->table('Historique')->insert([
            'idclient'    => $clientId,
            'idoperation' => 3,
            'montant'     => $montantEnvoye,
            'frais'       => $fraisTransfert,
        ]);

        if ($fraisRetrait > 0) {
            $db->table('Historique')->insert([
                'idclient'    => $clientId,
                'idoperation' => 2,
                'montant'     => $fraisRetrait,
                'frais'       => 0,
            ]);
        }

        if ($commission > 0) {
            $db->table('Historique')->insert([
                'idclient'    => $clientId,
                'idoperation' => 4,
                'montant'     => $montantEnvoye,
                'frais'       => $commission,
            ]);
        }

        $msg = 'Transfert effectué avec succès.';
        if ($fraisRetrait > 0) {
            $msg .= ' (Frais retrait inclus)';
        }
        if ($commission > 0) {
            $msg .= ' (Commission inter-operateur appliquee)';
        }

        return redirect()->to('/client')->with('success', $msg);
    }





    public function multiple()
    {
        if (!session()->get('client_id')) {
            return redirect()->to('/login');
        }
        return view('transfert_multiple');
    }

    public function faireTransfertMultiple()
    {
        $clientModel = new ClientModel();
        $fraisModel = new FraisModel();
        $clientId = session()->get('client_id');
        $montantTotal = $this->request->getPost('montant_total');
        $numeros = $this->request->getPost('numeros');

        if (!$clientId) { 
            return redirect()->to('/login'); 
            }

        if (!is_numeric($montantTotal) || $montantTotal <= 0) { 
            return redirect()->back()->withInput()->with('errors', ['Montant invalide.']); 
        }

        if (!$numeros || count($numeros) < 2) { 
            return redirect()->back()->withInput()->with('errors', ['Ajoutez au moins 2 numéros.']); 
        }

        $client = $clientModel->find($clientId);
        if (!$client) { 
            return redirect()->to('/login')->with('error', 'Client introuvable.'); 
        }

        $idOperateur = session()->get('operateur')['id'];
        $montantParPersonne = $montantTotal / count($numeros);

        $destinataires = [];
        foreach ($numeros as $tel) {
            $tel = trim($tel);
            if (!$tel) { 
                continue; 
            }

            $dest = $clientModel->where('telephone', $tel)->first();
            if (!$dest) { 
                return redirect()->back()->withInput()->with('errors', ["Le numéro $tel est introuvable."]); 
            }

            $opDest = $clientModel->getOperateur($tel);
            if (!$opDest || $opDest['type'] !== 'nous') { 
                return redirect()->back()->withInput()->with('errors', ["Tous les numéros doivent appartenir au même opérateur."]); 
            }

            $destinataires[] = $dest;
        }

        if (count($destinataires) < 2) { 
            return redirect()->back()->withInput()->with('errors', ['Ajoutez au moins 2 numéros.']); 
        }

        $row = $fraisModel->where('idoperation', 3)->where('idnotreoperateur', $idOperateur)
            ->where('montantmin <=', $montantParPersonne)->where('montantmax >=', $montantParPersonne)
            ->first();
        $fraisUnitaire = $row ? $row['frais'] : 0;
        $fraisTotal = $fraisUnitaire * count($destinataires);
        $totalADebiter = $montantTotal + $fraisTotal;

        if ($client['solde'] < $totalADebiter) { 
            return redirect()->back()->withInput()->with('errors', ['Solde insuffisant']); 
        }

        $clientModel->update($clientId, ['solde' => $client['solde'] - $totalADebiter]);

        $db = \Config\Database::connect();
        foreach ($destinataires as $dest) {
            $clientModel->update($dest['id'], ['solde' => $dest['solde'] + $montantParPersonne]);
            $db->table('Historique')->insert([
                'idclient'    => $clientId,
                'idoperation' => 3,
                'montant'     => $montantParPersonne,
                'frais'       => $fraisUnitaire,
            ]);
        }

        return redirect()->to('/client')->with('success',
            'Transfert multiple effectué. ' . count($destinataires) . ' destinataire(s) servis.');
    }
}
