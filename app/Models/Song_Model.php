<?php

namespace App\Models;

use CodeIgniter\Model;

class Song_Model extends Model
{
    protected $table = "songs";
    protected $primary_key = "id";
    protected $allowedFields = [
        'uuid',
        'title',
        'artist',
        'duration',
        'size',
        'playlist_ids',
        'filename',
        'image',
        'created_at',
        'updated_at',
    ];
}
