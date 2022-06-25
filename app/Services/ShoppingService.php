<?php

namespace App\Services;

use App\Models\Customers;
use App\Models\Rolls;

class ShoppingService
{
  public static function getShowData(): array
  {
    return  [
      "title" => "Penjualan",
      "dataRolls" => (new Rolls())->getAllDataRollsIsNotEmpty(),
      "dataCustomers" => (new Customers())->where("is_deleted", 0)->findAll(),
    ];
  }
}
