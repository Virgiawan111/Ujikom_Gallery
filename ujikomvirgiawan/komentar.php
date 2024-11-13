<?php
$host = "localhost"; // Ganti dengan host Anda
$username = "root";  // Ganti dengan username Anda
$password = "";      // Ganti dengan password Anda
$dbname = "ujikom_photogalery"; // Ganti dengan nama database Anda

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


// Menyertakan konfigurasi koneksi
include('config.php');

// Memeriksa apakah data POST ada
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];

    // Menyiapkan query SQL untuk memasukkan data
    $stmt = $conn->prepare("INSERT INTO komentarfoto (isikomentar, tanggalkomentar) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $komentar); // 'ss' berarti dua parameter string

    // Menjalankan query dan memeriksa apakah berhasil
    if ($stmt->execute()) {
        echo "Komentar berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    echo "Form tidak disubmit dengan benar.";
}
?>
