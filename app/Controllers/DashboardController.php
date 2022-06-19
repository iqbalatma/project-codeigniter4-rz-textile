<?php

namespace App\Controllers;

use App\Models\Invoices;

class DashboardController extends BaseController
{

    public function show()
    {
        $invoiceModel = new Invoices();
        $data = [
            "title" => "Dashboard",
            "invoicesToday" => $invoiceModel->getInvoicesToday(),
        ];
        return view('dashboard/index', $data);
    }
}
