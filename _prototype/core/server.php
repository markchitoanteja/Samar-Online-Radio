<?php
require_once 'helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (post("sync_data")) {
        $file = '../data/audio_data.json';

        $filePath = post("file");
        $currentProgress = post("progress");
        $duration = post("duration");
        $is_playing = post("is_playing");

        $filename = basename($filePath);

        $title = post("title") ?: pathinfo($filename, PATHINFO_FILENAME);

        $newData = [
            'filename' => $filename,
            'songTitle' => $title,
            'duration' => $duration,
            'currentProgress' => $currentProgress,
            'timestamp' => time(),
            'is_playing' => $is_playing,
        ];

        file_put_contents($file, json_encode($newData, JSON_PRETTY_PRINT));

        $response = [
            'status' => 'success',
            'message' => 'Data logged successfully.',
        ];

        echo json_encode($response);
    }
} else {
    echo json_encode("Invalid request method.");
}
