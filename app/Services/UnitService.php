<?php

namespace App\Services;

use App\Models\Units;
use Exception;

class UnitService
{
  public static function getShowData(): array
  {
    return  [
      "title" => "Data Unit",
      "units" => (new Units())->where("is_deleted", 0)->findAll(),
    ];
  }

  public static function store(array $data): bool
  {
    try {
      $unit_name = $data["unit_name"];
      $unit_code = $data["unit_code"];

      (new Units())->insert([
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
      $unit_code = $data["unit_code"];
      $unit_name = $data["unit_name"];

      (new Units())->update($id, [
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
    $unit_code = $data["unit_code"];
    $unit_id = $data["unit_id"];

    $unitCodeFromDB = (new Units())->find($unit_id)["unit_code"];

    if ($unitCodeFromDB == $unit_code) {
      return true;
    } else {
      return false;
    }
  }
}
