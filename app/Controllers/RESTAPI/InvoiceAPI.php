<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;
use App\Services\InvoiceService;
use CodeIgniter\API\ResponseTrait;

class InvoiceAPI extends BaseController
{
    use ResponseTrait;
    public function getAllInvoice()
    {
        return $this->respond(
            InvoiceService::getInvoices($this->request->getGet("month"), $this->request->getGet("year")),
            200
        );
    }

    public function getInvoiceYearly()
    {
        return $this->respond(InvoiceService::getInvoiceYearly(), 200);
    }

    public function getInvoiceMonthly()
    {
        return $this->respond(
            InvoiceService::getInvoiceMonthly($this->request->getGet("month"), $this->request->getGet("year")),
            200
        );
    }

    public function lastInvoice()
    {
        return $this->respond(InvoiceService::getLastInvoice(), 200);
    }

    public function invoiceById($id)
    {
        return $this->respond(
            InvoiceService::getInvoiceById($id),
            200
        );
    }

    public function report()
    {
        return $this->respond(
            InvoiceService::getInvoiceForReport($this->request->getPost("lower_limit"), $this->request->getPost("upper_limit")),
            200
        );
    }
}
