<?php

namespace App\Models;

use CodeIgniter\Model;

class Now_Playing_Model extends Model
{
    protected $table = "now_playing";
    protected $primary_key = "id";
    protected $allowedFields = [
        'current_song_index',
        'current_playlist_signature',
        'updated_at',
    ];
}
