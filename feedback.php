<?php
session_start();

class Feedback {
    public $image;
    public $name;
    public $comment;

    public function __construct($image, $name, $comment) {
        $this->image = $image;
        $this->name = $name;
        $this->comment = $comment;
    }

    public function render() {
        return "
        <div class='swiper-slide feedback'>
            <img src='{$this->image}' alt='{$this->name}' class='user-image'>
            <h3 class='name'>{$this->name}</h3>
            <p class='comment'>{$this->comment}</p>
        </div>
        ";
    }
}

$feedbacks = [
    new Feedback('user-1.jpg','Elira Krasniqi','"Burgeri më i mirë që kam shijuar."'),
    new Feedback('user-2.jpg','Arbër Hoxha','"Eksperiencë shumë e mirë dhe shërbim i shpejtë."'),
    new Feedback('user-3.jpg','Dardan Berisha','"Menuja ka shumë zgjedhje të shijshme."'),
    new Feedback('user-4.jpg','Blerta Gashi','"Veggie Pizza gjithmonë e freskët dhe e shijshme."'),
    new Feedback('user-5.jpg','Valon Leka','"Patatet e skuqura janë krokante dhe fantastike."')
];
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
                    <?php
                    foreach ($feedbacks as $fb) {
                        echo $fb->render();
                    }
                    ?>
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
