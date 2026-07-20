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

        $row = $this->db->table('NosPrefixes')
            ->select('NotreOperateur.id, NotreOperateur.nom, \'nous\' AS type')
            ->join('NotreOperateur', 'NotreOperateur.id = NosPrefixes.idnotreoperateur')
            ->where('NosPrefixes.prefixe', $prefixe)
            ->get()
            ->getRowArray();

        if ($row) return $row;

        return $this->db->table('AutrePrefixe')
            ->select('AutreOperateur.id, AutreOperateur.nom, \'autre\' AS type')
            ->join('AutreOperateur', 'AutreOperateur.id = AutrePrefixe.idautreoperateur')
            ->where('AutrePrefixe.prefixe', $prefixe)
            ->get()
            ->getRowArray();
    }
}
