<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback | Burger House</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>

<?php include "header.php"; ?>

<main>
    <section class="feedback-section">
        <h2 class="section-title">Customer Feedback</h2>
        <div class="section-content">
            <div class="feedback-swiper swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide feedback">
                        <img src="user-1.jpg" alt="Elira Krasniqi" class="user-image">
                        <h3 class="name">Elira Krasniqi</h3>
                        <p class="comment">"Burgeri më i mirë që kam shijuar."</p>
                    </div>
                    <div class="swiper-slide feedback">
                        <img src="user-2.jpg" alt="Arber Hoxha" class="user-image">
                        <h3 class="name">Arbër Hoxha</h3>
                        <p class="comment">"Eksperiencë shumë e mirë dhe shërbim i shpejtë."</p>
                    </div>
                    <div class="swiper-slide feedback">
                        <img src="user-3.jpg" alt="Dardan Berisha" class="user-image">
                        <h3 class="name">Dardan Berisha</h3>
                        <p class="comment">"Menuja ka shumë zgjedhje të shijshme."</p>
                    </div>
                    <div class="swiper-slide feedback">
                        <img src="user-4.jpg" alt="Blerta Gashi" class="user-image">
                        <h3 class="name">Blerta Gashi</h3>
                        <p class="comment">"Veggie Pizza gjithmonë e freskët dhe e shijshme."</p>
                    </div>
                    <div class="swiper-slide feedback">
                        <img src="user-5.jpg" alt="Valon Leka" class="user-image">
                        <h3 class="name">Valon Leka</h3>
                        <p class="comment">"Patatet e skuqura janë krokante dhe fantastike."</p>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>
