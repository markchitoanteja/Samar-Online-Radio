<?php

namespace App\Controllers;

use App\Models\User_Model;

class Admin extends BaseController
{
    private function upload_image($image)
    {
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'public/img/uploads', $newName);

            return $newName;
        }

        return false;
    }

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

    public function music_files()
    {
        if (!session()->get("user_id")) {
            $response = [
                "alert_type" => "danger",
                "message" => "You need to login first!"
            ];

            session()->setFlashdata("response", $response);

            return redirect()->to(base_url('/admin/login'));
        }

        session()->set("title", "Music Files");
        session()->set("current_tab", "music_files");

        $User_Model = new User_Model();

        $data["user"] = $User_Model->where("id", session()->get("user_id"))->findAll(1)[0];

        $header = view('_admin/templates/header', $data);
        $body = view('_admin/music_files');
        $modals = view('_admin/modals/profile_modal') . view('_admin/modals/upload_music_modal');
        $footer = view('_admin/templates/footer');

        return $header . $body . $modals . $footer;
    }

    public function playlists()
    {
        if (!session()->get("user_id")) {
            $response = [
                "alert_type" => "danger",
                "message" => "You need to login first!"
            ];
    
            session()->setFlashdata("response", $response);
    
            return redirect()->to(base_url('/admin/login'));
        }
    
        session()->set("title", "Playlists");
        session()->set("current_tab", "playlists");
    
        $User_Model = new User_Model();
    
        $data["user"] = $User_Model->where("id", session()->get("user_id"))->findAll(1)[0];
    
        $header = view('_admin/templates/header', $data);
        $body = view('_admin/playlists');
        $modals = view('_admin/modals/add_playlist_modal') . view('_admin/modals/edit_playlist_modal');
        $footer = view('_admin/templates/footer');
    
        return $header . $body . $modals . $footer;
    }
    public function login()
    {
        session()->set("title", "Login");
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

    public function update_user()
    {
        $name = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $image = $this->request->getFile("image");

        $id = $this->request->getPost("id");
        $old_email = $this->request->getPost("old_email");
        $old_password = $this->request->getPost("old_password");
        $old_image = $this->request->getPost("old_image");

        $User_Model = new User_Model();

        $email_exists = $User_Model->where("email", $email)->where("id !=", $id)->where("email !=", $old_email)->findAll();

        $success = false;

        if (!$email_exists) {
            $success = true;

            if ($password != "null") {
                $password = password_hash($password, PASSWORD_BCRYPT);
            } else {
                $password = $old_password;
            }

            if ($image) {
                $image = $this->upload_image($image);
            } else {
                $image = $old_image;
            }

            $data = [
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "image" => $image
            ];

            $User_Model->update($id, $data);

            $notification = [
                "title" => "Success!",
                "text" => "Profile updated successfully!",
                "icon" => "success",
            ];

            session()->setFlashdata("notification", $notification);
        }

        return json_encode($success);
    }

    public function upload_music()
    {
        $title = $this->request->getPost("title");
        $music = $this->request->getFile("music");

        $response = [
            "title" => $title,
            "music" => $music
        ];

        $notification = [
            "title" => "Success!",
            "text" => "Music uploaded successfully!",
            "icon" => "success",
        ];

        session()->setFlashdata("notification", $notification);

        return json_encode($response);
    }
}
