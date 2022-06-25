<?php

namespace App\Services;

use App\Models\Rolls;
use App\Models\RollTransaction;
use Exception;

class RollTransactionService
{

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
    return [
      "title" => "Restok Roll",
      "dataRolls" => (new Rolls())->getAllDataRolls(),
    ];
  }

  //!need improvement so i dont have to call the old data
  public static function store($data): bool
  {
    try {
      $rollModel = new Rolls();

      //new roll data
      $rollId = $data["roll_id"];
      $rollQuantity = $data["roll_quantity"];
      $allQuantity = $data["all_quantity"];

      //old roll data
      $rollData = $rollModel->find($rollId);
      $oldRollQuantity = $rollData["roll_quantity"];
      $oldAllQuantity = $rollData["all_quantity"];
      $rollCode = $rollData["roll_code"];

      $rollModel->update($rollId, ["roll_quantity" => $oldRollQuantity + $rollQuantity, "all_quantity" => $oldAllQuantity + $allQuantity]);
      (new RollTransaction())->insert([
        "roll_id" => $rollId,
        "transaction_type" => 0, //keluar
        "transaction_quantity" => $rollQuantity,
        "transaction_quantity_total" => $allQuantity,
        "sub_total" => null,
        "invoice_id" => null,
        "is_deleted" => 0,
      ]);

      LogService::setLogSuccess("STORE", "Transaksi masuk $rollCode sejumlah $rollQuantity Roll Berhasil dilakukan");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("STORE", "Transaksi masuk  $rollCode sejumlah $rollQuantity roll gagal dilakukan. Error : $e");
      return false;
    }
  }
}
