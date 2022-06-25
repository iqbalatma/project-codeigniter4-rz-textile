<?php

namespace App\Controllers;

use App\Services\UnitService;

class UnitController extends BaseController
{
    public function show()
    {
        return view('unit/index', UnitService::getShowData());
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

        if (UnitService::store($this->request->getPost())) {
            return redirect()->route("unit.show")->with("success", "Satuan " . $this->request->getPost('unit_name') . " berhasil ditambahkan");
        } else {
            return redirect()->route("unit.show")->with("failed", "Satuan " . $this->request->getPost('unit_name') . " gagal ditambahkan !");
        }
    }


    public function update()
    {
        $validationRules = [
            'unit_name' => [
                'label'  => 'Nama satuan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} belum di isi !',
                ],
            ],
        ];
        if (!UnitService::isCodeSame($this->request->getPost())) {
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

        $unitId = $this->request->getPost("unit_id");
        $unitName = $this->request->getPost("unit_name");
        if (UnitService::update($this->request->getPost(), $unitId)) {
            return redirect()->route("unit.show")->with("success", "Satuan berhasil diperbaharui menjadi $unitName");
        } else {
            return redirect()->route("unit.show")->with("failed", "Satuan $unitName gagal diperbaharui");
        }
    }
}
