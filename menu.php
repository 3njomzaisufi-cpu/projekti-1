<?php
session_start();

class MenuItem {
    public $name;
    public $image;
    public $description;

    public function __construct($name, $image, $description) {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
    }

    public function render() {
        return "
        <li class='menu-item'>
            <img src='{$this->image}' alt='{$this->name}' class='menu-image'>
            <h3 class='name'>{$this->name}</h3>
            <p class='description'>{$this->description}</p>
        </li>
        ";
    }
}

class Menu {
    private $items = [];

    public function __construct(array $items = []) {
        $this->items = $items;
    }

    public function addItem(MenuItem $item) {
        $this->items[] = $item;
    }

    public function render() {
        $html = '';
        foreach ($this->items as $item) {
            $html .= $item->render();
        }
        return $html;
    }
}

$menu = new Menu([
    new MenuItem("Hamburger", "images/burger-frenchfries.png", "Mish viçi i pjekur, i lëngshëm dhe i shijshëm, i shoqëruar me sallatë të freskët, domate dhe salcën tonë speciale."),
    new MenuItem("Special Combo", "images/special-combo.png", "Burger me patate të skuqura dhe një pije të ftohtë shija e përditshme që gjithmonë të pëlqen."),
    new MenuItem("Pizza", "images/pizza1.png", "Pizza e sapo pjekur me brumë të butë dhe krokant, djathë mozzarella të shkrifët dhe salcë domate të shijshme."),
    new MenuItem("Veggie Pizza", "images/vegie.jpg", "Pizza e mbushur me perime të freskëta dhe djathë mozzarella."),
    new MenuItem("Chicken Wrap", "images/chicken.png", "Një tortilla e mbushur me pulë të pjekur, perime të freskëta dhe salcë kremozë."),
    new MenuItem("Beef Tortilla", "images/beeef.jpg", "Tortilla e ngrohtë me mish viçi të spërkatur, perime të freskëta dhe salcë."),
    new MenuItem("Baguette Sandwich", "images/sandwich.jpg.png", "Baguette krokante e mbushur me mish, perime dhe salcë me shije."),
    new MenuItem("French Fries", "images/french.jpg", "Patate të skuqura të arta dhe krokante të jashtme, të brendshme të buta."),
    new MenuItem("Chicken Nuggets", "images/nugget.jpg", "Pulë të skuqur, e butë brend perfekt për kafshatë të vogël.")
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu | Burger House</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<?php include "header.php"; ?>

<main>
    <section class="menu-section">
        <h2 class="section-title">Our Menu</h2>
        <div class="section-content">
            <ul class="menu-list">
                <?= $menu->render() ?>
            </ul>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>

</body>
</html>
