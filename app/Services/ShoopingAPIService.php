<?php

namespace App\Services;

use App\Models\Invoices;
use App\Models\Rolls;
use App\Models\RollTransaction;

class ShoopingAPIService
{
  private int $totalCapital;
  private int $totalPayment;
  public function generateNewInvoice($dataCustomer, $typePayment, $isPaid): array
  {
    $invoiceCode =  (new Invoices())->getLastInvoiceCode();
    $invoiceCode ?
      $counter = explode("/", $invoiceCode->invoice_code)[5] + 1  : $counter = 1;

    $dataInvoice = [
      "invoice_code" => "INV/" . getDateNowSlash() . "/OUT/$counter",
      "is_deleted" => 0,
      "user_id" => intval(session()->get("id_user")),
      "type_payment" => $typePayment,
      "is_paid" => $isPaid
    ];

    if ($dataCustomer["customerId"] > 0) $dataInvoice["customer_id"] =  intval($dataCustomer["customerId"]);

    return $dataInvoice;
  }

  public function storeNewInvoice($newInvoice)
  {
    return (new Invoices())->insert($newInvoice);
  }

  public function storeNewTransaction($dataTable, $invoiceId)
  {
    $this->totalCapital = 0;
    $this->totalPayment = 0;

    foreach ($dataTable as $value) {
      $rollId = $value["rollId"];
      $subTotal =  rupiahToInt($value["subTotal"]);
      $rollQuantity = intval($value["transactionRollQuantity"]);
      $unitQuantity = intval($value["transactionAllQuantity"]);
      $totalAllQuantity = $rollQuantity * $unitQuantity;


      // UPDATE ROLL YANG TERJUAL
      $rollData = (new Rolls())->where("roll_id", $rollId)->first();

      $this->addCapital(intval($rollData["basic_price"])   * $totalAllQuantity);
      $this->addPayment($subTotal);

      $newRollQuantity    = intval($rollData["roll_quantity"])  - $rollQuantity;
      $newUnitQuantity    = intval($rollData["all_quantity"])   - ($totalAllQuantity);
      $subCapital         = intval($rollData["basic_price"])    * $totalAllQuantity;
      $subProfit           = $subTotal - (intval($rollData["basic_price"]) * $totalAllQuantity);


      // TAMBAHKAN DATA TRANSAKSI
      (new RollTransaction())->insert([
        "roll_id" => $rollId,
        "transaction_type" => 1, //keluar
        "transaction_quantity" => $rollQuantity,
        "transaction_quantity_total" => $unitQuantity * $rollQuantity,
        "sub_capital" => $subCapital,
        "sub_total" => $subTotal,
        "sub_profit" => $subProfit,
        "invoice_id" => $invoiceId,
      ]);
      (new Rolls())->update($rollId, [
        "roll_quantity" =>  $newRollQuantity,
        "all_quantity" => $newUnitQuantity
      ]);
    }
  }

  public function updateInvoice($invoiceId)
  {
    // UPDATE DATA INVOICE
    (new Invoices())->update(
      $invoiceId,
      [
        "total_payment" => $this->getPayment(),
        "total_capital" => $this->getCapital(),
        "total_profit" => $this->getPayment() - $this->getCapital()
      ]
    );
  }

  private function addCapital($capital): void
  {
    $this->totalCapital += $capital;
  }

  public function getCapital()
  {
    return $this->totalCapital;
  }

  private function addPayment($payment): void
  {
    $this->totalPayment += $payment;
  }

  public function getPayment()
  {
    return $this->totalPayment;
  }
}
