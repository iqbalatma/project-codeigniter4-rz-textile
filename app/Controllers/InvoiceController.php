<?php

namespace App\Controllers;


class InvoiceController extends BaseController
{

    public function __construct()
    {
        $this->invoiceModel = new \App\Models\Invoices();
        $this->logModel = new \App\Models\LogActivity();
        $this->rollTransactionModel = new  \App\Models\RollTransaction();
        $this->customerModel = new  \App\Models\Customers();
        $this->rollModel = new  \App\Models\Rolls();
        $this->unitModel = new \App\Models\Units();
        $this->db = \Config\Database::connect();
    }
    public function show()
    {
        return view('invoice/index', [
            "title" => "Invoice",
            "invoices" => $this->invoiceModel->getInvoices(),
        ]);
    }

    public function report()
    {
        $dataRolls = $this->rollModel->getAllDataRolls();
        $dataUnits = $this->unitModel->where("is_deleted", 0)->findAll();
        $data = [
            "title" => "Laporan Penjualan",
            "dataRolls" => $dataRolls,
            "dataUnits" => $dataUnits,
            "dataFinances" => $this->rollTransactionModel->getSummaryFinance()
        ];

        return view("invoice/report", $data);
    }

    public function edit($invoiceId)
    {
        $data = [
            "title" => "Refund Barang",
            "dataInvoice" => $this->invoiceModel->getInvoices($invoiceId)[0],
            "dataTransactions" => $this->rollTransactionModel->getRollTransactionById($invoiceId),
            "dataCustomers" => $this->customerModel->where("is_deleted", 0)->findAll(),
            "dataRolls" => $this->rollModel->getAllDataRollsIsNotEmpty(),
        ];
        return view("invoice/edit", $data);
    }

    public function updatePaymentStatus()
    {
        $this->invoiceModel->update($this->request->getPost(), ["is_paid" => 1]);
        $dataLog = [
            "log_name" => "Aktifitas update status pembayaran",
            "log_description" => "Aktifitas update status pembayaran berhasil.",
            "log_tr_collor" => "success",
            "user_id" => session()->get("id_user")
        ];
        $this->logModel->insert($dataLog);
        return redirect()->route("invoice.show")->with("success", "Memperbaharui status pembayaran berhasil !");
    }

    public function printInvoice($id)
    {
        $data = [
            "dataTransaction" => $this->rollTransactionModel->getRollTransactionById($id),
            "dataInvoice" => $this->invoiceModel->getInvoices($id),
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
        return redirect()->to($mpdf->Output());
    }

    public function printReport()
    {
        $dataInvoice = json_decode($this->request->getPost("dataInvoice"));
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
        return redirect()->to($mpdf->Output());
    }
}
