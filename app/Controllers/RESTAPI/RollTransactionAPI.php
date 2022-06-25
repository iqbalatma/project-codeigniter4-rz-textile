<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;
use App\Services\RollTransactionService;
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
        return $this->respond(
            RollTransactionService::getDataTransactionMonthly($this->request->getGet("month"), $this->request->getGet("year")),
            200
        );
    }

    public function show($id)
    {
        return $this->respond(
            RollTransactionService::getTrasactionByInvoiceId($id),
            200
        );
    }
}
