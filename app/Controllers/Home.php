<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $body = view('_public/home');
        $modals = view('_public/modals/full_image_modal');

        return $body . $modals;
    }
    
    public function about_us()
    {
        $body = view('_public/about_us');
        $modals = view('_public/modals/full_image_modal');

        return $body . $modals;
    }
}
