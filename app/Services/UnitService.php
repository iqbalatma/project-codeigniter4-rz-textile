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
      LogService::setLog("Aktifitas Tambah Satuan", "Tambah data satuan $unit_name BERHASIL", "success");

      return true;
    } catch (Exception $e) {
      LogService::setLog("Aktifitas Tambah Satuan", "Tambah data satuan $unit_name GAGAL", "danger");
      return false;
    }
  }

  public static function update(array $data, int $id): bool
  {
    $unit_code = $data["unit_code"];
    $unit_name = $data["unit_name"];

    try {
      $unitModel = new Units();
      $unitModel->update($id, [
        'unit_name' => $unit_name,
        'unit_code' => $unit_code,
      ]);

      LogService::setLog("Aktifitas Update Data Satuan", "Update data satuan menjadi $unit_name BERHASIL", "success");
      return true;
      // return redirect()->route("unit.show")->with("success", "Satuan berhasil diperbaharui menjadi $unit_name");
    } catch (Exception $e) {
      LogService::setLog("Aktifitas Update Data Satuan", "Update data satuan $unit_name GAGAL. Error : $e", "danger");
      return false;
      // return redirect()->route("unit.show")->with("failed", "Satuan $unit_name gagal diperbaharui");
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
