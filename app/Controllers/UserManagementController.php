<?php

namespace App\Controllers;

use App\Services\UserManagementService;
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
      UserManagementService::getShowData()
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

    $fullname = $this->request->getPost("fullname");
    if (UserManagementService::store($this->request->getPost())) {
      return redirect()->route("usermanagement.show")->with("success", "User $fullname berhasil ditambahkan");
    } else {
      return redirect()->route("usermanagement.show")->with("failed", "User $fullname gagal ditambahkan !");
    }
  }

  public function destroy()
  {
    $userId = $this->request->getPost("user_id");
    $status = $this->request->getPost("status");

    if (UserManagementService::destroy($userId, $status)) {
      return redirect()->route("usermanagement.show")->with("success", "Status user berhasil di perbaharui !");
    } else {
      return redirect()->route("usermanagement.show")->with("failed", "Status user gagal di perbaharui !");
    }
  }

  public function update()
  {

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
    if (!UserManagementService::isUsernameSame($this->request->getPost())) {
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

    $userId =  $this->request->getPost("user_id");
    $fullname = $this->request->getPost("fullname");

    if (UserManagementService::update($userId, $this->request->getPost())) {
      return redirect()->route("usermanagement.show")->with("success", "User $fullname berhasil diperbaharui");
    } else {
      return redirect()->route("usermanagement.show")->with("failed", "User $fullname gagal diperbaharui !");
    }
  }
}
