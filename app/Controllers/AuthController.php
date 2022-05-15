<?php

namespace App\Controllers;

use App\Models\LogActivity;
use App\Models\Users;

class AuthController extends BaseController
{

    public function __construct()
    {
        $this->userModel = new Users();
        $this->logModel = new LogActivity();
    }

    public function index()
    {
        if (session()->get("isLoggedIn")) {
            return redirect()->to("/dashboard");
        }
        return view('auth/index', ["title" => "Login"]);
    }

    public function login()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $user = $this->userModel->where("username", $username)->where("is_deleted", 0)->first();
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

                $dataLog = [
                    "log_name" => "Aktifitas Login BERHASIL",
                    "log_description" => $user["username"] . " BERHASIL melakukan login",
                    "log_tr_collor" => "success",
                    "user_id" => $user["user_id"]
                ];
                $this->logModel->insert($dataLog);
                session()->set($dataSession);
                return redirect()->to("/dashboard");
            } else {
                $loginFailed = true;
            }
        } else {
            $loginFailed = true;
        }

        if ($loginFailed) {
            $dataLog = [
                "log_name" => "Aktifitas Login GAGAL",
                "log_description" => "Terdapat upaya login dengan username " . $username,
                "user_id" => null,
                "log_tr_collor" => "danger",
            ];
            $this->logModel->insert($dataLog);

            session()->setFlashdata("msg", '<div class="alert alert-danger" role="alert">Username atau password salah ! Coba Lagi !</div>');
            return redirect()->to("/");
        }
    }

    public function logout()
    {
        $dataLog = [
            "log_name" => "Aktifitas Logout",
            "log_description" => session()->get("username") . " BERHASIL logout",
            "log_tr_collor" => "success",
            "user_id" => session()->get("id_user")
        ];
        $this->logModel->insert($dataLog);
        session()->destroy();

        return redirect()->to("/");
    }
}
