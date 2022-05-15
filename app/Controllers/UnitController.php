<?php

namespace App\Controllers;

use App\Models\Users;
use Exception;

class UnitController extends BaseController
{

    public function __construct()
    {
        $this->unitModel = new \App\Models\Units();
        $this->logModel = new \App\Models\LogActivity();
    }

    public function show()
    {
        return view('unit/index', [
            "title" => "Data Satuan",
            "units" => $this->unitModel->where("is_deleted", 0)->findAll(),
        ]);
    }

    public function store()
    {
        $validationRules = [
            'unit_name' => [
                'label'  => 'Nama satuan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum di isi !',
                ],
            ],
            'unit_code' => [
                'label'  => 'Kode satuan',
                'rules'  => 'required|is_unique[units.unit_code]',
                'errors' => [
                    'required' => '{field} belum di isi !',
                    'is_unique' => '{field} sudah ada, gunakan kode yang lain !'
                ],
            ]
        ];
        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            return redirect()->route("unit.show")->with("validationError", $validation->listErrors());
        }

        try {
            $unit_name = $this->request->getPost("unit_name");
            $unit_code = $this->request->getPost("unit_code");
            $data = [
                "unit_name" => $unit_name,
                "unit_code" => $unit_code
            ];
            $this->unitModel->insert($data);
            $dataLog = [
                "log_name" => "Aktifitas Tambah Satuan BERHASIL",
                "log_description" => "Tambah data satuan $unit_name BERHASIL",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("unit.show")->with("success", "Satuan $unit_name berhasil ditambahkan");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas Tambah Satuan GAGAL",
                "log_description" => "Tambah data satuan $unit_name GAGAL",
                "log_tr_collor" => "danger",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("unit.show")->with("failed", "Satuan $unit_name gagal ditambahkan !");
        }
    }


    public function update()
    {
        $unit_id = $this->request->getPost("unit_id");
        $unit_code = $this->request->getPost("unit_code");
        $unitCodeFromDB = $this->unitModel->find($unit_id)["unit_code"];

        $validationRules = [
            'unit_name' => [
                'label'  => 'Nama satuan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum di isi !',
                ],
            ],
        ];
        if ($unit_code !== $unitCodeFromDB) {
            $validationRules["unit_code"] = [
                'label'  => 'Kode satuan',
                'rules'  => 'required|is_unique[units.unit_code]',
                'errors' => [
                    'required' => '{field} belum di isi !',
                    'is_unique' => '{field} sudah ada, gunakan kode yang lain !'
                ],
            ];
        }
        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            return redirect()->route("unit.show")->with("validationError", $validation->listErrors());
        }

        try {
            $unit_name = $this->request->getPost("unit_name");
            $data = [
                'unit_name' => $unit_name,
                'unit_code' => $unit_code,
            ];
            $this->unitModel->update($unit_id, $data);
            $dataLog = [
                "log_name" => "Aktifitas Update Data Satuan BERHASIL",
                "log_description" => "Update data satuan menjadi $unit_name BERHASIL",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("unit.show")->with("success", "Satuan berhasil diperbaharui menjadi $unit_name");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas Update Data Satuan GAGAL",
                "log_description" => "Update data satuan $unit_name GAGAL",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("unit.show")->with("failed", "Satuan $unit_name gagal diperbaharui");
        }
    }
}
