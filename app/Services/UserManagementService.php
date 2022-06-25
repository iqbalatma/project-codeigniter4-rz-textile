<?php

namespace App\Services;

use App\Models\LogActivity;
use App\Models\Users;
use Exception;

class UserManagementService
{
  public  static function getShowData(): array
  {
    $userModel = new Users();
    return
      [
        "title" => "Manajemen User",
        "dataUsers" => $userModel->orderBy('is_deleted', 'asc')->findAll(),
        "myDataUser" => $userModel->find(session()->id_user),
      ];
  }

  public static function store(array $data): bool
  {
    try {
      $fullname = $data["fullname"];

      (new Users())->insert([
        "fullname" => $fullname,
        "username" => $data["username"],
        "password" => $data["password"],
        "role" => $data["role"]
      ]);

      LogService::setLogSuccess("STORE", "Tambah data user $fullname BERHASIL");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("STORE", "Tambah data user $fullname GAGAL. Error : $e");
      return false;
    }
  }

  public  static function destroy(int $id, string $status): bool
  {
    try {
      (new Users())->update($id, ["is_deleted" => $status]);

      LogService::setLogSuccess("DELETE", "Hapus data user BERHASIL");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("DELETE", "Hapus data user GAGAL");
      return true;
    }
  }

  public static function update(int $userId, array $data): bool
  {
    try {
      $username = $data["username"];
      $fullname = $data["fullname"];
      $password = $data["password"];

      $dataUpdate = [
        "fullname" => $fullname,
        "username" => $username,
        "password" => $password,
      ];

      if (session()->id_user == $userId) {
        session()->fullname = $fullname;
        session()->username = $username;
      } else {
        $dataUpdate["role"] = $data["role"];
      }

      (new Users())->update($userId, $data);

      LogService::setLogSuccess("UPDATE", "Update data user $fullname BERHASIL");

      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("UPDATE", "Update data user $fullname GAGAL. Error : $e");
      return false;
    }
  }

  public static function isUsernameSame(array $data): bool
  {
    $usernameFromDB = (new Users())->find($data["user_id"])["username"];

    if (($data["username"]) == $usernameFromDB) {
      return true;
    } else {
      return false;
    }
  }
}
