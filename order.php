<?php
session_start();

class User {
    public $username;
    public $role;
    public function __construct($username = '', $role = '') {
        $this->username = $username;
        $this->role = $role;
    }
}

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

class Order {
    private $items = [];
    public function __construct() {
        if (!isset($_SESSION['orders'])) $_SESSION['orders'] = [];
        $this->items = &$_SESSION['orders'];
    }
    public function addItem(MenuItem $item) {
        $this->items[] = ['id'=>uniqid(),'product_name'=>$item->name,'price'=>$item->price];
    }
    public function removeItem($id) {
        $this->items = array_filter($this->items, fn($o)=>$o['id']!==$id);
    }
    public function complete() {
        $this->items = [];
    }
    public function getItems() {
        return $this->items;
    }
    public function getTotal() {
        $total = 0;
        foreach($this->items as $o) $total += $o['price'];
        return $total;
    }
}

$showLogin = !isset($_SESSION['user_id']);
$user = new User($_SESSION['username'] ?? '', $_SESSION['role'] ?? '');
$order = new Order();

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

if (!$showLogin && $user->role === 'admin') {
    header("Location: admin_dashboard.php");
    exit;
}

if (!$showLogin && isset($_POST['produkt'])) {
    foreach($menuItems as $item) {
        if($item->name === $_POST['produkt']) {
            $order->addItem($item);
            break;
        }
    }
}

if (!$showLogin && isset($_POST['delete_id'])) {
    $order->removeItem($_POST['delete_id']);
}

if (!$showLogin && isset($_POST['complete_order'])) {
    $order->complete();
}

$orders = $order->getItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Porosi</title>
<link rel="stylesheet" href="style.css">
<style>
body { font-family: "Poppins", sans-serif; background:#f5f5f5; margin:0; padding:0; }
h2.title-welcome { font-family: 'Miniver', cursive; color: #f3961c; font-size:2.3rem; text-align:center; margin:40px 0; }
.menu-dashboard { display:flex; flex-wrap:wrap; gap:30px; justify-content:center; margin:20px; }
.menu-card { background:#fff; border-radius:30px; padding:20px; width:250px; text-align:center; box-shadow:0 5px 15px rgba(0,0,0,0.1); transition:0.3s; display:flex; flex-direction:column; height:400px; }
.menu-card img { width:100%; border-radius:20px; }
.menu-card h3 { margin:15px 0 5px; color:#252525; }
.menu-card p { font-size:0.95rem; color:#555; flex-grow:1; margin-bottom:5px; overflow:hidden; }
.menu-card span.price { font-weight:600; font-size:0.9rem; color:#f3961c; margin-bottom:5px; }
.menu-card form { margin-top:auto; }
.menu-card button { padding:8px 20px; border-radius:25px; border:none; background:#f3961c; color:#252525; font-weight:600; cursor:pointer; transition:0.3s; width:100%; font-size:0.85rem; }
.menu-card button:hover { background:#fff; color:#f3961c; border:2px solid #f3961c; }
.orders-list { max-width:800px; margin:20px auto; background:#fff; padding:20px; border-radius:30px; box-shadow:0 5px 15px rgba(0,0,0,0.1); }
.orders-list h3 { text-align:center; margin-bottom:15px; }
.orders-list ul { list-style:none; padding-left:0; }
.orders-list li { padding:10px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center; }
.orders-list li.total { font-weight:bold; font-size:1.1rem; border-top:2px solid #f3961c; margin-top:10px; padding-top:10px; }
.delete-x { background:none; border:none; color:#f3961c; font-size:18px; font-weight:bold; cursor:pointer; padding:0; }
.delete-x:hover { color:red; }
.login-form { max-width:350px; margin:50px auto; background:#fff; padding:20px; border-radius:20px; box-shadow:0 5px 15px rgba(0,0,0,0.1); display:flex; flex-direction:column; gap:15px; }
.login-form input { width:100%; padding:10px; border-radius:10px; border:1px solid #ccc; font-size:1rem; }
.login-form button { padding:10px 26px; border-radius:30px; border:none; background:#f3961c; color:#252525; font-weight:600; cursor:pointer; transition:0.3s; width:100%; }
.login-form button:hover { background:#fff; color:#f3961c; border:2px solid #f3961c; }
#action-buttons { text-align:center; margin:30px; display:flex; justify-content:center; gap:15px; flex-wrap:wrap; }
#action-buttons a.logout-btn { padding:10px 26px; border-radius:30px; background:#252525; color:#fff; text-decoration:none; font-weight:600; font-family:'Roboto Slab', serif; transition:0.3s; }
#action-buttons a.logout-btn:hover { background:#444; }
#perfundo-porosine { padding:10px 26px; border-radius:30px; background:#f3961c; color:#252525; font-weight:600; font-family:'Roboto Slab', serif; cursor:pointer; border:none; font-size:1rem; transition:0.3s; }
#perfundo-porosine:hover { background:#fff; color:#f3961c; border:2px solid #f3961c; transform: translateY(-2px); }
</style>
</head>
<body>

<?php if($showLogin): ?>

<h2 class="title-welcome">Ju lutem logohuni</h2>
<form action="login_process.php" method="post" class="login-form">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<h2 class="title-welcome" style="margin-top:30px;">Nuk keni llogari?</h2>
<form action="register_process.php" method="post" class="login-form">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit">Register</button>
</form>

<?php else: ?>

<h2 class="title-welcome">Mirësevini, <?= htmlspecialchars($user->username) ?>!</h2>

<?php if($user->role === 'user'): ?>
<div class="menu-dashboard">
<?php foreach($menuItems as $item): ?>
    <div class="menu-card">
        <img src="<?= $item->image ?>" alt="<?= $item->name ?>">
        <h3><?= $item->name ?></h3>
        <p><?= $item->desc ?></p>
        <span class="price">$<?= number_format($item->price,2) ?></span>
        <form method="post">
            <input type="hidden" name="produkt" value="<?= $item->name ?>">
            <button type="submit">Porosit</button>
        </form>
    </div>
<?php endforeach; ?>
</div>

<div class="orders-list" id="orders">
<h3>Porositë tuaja</h3>
<ul>
<?php foreach($orders as $o): ?>
<li>
    <span><?= htmlspecialchars($o['product_name'] ?? '') ?></span>
    <span style="display:flex;align-items:center;gap:8px;">
        $<?= number_format($o['price'] ?? 0,2) ?>
        <button type="button" class="delete-x" data-id="<?= $o['id'] ?? '' ?>">×</button>
    </span>
</li>
<?php endforeach; ?>
<li class="total">
    <span>Total</span>
    <span id="total-amount">$<?= number_format($order->getTotal(),2) ?></span>
</li>
</ul>
</div>

<div class="user-info" style="max-width:800px;margin:20px auto; background:#fff; padding:20px; border-radius:30px; box-shadow:0 5px 15px rgba(0,0,0,0.1); display:flex;flex-direction:column; gap:10px;">
    <input type="text" id="vendbanimi" placeholder="Vendbanimi" style="width:100%;padding:10px;border-radius:30px;border:1px solid #eee; font-size:1rem;">
    <input type="text" id="telefoni" placeholder="Numri i telefonit" style="width:100%;padding:10px;border-radius:30px;border:1px solid #eee; font-size:1rem;">
</div>

<div id="action-buttons">
    <a href="logout.php" class="logout-btn">Dil nga llogaria</a>
    <button id="perfundo-porosine">Perfundo Porosin</button>
</div>

<script>
document.querySelectorAll('.delete-x').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        fetch(window.location.href, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'delete_id=' + encodeURIComponent(id)
        }).then(() => {
            this.closest('li').remove();
            let total = 0;
            document.querySelectorAll('.orders-list li:not(.total)').forEach(li => {
                const priceEl = li.querySelector('span:nth-child(2)');
                if(priceEl) {
                    const priceText = priceEl.childNodes[0].textContent.replace('$','').trim();
                    total += parseFloat(priceText) || 0;
                }
            });
            document.getElementById('total-amount').textContent = '$' + total.toFixed(2);
        });
    });
});

document.getElementById('perfundo-porosine').addEventListener('click', function() {
    const vendbanimi = document.getElementById('vendbanimi').value.trim();
    const telefoni = document.getElementById('telefoni').value.trim();
    if (!vendbanimi || !telefoni) {
        alert('Ju lutem plotësoni vendbanimin dhe numrin e telefonit!');
        return;
    }
    fetch(window.location.href, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'complete_order=1'
    }).then(() => {
        document.querySelectorAll('.orders-list li:not(.total)').forEach(li => li.remove());
        document.getElementById('total-amount').textContent = '$0.00';
        alert('Porosia juaj u ruajt me sukses!');
    });
});
</script>

</body>
</html>
<?php endif; ?>
<?php endif; ?>
