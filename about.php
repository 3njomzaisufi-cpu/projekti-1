<?php
session_start();

class AboutSection {
    public $title;
    public $text;
    public $image;
    public $socialLinks;

    public function __construct($title, $text, $image, $socialLinks = []) {
        $this->title = $title;
        $this->text = $text;
        $this->image = $image;
        $this->socialLinks = $socialLinks;
    }

    public function renderSocialLinks() {
        $html = '';
        foreach ($this->socialLinks as $link) {
            $html .= "<a href='{$link['href']}' class='social-link'><i class='{$link['icon']}'></i></a>";
        }
        return $html;
    }

    public function render() {
        return "
        <section class='about-section'>
            <div class='section-content'>
                <div class='about-image-wrapper'>
                    <img src='{$this->image}' alt='About' class='about-image'>
                </div>
                <div class='about-details'>
                    <h2 class='section-title'>{$this->title}</h2>
                    <p class='text'>{$this->text}</p>
                    <div class='social-link-list'>
                        {$this->renderSocialLinks()}
                    </div>
                </div>
            </div>
        </section>
        ";
    }
}

$about = new AboutSection(
    'About us',
    "Në zemër të përvojës sonë të ushqimit të shpejtë qëndron pasioni për shijet e forta dhe momentet që ndajmë me çdo vakt. 
    Ne zgjedhim me kujdes përbërës të freskët dhe përgatisim çdo pjatë me përkushtim, duke ofruar një shije të paharrueshme. 
    Na gjeni në Rr. Bulevardi Bill Clinton, Prishtinë.",
    'images/about-image.jpg',
    [
        ['href'=>'#','icon'=>'fa-brands fa-facebook'],
        ['href'=>'#','icon'=>'fa-brands fa-instagram'],
        ['href'=>'#','icon'=>'fa-brands fa-tiktok']
    ]
);
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
    <?php echo $about->render(); ?>
</main>

<?php include "footer.php"; ?>

</body>
</html>
