<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "ujikom_photogalery";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari request
$photo_id = isset($_POST['photo_id']) ? intval($_POST['photo_id']) : 0;
$comment_text = isset($_POST['comment_text']) ? $conn->real_escape_string($_POST['comment_text']) : '';

if ($photo_id > 0 && !empty($comment_text)) {
    // Tambahkan komentar ke dalam tabel comments
    $sql = "INSERT INTO comments (photo_id, comment_text) VALUES ($photo_id, '$comment_text')";
    if ($conn->query($sql) === TRUE) {
        // Mengirim respons sukses
        echo json_encode(["success" => true, "comment_text" => $comment_text]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid input data"]);
}

$conn->close();
?>
