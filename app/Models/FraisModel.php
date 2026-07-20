<?php
namespace App\Models;

use CodeIgniter\Model;

class FraisModel extends Model
{
    protected $table = 'Frais';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idoperation', 'idnotreoperateur', 'montantmin', 'montantmax', 'frais'];
}
