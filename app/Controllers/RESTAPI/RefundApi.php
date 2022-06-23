<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;
use App\Services\LogService;
use CodeIgniter\API\ResponseTrait;

class RefundApi extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->rollModel = new \App\Models\Rolls();
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->invoiceModel = new \App\Models\Invoices();
        $this->customerModel = new \App\Models\Customers();
        $this->db = \Config\Database::connect();
    }

    public function update()
    {
        $invoiceId = $this->request->getPost("invoiceId");
        $isPaid = $this->request->getPost("isPaid");

        $dataRollOld = $this->rollTransactionModel->getWhere(['invoice_id' => $invoiceId])->getResultArray();

        // KEMBALIKAN KE KONDISI AWAL 
        foreach ($dataRollOld as $value) {
            $rollQuantity = intval($value["transaction_quantity"]);
            $unitQuantity = intval($value["transaction_quantity_total"]);

            $this->rollModel->where("roll_id", $value["roll_id"])->set('roll_quantity', "`roll_quantity`+" . $rollQuantity, FALSE)->update();

            $this->rollModel->where("roll_id", $value["roll_id"])->set('all_quantity', "`all_quantity`+" . $unitQuantity, FALSE)->update();
        }
        // KEMUDIAN HAPUS PADA TABEL TRANSAKSI
        $this->rollTransactionModel->where("invoice_id", $invoiceId)->delete();


        // BUAT TRANSAKSI BARU
        if ($this->request->getPost("dataTable")) {
            $dataTable = $this->request->getPost("dataTable");
            $totalCapital = 0;
            $totalPayment = 0;
            $totalProfit = 0;
            foreach ($dataTable as $value) {
                $rollQuantity =  intval($value["transactionQuantity"]);
                $unitQuantity =  intval($value["transactionQuantityTotal"]);
                $basicPrice = intval($this->rollModel->find($value["rollId"])["basic_price"]);
                $totalPayment += rupiahToInt($value["subTotal"]);
                $totalCapital += $basicPrice * $unitQuantity * $rollQuantity;

                $dataTransaction = [
                    "roll_id" => $value["rollId"],
                    "transaction_type" => 1,
                    "transaction_quantity" => $rollQuantity,
                    "transaction_quantity_total" => $unitQuantity * $rollQuantity,
                    "sub_total" => rupiahToInt($value["subTotal"]),
                    "sub_capital" => $basicPrice * $unitQuantity * $rollQuantity,
                    "sub_profit" => rupiahToInt($value["subTotal"]) - ($basicPrice * $unitQuantity * $rollQuantity),
                    "invoice_id" => $invoiceId,
                    "is_deleted" => 0,
                ];
                $this->rollTransactionModel->insert($dataTransaction);
                $this->rollModel->where("roll_id", $value["rollId"])->set('roll_quantity', "`roll_quantity`-" . $rollQuantity, FALSE)->update();

                $this->rollModel->where("roll_id", $value["rollId"])->set('all_quantity', "`all_quantity`-" . $unitQuantity * $rollQuantity, FALSE)->update();
            }
            $totalProfit += $totalPayment - $totalCapital;
            $this->invoiceModel->update($invoiceId, ["date_invoice" => getDateTimeNow(), "total_capital" => $totalCapital, "total_payment" => $totalPayment, "total_profit" => $totalProfit, "is_paid" => $isPaid]);


            $this->saveInvoiceToPdf($invoiceId);
        } else {
            $this->invoiceModel->where("invoice_id", $invoiceId)->delete();
        }

        LogService::setLogSuccess("UPDATE", "Invoice BERHASIL diperbaharui");
        $response = [
            "message" => "success",
            "message_code" => "200",
            "dataRollOld" => ($dataRollOld),
        ];
        return $this->respond($response, 200);
    }


    private function saveInvoiceToPdf($id)
    {
        $data = [
            "dataTransaction" => $this->rollTransactionModel->getRollTransactionById($id),
            "dataInvoice" => $this->invoiceModel->getInvoices($id),
        ];

        $html = view("printpdf/invoice", $data);

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 48,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10,
            'format' => 'A5-L'
        ]);

        $invoiceCode = $data["dataInvoice"][0]["invoice_code"];
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle($invoiceCode);
        $mpdf->SetAuthor("RZ TEXTILE");
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);
        $mpdf->Output("./invoice-doc/invoiceid-$id.pdf", "F");
    }
}
