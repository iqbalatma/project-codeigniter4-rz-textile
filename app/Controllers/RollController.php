<?php

namespace App\Controllers;

use Exception;

class RollController extends BaseController
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->rollModel = new \App\Models\Rolls();
        $this->unitModel = new \App\Models\Units();
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->logModel = new \App\Models\LogActivity();
        $this->generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
    }

    public function search()
    {
        return view("roll/search", [
            "title" => "Pencarian Item",
            "dataRolls" => $this->rollModel->getAllDataRolls()
        ]);
    }


    public function show()
    {
        $dataRolls = $this->rollModel->getAllDataRolls();
        $dataUnits = $this->unitModel->where("is_deleted", 0)->findAll();
        $data = [
            "title" => "Data Roll Kain",
            "dataRolls" => $dataRolls,
            "dataUnits" => $dataUnits,
            "dataFinances" => $this->rollTransactionModel->getSummaryFinance()
        ];

        return view('roll/index', $data);
    }

    public function store()
    {
        $isUnique = false;
        while (!$isUnique) {
            $generatedBarcode = generateRandomString();
            if (count($this->rollModel->getRollByBarcode($generatedBarcode)) === 0) {
                $isUnique = true;
            }
        }

        if (!$this->validate([
            'roll_name' => [
                'label'  => 'Nama roll',
                'rules'  => 'required|max_length[64]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang. Maksimal 64 karakter !'
                ],
            ],
            'roll_code' => [
                'label'  => 'Kode roll',
                'rules'  => 'required|max_length[64]|is_unique[rolls.roll_code]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang. Maksimal 64 karakter !',
                    'is_unique' => '{field} sudah ada, gunakan nama roll yang lain !'

                ],
            ],
            'roll_quantity' => [
                'label'  => 'Kuantitas rol',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum diisi !',
                ],
            ],
            'all_quantity' => [
                'label'  => 'Total satuan rol',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum diisi !',
                ],
            ],
            'basic_price' => [
                'label'  => 'Harga dasar',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum diisi !',
                ],
            ],
            'selling_price' => [
                'label'  => 'Harga dasar',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum diisi !',
                ],
            ],
            'unit_id' => [
                'label'  => 'Satuan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum dipilih !',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->route("roll.show")->with("validationError", $validation->listErrors());
        }

        $rollName = $this->request->getPost("roll_name");
        $rollCode = $this->request->getPost("roll_code");
        $rollQuantity = $this->request->getPost("roll_quantity");
        $basicPrice = $this->request->getPost("basic_price");
        $sellingPrice =  $this->request->getPost("selling_price");
        $allQuantity =  $this->request->getPost("all_quantity");
        $unitId =  $this->request->getPost("unit_id");

        $data = [
            "roll_code" => $rollCode,
            "barcode_code" => $generatedBarcode,
            "roll_name" => $rollName,
            "roll_quantity" => $rollQuantity,
            "all_quantity" => $allQuantity,
            "unit_id" => $unitId,
            "basic_price" => $basicPrice,
            "selling_price" => $sellingPrice,
            "is_deleted" => 0,
            "barcode_image" => "barcode/" .  $generatedBarcode . ".jpg",
        ];
        file_put_contents(ROOTPATH . "public/barcode/$generatedBarcode.jpg", $this->generator->getBarcode($generatedBarcode, $this->generator::TYPE_CODE_128, 3, 50));

        try {
            $this->rollModel->insert($data);
            $lastCode = $this->rollModel->orderBy("roll_id", "desc")->findAll(1)[0]["roll_id"];
            $dataLog = [
                "log_name" => "Aktifitas Tambah Roll BERHASIL",
                "log_description" => "Tambah Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);

            $dataTransaction = [
                "roll_id" => $lastCode,
                "transaction_type" => 0,
                "transaction_quantity" => $rollQuantity,
                "transaction_quantity_total" => $allQuantity,
                "sub_total" => null,
                "invoice_id" => null,
                "is_deleted" => 0
            ];
            $this->rollTransactionModel->insert($dataTransaction);

            $dataLog = [
                "log_name" => "Aktifitas Tambah Transaksi Roll BERHASIL",
                "log_description" => "Transaksi Roll :  $rollCode BERHASIL dilakukan dengan jumlah $rollQuantity",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("roll.show")->with("success", "Data roll kain $rollCode berhasil ditambahkan");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas Tambah Roll GAGAL",
                "log_description" => "Tambah Roll GAGAL dilakukan.",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            $dataLog = [
                "log_name" => "Aktifitas Tambah Transaksi Roll GAGAL",
                "log_description" => "Tambah Transaksi Roll GAGAL dilakukan. Error : $e",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("roll.show")->with("failed", "Data roll kain $rollCode gagal ditambahkan");
        }
    }

    public function update()
    {
        $rollId = $this->request->getPost("roll_id");
        $rollCode = $this->request->getPost("roll_code");
        $rollCodeFromDB = $this->rollModel->getRollById($rollId)[0]["roll_code"];
        $validationRules = [
            'roll_name' => [
                'label'  => 'Nama roll',
                'rules'  => 'required|max_length[64]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang. Maksimal 64 karakter !'
                ],
            ],
            'basic_price' => [
                'label'  => 'Harga dasar',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum diisi !',
                ],
            ],
            'unit_id' => [
                'label'  => 'Satuan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum dipilih !',
                ],
            ],
            'selling_price' => [
                'label'  => 'Harga dasar',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum diisi !',
                ],
            ],
        ];
        if ($rollCode !== $rollCodeFromDB) {
            $validationRules["roll_code"] = [
                'label'  => 'Kode roll',
                'rules'  => 'required|max_length[64]|is_unique[rolls.roll_code]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang. Maksimal 64 karakter !',
                    'is_unique' => '{field} sudah ada, gunakan nama roll yang lain !'
                ],
            ];
        }

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            return redirect()->route("roll.show")->with("validationError", $validation->listErrors());
        }


        $rollName = $this->request->getPost("roll_name");
        $basicPrice = $this->request->getPost("basic_price");
        $sellingPrice =  $this->request->getPost("selling_price");
        $unitId =  $this->request->getPost("unit_id");

        $data = [
            "roll_code" => $rollCode,
            "roll_name" => $rollName,
            "basic_price" => $basicPrice,
            "selling_price" => $sellingPrice,
            "unit_id" => $unitId,
            "is_deleted" => 0,
        ];

        try {
            $this->rollModel->update($rollId, $data);
            $dataLog = [
                "log_name" => "Aktifitas Update Roll BERHASIL",
                "log_description" => "Update Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("roll.show")->with("success", "Data roll kain $rollCode berhasil diperbaharui");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas Update Roll GAGAL",
                "log_description" => "Update Roll GAGAL dilakukan. Error: $e",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("roll.show")->with("failed", "Data roll kain $rollCode gagal diperbaharui");
        }
    }

    public function destroy()
    {
        $rollId = $this->request->getPost("roll_id");
        $rollCode = $this->request->getPost("roll_code");
        $rollName = $this->request->getPost("roll_name");
        try {
            $this->rollTransactionModel->where("roll_id", $rollId)->delete();
            $this->rollModel->delete($rollId);

            $dataLog = [
                "log_name" => "Aktifitas Hapus Roll BERHASIL",
                "log_description" => "Hapus Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("roll.show")->with("success", "Data roll kain $rollCode berhasil dihapus");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas Hapus Roll GAGAL",
                "log_description" => "Hapus Roll GAGAL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("roll.show")->with("failed", "Data roll kain $rollCode gagal dihapus karena sudah terjadi transaksi dengan roll ini");
        }
    }

    public function printBarcode($imgSrc, $rollCode, $rollName, $quantity)
    {
        $data = [
            "rollName" => $rollName,
            "rollCode" => $rollCode,
            "imgSrc" => $imgSrc,
            "quantity" => $quantity
        ];

        $html = view("printpdf/roll", $data);

        $mpdf = new \Mpdf\Mpdf([
            'margin_top' => 5,
            'margin_bottom' => 5,
            'format' => [108, 35]
        ]);

        $mpdf->showImageErrors = true;
        $mpdf->curlAllowUnsafeSslRequests = true;
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Barcode $rollName");
        $mpdf->SetAuthor("RZ TEXTILE");
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->debug = true;
        // $mpdf->WriteHTML($html);
        for ($i = 0; $i < $quantity; $i++) {
            $mpdf->WriteHTML('<img  src="barcode/2h2T1TQY.jpg" alt="">');
            $mpdf->WriteHTML("Kode Roll : $rollCode");
            $mpdf->WriteHTML("Nama Roll : $rollName");
            if ($i !== $quantity - 1) {
                $mpdf->AddPage();
            }
        }
        return redirect()->to($mpdf->Output());
    }
}
