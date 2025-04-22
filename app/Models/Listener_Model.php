<?php

namespace App\Models;

use CodeIgniter\Model;

class Listener_Model extends Model
{
    protected $table = "listeners";
    protected $primary_key = "id";
    protected $allowedFields = [
        'uuid',
        'ip_address',
        'user_agent',
        'last_activity',
        'is_online',
        'created_at',
    ];
}
