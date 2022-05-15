<?php

namespace App\Controllers;

use Exception;

class CustomerController extends BaseController
{

    public function __construct()
    {
        $this->customerModel = new \App\Models\Customers();
        $this->invoiceModel = new \App\Models\Invoices();
        $this->logModel = new \App\Models\LogActivity();
    }

    public function show()
    {
        return view('customer/index', [
            "title" => "Data Pelanggan",
            "dataCustomers" => $this->customerModel->where("is_deleted", 0)->findAll(),
            "dataTransactions" => $this->invoiceModel->getSumTransactionByCustomerId()
        ]);
    }



    public function store()
    {
        if (!$this->validate([
            'customer_NIK' => [
                'label'  => 'NIK pelanggan',
                'rules'  => 'required|max_length[16]|min_length[16]',
                'errors' => [
                    'required' => '{field} belum dipilih !',
                    'max_length' => '{field} harus 16 digit !',
                    'min_length' => '{field} harus 16 digit !',
                ],
            ],
            'customer_name' => [
                'label'  => 'Nama pelanggan',
                'rules'  => 'required|max_length[64]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang. Maksimal 64 karakter !'
                ],
            ],
            'no_hp' => [
                'label'  => 'Nomor hp',
                'rules'  => 'required|max_length[15]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang.'

                ],
            ],
            'address' => [
                'label'  => 'Alamat',
                'rules'  => 'required|max_length[128]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang.'

                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->route("customer.show")->with("validationError", $validation->listErrors());
        }

        $customer_NIK = $this->request->getPost("customer_NIK");
        $customer_name = $this->request->getPost("customer_name");
        $address = $this->request->getPost("address");
        $no_hp = $this->request->getPost("no_hp");

        try {
            $data = [
                "customer_NIK" => $customer_NIK,
                "customer_name" => $customer_name,
                "address" => $address,
                "no_hp" => $no_hp
            ];
            $this->customerModel->insert($data);

            $dataLog = [
                "log_name" => "Aktifitas Tambah Konsumen BERHASIL",
                "log_description" => "Customer $customer_name  BERHASIL ditambahkan",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);

            return redirect()->route("customer.show")->with("success", "Data konsumen $customer_name berhasil ditambahkan");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas Tambah Konsumen GAGAL",
                "log_description" => "Customer $customer_name GAGAL ditambahkan. Error : $e",
                "log_tr_collor" => "danger",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("customer.show")->with("failed", "Data konsumen $customer_name gagal ditambahkan");
        }
    }



    public function update()
    {
        if (!$this->validate([
            'customer_NIK' => [
                'label'  => 'NIK pelanggan',
                'rules'  => 'required|max_length[16]|min_length[16]',
                'errors' => [
                    'required' => '{field} belum dipilih !',
                    'max_length' => '{field} harus 16 digit !',
                    'min_length' => '{field} harus 16 digit !',
                ],
            ],
            'customer_name' => [
                'label'  => 'Nama pelanggan',
                'rules'  => 'required|max_length[64]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang. Maksimal 64 karakter !'
                ],
            ],
            'no_hp' => [
                'label'  => 'Nomor hp',
                'rules'  => 'required|max_length[15]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang.'

                ],
            ],
            'address' => [
                'label'  => 'Alamat',
                'rules'  => 'required|max_length[128]',
                'errors' => [
                    'required' => '{field} belum diisi !',
                    'max_length' => '{field} terlalu panjang.'

                ],
            ],

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->route("customer.show")->with("validationError", $validation->listErrors());
        }


        $customer_id = $this->request->getPost("customer_id");
        $customer_nik = $this->request->getPost("customer_NIK");
        $customer_name = $this->request->getPost("customer_name");
        $address = $this->request->getPost("address");
        $no_hp = $this->request->getPost("no_hp");


        try {
            $data = [
                "customer_NIK" => $customer_nik,
                "customer_name" => $customer_name,
                "address" => $address,
                "no_hp" => $no_hp
            ];
            $this->customerModel->update($customer_id, $data);
            $dataLog = [
                "log_name" => "Aktifitas update konsumen BERHASIL",
                "log_description" => "Konsumen $customer_name BERHASIL diperbaharui",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);

            return redirect()->route("customer.show")->with("success", "Data konsumen $customer_name berhasil diperbaharui");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas update konsumen GAGAL",
                "log_description" => "Konsumen $customer_name GAGAL diperbaharui. Error : $e",
                "log_tr_collor" => "danger",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("customer.show")->with("failed", "Data konsumen $customer_name gagal diperbaharui");
        }
    }

    public function destroy()
    {
        $customer_id = $this->request->getPost("customer_id");
        $customer_name = $this->request->getPost("customer_name");

        try {
            $this->customerModel->update($customer_id, ["is_deleted" => 1]);
            $dataLog = [
                "log_name" => "Aktifitas hapus konsumen BERHASIL",
                "log_description" => "Konsumen  $customer_name  BERHASIL dihapus",
                "log_tr_collor" => "success",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);
            return redirect()->route("customer.show")->with("success", "Data konsumen $customer_name berhasil dihapus");
        } catch (Exception $e) {
            $dataLog = [
                "log_name" => "Aktifitas hapus konsumen GAGAL",
                "log_description" => "Konsumen $customer_name GAGAL dihapus. Error : $e",
                "log_tr_collor" => "danger",
                "user_id" => session()->get("id_user")
            ];
            $this->logModel->insert($dataLog);

            return redirect()->route("customer.show")->with("failed", "Data konsumen $customer_name gagal dihapus");
        }
    }
}
