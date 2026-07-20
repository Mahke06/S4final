<?php
namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table = '';
    protected $allowedFields = ['nom', 'prix']; 
}