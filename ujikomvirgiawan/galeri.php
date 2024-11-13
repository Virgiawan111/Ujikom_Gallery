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

// Ambil data foto dari database
$sql = "SELECT * FROM fotogallery ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Galeri Foto - Hezz Gallery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 20px;
        }
        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px 5px 0 0;
        }
    </style>
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
    <h2 class="text-center">Galeri Foto</h2>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-lg-4 col-md-6 mb-4'>";
                echo "<div class='card'>";
                echo "<img src='" . $row['foto_path'] . "' alt='Foto' class='card-img-top'>";
                echo "<div class='card-body'>";
                echo "<p class='card-text'>" . htmlspecialchars($row['keterangan']) . "</p>";
                echo "<small class='text-muted'>Diunggah pada: " . $row['tanggal'] . "</small>";
                echo "<hr>";

                // Tombol Like dan Komentar
                echo "<button class='btn btn-primary btn-sm mr-2' onclick='likePhoto(" . $row['id'] . ")'>Like</button>";
                echo "<span id='like-count-" . $row['id'] . "'>0</span> Likes"; // Menampilkan jumlah like
                echo "<div class='mt-3'>";
                echo "<form onsubmit='postComment(event, " . $row['id'] . ")'>";
                echo "<input type='text' class='form-control form-control-sm' placeholder='Tambahkan komentar...' required>";
                echo "<input type='text' class='form-control form-control-sm' placeholder='Masukan Keterangan...' required>";
                echo "<input type='text' class='form-control form-control-sm' placeholder='Masukan Saran...' required>";
                echo "<button type='submit' class='btn btn-secondary btn-sm mt-2'>Kirim</button>";
                echo "</form>";
                echo "<ul id='comment-list-" . $row['id'] . "' class='list-unstyled mt-2'></ul>"; // Menampilkan komentar
                echo "</div>";

                // Tombol Hapus Foto
                echo "<button class='btn btn-danger btn-sm mt-3' onclick='deletePhoto(" . $row['id'] . ", \"" . $row['foto_path'] . "\")'>Hapus Foto</button>";


                
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center'>Belum ada foto yang diunggah.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<script>
    function logout() {
        alert('You have logged out.');
        window.location.href = 'Login.php';
    }

   // Fungsi untuk menambah like ke foto
function likePhoto(photoId) {
    fetch("like.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "photo_id=" + photoId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Menampilkan jumlah like yang baru
            document.getElementById('like-count-' + photoId).innerText = data.like_count + " Likes";
        } else {
            alert(data.message); // Menampilkan pesan jika like gagal ditambahkan
        }
    });
}
    // Fungsi Kirim Komentar
    function postComment(event, photoId) {
        event.preventDefault(); // Mencegah refresh halaman

        let commentList = document.getElementById('comment-list-' + photoId);
        let input = event.target.querySelector('input[type="text"]');
        let newComment = document.createElement('li');
        newComment.textContent = input.value;
        commentList.appendChild(newComment); // Tambahkan komentar baru
        input.value = ""; // Kosongkan input setelah kirim
    }
</script>

<script>
// Fungsi untuk menambah like ke foto
function likePhoto(photoId) {
    fetch("like.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "photo_id=" + photoId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('like-count-' + photoId).innerText = data.like_count + " Likes";
        } else {
            alert("Gagal menambah like: " + data.error);
        }
    });
}

// Fungsi untuk mengirim komentar ke foto
function postComment(event, photoId) {
    event.preventDefault();
    
    let commentInput = event.target.querySelector('input[type="text"]');
    let commentText = commentInput.value;
    if (!commentText) return;

    fetch("comment.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "photo_id=" + photoId + "&comment_text=" + encodeURIComponent(commentText)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let commentList = document.getElementById('comment-list-' + photoId);
            let newComment = document.createElement('li');
            newComment.textContent = data.comment_text;
            commentList.appendChild(newComment);
            commentInput.value = ""; // Kosongkan input setelah kirim
        } else {
            alert("Gagal menambah komentar: " + data.error);
        }
    });
}

function deletePhoto(photoId, photoPath) {
    // Konfirmasi penghapusan
    if (confirm("Apakah Anda yakin ingin menghapus foto ini?")) {
        fetch("delete_photo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "photo_id=" + photoId + "&photo_path=" + encodeURIComponent(photoPath)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Foto berhasil dihapus.");
                location.reload(); // Reload halaman setelah foto dihapus
            } else {
                alert("Gagal menghapus foto: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menghapus foto.");
        });
    }
}

</script>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
