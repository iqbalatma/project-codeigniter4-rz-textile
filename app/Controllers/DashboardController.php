<?php

namespace App\Controllers;


class DashboardController extends BaseController
{

    public function __construct()
    {
        $this->invoiceModel = new \App\Models\Invoices();
    }

    public function show()
    {
        $data = [
            "title" => "Dashboard",
            "invoicesToday" => $this->invoiceModel->getInvoicesToday(),
        ];
        return view('dashboard/index', $data);
    }
}
