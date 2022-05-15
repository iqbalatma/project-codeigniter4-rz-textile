<?php

namespace App\Models;

use CodeIgniter\Model;

class LogActivity extends Model
{
    protected $table      = 'log_activity';
    protected $primaryKey = 'log_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['log_id', 'log_name', 'log_description', 'log_tr_collor', 'log_date', 'user_id'];

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function get100LogActivity()
    {
        $builder = db_connect()->table($this->table);
        $builder->select('*');
        $builder->join('users', 'users.user_id = log_activity.user_id', 'left');
        $builder->orderBy('log_id', 'DESC');
        $builder->limit(100);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
