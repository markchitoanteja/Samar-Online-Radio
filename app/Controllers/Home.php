<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $body = view('_public/home');
        $modals = view('_admin/modals/full_image_modal');

        return $body . $modals;
    }
}
