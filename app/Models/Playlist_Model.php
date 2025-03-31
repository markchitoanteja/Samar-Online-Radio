<?php

namespace App\Models;

use CodeIgniter\Model;

class Playlist_Model extends Model
{
    protected $table = "playlists";
    protected $primary_key = "id";
    protected $allowedFields = [
        'uuid',
        'name',
        'schedule',
        'time_range',
        'song_ids',
        'created_at',
        'updated_at',
    ];
}
