<?php

namespace App\Controllers;

use App\Services\RollTransactionService;

class RollTransactionController extends BaseController
{
    public function show()
    {
        return view('roll-transaction/index',  RollTransactionService::getShowData());
    }

    public function edit() //restok
    {
        return view('roll-transaction/edit', RollTransactionService::getEditData());
    }

    public function store()
    {
        if (RollTransactionService::store($this->request->getPost())) {
            return redirect()->route("rolltransaction.edit")->with("success", "Restok berhasil !");
        } else {
            return redirect()->route("rolltransaction.edit")->with("failed", "Restok Gagal !");
        }
    }
}
