<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;

use CodeIgniter\API\ResponseTrait;

class ProfitApi extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->rollModel = new \App\Models\Rolls();
        $this->db = \Config\Database::connect();
    }

    public function show($type, $id)
    {
        $data = $this->rollTransactionModel->getFinanceByRollId($id);
        $response = [
            "message" => "Berhasil melakukan request data",
            "status_code" => "200",
            "status" => "success",
            "data" => $data
        ];
        return $this->respond($response, 200);
    }
}
