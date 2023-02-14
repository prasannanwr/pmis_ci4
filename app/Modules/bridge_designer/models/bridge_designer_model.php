<?php

namespace App\Modules\bridge_designer\Models;

use CodeIgniter\Model;

class bridge_designer_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bdr01bridge_designer_table';
    protected $primaryKey       = 'bdr01id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bdr01designer_id',
					       	'bdr01designer_name',
					       	'bdr01birth_date',
					       	'bdr01address',
					       	'bdr01agency_id',
					       	'bdr01description'
    ];
  
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}