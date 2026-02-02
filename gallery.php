<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery | Burger House</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<?php include "header.php"; ?>

<main>
    <section class="gallery-section">
        <h2 class="section-title">Gallery</h2>
        <div class="section-content">
            <ul class="gallery-list">
                <li class="gallery-item"><img src="photo1.jpg" alt="Gallery Image 1" class="gallery-image"></li>
                <li class="gallery-item"><img src="photo2.jpg" alt="Gallery Image 2" class="gallery-image"></li>
                <li class="gallery-item"><img src="photo4.jpg" alt="Gallery Image 3" class="gallery-image"></li>
                <li class="gallery-item"><img src="photo5.jpg" alt="Gallery Image 4" class="gallery-image"></li>
                <li class="gallery-item"><img src="photo6.jpg" alt="Gallery Image 5" class="gallery-image"></li>
                <li class="gallery-item"><img src="photo7.jpg" alt="Gallery Image 6" class="gallery-image"></li>
            </ul>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>

</body>
</html>
