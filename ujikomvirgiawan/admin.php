



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
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px;
            margin: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px 5px 0 0;
        }

        .like-button, .comment-button {
            color: #007bff;
            cursor: pointer;
            border: none;
            background: none;
            padding: 5px;
        }

        .like-button.liked {
            color: red;
        }

        .comment-section {
            margin-top: 15px;
        }

        .comments {
            margin-top: 10px;
            font-size: 0.9em;
            color: #555;
        }

        .comments .comment {
            padding: 5px 0;
        }

        .delete-button {
            color: red;
            cursor: pointer;
            margin-left: 10px;
        }

        .add-photo-button {
            margin-top: 10px;
        }

        .uploaded-image {
            margin-top: 10px;
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-primary bg-dark">
        <a class="navbar-brand" href="#">Hezz Gallery</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            </div>
        </div>
        <div class="navbar-nav ml-auto">
            <button class="btn btn-outline-primary" onclick="logout()">Logout</button>
        </div>
    </nav>

    <div class="container">
        <!-- Card 1 -->
        <div class="card" id="card-1">
            <img src="lombokk.jpg" alt="Foto 1">
            <h2>Lombok</h2>
            <button class="like-button" onclick="toggleLike(1)">Like</button>
            <div class="comment-section">
                <input type="text" placeholder="Tulis komentar..." id="comment-input-1">
                <button onclick="addComment(1)">Kirim</button>
                <div class="comments" id="comments-1"></div>
                <!-- Button moved below comments section -->
                <button class="add-photo-button" onclick="document.getElementById('photo-input-1').click()">Tambah Foto</button>
                <input type="file" class="add-photo-input" id="photo-input-1" onchange="handleFileSelect(event, 1)" style="display: none;">
                <div id="uploaded-image-1"></div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="card" id="card-2">
            <img src="bromo.jpg" alt="Foto 2">
            <h2>Bromo</h2>
            <button class="like-button" onclick="toggleLike(2)">Like</button>
            <div class="comment-section">
                <input type="text" placeholder="Tulis komentar..." id="comment-input-2">
                <button onclick="addComment(2)">Kirim</button>
                <div class="comments" id="comments-2"></div>
                <!-- Button moved below comments section -->
                <button class="add-photo-button" onclick="document.getElementById('photo-input-2').click()">Tambah Foto</button>
                <input type="file" class="add-photo-input" id="photo-input-2" onchange="handleFileSelect(event, 2)" style="display: none;">
                <div id="uploaded-image-2"></div>
            </div>
        </div>

         <!-- Card 3-->
         <div class="card" id="card-3">
            <img src="borobudurr.jpg" alt="Foto 3">
            <h2>Borobur</h2>
            <button class="like-button" onclick="toggleLike(3)">Like</button>
            <div class="comment-section">
                <input type="text" placeholder="Tulis komentar..." id="comment-input-3">
                <button onclick="addComment(3)">Kirim</button>
                <div class="comments" id="comments-2"></div>
                <!-- Button moved below comments section -->
                <button class="add-photo-button" onclick="document.getElementById('photo-input-3').click()">Tambah Foto</button>
                <input type="file" class="add-photo-input" id="photo-input-3" onchange="handleFileSelect(event, 3)" style="display: none;">
                <div id="uploaded-image-3"></div>
            </div>
        </div>

         <!-- Card 4 -->
         <div class="card" id="card-4">
            <img src="raja ampat.jpg" alt="Foto 4">
            <h2>Raja Ampat</h2>
            <button class="like-button" onclick="toggleLike(4)">Like</button>
            <div class="comment-section">
                <input type="text" placeholder="Tulis komentar..." id="comment-input-4">
                <button onclick="addComment(4)">Kirim</button>
                <div class="comments" id="comments-2"></div>
                <!-- Button moved below comments section -->
                <button class="add-photo-button" onclick="document.getElementById('photo-input-4').click()">Tambah Foto</button>
                <input type="file" class="add-photo-input" id="photo-input-4" onchange="handleFileSelect(event, 4)" style="display: none;">
                <div id="uploaded-image-4"></div>
            </div>
        </div>

         <!-- Card 5 -->
         <div class="card" id="card-5">
            <img src="komodo.jpg" alt="Foto 5">
            <h2>Komodo</h2>
            <button class="like-button" onclick="toggleLike(5)">Like</button>
            <div class="comment-section">
                <input type="text" placeholder="Tulis komentar..." id="comment-input-5">
                <button onclick="addComment(5)">Kirim</button>
                <div class="comments" id="comments-5"></div>
                <!-- Button moved below comments section -->
                <button class="add-photo-button" onclick="document.getElementById('photo-input-5').click()">Tambah Foto</button>
                <input type="file" class="add-photo-input" id="photo-input-5" onchange="handleFileSelect(event, 5)" style="display: none;">
                <div id="uploaded-image-5"></div>
            </div>
        </div>

        <!-- Repeat for other cards... -->

         <!-- Card 6 -->
         <div class="card" id="card-6">
            <img src="rinjani.jpg" alt="Foto 6">
            <h2>Rinjani</h2>
            <button class="like-button" onclick="toggleLike(6)">Like</button>
            <div class="comment-section">
                <input type="text" placeholder="Tulis komentar..." id="comment-input-6">
                <button onclick="addComment(6)">Kirim</button>
                <div class="comments" id="comments-6"></div>
                <!-- Button moved below comments section -->
                <button class="add-photo-button" onclick="document.getElementById('photo-input-6').click()">Tambah Foto</button>
                <input type="file" class="add-photo-input" id="photo-input-6" onchange="handleFileSelect(event, 6)" style="display: none;">
                <div id="uploaded-image-6"></div>
            </div>
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
