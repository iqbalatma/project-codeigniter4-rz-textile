<?php

namespace App\Services;

use App\Models\Invoices;
use App\Models\RollTransaction;

class PDFService
{
  public static function saveInvoiceToPdf(int $id): void
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

    $invoiceCode = $data["dataInvoice"][0]["invoice_code"];
    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle($invoiceCode);
    $mpdf->SetAuthor("RZ TEXTILE");
    $mpdf->SetDisplayMode('fullpage');

    $mpdf->WriteHTML($html);
    $mpdf->Output("./invoice-doc/invoiceid-$id.pdf", "F");
  }
}
