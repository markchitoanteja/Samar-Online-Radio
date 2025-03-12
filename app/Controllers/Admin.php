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

        session()->set("title", "Dashboard");
        session()->set("current_tab", "dashboard");

        $User_Model = new User_Model();

        $data["user"] = $User_Model->where("id", session()->get("user_id"))->findAll(1)[0];

        $header = view('_admin/templates/header', $data);
        $body = view('_admin/dashboard');
        $modals = view('_admin/modals/profile_modal');
        $footer = view('_admin/templates/footer');

        return $header . $body . $modals . $footer;
    }

    public function login()
    {
        session()->set("current_tab", "login");

        return view('_admin/login');
    }

    public function logout()
    {
        session()->remove('user_id');

        return redirect()->to(base_url('/admin/login'));
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
    
    public function get_user_data_by_id()
    {
        $user_id = $this->request->getPost("user_id");
        
        $User_Model = new User_Model();

        $user_data = $User_Model->where("id", $user_id)->findAll(1)[0];

        return json_encode($user_data);
    }
}
