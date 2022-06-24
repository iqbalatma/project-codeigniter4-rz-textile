<?php

namespace App\Controllers;


use App\Services\InvoiceService;

class InvoiceController extends BaseController
{
    public function show()
    {
        return view('invoice/index', InvoiceService::getDataIndex());
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
        return view("invoice/edit", InvoiceService::getDataEdit($invoiceId));
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
