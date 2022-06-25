<?php

namespace App\Services;

use App\Models\Invoices;
use App\Models\Rolls;
use App\Models\RollTransaction;

class RefundService
{

  public static function rollBackTransaction(int $invoiceId): array
  {
    $rollTransactionModel = new RollTransaction();
    $rollModel = new Rolls();
    $dataRollTransactionOld = $rollTransactionModel->getWhere(['invoice_id' => $invoiceId])->getResultArray();

    // KEMBALIKAN KE KONDISI AWAL 
    foreach ($dataRollTransactionOld as $value) {
      $rollQuantity = intval($value["transaction_quantity"]);
      $unitQuantity = intval($value["transaction_quantity_total"]);

      $rollModel->where("roll_id", $value["roll_id"])->set('roll_quantity', "`roll_quantity`+" . $rollQuantity, FALSE)->update();
      $rollModel->where("roll_id", $value["roll_id"])->set('all_quantity', "`all_quantity`+" . $unitQuantity, FALSE)->update();
    }

    // KEMUDIAN HAPUS PADA TABEL TRANSAKSI
    $rollTransactionModel->where("invoice_id", $invoiceId)->delete();

    return $dataRollTransactionOld;
  }

  public static function makeNewTransaction($dataTable, $invoiceId, $isPaid)
  {
    $rollModel = new Rolls();
    $totalCapital = 0;
    $totalPayment = 0;
    $totalProfit = 0;
    foreach ($dataTable as $value) {
      $rollQuantity =  intval($value["transactionQuantity"]);
      $unitQuantity =  intval($value["transactionQuantityTotal"]);
      $basicPrice = intval($rollModel->find($value["rollId"])["basic_price"]);
      $totalPayment += rupiahToInt($value["subTotal"]);
      $totalCapital += $basicPrice * $unitQuantity * $rollQuantity;

      (new RollTransaction())->insert([
        "roll_id" => $value["rollId"],
        "transaction_type" => 1,
        "transaction_quantity" => $rollQuantity,
        "transaction_quantity_total" => $unitQuantity * $rollQuantity,
        "sub_total" => rupiahToInt($value["subTotal"]),
        "sub_capital" => $basicPrice * $unitQuantity * $rollQuantity,
        "sub_profit" => rupiahToInt($value["subTotal"]) - ($basicPrice * $unitQuantity * $rollQuantity),
        "invoice_id" => $invoiceId,
        "is_deleted" => 0,
      ]);
      $rollModel->where("roll_id", $value["rollId"])->set('roll_quantity', "`roll_quantity`-" . $rollQuantity, FALSE)->update();

      $rollModel->where("roll_id", $value["rollId"])->set('all_quantity', "`all_quantity`-" . $unitQuantity * $rollQuantity, FALSE)->update();
    }
    $totalProfit += $totalPayment - $totalCapital;

    (new Invoices())->update(
      $invoiceId,
      [
        "date_invoice" => getDateTimeNow(),
        "total_capital" => $totalCapital,
        "total_payment" => $totalPayment,
        "total_profit" => $totalProfit,
        "is_paid" => $isPaid
      ]
    );
  }
}
