<?php

namespace App\Services;

use App\Models\Invoices;
use App\Models\RollTransaction;
use Exception;

class InvoiceService
{
  public static function updatePayment($data)
  {
    $invoiceModel = new Invoices();
    try {
      $invoiceModel->update($data, ["is_paid" => 1]);
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
    $rollTransactionModel = new RollTransaction();
    $invoiceModel = new Invoices();
    $data = [
      "dataTransaction" => $rollTransactionModel->getRollTransactionById($id),
      "dataInvoice" => $invoiceModel->getInvoices($id),
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
