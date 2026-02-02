<?php
session_start();

class GalleryImage {
    public $src;
    public $alt;

    public function __construct($src, $alt) {
        $this->src = $src;
        $this->alt = $alt;
    }

    public function render() {
        return "<li class='gallery-item'><img src='{$this->src}' alt='{$this->alt}' class='gallery-image'></li>";
    }
}

$images = [
    new GalleryImage('photo1.jpg','Gallery Image 1'),
    new GalleryImage('photo2.jpg','Gallery Image 2'),
    new GalleryImage('photo4.jpg','Gallery Image 3'),
    new GalleryImage('photo5.jpg','Gallery Image 4'),
    new GalleryImage('photo6.jpg','Gallery Image 5'),
    new GalleryImage('photo7.jpg','Gallery Image 6')
];
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
                <?php
                foreach ($images as $img) {
                    echo $img->render();
                }
                ?>
            </ul>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>

</body>
</html>
