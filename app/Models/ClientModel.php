<?php
namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table            = 'Client';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nom', 'prenom', 'telephone', 'solde'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts        = [];
    protected array $castHandlers = [];

    public function getOperateur($telephone)
    {
        $prefixe = substr($telephone, 0, 3);
        return $this->db->table('Prefixes')
            ->select('Operateurs.*')
            ->join('Operateurs', 'Operateurs.id = Prefixes.idoperateur')
            ->where('Prefixes.prefixe', $prefixe)
            ->get()
            ->getRowArray();
    }
}
