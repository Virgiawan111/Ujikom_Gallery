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

// Ambil ID foto dan path foto dari request
$photoId = $_POST['photo_id'];
$photoPath = $_POST['photo_path'];

// Mulai transaksi
$conn->begin_transaction();

try {
    // Hapus like terkait foto
    $sqlLike = "DELETE FROM likes WHERE photo_id = ?";
    $stmt = $conn->prepare($sqlLike);
    $stmt->bind_param("i", $photoId);
    $stmt->execute();

    // Hapus komentar terkait foto
    $sqlComment = "DELETE FROM comments WHERE photo_id = ?";
    $stmt = $conn->prepare($sqlComment);
    $stmt->bind_param("i", $photoId);
    $stmt->execute();

    // Hapus foto dari galeri
    $sqlPhoto = "DELETE FROM fotogallery WHERE id = ?";
    $stmt = $conn->prepare($sqlPhoto);
    $stmt->bind_param("i", $photoId);
    $stmt->execute();

    // Hapus file foto di server
    if (file_exists($photoPath)) {
        unlink($photoPath);
    }

    // Commit transaksi
    $conn->commit();
    
    // Kirim respons sukses
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // Rollback jika ada kesalahan
    $conn->rollback();
    
    // Kirim respons gagal
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

$conn->close();
?>
