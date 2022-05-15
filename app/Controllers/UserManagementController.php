<?php

namespace App\Controllers;

use Exception;

class UserManagementController extends BaseController
{

  public function __construct()
  {
    $this->userModel = new \App\Models\Users();
    $this->logModel = new \App\Models\LogActivity();
  }

  public function show()
  {
    return view(
      "user-management/index",
      [
        "title" => "Manajemen User",
        "dataUsers" => $this->userModel->orderBy('is_deleted', 'asc')->findAll(),
        "myDataUser" => $this->userModel->find(session()->id_user),
      ]
    );
  }

  public function store()
  {
    $validationRules = [
      'fullname' => [
        'label'  => 'Nama lengkap',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} belum di isi !',
        ],
      ],
      'username' => [
        'label'  => 'Username',
        'rules'  => 'required|is_unique[users.username]',
        'errors' => [
          'required' => '{field} belum di isi !',
          'is_unique' => '{field} sudah ada, gunakan kode yang lain !'
        ],
      ],
      'password' => [
        'label'  => 'Passowrd',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} belum di isi !',
        ],
      ]
    ];
    if (!$this->validate($validationRules)) {
      $validation = \Config\Services::validation();
      return redirect()->route("usermanagement.show")->with("validationError", $validation->listErrors());
    }

    try {
      $fullname = $this->request->getPost("fullname");
      $username = $this->request->getPost("username");
      $password = $this->request->getPost("password");
      $role = $this->request->getPost("role");
      $data = [
        "fullname" => $fullname,
        "username" => $username,
        "password" => $password,
        "role" => $role
      ];

      $this->userModel->insert($data);
      $dataLog = [
        "log_name" => "Aktifitas Tambah User BERHASIL",
        "log_description" => "Tambah data user $fullname BERHASIL",
        "log_tr_collor" => "success",
        "user_id" => session()->get("id_user")
      ];
      $this->logModel->insert($dataLog);
      return redirect()->route("usermanagement.show")->with("success", "User $fullname berhasil ditambahkan");
    } catch (Exception $e) {
      $dataLog = [
        "log_name" => "Aktifitas Tambah User GAGAL",
        "log_description" => "Tambah data user $fullname GAGAL",
        "log_tr_collor" => "danger",
        "user_id" => session()->get("id_user")
      ];
      $this->logModel->insert($dataLog);
      return redirect()->route("usermanagement.show")->with("failed", "User $fullname gagal ditambahkan !");
    }
  }

  public function destroy()
  {
    try {
      $userId = $this->request->getPost("user_id");
      $status = $this->request->getPost("status");

      $this->userModel->update($userId, ["is_deleted" => $status]);
      $dataLog = [
        "log_name" => "Aktifitas Hapus User BERHASIL",
        "log_description" => "Hapus data user BERHASIL",
        "log_tr_collor" => "success",
        "user_id" => session()->get("id_user")
      ];
      $this->logModel->insert($dataLog);
      return redirect()->route("usermanagement.show")->with("success", "Status user berhasil di perbaharui !");
    } catch (Exception $e) {
      $dataLog = [
        "log_name" => "Aktifitas Hapus User GAGAL",
        "log_description" => "Hapus data user GAGAL",
        "log_tr_collor" => "danger",
        "user_id" => session()->get("id_user")
      ];
      $this->logModel->insert($dataLog);
      return redirect()->route("usermanagement.show")->with("failed", "Status user gagal di perbaharui !");
    }
  }

  public function update()
  {
    $userId =  $this->request->getPost("user_id");
    $usernameFromDB = $this->userModel->find($userId)["username"];
    $username = $this->request->getPost("username");
    $validationRules = [
      'fullname' => [
        'label'  => 'Nama lengkap',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} belum di isi !',
        ],
      ],
      'password' => [
        'label'  => 'Passowrd',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} belum di isi !',
        ],
      ]
    ];
    if ($usernameFromDB !== $username) {
      $validationRules["username"] = [
        'label'  => 'Username',
        'rules'  => 'required|is_unique[users.username]',
        'errors' => [
          'required' => '{field} belum di isi !',
          'is_unique' => '{field} sudah ada, gunakan kode yang lain !'
        ],
      ];
    }
    if (!$this->validate($validationRules)) {
      $validation = \Config\Services::validation();
      return redirect()->route("usermanagement.show")->with("validationError", $validation->listErrors());
    }
    try {
      $fullname = $this->request->getPost("fullname");
      $password = $this->request->getPost("password");
      $role = $this->request->getPost("role");


      $data = [
        "fullname" => $fullname,
        "username" => $username,
        "password" => $password,

      ];
      if (session()->id_user == $userId) {
        session()->fullname = $fullname;
        session()->username = $username;
      } else {
        $data["role"] = $role;
      }

      $this->userModel->update($userId, $data);
      $dataLog = [
        "log_name" => "Aktifitas Tambah User BERHASIL",
        "log_description" => "Tambah data user $fullname BERHASIL",
        "log_tr_collor" => "success",
        "user_id" => session()->get("id_user")
      ];
      $this->logModel->insert($dataLog);


      return redirect()->route("usermanagement.show")->with("success", "User $fullname berhasil diperbaharui");
    } catch (Exception $e) {
      $dataLog = [
        "log_name" => "Aktifitas Tambah User GAGAL",
        "log_description" => "Tambah data user $fullname GAGAL",
        "log_tr_collor" => "danger",
        "user_id" => session()->get("id_user")
      ];
      $this->logModel->insert($dataLog);
      return redirect()->route("usermanagement.show")->with("failed", "User $fullname gagal diperbaharui !");
    }
  }
}
