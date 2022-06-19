<?php

namespace App\Services;

use App\Models\Rolls;
use App\Models\RollTransaction;
use Exception;

class RollTransactionService
{
  public static function store($data): bool
  {
    $rollId = $data["roll_id"];
    $rollQuantity = $data["roll_quantity"];
    $allQuantity = $data["all_quantity"];
    $rollModel = new Rolls();
    $rollTransactionModel = new RollTransaction();


    try {
      $rollData = $rollModel->find($rollId);
      $oldRollQuantity = $rollData["roll_quantity"];
      $oldAllQuantity = $rollData["all_quantity"];
      $rollCode = $rollData["roll_code"];

      $rollModel->update($rollId, ["roll_quantity" => $oldRollQuantity + $rollQuantity, "all_quantity" => $oldAllQuantity + $allQuantity]);
      $rollTransactionModel->insert([
        "roll_id" => $rollId,
        "transaction_type" => 0, //keluar
        "transaction_quantity" => $rollQuantity,
        "transaction_quantity_total" => $allQuantity,
        "sub_total" => null,
        "invoice_id" => null,
        "is_deleted" => 0,
      ]);

      LogService::setLog("Aktifitas Transaksi Roll", "Transaksi masuk " . $rollCode . " sejumlah " . $rollQuantity . " Roll Berhasil dilakukan", "success");
      return true;
    } catch (Exception $e) {
      LogService::setLog("Aktifitas Transaksi Roll gagal", "Transaksi masuk  $rollCode sejumlah $rollQuantity roll gagal dilakukan. Error : $e", "danger");
      return false;
    }
  }

  public static function getShowData(): array
  {
    $rollTransactionModel = new RollTransaction();
    $data = [
      "title" => "Transaksi Roll",
      "rollTransactionsOut" => $rollTransactionModel->getAllRollTransactions(null, null, "out"),
      "rollTransactions" => $rollTransactionModel->getAllRollTransactions(null, null, "in"),
    ];
    return $data;
  }

  public static function getEditData(): array
  {
    $rollModel = new Rolls();
    return [
      "title" => "Restok Roll",
      "dataRolls" => $rollModel->getAllDataRolls(),
    ];
  }
}
