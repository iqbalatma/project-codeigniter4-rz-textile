<?php

namespace App\Controllers;

use App\Models\Users;
use Exception;

class RollTransactionController extends BaseController
{

    public function __construct()
    {
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->rollModel = new \App\Models\Rolls();
        $this->logModel = new \App\Models\LogActivity();
    }
    public function show()
    {
        $data = [
            "title" => "Transaksi Roll",
            "rollTransactionsOut" => $this->rollTransactionModel->getAllRollTransactions(null, null, "out"),
            "rollTransactions" => $this->rollTransactionModel->getAllRollTransactions(null, null, "in"),
        ];

        return view('roll-transaction/index', $data);
    }

    public function edit()
    {
        return view('roll-transaction/edit', [
            "title" => "Restok Roll",
            "dataRolls" => $this->rollModel->getAllDataRolls(),
        ]);
    }

    public function store()
    {

        $rollId = $this->request->getPost("roll_id");
        $rollQuantity = $this->request->getPost("roll_quantity");
        $allQuantity = $this->request->getPost("all_quantity");
        $data = [
            "roll_id" => $rollId,
            "transaction_type" => 0, //keluar
            "transaction_quantity" => $rollQuantity,
            "transaction_quantity_total" => $allQuantity,
            "sub_total" => null,
            "invoice_id" => null,
            "is_deleted" => 0,
        ];

        try {
            $rollData = $this->rollModel->find($rollId);
            $oldRollQuantity = $rollData["roll_quantity"];
            $oldAllQuantity = $rollData["all_quantity"];
            $rollCode = $rollData["roll_code"];

            $this->rollModel->update($rollId, ["roll_quantity" => $oldRollQuantity + $rollQuantity, "all_quantity" => $oldAllQuantity + $allQuantity]);
            $this->rollTransactionModel->insert($data);

            $dataLog = [
                "log_name" => "Aktifitas Transaksi Roll Berhasil",
                "log_description" => "Transaksi masuk " . $rollCode . " sejumlah " . $rollQuantity . " Roll Berhasil dilakukan",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);

            return redirect()->route("rolltransaction.edit")->with("success", "Restok berhasil !");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas Transaksi Roll gagal",
                "log_description" => "Transaksi masuk  $rollCode sejumlah $rollQuantity roll gagal dilakukan. Error : $e",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("rolltransaction.edit")->with("failed", "Restok Gagal !");
        }
    }
}
