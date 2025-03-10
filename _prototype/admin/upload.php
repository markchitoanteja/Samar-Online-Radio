<?php
function upload_songs($files, $uploadDir = '../dist/uploads/')
{
    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadedFiles = [];

    // Handle single and multiple files
    $filesArray = is_array($files['name']) ? $files : [
        'name' => [$files['name']],
        'type' => [$files['type']],
        'tmp_name' => [$files['tmp_name']],
        'error' => [$files['error']],
        'size' => [$files['size']]
    ];

    foreach ($filesArray['name'] as $key => $fileName) {
        $fileType = $filesArray['type'][$key];
        $tmpName = $filesArray['tmp_name'][$key];
        $error = $filesArray['error'][$key];
        $fileSize = $filesArray['size'][$key];

        // Validate file type (MP3 only)
        if ($fileType !== 'audio/mpeg') {
            echo "<p style='color:red;'>Error: Only MP3 files are allowed - $fileName</p>";
            continue;
        }

        // Check for upload errors
        if ($error !== UPLOAD_ERR_OK) {
            echo "<p style='color:red;'>Error uploading file: $fileName</p>";
            continue;
        }

        // Generate unique file name if it exists
        $targetFile = $uploadDir . basename($fileName);
        while (file_exists($targetFile)) {
            $fileInfo = pathinfo($targetFile);
            $targetFile = $fileInfo['dirname'] . '/' . $fileInfo['filename'] . '_copy.' . $fileInfo['extension'];
        }

        // Move file to destination
        if (move_uploaded_file($tmpName, $targetFile)) {
            echo "<p style='color:green;'>Uploaded: $targetFile</p>";
            $uploadedFiles[] = $targetFile;
        } else {
            echo "<p style='color:red;'>Failed to upload: $fileName</p>";
        }
    }

    return $uploadedFiles;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload MP3 Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type='file'] {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Upload MP3 Files</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="songs[]" multiple accept="audio/mpeg"><br>
        <input type="submit" value="Upload">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['songs'])) {
        upload_songs($_FILES['songs']);
    }
    ?>
</body>

</html>