<?php
// Mulai sesi
session_start();

// Koneksi ke database MySQL
$host = 'localhost';  // Sesuaikan dengan konfigurasi database Anda
$dbUsername = 'root';  // Username MySQL Anda
$dbPassword = '';      // Password MySQL Anda
$dbname = 'ujikom_photogalery'; // Nama database Anda

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk pesan error
$error_message = '';

// Proses login jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitasi input untuk keamanan
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk mencari pengguna berdasarkan username
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data pengguna di sesi
            $_SESSION['username'] = $user['username'];
            header("Location: home.php"); // Ganti dengan halaman setelah login berhasil
            exit();
        } else {
            $error_message = 'Password salah!';
        }
    } else {
        $error_message = 'Username tidak ditemukan!';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hezz Gallery - Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Mengatur style container dan form */
        body {
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        .login-wrapper {
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-wrapper h3 {
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 30px;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-dark {
            border-radius: 30px;
            padding: 10px;
            font-weight: bold;
            background-color: #343a40;
            color: #fff;
            border: none;
            width: 100%;
            margin-bottom: 15px;
        }

        .btn-dark:hover {
            background-color: #5a6268;
        }

        .alert {
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .register-link {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .mt-5 {
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <h3>Login Hezz Gallery</h3>

        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="Login.php" method="POST">
            <div class="form-group">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" class="form-control" name="username" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" class="form-control" name="password" required>
            </div>

            <input type="submit" value="Login" class="btn btn-dark">
        </form>

        <p>Belum punya akun? <a href="Register.php" class="register-link">Daftar Sekarang</a></p>
    </div>

</body>

</html>
