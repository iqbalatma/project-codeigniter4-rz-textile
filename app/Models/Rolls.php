<?php

namespace App\Models;

use CodeIgniter\Model;

class Rolls extends Model
{
    protected $table      = 'rolls';
    protected $primaryKey = 'roll_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['roll_code', 'roll_name', 'barcode_code', 'unit_quantity', 'roll_quantity', 'basic_price', 'selling_price',  'category_model_id', 'updated_at', 'is_deleted', 'barcode_image', 'all_quantity', 'unit_id'];


    public function getAllDataRolls()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->join('units', 'rolls.unit_id= units.unit_id');
        $builder->where("rolls.is_deleted", 0);
        $query = $builder->get();
        return $query->getResultArray();
    }

    function getRollById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->join('units', 'rolls.unit_id= units.unit_id');
        $builder->where("rolls.is_deleted", 0);
        $builder->where("rolls.roll_id", $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    function getRollByBarcode($barcode)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->join('units', 'rolls.unit_id= units.unit_id');
        $builder->where("rolls.is_deleted", 0);
        $builder->where("rolls.barcode_code", $barcode);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllDataRollsIsNotEmpty()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->join('units', 'rolls.unit_id= units.unit_id');
        $builder->where("rolls.is_deleted", 0);
        $builder->where("rolls.roll_quantity > ", 0);
        $builder->where("rolls.all_quantity > ", 0);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
