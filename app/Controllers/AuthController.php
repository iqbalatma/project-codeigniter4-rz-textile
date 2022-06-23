<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\LogService;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get("isLoggedIn")) {
            return redirect()->route("dashboard.show");
        }
        return view('auth/index', ["title" => "Login"]);
    }

    public function login()
    {
        if (AuthService::authenticated($this->request->getPost())) {
            return redirect()->route("dashboard.show");
        } else {
            return redirect()->route("login");
        }
    }

    public function logout()
    {
        LogService::setLogSuccess("LOGOUT",  session()->get("username") . " BERHASIL logout");
        session()->destroy();
        return redirect()->route("login");
    }
}
