<?php

namespace App\Controllers;

use App\Services\DashboardService;

class DashboardController extends BaseController
{

    public function show()
    {
        return view('dashboard/index', DashboardService::getDataIndex());
    }
}
