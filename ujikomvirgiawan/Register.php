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
$success_message = '';

// Proses registrasi jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitasi input untuk keamanan
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Cek apakah username sudah ada di database
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Username sudah ada
        $error_message = 'Username sudah digunakan, pilih username lain!';
    } else {
        // Hash password dan simpan data pengguna ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($insert_query) === TRUE) {
            $success_message = 'Registrasi berhasil! Anda dapat login sekarang.';
        } else {
            $error_message = 'Terjadi kesalahan saat registrasi: ' . $conn->error;
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hezz Gallery</title>
    
    <!-- Link to Bootstrap CSS for responsive design -->
    <link rel="stylesheet" href="style.css">
    
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }

        .register-container {
            max-width: 450px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Opacity dikurangi sedikit untuk ketajaman */
            padding: 30px;
            border-radius: 15px; /* Sudut lebih halus */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Shadow ringan */
        }

        .register-container h3 {
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px; /* Margin antara input */
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 20px;
            height: 45px;
            font-size: 14px;
            border: 1px solid #ccc; /* Border yang lebih lembut */
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #6f42c1; /* Highlight warna saat input difokuskan */
            outline: none;
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #6f42c1;
            border: none;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #5a32a3;
        }

        .form-links {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .form-links a {
            color: #6f42c1;
            text-decoration: none;
            font-size: 14px;
        }

        .form-links a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>
    <div class="register-container">
        <h3>Register</h3>

        <!-- Menampilkan pesan error atau sukses -->
        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success_message)) : ?>
            <div class="alert alert-success" role="alert">
                <?= $success_message; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <!-- Input Username -->
            <div class="form-group">
                <label for="username" class="text-dark">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <!-- Input Email -->
            <div class="form-group">
                <label for="email" class="text-dark">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Input Password -->
            <div class="form-group">
                <label for="password" class="text-dark">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <input type="submit" value="Register" class="btn-custom">
        </form>

        <div class="form-links">
            <a href="Login.php">Already have an account? Login</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>
