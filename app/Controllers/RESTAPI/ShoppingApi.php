<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;

use CodeIgniter\API\ResponseTrait;
use Exception;

class ShoppingApi extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->rollModel = new \App\Models\Rolls();
        $this->logModel = new \App\Models\LogActivity();
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->invoiceModel = new \App\Models\Invoices();
        $this->customerModel = new \App\Models\Customers();
        $this->db = \Config\Database::connect();
    }

    public function store()
    {
        $dataTable = $this->request->getPost("dataTable");
        $newInvoice = $this->getNewDataInvoice($this->request->getPost("dataCustomer"), $this->request->getPost("typePayment"), $this->request->getPost("isPaid"));
        try {
            $this->invoiceModel->insert($newInvoice);
            $lastInvoiceId = $this->invoiceModel->where('is_deleted', 0)->orderBy("invoice_id", "DESC")->findAll(1)[0]["invoice_id"];

            $totalPayment = 0;
            $totalCapital = 0;
            $totalProfit = 0;
            foreach ($dataTable as $value) {
                $rollId = $value["rollId"];
                $subTotal =  rupiahToInt($value["subTotal"]);

                $rollQuantity = intval($value["transactionRollQuantity"]);
                $unitQuantity = intval($value["transactionAllQuantity"]);


                // UPDATE ROLL YANG TERJUAL
                $rollData = $this->rollModel->where("roll_id", $rollId)->findAll()[0];
                $totalCapital += intval($rollData["basic_price"]) * $unitQuantity * $rollQuantity;
                $totalPayment += $subTotal;
                $newRollQuantity = intval($rollData["roll_quantity"]) - $rollQuantity;
                $newUnitQuantity = intval($rollData["all_quantity"]) - ($unitQuantity * $rollQuantity);
                $subCapital = intval($rollData["basic_price"]) * $unitQuantity * $rollQuantity;
                $subProfit = $subTotal - (intval($rollData["basic_price"]) * $unitQuantity * $rollQuantity);


                // TAMBAHKAN DATA TRANSAKSI
                $dataTransaksi = [
                    "roll_id" => $rollId,
                    "transaction_type" => 1, //keluar
                    "transaction_quantity" => $rollQuantity,
                    "transaction_quantity_total" => $unitQuantity * $rollQuantity,
                    "sub_capital" => $subCapital,
                    "sub_total" => $subTotal,
                    "sub_profit" => $subProfit,
                    "invoice_id" => $lastInvoiceId,
                ];
                $this->rollTransactionModel->insert($dataTransaksi);
                $this->rollModel->update($rollId, [
                    "roll_quantity" =>  $newRollQuantity,
                    "all_quantity" => $newUnitQuantity
                ]);
            }

            // UPDATE DATA INVOICE
            $totalProfit = $totalPayment - $totalCapital;
            $this->invoiceModel->update($lastInvoiceId, ["total_payment" => $totalPayment, "total_capital" => $totalCapital, "total_profit" => $totalProfit]);

            $response = [
                "message" => "success",
                "message_code" => "200",
                "success" => true,
            ];
            session()->setFlashdata("success", "Transaksi Berhasil");

            $dataLog = [
                "log_name" => "Transaksi penjualan BERHASIL. ",
                "log_description" => "Transaksi penjualan BERHASIL. Kode invoice " . $newInvoice["invoice_code"],
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
        } catch (Exception $e) {

            $response = [
                "message" => "failed",
                "message_code" => "200",
                "success" => false,
            ];
            session()->setFlashdata("failed", "Transaksi Gagal !");
            $dataLog = [
                "log_name" => "Transaksi penjualan GAGAL",
                "log_description" => "Transaksi penjualan GAGAL",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
        }


        return $this->respond($response, 200);
    }

    public function getNewDataInvoice($dataCustomer, $typePayment, $isPaid)
    {
        $year = getYearNow();
        $month = getMonthNow();
        $day = getDayNow();

        $lastInvoiceCode = $this->invoiceModel->where('is_deleted', 0)
            ->orderBy("invoice_id", "DESC")
            ->where('MONTH(date_invoice)', $month)
            ->where('YEAR(date_invoice)', $year)
            ->findAll(1);

        if (count($lastInvoiceCode) == 0) {
            $counter = 1;
        } else {
            $counter = explode("/", $lastInvoiceCode[0]["invoice_code"])[5] + 1;
        }

        if ($dataCustomer["customerId"] > 0) {
            $idCustomer = intval($dataCustomer["customerId"]);
            $dataInvoice = [
                "invoice_code" => "INV/$year/$month/$day/OUT/$counter",
                "is_deleted" => 0,
                "customer_id" => $idCustomer,
                "user_id" => intval(session()->get("id_user")),
                "type_payment" => $typePayment,
                "is_paid" => $isPaid
            ];
        } else {
            $dataInvoice = [
                "invoice_code" => "INV/$year/$month/$day/OUT/$counter",
                "is_deleted" => 0,
                "user_id" => intval(session()->get("id_user")),
                "type_payment" => $typePayment,
                "is_paid" => $isPaid
            ];
        }

        return $dataInvoice;
    }
}
