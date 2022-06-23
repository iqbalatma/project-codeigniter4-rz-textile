<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;
use App\Services\LogService;
use CodeIgniter\API\ResponseTrait;
use Exception;

class ShoppingApi extends BaseController
{
    use ResponseTrait;

    private $emailMessage = "<h1>Invoice Pembelian Kain</h1>Kepada Iqbal Berikut Invoice pembelian anda:";
    private $totalCapital = 0;
    private $totalPayment = 0;

    public function __construct()
    {
        $this->rollModel = new \App\Models\Rolls();
        $this->logModel = new \App\Models\LogActivity();
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->invoiceModel = new \App\Models\Invoices();
    }


    public function store()
    {
        $dataTable = $this->request->getPost("dataTable");
        $dataCustomer = $this->request->getPost("dataCustomer");
        $typePayment =    $this->request->getPost("typePayment");
        $isPaid = $this->request->getPost("isPaid");
        $newInvoice = $this->getNewDataInvoice($dataCustomer, $typePayment, $isPaid);


        try {
            $insertedInvoiceId = $this->invoiceModel->insert($newInvoice);
            $this->totalPayment = 0;
            $this->totalCapital = 0;
            foreach ($dataTable as $value) {
                $this->addNewTransaction($value, $insertedInvoiceId);
            }
            // UPDATE DATA INVOICE
            $this->invoiceModel->update(
                $insertedInvoiceId,
                [
                    "total_payment" => $this->totalPayment,
                    "total_capital" => $this->totalCapital,
                    "total_profit" => $this->totalPayment - $this->totalCapital
                ]
            );

            // $attachment = "./invoice-doc/invoiceid-$insertedInvoiceId.pdf";
            $this->saveInvoiceToPdf($insertedInvoiceId);
            // $this->sendEmail('iqbalatma@gmail.com',  $attachment);


            $response = [
                "message" => "success",
                "message_code" => "200",
                "success" => true,
            ];
            session()->setFlashdata("success", "Transaksi Berhasil");


            LogService::setLogSuccess("STORE", "Transaksi penjualan BERHASIL. Kode invoice " . $newInvoice["invoice_code"]);
        } catch (Exception $e) {
            $response = [
                "message" => "failed",
                "message_code" => "200",
                "success" => false,
                "error" => $e,
            ];
            session()->setFlashdata("failed", "Transaksi Gagal ! Error : $e");

            LogService::setLogFailed("STORE", "Transaksi penjualan GAGAL");
        }

        return $this->respond($response, 200);
    }


    private function getNewDataInvoice($dataCustomer, $typePayment, $isPaid)
    {
        $invoiceCode =  $this->invoiceModel->getLastInvoiceCode();
        $invoiceCode ?
            $counter = explode("/", $invoiceCode->invoice_code)[5] + 1  : $counter = 1;

        $dataInvoice = [
            "invoice_code" => "INV/" . getDateNowSlash() . "/OUT/$counter",
            "is_deleted" => 0,
            "user_id" => intval(session()->get("id_user")),
            "type_payment" => $typePayment,
            "is_paid" => $isPaid
        ];

        if ($dataCustomer["customerId"] > 0) $dataInvoice["customer_id"] =  intval($dataCustomer["customerId"]);

        return $dataInvoice;
    }


    private function addNewTransaction($data, $invoiceId)
    {
        $rollId = $data["rollId"];
        $subTotal =  rupiahToInt($data["subTotal"]);
        $rollQuantity = intval($data["transactionRollQuantity"]);
        $unitQuantity = intval($data["transactionAllQuantity"]);
        $totalAllQuantity = $rollQuantity * $unitQuantity;


        // UPDATE ROLL YANG TERJUAL
        $rollData = $this
            ->rollModel
            ->where("roll_id", $rollId)
            ->first();

        $this->addCapital(intval($rollData["basic_price"])   * $totalAllQuantity);
        $this->addPayment($subTotal);

        $newRollQuantity    = intval($rollData["roll_quantity"])  - $rollQuantity;
        $newUnitQuantity    = intval($rollData["all_quantity"])   - ($totalAllQuantity);
        $subCapital         = intval($rollData["basic_price"])    * $totalAllQuantity;
        $subProfit           = $subTotal - (intval($rollData["basic_price"]) * $totalAllQuantity);


        // TAMBAHKAN DATA TRANSAKSI
        $dataTransaksi = [
            "roll_id" => $rollId,
            "transaction_type" => 1, //keluar
            "transaction_quantity" => $rollQuantity,
            "transaction_quantity_total" => $unitQuantity * $rollQuantity,
            "sub_capital" => $subCapital,
            "sub_total" => $subTotal,
            "sub_profit" => $subProfit,
            "invoice_id" => $invoiceId,
        ];
        $this->rollTransactionModel->insert($dataTransaksi);
        $this->rollModel->update($rollId, [
            "roll_quantity" =>  $newRollQuantity,
            "all_quantity" => $newUnitQuantity
        ]);
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


    private function sendEmail($to,  $attachment = null)
    {
        $email = \Config\Services::email();

        $email->setFrom('admin@geotech.zifaengineering.com', 'RZ Textile');
        $email->setTo($to);
        $email->attach($attachment);
        $email->setSubject('Invoice');
        $email->setMessage($this->emailMessage);

        return $email->send();
    }


    private function addCapital($capital)
    {
        $this->totalCapital += $capital;
    }


    private function addPayment($payment)
    {
        $this->totalPayment += $payment;
    }
}
