<?php

namespace App\Controllers;

use App\Models\Rolls;
use App\Models\RollTransaction;
use App\Models\Units;
use App\Services\RollService;

class RollController extends BaseController
{

    private RollService $rollService;

    public function __construct()
    {
        $this->rollModel = new \App\Models\Rolls();
        $this->unitModel = new \App\Models\Units();
        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->logModel = new \App\Models\LogActivity();
        $this->generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
        $this->rollService = new RollService();
    }

    public function search()
    {
        $rollModel = new Rolls();
        return view("roll/search", [
            "title" => "Pencarian Item",
            "dataRolls" => $rollModel->getAllDataRolls()
        ]);
    }


    public function show()
    {
        $rollModel = new Rolls();
        $unitModel = new Units();
        $rollTransactionModel = new RollTransaction();
        $dataRolls = $rollModel->getAllDataRolls();
        $dataUnits = $unitModel->where("is_deleted", 0)->findAll();
        $data = [
            "title" => "Data Roll Kain",
            "dataRolls" => $dataRolls,
            "dataUnits" => $dataUnits,
            "dataFinances" => $rollTransactionModel->getSummaryFinance()
        ];

        return view('roll/index', $data);
    }

    public function store()
    {
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

        $rollCode = $this->request->getPost("roll_code");
        if ($this->rollService->store($this->request->getPost())) {
            return redirect()->route("roll.show")->with("success", "Data roll kain $rollCode berhasil ditambahkan");
        } else {
            return redirect()->route("roll.show")->with("failed", "Data roll kain $rollCode gagal ditambahkan");
        }
    }

    public function update()
    {
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

        if (!$this->rollService->isCodeSame($this->request->getPost())) {
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

        $rollCode = $this->request->getPost("roll_code");
        if ($this->rollService->update($this->request->getPost())) {
            return redirect()->route("roll.show")->with("success", "Data roll kain $rollCode berhasil diperbaharui");
        } else {
            return redirect()->route("roll.show")->with("failed", "Data roll kain $rollCode gagal diperbaharui");
        }
    }

    public function destroy()
    {
        $rollCode = $this->request->getPost("roll_code");

        if ($this->rollService->destroy($this->request->getPost())) {
            return redirect()->route("roll.show")->with("success", "Data roll kain $rollCode berhasil dihapus");
        } else {
            return redirect()->route("roll.show")->with("failed", "Data roll kain $rollCode gagal dihapus karena sudah terjadi transaksi dengan roll ini");
        }
    }

    public function printBarcode($imgSrc, $rollCode, $rollName, $quantity)
    {
        $pdfOutput = $this->rollService->printBarcode($imgSrc, $rollCode, $rollName, $quantity);
        return redirect()->to($pdfOutput);
    }

    public function downloadBarcode($imgSrc, $rollCode, $rollName, $quantity)
    {
        $this->rollService->printBarcode($imgSrc, $rollCode, $rollName, $quantity, true);
    }
}
