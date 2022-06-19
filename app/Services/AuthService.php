<?php

namespace App\Services;

use App\Models\Users;

class AuthService
{
  public static function authenticated($request)
  {
    $userModel = new Users();
    $username = $request["username"];
    $password = $request["password"];

    $user = $userModel->where("username", $username)->where("is_deleted", 0)->first();
    if ($user !== null) {
      if ($user["password"] === $password) {
        $loginFailed = false;
        $dataSession = [
          "id_user" => $user["user_id"],
          "fullname" => $user["fullname"],
          "username" => $user["username"],
          "password" => $user["password"],
          "role" => $user["role"],
          "isLoggedIn" => true,
        ];
        LogService::setLog("Aktifitas Login Berhasil", $user["username"] . " BERHASIL melakukan login", "success");
        session()->set($dataSession);
        return true;
      } else {
        $loginFailed = true;
      }
    } else {
      $loginFailed = true;
    }

    if ($loginFailed) {
      LogService::setLog("Aktifitas Login Gagal", "Terdapat upaya login dengan username " . $username, "danger");
      session()->setFlashdata("msg", '<div class="alert alert-danger" role="alert">Username atau password salah ! Coba Lagi !</div>');
      return false;
    }
  }
}
