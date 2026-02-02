<?php
session_start();

class MenuItem {
    public $name;
    public $image;
    public $desc;
    public $price;

    public function __construct($name, $image, $desc, $price) {
        $this->name = $name;
        $this->image = $image;
        $this->desc = $desc;
        $this->price = $price;
    }
}

class OrderManager {
    private $orders;

    public function __construct() {
        if (!isset($_SESSION['all_orders'])) $_SESSION['all_orders'] = [];
        $this->orders = &$_SESSION['all_orders'];
    }

    public function addOrder($user, MenuItem $item) {
        $this->orders[] = ['id'=>uniqid(),'user'=>$user,'produkt'=>$item->name,'price'=>$item->price];
    }

    public function deleteOrder($id) {
        $this->orders = array_values(array_filter($this->orders, fn($o)=>$o['id'] !== $id));
    }

    public function completeOrders() {
        $this->orders = [];
    }

    public function getOrders() {
        return $this->orders;
    }
}

$menuItems = [
    new MenuItem('Hamburger','images/burger-frenchfries.png','Mish viçi i pjekur, i lëngshëm dhe i shijshëm, me sallatë dhe salcë speciale.',5.5),
    new MenuItem('Special Combo','images/special-combo.png','Burger me patate të skuqura dhe një pije të ftohtë.',7.0),
    new MenuItem('Pizza','images/pizza1.png','Pizza e sapo pjekur me djathë mozzarella dhe salcë domate.',8.5),
    new MenuItem('Veggie Pizza','images/vegie.jpg','Pizza me perime të freskëta dhe djathë mozzarella.',7.5),
    new MenuItem('Chicken Wrap','images/chicken.png','Tortilla me pulë të pjekur, perime të freskëta dhe salcë kremozë.',6.0),
    new MenuItem('Beef Tortilla','images/beeef.jpg','Tortilla me mish viçi të spërkatur dhe perime.',6.5),
    new MenuItem('Baguette Sandwich','images/sandwich.jpg.png','Baguette krokante me mish, perime dhe salcë.',5.0),
    new MenuItem('French Fries','images/french.jpg','Patate të skuqura të arta dhe krokante.',3.0),
    new MenuItem('Chicken Nuggets','images/nugget.jpg','Pulë të skuqur, e butë brenda dhe krokante jashtë.',4.0)
];

$orderManager = new OrderManager();
$showLogin = !isset($_SESSION['user_id']);
$username = $_SESSION['user_id'] ?? '';

if (isset($_POST['produkt'])) {
    foreach ($menuItems as $item) {
        if ($item->name === $_POST['produkt']) {
            $orderManager->addOrder($username ?? 'Guest', $item);
            break;
        }
    }
}

if (isset($_POST['delete_id'])) $orderManager->deleteOrder($_POST['delete_id']);
if (isset($_POST['complete_order'])) $orderManager->completeOrders();
$orders = $orderManager->getOrders();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faza Pare</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "header.php"; ?>

<main>
<section class="hero-section" id="home">
<div class="section-content">
<div class="hero-details">
<h2 class="title">Hot, Crispy & Tasty</h2>
<p class="description">Ke uri për diçka të shpejtë, të freskët dhe vërtet të shijshme? Burger House është zgjedhja perfekte për të kënaqur dëshirën tënde me menunë tonë të jashtëzakonshme.</p>
<div class="buttons">
<a href="#" class="button order-now">Order Now</a>
<a href="#" class="button learn-more">Learn More</a>
</div>
</div>
<div class="hero-image-wrapper">
<img src="images/special-combo.png" alt="Hero" class="hero-image">
</div>
</div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
