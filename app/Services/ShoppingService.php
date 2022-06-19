<?php

namespace App\Services;

use App\Models\Customers;
use App\Models\Rolls;

class ShoppingService
{
  public static function getShowData(): array
  {
    $rollModel = new Rolls();
    $customerModel = new Customers();

    return  [
      "title" => "Penjualan",
      "dataRolls" => $rollModel->getAllDataRollsIsNotEmpty(),
      "dataCustomers" => $customerModel->where("is_deleted", 0)->findAll(),
    ];
  }
}
