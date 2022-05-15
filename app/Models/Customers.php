<?php

namespace App\Models;

use CodeIgniter\Model;

class Customers extends Model
{
    protected $table      = 'customers';
    protected $primaryKey = 'customer_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['customer_NIK', 'customer_name', 'address', 'no_hp', 'updated_at', 'is_deleted'];
}
