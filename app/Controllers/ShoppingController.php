<?php

namespace App\Controllers;

class ShoppingController extends BaseController
{

    public function __construct()
    {
        $this->rollModel = new \App\Models\Rolls();
        $this->customerModel = new \App\Models\Customers();
    }
    public function show()
    {
        return view('shopping/index', [
            "title" => "Penjualan",
            "dataRolls" => $this->rollModel->getAllDataRollsIsNotEmpty(),
            "dataCustomers" => $this->customerModel->where("is_deleted", 0)->findAll(),
        ]);
    }
}
