<?php

namespace App\Controllers;

use App\Models\Listener_Model;

class Home extends BaseController
{
    private function generate_uuid()
    {
        return bin2hex(random_bytes(16));
    }

    private function track_user_activity()
    {
        $listenerModel = new Listener_Model();

        $ipAddress = $this->request->getIPAddress();
        $userAgent = $this->request->getUserAgent()->getAgentString();

        $listener = $listenerModel->where('ip_address', $ipAddress)->where('user_agent', $userAgent)->first();

        $data = [
            'ip_address'     => $ipAddress,
            'user_agent'     => $userAgent,
            'last_activity'  => date('Y-m-d H:i:s'),
            'is_online'      => 1
        ];

        if ($listener) {
            $listenerModel->update($listener['id'], $data);
        } else {
            $data['uuid']       = $this->generate_uuid();
            $data['created_at'] = date('Y-m-d H:i:s');
            $listenerModel->insert($data);
        }
    }

    public function index()
    {
        $this->track_user_activity();

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

    public function update_user_activity()
    {
        $listenerModel = new Listener_Model();

        $ipAddress = $this->request->getIPAddress();
        $userAgent = $this->request->getUserAgent()->getAgentString();

        $listener = $listenerModel->where('ip_address', $ipAddress)->where('user_agent', $userAgent)->first();

        if ($listener) {
            $listenerModel->update($listener['id'], [
                'last_activity' => date('Y-m-d H:i:s'),
                'is_online'     => 1
            ]);

            return json_encode(true);
        }
    }
}
