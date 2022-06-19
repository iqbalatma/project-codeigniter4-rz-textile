<?php

namespace App\Controllers;

use App\Models\Customers;
use App\Models\Invoices;
use App\Services\CustomerService;
use Exception;

class CustomerController extends BaseController
{

    public function show()
    {
        $customerModel = new Customers();
        $invoiceModel = new Invoices();
        return view('customer/index', [
            "title" => "Data Konsumen",
            "dataCustomers" => $customerModel->where("is_deleted", 0)->findAll(),
            "dataTransactions" => $invoiceModel->getSumTransactionByCustomerId()
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
        $customer_name = $this->request->getPost("customer_name");
        if (CustomerService::store($this->request->getPost())) {
            return redirect()->route("customer.show")->with("success", "Data konsumen $customer_name berhasil ditambahkan");
        } else {
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

        $customer_name = $this->request->getPost('customer_name');
        if (CustomerService::update($this->request->getPost())) {
            return redirect()->route("customer.show")->with("success", "Data konsumen $customer_name berhasil diperbaharui");
        } else {
            return redirect()->route("customer.show")->with("failed", "Data konsumen $customer_name gagal diperbaharui");
        }
    }

    public function destroy()
    {
        $customer_name = $this->request->getPost("customer_name");

        if (CustomerService::destroy($this->request->getPost())) {
            return redirect()->route("customer.show")->with("success", "Data konsumen $customer_name berhasil dihapus");
        } else {
            return redirect()->route("customer.show")->with("failed", "Data konsumen $customer_name gagal dihapus");
        }
    }
}
