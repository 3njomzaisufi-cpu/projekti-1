<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | Burger House</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<?php include "header.php"; ?>

<main>
    <section class="about-section">
        <div class="section-content">
            <div class="about-image-wrapper">
                <img src="images/about-image.jpg" alt="About" class="about-image">
            </div>
            <div class="about-details">
                <h2 class="section-title">About us</h2>
                <p class="text">
                    Në zemër të përvojës sonë të ushqimit të shpejtë qëndron pasioni për shijet e forta dhe momentet që ndajmë me çdo vakt. 
                    Ne zgjedhim me kujdes përbërës të freskët dhe përgatisim çdo pjatë me përkushtim, duke ofruar një shije të paharrueshme. 
                    Na gjeni në Rr. Bulevardi Bill Clinton, Prishtinë.
                </p>
                <div class="social-link-list">
                    <a href="#" class="social-link"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>

</body>
</html>
