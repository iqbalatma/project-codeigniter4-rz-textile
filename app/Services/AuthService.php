<?php

namespace App\Services;

use App\Models\Users;
use Exception;

class AuthService
{
  public static function authenticated($data)
  {

    try {
      $username = $data["username"];
      $password = $data["password"];
      $loginFailed = false;

      $user = (new Users())->where(["username" => $username, 'is_deleted' => 0])->first();

      if ($user !== null) {
        if ($user["password"] === $password) {
          LogService::setLogSuccess("LOGIN", $user["username"] . " BERHASIL melakukan login");
          session()->set([
            "id_user" => $user["user_id"],
            "fullname" => $user["fullname"],
            "username" => $user["username"],
            "password" => $user["password"],
            "role" => $user["role"],
            "isLoggedIn" => true,
          ]);
          return true;
        } else {
          $loginFailed = true;
        }
      } else {
        $loginFailed = true;
      }

      if ($loginFailed) {
        LogService::setLogFailed("LOGIN", "Terdapat upaya login dengan username " . $username);
        session()->setFlashdata("msg", '<div class="alert alert-danger" role="alert">Username atau password salah ! Coba Lagi !</div>');
        return false;
      }
    } catch (Exception $e) {
      LogService::setLogFailed("LOGIN", "Login gagal. Error : $e");
      session()->setFlashdata("msg", '<div class="alert alert-danger" role="alert">Username atau password salah ! Coba Lagi !</div>');
      return false;
    }
  }
}
