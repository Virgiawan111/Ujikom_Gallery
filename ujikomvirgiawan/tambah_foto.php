<?php
// Menyertakan konfigurasi koneksi database
$host = "localhost";      // Ganti dengan host Anda
$username = "root";       // Ganti dengan username Anda
$password = "";           // Ganti dengan password Anda
$dbname = "ujikom_photogalery"; // Ganti dengan nama database Anda

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $keterangan = $_POST['keterangan'];
    $keterangan = htmlspecialchars($keterangan, ENT_QUOTES, 'UTF-8'); // Sanitasi input
    
    // Memeriksa apakah ada file yang diunggah
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto'];
        $target_dir = "uploads/"; // Folder untuk menyimpan foto
        $target_file = $target_dir . basename($foto["name"]);
        
        // Memindahkan file yang diunggah ke folder tujuan
        if (move_uploaded_file($foto["tmp_name"], $target_file)) {
            // Menyimpan path dan keterangan foto ke database
            $sql = "INSERT INTO fotogallery (foto_path, keterangan, tanggal) VALUES ('$target_file', '$keterangan', NOW())";
            
            if ($conn->query($sql) === TRUE) {
                echo "Foto berhasil ditambahkan!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah foto.";
        }
    } else {
        echo "Harap pilih foto untuk diunggah.";
    }
}

// Menutup koneksi
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah Foto - Hezz Gallery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-primary bg-dark">
        <a class="navbar-brand" href="home.php">Hezz Gallery</a>
        <a class="nav-item nav-link text-light" href="tambah_foto.php">Tambah Foto</a> <!-- New "Tambah Foto" link -->
        <a class="nav-item nav-link text-light" href="galeri.php">Foto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            
            </div>
        </div>
        <div class="navbar-nav ml-auto">
            <button class="btn btn-outline-primary" onclick="logout()">Logout</button>
        </div>
    </nav>

<div class="container mt-5">
    <h2>Tambah Foto Baru</h2>
    <form action="tambah_foto.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="foto">Pilih Foto</label>
            <input type="file" name="foto" id="foto" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan Foto</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Unggah Foto</button>
    </form>
</div>

<script>
    function logout() {
        alert('You have logged out.');
        window.location.href = 'Login.php';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
