<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "blog_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $media_path = '';

    if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['media']['tmp_name'];
        $fileName = $_FILES['media']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'webp', 'mp4', 'mov', 'avi', 'mkv');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = './uploaded_files/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $media_path = $dest_path;
            } else {
                echo 'There was an error moving the uploaded file.';
                exit;
            }
        } else {
            echo 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            exit;
        }
    } else {
        echo 'No file uploaded or there was an upload error.';
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO posts (title, content, media_path) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $media_path);

    if ($stmt->execute()) {
        echo 'Post successfully added.';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
