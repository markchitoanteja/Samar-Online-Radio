<?php

namespace App\Controllers;

use App\Models\User_Model;

class Admin extends BaseController
{
    public function index()
    {
        return session()->get("user_id") ? redirect()->to(base_url('/admin/dashboard')) : redirect()->to(base_url('/admin/login'));
    }

    public function dashboard()
    {
        if (!session()->get("user_id")) {
            $response = [
                "alert_type" => "danger",
                "message" => "You need to login first!"
            ];

            session()->setFlashdata("response", $response);

            return redirect()->to(base_url('/admin/login'));
        }

        return view('_admin/dashboard');
    }

    public function login()
    {
        return view('_admin/login');
    }

    public function get_user_data()
    {
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $remember_me = $this->request->getPost("remember_me");

        $User_Model = new User_Model();

        $email_exists = $User_Model->where("email", $email)->findAll();

        $success = false;

        $response = [
            "alert_type" => "danger",
            "message" => "Invalid Username or Password!"
        ];

        if ($email_exists && password_verify($password, $email_exists[0]["password"])) {
            $response = [];
            $success = true;

            $remember_me_session = [];

            if ($remember_me == "true") {
                $remember_me_session["email"] = $email;
                $remember_me_session["password"] = $password;
            }

            session()->set("remember_me", $remember_me_session);
            session()->set("user_id", "1");
        }

        session()->setFlashdata("response", $response);

        return json_encode($success);
    }
}
