<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;

use CodeIgniter\API\ResponseTrait;

class RollTransactionAPI extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->rollModel = new \App\Models\Rolls();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $year = $this->request->getGet("year");
        $month = $this->request->getGet("month");
        $data = [
            "rollTransactionsOut" => $this->rollTransactionModel->getAllRollTransactions($month, $year, "out"),
            "rollTransactions" => $this->rollTransactionModel->getAllRollTransactions($month, $year, "in"),
        ];
        return $this->respond($data, 200);
    }

    public function show($id)
    {
        $data = $this->rollTransactionModel->getRollTransactionById($id);
        return $this->respond($data, 200);
    }
}
