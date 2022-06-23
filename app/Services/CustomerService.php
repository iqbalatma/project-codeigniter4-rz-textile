<?php

namespace App\Services;

use App\Models\Customers;
use App\Models\LogActivity;
use Exception;

class CustomerService
{
  public static function store($data)
  {
    try {
      $customerModel = new Customers();
      $customer_name = $data["customer_name"];
      $data = [
        "customer_NIK" => $data["customer_NIK"],
        "customer_name" => $customer_name,
        "address" => $data["address"],
        "no_hp" => $data["no_hp"],
      ];
      $customerModel->insert($data);
      LogService::setLogSuccess("STORE",   "Customer $customer_name  BERHASIL ditambahkan");

      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("STORE", "Customer $customer_name GAGAL ditambahkan. Error : $e");
      return false;
    }
  }

  public static function update($data)
  {
    try {
      $customerModel = new Customers();

      $customer_name = $data["customer_name"];
      $customer_id = $data['customer_id'];

      $customerModel->update($customer_id,  [
        "customer_NIK" => $data["customer_NIK"],
        "customer_name" => $customer_name,
        "address" => $data["address"],
        "no_hp" => $data["no_hp"]
      ]);

      LogService::setLogSuccess("UPDATE", "Konsumen $customer_name BERHASIL diperbaharui");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("UPDATE", "Konsumen $customer_name GAGAL diperbaharui. Error : $e");
      return false;
    }
  }

  public static function destroy($data)
  {
    try {
      $customerModel = new Customers();
      $customer_id = $data["customer_id"];
      $customer_name = $data["customer_name"];
      $customerModel->update($customer_id, ["is_deleted" => 1]);
      LogService::setLogSuccess("DELETE", "Konsumen  $customer_name  BERHASIL dihapus");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("DELETE", "Konsumen  $customer_name  Gagal dihapus. Error : $e");
      return false;
    }
  }
}
