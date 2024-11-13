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

// Tangkap ID foto dari request
$photo_id = isset($_POST['photo_id']) ? intval($_POST['photo_id']) : 0;

if ($photo_id > 0) {
    // Tambahkan like ke dalam tabel likes
    $sql = "INSERT INTO likes (photo_id) VALUES ($photo_id)";
    if ($conn->query($sql) === TRUE) {
        // Menghitung total like setelah penambahan
        $count_result = $conn->query("SELECT COUNT(*) AS like_count FROM likes WHERE photo_id = $photo_id");
        $like_count = $count_result->fetch_assoc()['like_count'];
        
        // Kirim respons jumlah like
        echo json_encode(["success" => true, "like_count" => $like_count]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid photo ID"]);
}

$conn->close();
?>
