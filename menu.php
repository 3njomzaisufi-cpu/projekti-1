<?php
session_start();
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
                <li class="menu-item">
                    <img src="images/burger-frenchfries.png" alt="Hamburger" class="menu-image">
                    <h3 class="name">Hamburger</h3>
                    <p class="description">Mish viçi i pjekur, i lëngshëm dhe i shijshëm, i shoqëruar me sallatë të freskët, domate dhe salcën tonë speciale.</p>
                </li>
                <li class="menu-item">
                    <img src="images/special-combo.png" alt="Special Combo" class="menu-image">
                    <h3 class="name">Special Combo</h3>
                    <p class="description">Burger me patate të skuqura dhe një pije të ftohtë shija e përditshme që gjithmonë të pëlqen.</p>
                </li>
                <li class="menu-item">
                    <img src="images/pizza1.png" alt="Pizza" class="menu-image">
                    <h3 class="name">Pizza</h3>
                    <p class="description">Pizza e sapo pjekur me brumë të butë dhe krokant, djathë mozzarella të shkrifët dhe salcë domate të shijshme.</p>
                </li>
                <li class="menu-item">
                    <img src="images/vegie.jpg" alt="Veggie Pizza" class="menu-image">
                    <h3 class="name">Veggie Pizza</h3>
                    <p class="description">Pizza e mbushur me perime të freskëta dhe djathë mozzarella.</p>
                </li>
                <li class="menu-item">
                    <img src="images/chicken.png" alt="Chicken wrap" class="menu-image">
                    <h3 class="name">Chicken Wrap</h3>
                    <p class="description">Një tortilla e mbushur me pulë të pjekur, perime të freskëta dhe salcë kremozë.</p>
                </li>
                <li class="menu-item">
                    <img src="images/beeef.jpg" alt="Beef Tortilla" class="menu-image">
                    <h3 class="name">Beef Tortilla</h3>
                    <p class="description">Tortilla e ngrohtë me mish viçi të spërkatur, perime të freskëta dhe salcë.</p>
                </li>
                <li class="menu-item">
                    <img src="images/sandwich.jpg.png" alt="Baguette Sandwich" class="menu-image">
                    <h3 class="name">Baguette Sandwich</h3>
                    <p class="description">Baguette krokante e mbushur me mish, perime dhe salcë me shije.</p>
                </li>
                <li class="menu-item">
                    <img src="images/french.jpg" alt="French Fries" class="menu-image">
                    <h3 class="name">French Fries</h3>
                    <p class="description">Patate të skuqura të arta dhe krokante të jashtme, të brendshme të buta.</p>
                </li>
                <li class="menu-item">
                    <img src="images/nugget.jpg" alt="Chicken Nuggets" class="menu-image">
                    <h3 class="name">Chicken Nuggets</h3>
                    <p class="description">Pulë të skuqur, e butë brend perfekt për kafshatë të vogël.</p>
                </li>
            </ul>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>

</body>
</html>
