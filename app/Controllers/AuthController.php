<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\LogService;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get("isLoggedIn")) {
            return redirect()->to("/dashboard");
        }
        return view('auth/index', ["title" => "Login"]);
    }

    public function login()
    {
        if (AuthService::authenticated($this->request->getPost())) {
            return redirect()->to("/dashboard");
        } else {
            return redirect()->to("/");
        }
    }

    public function logout()
    {
        $username = session()->get("username");
        LogService::setLogSuccess("LOGOUT",  "$username BERHASIL logout");
        session()->destroy();
        return redirect()->to("/");
    }
}
