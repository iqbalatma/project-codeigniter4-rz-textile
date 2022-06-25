<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;
use App\Models\Invoices;
use App\Services\InvoiceService;
use App\Services\LogService;
use App\Services\PDFService;
use App\Services\RefundService;
use CodeIgniter\API\ResponseTrait;

class RefundApi extends BaseController
{
    use ResponseTrait;
    public function update()
    {
        $invoiceId = $this->request->getPost("invoiceId");
        $isPaid = $this->request->getPost("isPaid");

        $dataRollTransactionOld = RefundService::rollBackTransaction($invoiceId);

        // BUAT TRANSAKSI BARU
        if ($this->request->getPost("dataTable")) {
            RefundService::makeNewTransaction(
                $this->request->getPost("dataTable"),
                $invoiceId,
                $isPaid
            );

            PDFService::saveInvoiceToPdf($invoiceId);
        } else {
            (new Invoices())->where("invoice_id", $invoiceId)->delete();
        }

        LogService::setLogSuccess("UPDATE", "Invoice BERHASIL diperbaharui");
        $response = [
            "message" => "success",
            "message_code" => "200",
            "dataRollOld" => ($dataRollTransactionOld),
        ];
        return $this->respond($response, 200);
    }
}
