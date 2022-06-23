<?php

namespace App\Services;

use App\Models\Units;
use Exception;

class UnitService
{
  public static function getShowData(): array
  {
    $unitModel = new Units();
    return  [
      "title" => "Data Unit",
      "units" => $unitModel->where("is_deleted", 0)->findAll(),
    ];
  }

  public static function store(array $data): bool
  {
    try {
      $unitModel = new Units();
      $unit_name = $data["unit_name"];
      $unit_code = $data["unit_code"];

      $unitModel->insert([
        "unit_name" => $unit_name,
        "unit_code" => $unit_code
      ]);
      LogService::setLogSuccess("STORE", "Tambah data satuan $unit_name BERHASIL");

      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("STORE", "Tambah data satuan $unit_name GAGAL. Error : $e");
      return false;
    }
  }

  public static function update(array $data, int $id): bool
  {
    try {
      $unitModel = new Units();

      $unit_code = $data["unit_code"];
      $unit_name = $data["unit_name"];

      $unitModel->update($id, [
        'unit_name' => $unit_name,
        'unit_code' => $unit_code,
      ]);

      LogService::setLogSuccess("UPDATE", "Update data satuan menjadi $unit_name BERHASIL");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("UPDATE", "Update data satuan $unit_name GAGAL. Error : $e");
      return false;
    }
  }

  public static function isCodeSame(array $data): bool
  {
    $unitModel = new Units();
    $unit_code = $data["unit_code"];
    $unit_id = $data["unit_id"];

    $unitCodeFromDB = $unitModel->find($unit_id)["unit_code"];

    if ($unitCodeFromDB == $unit_code) {
      return true;
    } else {
      return false;
    }
  }
}
