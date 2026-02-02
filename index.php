<?php
session_start();
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
<?php
$menuItems = [
['name'=>'Hamburger','image'=>'images/burger-frenchfries.png','desc'=>'Mish viçi i pjekur, i lëngshëm dhe i shijshëm, me sallatë dhe salcë speciale.','price'=>5.5],
['name'=>'Special Combo','image'=>'images/special-combo.png','desc'=>'Burger me patate të skuqura dhe një pije të ftohtë.','price'=>7.0],
['name'=>'Pizza','image'=>'images/pizza1.png','desc'=>'Pizza e sapo pjekur me djathë mozzarella dhe salcë domate.','price'=>8.5],
['name'=>'Veggie Pizza','image'=>'images/vegie.jpg','desc'=>'Pizza me perime të freskëta dhe djathë mozzarella.','price'=>7.5],
['name'=>'Chicken Wrap','image'=>'images/chicken.png','desc'=>'Tortilla me pulë të pjekur, perime të freskëta dhe salcë kremozë.','price'=>6.0],
['name'=>'Beef Tortilla','image'=>'images/beeef.jpg','desc'=>'Tortilla me mish viçi të spërkatur dhe perime.','price'=>6.5],
['name'=>'Baguette Sandwich','image'=>'images/sandwich.jpg.png','desc'=>'Baguette krokante me mish, perime dhe salcë.','price'=>5.0],
['name'=>'French Fries','image'=>'images/french.jpg','desc'=>'Patate të skuqura të arta dhe krokante.','price'=>3.0],
['name'=>'Chicken Nuggets','image'=>'images/nugget.jpg','desc'=>'Pulë të skuqur, e butë brenda dhe krokante jashtë.','price'=>4.0]
];
if (!isset($_SESSION['all_orders'])) $_SESSION['all_orders'] = [];
if (isset($_POST['produkt'])) {
foreach ($menuItems as $item) {
if ($item['name'] === $_POST['produkt']) {
$_SESSION['all_orders'][] = ['id'=>uniqid(),'user'=>$_SESSION['user_id'] ?? 'Guest','produkt'=>$item['name'],'price'=>$item['price']];
break;
}
}
}
if (isset($_POST['delete_id'])) {
$delete_id = $_POST['delete_id'];
$_SESSION['all_orders'] = array_values(array_filter($_SESSION['all_orders'], fn($o)=>$o['id'] !== $delete_id));
}
if (isset($_POST['complete_order'])) $_SESSION['all_orders'] = [];
$showLogin = !isset($_SESSION['user_id']);
$username = $_SESSION['user_id'] ?? '';
$orders = $_SESSION['all_orders'];
?>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
