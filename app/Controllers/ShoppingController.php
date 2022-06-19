<?php

namespace App\Controllers;

use App\Services\ShoppingService;

class ShoppingController extends BaseController
{
    public function show()
    {
        return view('shopping/index', ShoppingService::getShowData());
    }
}
