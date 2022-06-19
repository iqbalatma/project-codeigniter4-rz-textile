<?php

namespace App\Services;

use App\Models\Customers;
use App\Models\LogActivity;
use Exception;

class CustomerService
{
  public static function store($data)
  {
    $customerModel = new Customers();
    $customer_name = $data["customer_name"];
    try {
      $data = [
        "customer_NIK" => $data["customer_NIK"],
        "customer_name" => $customer_name,
        "address" => $data["address"],
        "no_hp" => $data["no_hp"],
      ];
      $customerModel->insert($data);
      LogService::setLog("Aktifitas Tambah Konsumen BERHASIL",   "Customer $customer_name  BERHASIL ditambahkan", "success");

      return true;
    } catch (Exception $e) {
      LogService::setLog("Aktifitas Tambah Konsumen GAGAL", "Customer $customer_name GAGAL ditambahkan. Error : $e", "danger");
      return false;
    }
  }

  public static function update($data)
  {

    $customer_name = $data["customer_name"];
    $customer_id = $data['customer_id'];
    $customerModel = new Customers();

    try {
      $data = [
        "customer_NIK" => $data["customer_NIK"],
        "customer_name" => $customer_name,
        "address" => $data["address"],
        "no_hp" => $data["no_hp"]
      ];
      $customerModel->update($customer_id, $data);

      LogService::setLog("Aktifitas update konsumen BERHASIL", "Konsumen $customer_name BERHASIL diperbaharui", "success");
      return true;
    } catch (Exception $e) {
      LogService::setLog("Aktifitas update konsumen GAGAL", "Konsumen $customer_name GAGAL diperbaharui. Error : $e", "danger");
      return false;
    }
  }

  public static function destroy($data)
  {
    $customer_id = $data["customer_id"];
    $customer_name = $data["customer_name"];
    $customerModel = new Customers();

    try {
      $customerModel->update($customer_id, ["is_deleted" => 1]);
      LogService::setLog("Aktifitas hapus konsumen BERHASIL", "Konsumen  $customer_name  BERHASIL dihapus", "success");
      return true;
    } catch (Exception $e) {
      LogService::setLog("Aktifitas hapus konsumen GAGAL", "Konsumen  $customer_name  Gagal dihapus. Error : $e", "danger");
      return false;
    }
  }
}
