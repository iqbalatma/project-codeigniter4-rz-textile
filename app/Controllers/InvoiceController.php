<?php

namespace App\Controllers;

use App\Models\Invoices;
use App\Models\Rolls;
use App\Models\RollTransaction;
use App\Services\InvoiceService;

class InvoiceController extends BaseController
{


    public function show()
    {
        $invoiceModel = new Invoices();
        return view('invoice/index', [
            "title" => "Invoice",
            "invoices" => $invoiceModel->getInvoices(),
        ]);
    }

    public function report()
    {
        $data = [
            "title" => "Laporan Penjualan",
        ];
        return view("invoice/report", $data);
    }

    public function edit($invoiceId)
    {
        $invoiceModel = new Invoices();
        $rollTransactionModel = new RollTransaction();
        $rollModel = new Rolls();
        $data = [
            "title" => "Refund Barang",
            "dataInvoice" => $invoiceModel->getInvoices($invoiceId)[0],
            "dataTransactions" => $rollTransactionModel->getRollTransactionById($invoiceId),
            "dataRolls" => $rollModel->getAllDataRollsIsNotEmpty(),
        ];
        return view("invoice/edit", $data);
    }

    public function updatePaymentStatus()
    {
        if (InvoiceService::updatePayment($this->request->getPost())) {
            return redirect()->route("invoice.show")->with("success", "Memperbaharui status pembayaran berhasil !");
        } else {
            return redirect()->route("invoice.show")->with("failed", "Memperbaharui status pembayaran gagal !");
        }
    }

    public function printInvoice($id)
    {
        $pdfOutput =  InvoiceService::printInvoice($id);
        return redirect()->to($pdfOutput);
    }

    public function printReport()
    {
        $dataInvoice = json_decode($this->request->getPost("dataInvoice"));
        $pdfOutput =  InvoiceService::printReport($dataInvoice);

        return redirect()->to($pdfOutput);
    }
}
