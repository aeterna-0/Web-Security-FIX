<?php
session_start();

if (!isset($_GET['file'])) {
    http_response_code(400);
    die('Error: File Apa Ini Anjir');
}

$file_name = basename($_GET['file']);
$base_dir  = __DIR__;
$full_path = realpath($base_dir . '/download/' . $file_name);

if ($file_name === 'key') {
    http_response_code(403);
    die('Error: Yahaha...Gak Bisa Download Ya?');
}

if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if (strpos($full_path, $base_dir) !== 0) {
    http_response_code(403);
    die('Error: File Apa Ini Anjir');
}

if (strtolower(substr($file_name, -4)) === '.php') {
    http_response_code(403);
    die('Error: Yahaha...Gak Bisa Download Ya?');
}

if (strtolower(substr($file_name, -4)) === '.txt') {
    http_response_code(403);
    die('Error: Yahaha...Gak Bisa Download Ya?');
}

if (is_readable($full_path)) {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . basename($full_path) . '"');
    header('Content-Length: ' . filesize($full_path));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    ob_clean();
    flush();
    readfile($full_path);
    exit;
}

http_response_code(404);
die('Error: File not found or is not readable.');
?>