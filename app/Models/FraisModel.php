<?php
namespace App\Models;

use CodeIgniter\Model;

class FraisModel extends Model
{
    protected $table = 'Frais';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idoperation', 'idoperateur', 'montantmin', 'montantmax', 'frais'];


    public function Operateursetoperation(){
        return $this->select('Frais.*, Operateurs.nom AS operateur_nom, Operations.nom AS operation_nom')
                    ->join('Operateurs', 'Operateurs.id = Frais.idoperateur')
                    ->join('Operations', 'Operations.id = Frais.idoperation')
                    ->findAll();
    }
}
