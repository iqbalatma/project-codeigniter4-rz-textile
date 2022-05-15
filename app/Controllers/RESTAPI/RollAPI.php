<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;
use App\Models\Users;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class RollAPI extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->rollModel = new \App\Models\Rolls();
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->invoiceModel = new \App\Models\Invoices();
        $this->db = \Config\Database::connect();
        $this->generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
    }

    public function index()
    {
        $data = $this->rollModel->getAllDataRolls();
        return $this->respond($data, 200);
    }
    public function show($id)
    {
        $data = $this->rollModel->getRollById($id);
        return $this->respond($data, 200);
    }
}
