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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hezz Gallery</title>
    
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
        // To handle the "like" toggle functionality
        function toggleLike(cardId) {
            const likeButton = document.querySelector(`#card-${cardId} .like-button`);
            likeButton.classList.toggle('liked');
            likeButton.textContent = likeButton.classList.contains('liked') ? 'Like❤️' : 'Like';
        }

        // To add comments
        function addComment(cardId) {
            const commentInput = document.querySelector(`#comment-input-${cardId}`);
            const commentText = commentInput.value.trim();

            if (commentText) {
                const commentSection = document.querySelector(`#comments-${cardId}`);
                const comment = document.createElement('div');
                comment.classList.add('comment');
                comment.textContent = commentText;

                // Optional: Add a delete button for each comment
                const deleteButton = document.createElement('span');
                deleteButton.classList.add('delete-button');
                deleteButton.textContent = 'Delete';
                deleteButton.onclick = function () {
                    comment.remove();
                };

                comment.appendChild(deleteButton);
                commentSection.appendChild(comment);

                // Clear the input after adding comment
                commentInput.value = '';
            }
        }

        // Function to handle file upload and display the image
        function handleFileSelect(event, cardId) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                const uploadedImage = document.querySelector(`#uploaded-image-${cardId}`);
                uploadedImage.innerHTML = `<img src="${e.target.result}" class="uploaded-image" alt="Uploaded image">`;
            };

            reader.readAsDataURL(file);
        }

        // Optional: Logout function
        function logout() {
    alert('You have logged out.'); // Menampilkan peringatan logout
    window.location.href = 'Login.php'; // Mengarahkan ke halaman login
}

    </script>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>
