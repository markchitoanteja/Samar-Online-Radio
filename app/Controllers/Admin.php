<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Song_Model;
use App\Models\Playlist_Model;
use App\Models\Now_Playing_Model;

class Admin extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Manila');
    }

    private function upload_music_file($music, $uuid)
    {
        if ($music && $music->isValid() && !$music->hasMoved()) {
            $newName = $music->getRandomName();

            $uploadPath = FCPATH . 'public/songs/uploads/' . $uuid . '/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $music->move($uploadPath, $newName);

            return $uuid . '/' . $newName;
        }

        return false;
    }

    private function upload_image($image)
    {
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'public/img/uploads', $newName);

            return $newName;
        }

        return false;
    }

    private function generate_uuid()
    {
        return bin2hex(random_bytes(16));
    }

    public function index()
    {
        return session()->get("user_id") ? redirect()->to(base_url('/admin/dashboard')) : redirect()->to(base_url('/admin/login'));
    }

    public function dashboard()
    {
        if (!session()->get("user_id")) {
            session()->set("redirect_after_login", base_url(uri_string()));

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
            session()->set("redirect_after_login", base_url(uri_string()));

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
        $Song_Model = new Song_Model();
        $Playlist_Model = new Playlist_Model();

        $data["user"] = $User_Model->where("id", session()->get("user_id"))->findAll(1)[0];
        $data["songs"] = $Song_Model->orderBy('id', 'desc')->findAll();
        $data["playlists"] = $Playlist_Model->orderBy('name', 'desc')->findAll();

        $header = view('_admin/templates/header', $data);
        $body = view('_admin/music_files');
        $modals = view('_admin/modals/profile_modal') . view('_admin/modals/upload_music_modal') . view('_admin/modals/edit_music_modal') . view('_admin/modals/add_to_playlist_modal');
        $footer = view('_admin/templates/footer');

        return $header . $body . $modals . $footer;
    }

    public function playlists()
    {
        if (!session()->get("user_id")) {
            session()->set("redirect_after_login", base_url(uri_string()));

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
        $Playlist_Model = new Playlist_Model();

        $data["user"] = $User_Model->where("id", session()->get("user_id"))->findAll(1)[0];
        $data["playlists"] = $Playlist_Model->orderBy('id', 'desc')->findAll();

        $header = view('_admin/templates/header', $data);
        $body = view('_admin/playlists');
        $modals = view('_admin/modals/profile_modal') . view('_admin/modals/add_playlist_modal') . view('_admin/modals/edit_playlist_modal');
        $footer = view('_admin/templates/footer');

        return $header . $body . $modals . $footer;
    }

    public function server_music_player()
    {
        if (!session()->get("user_id")) {
            $response = [
                "alert_type" => "danger",
                "message" => "You need to login first!"
            ];

            session()->setFlashdata("response", $response);

            return redirect()->to(base_url('/admin/server_login'));
        }

        session()->set("title", "Server Music Player");
        session()->set("current_tab", "server_music_player");

        return view('_admin/server_music_player');
    }

    public function server_login()
    {
        session()->set("title", "Server Login");
        session()->set("current_tab", "server_login");

        return view('_admin/server_login');
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

        $response = [
            "alert_type" => "success",
            "message" => "You have been logged out!"
        ];

        session()->setFlashdata("response", $response);

        return redirect()->to(base_url('/admin/login'));
    }

    public function get_user_data()
    {
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $remember_me = $this->request->getPost("remember_me");

        $User_Model = new User_Model();

        $email_exists = $User_Model->where("email", $email)->findAll();

        $redirect_url = session()->get("current_tab") == "login" ? "dashboard" : "server_music_player";
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

            if (session()->get("redirect_after_login")) {
                $redirect_url = session()->get("redirect_after_login");
                session()->remove("redirect_after_login");
            }
        }

        session()->setFlashdata("response", $response);

        return json_encode([
            "success" => $success,
            "redirect_url" => $redirect_url
        ]);
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
        $title    = $this->request->getPost("title");
        $artist   = $this->request->getPost("artist");
        $duration = $this->request->getPost("duration");
        $size     = $this->request->getPost("size");
        $file     = $this->request->getFile("file");
        $cover    = $this->request->getFile("cover");

        $uuid = $this->generate_uuid();

        $uploadedFilePath = $this->upload_music_file($file, $uuid);

        $coverPath = 'public/img/audio-placeholder.webp';

        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $coverName = $uuid . '_cover.' . $cover->getExtension();

            $coverDir = FCPATH . 'public/img/uploads/album_art/' . $uuid . '/';

            if (!is_dir($coverDir)) {
                mkdir($coverDir, 0755, true);
            }

            $cover->move($coverDir, $coverName);

            $coverPath = 'public/img/uploads/album_art/' . $uuid . '/' . $coverName;
        }

        if ($uploadedFilePath) {
            $data = [
                "uuid"       => $uuid,
                "title"      => $title,
                "artist"     => $artist,
                "duration"   => $duration,
                "size"       => $size,
                "filename"   => $uploadedFilePath,
                "image"      => $coverPath,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ];

            // Insert into the Song_Model
            $Song_Model = new Song_Model();
            $Song_Model->insert($data);

            // Success notification
            $notification = [
                "title" => "Success!",
                "text"  => "Music uploaded successfully!",
                "icon"  => "success",
            ];
        } else {
            // Error notification if the music file failed to upload
            $notification = [
                "title" => "Error!",
                "text"  => "Failed to upload music!",
                "icon"  => "error",
            ];
        }

        // Store notification message in session
        session()->setFlashdata("notification", $notification);

        // Return success response
        return json_encode(true);
    }

    public function update_music()
    {
        $title    = $this->request->getPost("title");
        $artist   = $this->request->getPost("artist");
        $duration = $this->request->getPost("duration");
        $size     = $this->request->getPost("size");
        $id       = $this->request->getPost("id");

        $data = [
            "title"      => $title,
            "artist"     => $artist,
            "duration"   => $duration,
            "size"       => $size,
            "updated_at" => date("Y-m-d H:i:s")
        ];

        $Song_Model = new Song_Model();

        $Song_Model->update($id, $data);

        $notification = [
            "title" => "Success!",
            "text"  => "Music updated successfully!",
            "icon"  => "success",
        ];

        session()->setFlashdata("notification", $notification);

        return json_encode(true);
    }

    public function delete_music()
    {
        $id = $this->request->getPost("music_id");

        $Song_Model = new Song_Model();
        $song = $Song_Model->where("id", $id)->first();

        if ($song) {
            $uuid = basename(dirname(FCPATH . 'public/songs/uploads/' . $song["filename"]));

            $musicFolderPath = FCPATH . 'public/songs/uploads/' . $uuid;

            $coverArtFolderPath = FCPATH . 'public/img/uploads/album_art/' . $uuid;

            if (is_dir($musicFolderPath)) {
                $this->delete_folder($musicFolderPath);
            }

            if (is_dir($coverArtFolderPath)) {
                $this->delete_folder($coverArtFolderPath);
            }

            $Song_Model->delete($id);

            $notification = [
                "title" => "Success!",
                "text"  => "Music deleted successfully!",
                "icon"  => "success",
            ];
        } else {
            $notification = [
                "title" => "Error!",
                "text"  => "Failed to delete music! Song not found.",
                "icon"  => "error",
            ];
        }

        session()->setFlashdata("notification", $notification);

        return json_encode(true);
    }

    private function delete_folder($folderPath)
    {
        if (is_dir($folderPath)) {
            $files = array_diff(scandir($folderPath), array('.', '..'));

            foreach ($files as $file) {
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;

                if (is_dir($filePath)) {
                    $this->delete_folder($filePath);
                } else {
                    unlink($filePath);
                }
            }

            rmdir($folderPath);
        }
    }

    public function get_music_by_id()
    {
        $id = $this->request->getPost("music_id");

        $Song_Model = new Song_Model();

        $song = $Song_Model->where("id", $id)->findAll(1)[0];

        return json_encode($song);
    }

    public function add_playlist()
    {
        $name = $this->request->getPost("name");
        $schedule = $this->request->getPost("schedule");
        $time_range = $this->request->getPost("time_range");

        $Playlist_Model = new Playlist_Model();

        $data = [
            "uuid" => $this->generate_uuid(),
            "name" => $name,
            "time_range" => $time_range,
            "schedule" => $schedule,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ];

        $Playlist_Model->insert($data);

        $notification = [
            "title" => "Success!",
            "text" => "Playlist added successfully!",
            "icon" => "success",
        ];

        session()->setFlashdata("notification", $notification);

        return json_encode(true);
    }

    public function add_to_playlist()
    {
        $playlist_id = $this->request->getPost("playlist_id");
        $song_ids = $this->request->getPost("selected_song_ids");

        $Playlist_Model = new Playlist_Model();
        $Song_Model = new Song_Model();

        if (!is_array($song_ids)) {
            $song_ids = !empty($song_ids) ? explode(",", $song_ids) : [];
        }

        foreach ($song_ids as $song_id) {
            $song = $Song_Model->find($song_id);

            if ($song) {
                $current_playlist_ids = !empty($song["playlist_ids"]) ? explode(",", $song["playlist_ids"]) : [];

                if (!in_array($playlist_id, $current_playlist_ids)) {
                    $current_playlist_ids[] = $playlist_id;

                    $data = [
                        "playlist_ids" => implode(",", $current_playlist_ids),
                        "updated_at" => date("Y-m-d H:i:s")
                    ];

                    if (!$Song_Model->update($song_id, $data)) {
                        error_log("Failed to update song_id: $song_id");
                    }
                }
            }
        }

        $playlist = $Playlist_Model->find($playlist_id);

        if ($playlist) {
            $current_song_ids = !empty($playlist["song_ids"]) ? explode(",", $playlist["song_ids"]) : [];

            foreach ($song_ids as $song_id) {
                if (!in_array($song_id, $current_song_ids)) {
                    $current_song_ids[] = $song_id;
                }
            }

            $playlist_data = [
                "song_ids" => implode(",", $current_song_ids),
                "updated_at" => date("Y-m-d H:i:s")
            ];

            if (!$Playlist_Model->update($playlist_id, $playlist_data)) {
                error_log("Failed to update playlist_id: $playlist_id");
            }
        }

        $notification = [
            "title" => "Success!",
            "text" => "Songs added to playlist successfully!",
            "icon" => "success",
        ];

        session()->setFlashdata("notification", $notification);

        return json_encode(true);
    }

    public function delete_playlist()
    {
        $id = $this->request->getPost("playlist_id");

        $Playlist_Model = new Playlist_Model();
        $Song_Model = new Song_Model();

        $playlist = $Playlist_Model->where("id", $id)->findAll(1)[0];

        if ($playlist) {
            $songs = $Song_Model->findAll();

            foreach ($songs as $song) {
                $playlist_ids = !empty($song["playlist_ids"]) ? explode(",", $song["playlist_ids"]) : [];
                if (in_array($id, $playlist_ids)) {
                    $playlist_ids = array_filter($playlist_ids, function ($pid) use ($id) {
                        return $pid != $id;
                    });

                    $data = [
                        "playlist_ids" => implode(",", $playlist_ids),
                        "updated_at" => date("Y-m-d H:i:s")
                    ];

                    $Song_Model->update($song["id"], $data);
                }
            }

            $Playlist_Model->delete($id);

            $notification = [
                "title" => "Success!",
                "text" => "Playlist deleted successfully!",
                "icon" => "success",
            ];
        } else {
            $notification = [
                "title" => "Oops...",
                "text" => "Failed to delete playlist!",
                "icon" => "error",
            ];
        }

        session()->setFlashdata("notification", $notification);

        return json_encode(true);
    }

    public function get_playlist_by_id()
    {
        $id = $this->request->getPost("playlist_id");

        $Playlist_Model = new Playlist_Model();

        $playlist = $Playlist_Model->where("id", $id)->findAll(1)[0];

        return json_encode($playlist);
    }

    public function edit_playlist()
    {
        $playlist_id = $this->request->getPost("playlist_id");
        $name = $this->request->getPost("name");
        $schedule = $this->request->getPost("schedule");
        $time_range = $this->request->getPost("time_range");

        $Playlist_Model = new Playlist_Model();

        $playlist = $Playlist_Model->find($playlist_id);

        if (!$playlist) {
            return json_encode([
                "status" => "error",
                "message" => "Playlist not found"
            ]);
        }

        $data = [
            "name" => $name,
            "time_range" => $time_range,
            "schedule" => $schedule,
            "updated_at" => date("Y-m-d H:i:s")
        ];

        $Playlist_Model->update($playlist_id, $data);

        $notification = [
            "title" => "Success!",
            "text" => "Playlist updated successfully!",
            "icon" => "success",
        ];

        session()->setFlashdata("notification", $notification);

        return json_encode([
            "status" => "success",
            "message" => "Playlist updated successfully!"
        ]);
    }

    public function sync_data()
    {
        $file = 'public/data/audio_data.json';

        $filePath = $this->request->getPost("file");
        $currentProgress = $this->request->getPost("progress");
        $duration = $this->request->getPost("duration");
        $is_playing = $this->request->getPost("is_playing") == "true";

        $filename = basename($filePath);

        $parts = explode('/', $filePath);
        $lastTwoParts = array_slice($parts, -2);
        $filename_not_original = implode('/', $lastTwoParts);

        if ($filename_not_original == "songs/default_song.mp3") {
            $filename_not_original = "default_song.mp3";
        }

        $session = session();

        if ($session->get('last_filename') === $filename) {
            $title = $session->get('last_title');
            $artist = $session->get('last_artist');
            $image = $session->get('last_image');
        } else {
            $Song_Model = new Song_Model();
            $song = $Song_Model->like('filename', $filename, 'both')->findAll(1);

            if (!empty($song)) {
                $title = $song[0]["title"];
                $artist = $song[0]["artist"];
                $image = $song[0]["image"];
            } else {
                $title = "Unknown Track";
                $artist = "Unknown Artist";
                $image = "public/img/audio-placeholder.webp";
            }

            $session->set([
                'last_filename' => $filename,
                'last_title' => $title,
                'last_artist' => $artist,
                'last_image' => $image
            ]);
        }

        $newData = [
            'filename' => $filename_not_original,
            'songTitle' => $title,
            'artist' => $artist,
            'image' => $image,
            'duration' => $duration,
            'currentProgress' => $currentProgress,
            'timestamp' => time(),
            'is_playing' => $is_playing,
        ];

        file_put_contents($file, json_encode($newData, JSON_PRETTY_PRINT));

        return json_encode($title);
    }

    // public function get_current_playlist_songs()
    // {
    //     $Playlist_Model = new Playlist_Model();
    //     $Song_Model = new Song_Model();

    //     $playlists = $Playlist_Model->findAll();

    //     $dayMap = [
    //         'Mon' => 'M',
    //         'Tue' => 'T',
    //         'Wed' => 'W',
    //         'Thu' => 'Th',
    //         'Fri' => 'F',
    //         'Sat' => 'Sa',
    //         'Sun' => 'Su'
    //     ];

    //     $currentDay = date('D');
    //     $currentTime = date('H:i');

    //     $shortDay = $dayMap[$currentDay] ?? '';
    //     $songTitles = ["../public/songs/default_song.mp3"];

    //     foreach ($playlists as $playlist) {
    //         $days = explode('-', $playlist['schedule']);

    //         if (in_array($shortDay, $days)) {
    //             list($startTime, $endTime) = explode(' - ', $playlist['time_range']);

    //             if ($currentTime >= $startTime && $currentTime <= $endTime) {
    //                 $songIds = explode(',', $playlist['song_ids']);
    //                 $songs = $Song_Model->whereIn('id', $songIds)->findAll();

    //                 if (!empty($songs)) {
    //                     $songTitles = array_map(fn($song) => "../public/songs/uploads/" . $song['filename'], $songs);
    //                 }

    //                 break;
    //             }
    //         }
    //     }

    //     return json_encode($songTitles);
    // }

    public function get_current_playlist_songs()
    {
        $Playlist_Model = new Playlist_Model();
        $Song_Model = new Song_Model();

        $playlists = $Playlist_Model->findAll();

        $dayMap = [
            'Mon' => 'M',
            'Tue' => 'T',
            'Wed' => 'W',
            'Thu' => 'Th',
            'Fri' => 'F',
            'Sat' => 'Sa',
            'Sun' => 'Su'
        ];

        $currentDay = date('D');
        $currentTime = date('H:i');

        $shortDay = $dayMap[$currentDay] ?? '';
        $songTitles = [];

        foreach ($playlists as $playlist) {
            $days = explode('-', $playlist['schedule']);

            if (in_array($shortDay, $days)) {
                list($startTime, $endTime) = explode(' - ', $playlist['time_range']);

                if ($currentTime >= $startTime && $currentTime <= $endTime) {
                    $songIds = array_map('trim', explode(',', $playlist['song_ids']));
                    $songIds = array_reverse($songIds); // Reverse the order

                    foreach ($songIds as $songId) {
                        $song = $Song_Model->find($songId);

                        if ($song && isset($song['filename'])) {
                            $songTitles[] = "../public/songs/uploads/" . $song['filename'];
                        }
                    }

                    break; // Stop after the first matched playlist
                }
            }
        }

        if (empty($songTitles)) {
            $songTitles[] = "../public/songs/default_song.mp3";
        }

        return json_encode($songTitles);
    }

    public function save_session_index()
    {
        $index = $this->request->getPost("index");
        $playlist = $this->request->getPost("playlist");

        $Now_Playing_Model = new Now_Playing_Model();

        $data = [
            "current_playlist_signature" => $playlist,
            "current_song_index" => $index,
            "updated_at" => date("Y-m-d H:i:s")
        ];

        $Now_Playing_Model->where("id", 1)->set($data)->update();

        return json_encode(true);
    }

    public function get_session_index()
    {
        $Now_Playing_Model = new Now_Playing_Model();
        $sessionData = $Now_Playing_Model->where("id", 1)->findAll(1)[0];

        $index = $sessionData["current_song_index"] ?? 0;
        $playlist = $sessionData["current_playlist_signature"] ?? null;

        return json_encode([
            'index' => $index,
            'playlist' => $playlist
        ]);
    }

    public function live_streaming()
    {
        $notification = [
            "title" => "Oops...",
            "text" => "This is not available yet!",
            "icon" => "error",
        ];

        session()->setFlashdata("notification", $notification);

        return json_encode(true);
    }
}
