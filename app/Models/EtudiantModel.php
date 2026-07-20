<?php
namespace App\Models;
use CodeIgniter\Model;

class EtudiantModel extends Model
{
    public function getAllEtudiants(){
        $etudiants = ["Kenny", "OPs", "dpd"];
        return $etudiants;
    }
}