<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class InvoiceAPI extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->rollModel = new \App\Models\Rolls();
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->db = \Config\Database::connect();
        $this->generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
        $this->invoiceModel = new \App\Models\Invoices();
    }

    public function getAllInvoice()
    {
        $month = $this->request->getGet("month");
        $year = $this->request->getGet("year");
        $data = $this->invoiceModel->getInvoices(null, $month, $year);
        return $this->respond($data, 200);
    }

    public function getInvoiceYearly()
    {
        $data = [
            "finance" => $this->invoiceModel->getFinanceInvoice("yearly"),
        ];
        return $this->respond($data, 200);
    }

    public function getInvoiceMonthly()
    {
        $month = $this->request->getGet("month");
        $year = $this->request->getGet("year");
        if ($month && $year) {
            $finance = $this->invoiceModel->getFinanceInvoice("monthly", $month, $year);
        } else {
            $finance = $this->invoiceModel->getFinanceInvoice("monthly");
        }
        $data = [
            "finance" => $finance
        ];
        return $this->respond($data, 200);
    }

    public function lastInvoice()
    {
        $lastInvoice = $this->invoiceModel->getLastInvoice();
        $invoiceId = $lastInvoice[0]["invoice_id"];
        $transactionByInvoiceId = $this->rollTransactionModel->getRollTransactionByInvoiceId($invoiceId);
        $data = [
            "invoice" => $lastInvoice,
            "transaction_by_invoice_id" => $transactionByInvoiceId,
        ];
        return $this->respond($data, 200);
    }

    public function invoiceById($id)
    {
        $lastInvoice = $this->invoiceModel->getInvoices($id);
        $invoiceId = $lastInvoice[0]["invoice_id"];
        $transactionByInvoiceId = $this->rollTransactionModel->getRollTransactionByInvoiceId($invoiceId);
        $data = [
            "invoice" => $lastInvoice,
            "transaction_by_invoice_id" => $transactionByInvoiceId,
        ];
        return $this->respond($data, 200);
    }

    public function report()
    {
        $lowerLimit = $this->request->getPost("lower_limit");
        $upperLimit = $this->request->getPost("upper_limit");

        $dataInvoices =  $this->invoiceModel->getInvoicesRangePaid($lowerLimit, $upperLimit);
        $dataTransactions = $this->rollTransactionModel->getTransactionsRange($lowerLimit, $upperLimit);
        $data = [
            "dataInvoices" => $dataInvoices,
            "dataTransactions" => $dataTransactions
        ];
        return $this->respond($data, 200);
    }
}
