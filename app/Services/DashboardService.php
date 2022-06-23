<?php

namespace App\Services;

use App\Models\Invoices;

class DashboardService
{
  public static function getDataIndex(): array
  {
    return  [
      "title" => "Dashboard",
      "invoicesToday" => (new Invoices())->getInvoicesToday(),
    ];
  }
}
