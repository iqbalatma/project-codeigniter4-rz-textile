<?php

namespace App\Models;

use CodeIgniter\Model;

class Units extends Model
{
    protected $table      = 'units';
    protected $primaryKey = 'unit_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['unit_id', 'unit_name', 'unit_code', 'is_deleted'];
}
