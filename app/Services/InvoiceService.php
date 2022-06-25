<?php

namespace App\Services;

use App\Models\Invoices;
use App\Models\Rolls;
use App\Models\RollTransaction;
use Exception;

class InvoiceService
{
  public static function getDataIndex(): array
  {
    return  [
      "title" => "Invoice",
      "invoices" => (new Invoices())->getInvoices(),
    ];
  }

  public static function getDataEdit(int $invoiceId): array
  {
    return [
      "title" => "Refund Barang",
      "dataInvoice" => (new Invoices())->getInvoices($invoiceId)[0],
      "dataTransactions" => (new RollTransaction())->getRollTransactionByInvoiceId($invoiceId),
      "dataRolls" => (new Rolls())->getAllDataRollsIsNotEmpty(),
    ];
  }

  public static function getInvoices($month, $year): array
  {
    return (new Invoices())->getInvoices(null, $month, $year);
  }

  public  static function getInvoiceYearly(): array
  {
    return [
      "finance" => (new Invoices())->getFinanceInvoice("yearly"),
    ];
  }

  public static function getInvoiceMonthly($month, $year): array
  {
    if ($month && $year) {
      $finance = (new Invoices())->getFinanceInvoice("monthly", $month, $year);
    } else {
      $finance = (new Invoices())->getFinanceInvoice("monthly");
    }
    return [
      "finance" => $finance
    ];
  }

  public static function getLastInvoice()
  {
    $lastInvoice = (new Invoices())->getLastInvoice();
    $invoiceId = $lastInvoice[0]["invoice_id"];
    $transactionByInvoiceId = (new RollTransaction())->getRollTransactionByInvoiceId($invoiceId);
    return  [
      "invoice" => $lastInvoice,
      "transaction_by_invoice_id" => $transactionByInvoiceId,
    ];
  }

  public static function getInvoiceById(int $id): array
  {
    $lastInvoice = (new Invoices())->getInvoices($id);
    $invoiceId = $lastInvoice[0]["invoice_id"];
    $transactionByInvoiceId = (new RollTransaction())->getRollTransactionByInvoiceId($invoiceId);

    return   [
      "invoice" => $lastInvoice,
      "transaction_by_invoice_id" => $transactionByInvoiceId,
    ];
  }

  public static function getInvoiceForReport($lowerLimit, $upperLimit): array
  {
    return  [
      "dataInvoices" => (new Invoices())->getInvoicesRangePaid($lowerLimit, $upperLimit),
      "dataTransactions" => (new RollTransaction())->getTransactionsRange($lowerLimit, $upperLimit)
    ];
  }


  public static function updatePayment($data)
  {
    try {
      (new Invoices())->update($data, ["is_paid" => 1]);
      LogService::setLogSuccess("UPDATE", "Aktifitas update status pembayaran berhasil.");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("UPDATE", "Aktifitas update status pembayaran gagal.");
      return false;
    }
  }

  public static function printReport($dataInvoice)
  {
    $dataInvoiceArray = json_decode(json_encode($dataInvoice), true);

    $html = view("printpdf/report", $dataInvoiceArray);
    $mpdf = new \Mpdf\Mpdf([
      'margin_left' => 10,
      'margin_right' => 10,
      'margin_top' => 10,
      'margin_bottom' => 25,
      'margin_header' => 10,
      'margin_footer' => 10,
      'format' => 'A4-L'
    ]);
    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Laporan Keuangan");
    $mpdf->SetAuthor("RZ TEXTILE");
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    return $mpdf->Output();
  }

  public static function printInvoice($id)
  {
    $data = [
      "dataTransaction" => (new RollTransaction())->getRollTransactionByInvoiceId($id),
      "dataInvoice" => (new Invoices())->getInvoices($id),
    ];

    $html = view("printpdf/invoice", $data);

    $mpdf = new \Mpdf\Mpdf([
      'margin_left' => 10,
      'margin_right' => 10,
      'margin_top' => 48,
      'margin_bottom' => 25,
      'margin_header' => 10,
      'margin_footer' => 10,
      'format' => 'A5-L'
    ]);

    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle($data["dataInvoice"][0]["invoice_code"]);
    $mpdf->SetAuthor("RZ TEXTILE");
    $mpdf->SetDisplayMode('fullpage');

    $mpdf->WriteHTML($html);
    return $mpdf->Output();
  }
}
