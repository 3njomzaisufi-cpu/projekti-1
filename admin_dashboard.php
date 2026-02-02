<?php
session_start();

class MenuItem {
    public $id,$name,$image,$desc,$price;
    public function __construct($name,$image,$desc,$price,$id=null){
        $this->id=$id??uniqid();
        $this->name=$name;
        $this->image=$image;
        $this->desc=$desc;
        $this->price=$price;
    }
}

class MenuManager {
    private $items=[];
    public function __construct(){
        if(!isset($_SESSION['menuItems'])){
            $this->items=[
                new MenuItem('Hamburger','images/burger-frenchfries.png','Mish viçi i pjekur me sallatë dhe salcë speciale.',5.50),
                new MenuItem('Special Combo','images/special-combo.png','Burger me patate dhe pije.',7.00),
                new MenuItem('Pizza','images/pizza1.png','Pizza me mozzarella dhe salcë domate.',8.50),
                new MenuItem('Veggie Pizza','images/vegie.jpg','Pizza me perime të freskëta.',7.50),
                new MenuItem('Chicken Wrap','images/chicken.png','Wrap me pulë dhe perime.',6.00),
                new MenuItem('Beef Tortilla','images/beeef.jpg','Tortilla me mish viçi.',6.50),
                new MenuItem('Baguette Sandwich','images/sandwich.jpg.png','Baguette me mish dhe perime.',5.50),
                new MenuItem('French Fries','images/french.jpg','Patate të skuqura krokante.',3.00),
                new MenuItem('Chicken Nuggets','images/nugget.jpg','Pulë të skuqur.',4.00)
            ];
            $_SESSION['menuItems']=$this->items;
        } else $this->items=$_SESSION['menuItems'];
    }
    public function getItems(){return $this->items;}
    public function addItem($item){$this->items[]=$item;$_SESSION['menuItems']=$this->items;}
    public function deleteItem($id){$this->items=array_values(array_filter($this->items,fn($i)=>$i->id!==$id));$_SESSION['menuItems']=$this->items;}
    public function editPrice($id,$price){foreach($this->items as $item) if($item->id===$id)$item->price=floatval($price); $_SESSION['menuItems']=$this->items;}
}

class Gallery {
    private $images=[];
    public function __construct(){
        if(!isset($_SESSION['galleryImages'])){
            $_SESSION['galleryImages']=[
                ['id'=>uniqid(),'src'=>'photo1.jpg','alt'=>'Gallery Image 1'],
                ['id'=>uniqid(),'src'=>'photo2.jpg','alt'=>'Gallery Image 2'],
                ['id'=>uniqid(),'src'=>'photo7.jpg','alt'=>'Gallery Image 3'],
                ['id'=>uniqid(),'src'=>'photo4.jpg','alt'=>'Gallery Image 4'],
                ['id'=>uniqid(),'src'=>'photo5.jpg','alt'=>'Gallery Image 5'],
                ['id'=>uniqid(),'src'=>'photo6.jpg','alt'=>'Gallery Image 6']
            ];
        }
        $this->images=$_SESSION['galleryImages'];
    }
    public function getImages(){return $this->images;}
    public function addImage($src,$alt){$this->images[]=['id'=>uniqid(),'src'=>$src,'alt'=>$alt];$_SESSION['galleryImages']=$this->images;}
    public function deleteImage($id){$this->images=array_values(array_filter($this->images,fn($img)=>$img['id']!==$id));$_SESSION['galleryImages']=$this->images;}
    public function editImage($id,$src,$alt){foreach($this->images as &$img) if($img['id']===$id){$img['src']=$src;$img['alt']=$alt;} $_SESSION['galleryImages']=$this->images;}
}

class Admin {
    public static function checkAccess(){if(!isset($_SESSION['username'])||($_SESSION['role']??'')!=='admin'){header("Location: order.php");exit;}}
}

class Orders {
    private $orders = [];
    public function __construct() {
        $_SESSION['all_orders'] = $_SESSION['all_orders'] ?? [];
        $existingNames = array_map(fn($o) => $o['name'], $_SESSION['all_orders']);
        if (!in_array('Arjeta Krasniqi', $existingNames)) $_SESSION['all_orders'][] = ['id'=>uniqid(),'name'=>'Arjeta Krasniqi','items'=>['Pizza','Coca-Cola'],'total'=>10.50,'phone'=>'045987654','address'=>'Prishtina','status'=>'Pending'];
        if (!in_array('Blerim Gashi', $existingNames)) $_SESSION['all_orders'][] = ['id'=>uniqid(),'name'=>'Blerim Gashi','items'=>['Chicken Wrap','French Fries'],'total'=>9.00,'phone'=>'044112233','address'=>'Peja','status'=>'Delivered'];
        $this->orders = $_SESSION['all_orders'];
    }
    public function getOrders(){return $this->orders;}
    public function deleteOrder($id){$this->orders=array_values(array_filter($this->orders,fn($o)=>$o['id']!==$id));$_SESSION['all_orders']=$this->orders;}
    public function updateStatus($id,$status){foreach($this->orders as &$o) if($o['id']===$id)$o['status']=$status; $_SESSION['all_orders']=$this->orders;}
}

class Feedback {
    private $items=[];
    public function __construct(){if(!isset($_SESSION['feedbacks'])) $_SESSION['feedbacks']=[
        ['id'=>uniqid(),'name'=>'Elira Krasniqi','comment'=>'Burgeri më i mirë që kam shijuar.','image'=>'user-1.jpg'],
        ['id'=>uniqid(),'name'=>'Arbër Hoxha','comment'=>'Shërbim shumë i shpejtë.','image'=>'user-2.jpg'],
        ['id'=>uniqid(),'name'=>'Dardan Berisha','comment'=>'Menuja ka shumë zgjedhje të shijshme.','image'=>'user-3.jpg'],
        ['id'=>uniqid(),'name'=>'Arta Hoxha','comment'=>'Shërbim fantastik.','image'=>'user-4.jpg'],
        ['id'=>uniqid(),'name'=>'Blerim Gashi','comment'=>'Ushqim shumë i shijshëm.','image'=>'user-5.jpg']];
    $this->items=$_SESSION['feedbacks'];}
    public function getAll(){return $this->items;}
    public function add($name,$comment,$image){$this->items[]=['id'=>uniqid(),'name'=>$name,'comment'=>$comment,'image'=>$image];$_SESSION['feedbacks']=$this->items;}
    public function delete($id){$this->items=array_values(array_filter($this->items,fn($f)=>$f['id']!==$id));$_SESSION['feedbacks']=$this->items;}
    public function edit($id,$name,$comment,$image){foreach($this->items as &$f) if($f['id']===$id){$f['name']=$name;$f['comment']=$comment;$f['image']=$image;} $_SESSION['feedbacks']=$this->items;}
}

class AdminManager {
    private $admins=[];
    public function __construct(){if(!isset($_SESSION['admins'])) $_SESSION['admins']=[['id'=>uniqid(),'username'=>'admin','password'=>password_hash('admin123',PASSWORD_DEFAULT)]];$this->admins=$_SESSION['admins'];}
    public function getAdmins(){return $this->admins;}
    public function addAdmin($username,$password){$this->admins[]=['id'=>uniqid(),'username'=>$username,'password'=>password_hash($password,PASSWORD_DEFAULT)];$_SESSION['admins']=$this->admins;}
    public function deleteAdmin($id){$this->admins=array_values(array_filter($this->admins,fn($a)=>$a['id']!==$id));$_SESSION['admins']=$this->admins;}
    public function changePassword($id,$newPassword){foreach($this->admins as &$a) if($a['id']===$id)$a['password']=password_hash($newPassword,PASSWORD_DEFAULT); $_SESSION['admins']=$this->admins;}
}

Admin::checkAccess();
$menuManager=new MenuManager();
$galleryManager=new Gallery();
$ordersManager=new Orders();
$feedbackManager=new Feedback();
$adminManager=new AdminManager();
$admins=$adminManager->getAdmins();

if(isset($_POST['delete_menu_id'])) $menuManager->deleteItem($_POST['delete_menu_id']);
if(isset($_POST['new_name'],$_POST['new_price'],$_POST['new_desc'],$_POST['new_image'])) $menuManager->addItem(new MenuItem($_POST['new_name'],$_POST['new_image'],$_POST['new_desc'],floatval($_POST['new_price'])));
if(isset($_POST['edit_id'],$_POST['edit_price'])) $menuManager->editPrice($_POST['edit_id'],$_POST['edit_price']);

if(isset($_POST['delete_image_id'])) $galleryManager->deleteImage($_POST['delete_image_id']);
if(isset($_POST['new_image_src'],$_POST['new_image_alt'])) $galleryManager->addImage($_POST['new_image_src'],$_POST['new_image_alt']);
if(isset($_POST['edit_image_id'],$_POST['edit_image_src'],$_POST['edit_image_alt'])) $galleryManager->editImage($_POST['edit_image_id'],$_POST['edit_image_src'],$_POST['edit_image_alt']);

if(isset($_POST['delete_order_id'])) $ordersManager->deleteOrder($_POST['delete_order_id']);
if(isset($_POST['update_status_id'],$_POST['update_status_value'])) $ordersManager->updateStatus($_POST['update_status_id'],$_POST['update_status_value']);

if(isset($_POST['delete_feedback_id'])) $feedbackManager->delete($_POST['delete_feedback_id']);
if(isset($_POST['edit_feedback_id'],$_POST['edit_feedback_name'],$_POST['edit_feedback_comment'],$_POST['edit_feedback_image'])) $feedbackManager->edit($_POST['edit_feedback_id'],$_POST['edit_feedback_name'],$_POST['edit_feedback_comment'],$_POST['edit_feedback_image']);
if(isset($_POST['new_feedback_name'],$_POST['new_feedback_comment'],$_POST['new_feedback_image'])) $feedbackManager->add($_POST['new_feedback_name'],$_POST['new_feedback_comment'],$_POST['new_feedback_image']);

if(isset($_POST['new_admin_username'],$_POST['new_admin_password'])) $adminManager->addAdmin($_POST['new_admin_username'],$_POST['new_admin_password']);
if(isset($_POST['delete_admin_id'])) $adminManager->deleteAdmin($_POST['delete_admin_id']);
if(isset($_POST['change_admin_id'],$_POST['new_password'])) $adminManager->changePassword($_POST['change_admin_id'],$_POST['new_password']);

$menuItems=$menuManager->getItems();
$orders=$ordersManager->getOrders();
$galleryImages=$galleryManager->getImages();
$feedbacks=$feedbackManager->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box}body{margin:0;font-family:Poppins;background:#f4f6f9}.dashboard{display:flex}.sidebar{width:240px;background:#1f2933;color:#fff;min-height:100vh;padding:20px}.sidebar h2{text-align:center;margin-bottom:30px}.sidebar a{display:block;color:#cbd5e1;text-decoration:none;padding:12px;border-radius:10px;margin-bottom:8px;cursor:pointer}.sidebar a:hover,.sidebar a.active{background:#f3961c;color:#000}.main{flex:1;padding:30px}#dashboardCards{display:grid;grid-template-columns:repeat(2,1fr);grid-template-rows:repeat(2,1fr);gap:30px;margin-bottom:30px}#dashboardCards .card{background:#1f2937;border-radius:20px;padding:40px 30px;text-align:center;box-shadow:0 8px 25px rgba(0,0,0,0.2);transition:transform 0.3s,box-shadow 0.3s;color:#f97316;font-family:'Inter',sans-serif;font-size:18px;display:flex;flex-direction:column;justify-content:center;align-items:center}#dashboardCards .card:hover{transform:translateY(-8px);box-shadow:0 15px 35px rgba(0,0,0,0.25)}#dashboardCards .card h4{font-size:24px;margin-bottom:15px;display:flex;align-items:center;justify-content:center;gap:12px;color:#f97316}#dashboardCards .card p{font-size:40px;font-weight:700;margin:0;color:#f97316}.card.c1 h4::before{content:"🛒";font-size:26px}.card.c2 h4::before{content:"🍴";font-size:26px}.card.c3 h4::before{content:"📷";font-size:26px}.card.c4 h4::before{content:"💬";font-size:26px}h2.title-welcome{font-family:Roboto Slab;color:#f3961c;text-align:center;margin-bottom:30px}.admin-section{display:flex;flex-wrap:wrap;gap:30px;justify-content:center}.menu-card,.gallery-card,.feedback-card{background:#fff;border-radius:30px;padding:20px;width:250px;min-height:250px;display:flex;flex-direction:column;align-items:center;transition:0.3s;box-shadow:0 4px 12px rgba(0,0,0,0.1)}.menu-card:hover,.gallery-card:hover,.feedback-card:hover{transform:translateY(-5px);box-shadow:0 8px 20px rgba(0,0,0,0.2)}.menu-card img,.gallery-card img,.feedback-card img{width:100%;border-radius:20px;object-fit:cover;margin-bottom:10px;height:150px}.menu-card h3,.gallery-card h3,.feedback-card h3{margin:10px 0 5px 0;text-align:center}.menu-card p,.gallery-card p,.feedback-card p{margin:5px 0;text-align:center}.card-buttons{display:flex;flex-direction:column;gap:6px;width:100%;margin-top:auto}.card-buttons form,.card-buttons button{width:100%}.card-buttons button{background:#f3961c;border:none;font-weight:600;cursor:pointer;padding:8px;border-radius:12px;transition:0.3s}.card-buttons button:hover{background:#fff;color:#f3961c;border:2px solid #f3961c}.add-section{max-width:400px;margin:0 auto 30px;background:#fff;padding:20px;border-radius:30px;box-shadow:0 8px 20px rgba(0,0,0,.05);text-align:center}.add-section input{width:100%;padding:12px;margin-bottom:12px;border-radius:12px;border:1px solid #ddd;font-size:16px;transition:0.3s}.add-section input:focus{border-color:#f3961c;outline:none}.add-section button{width:100%;padding:12px;border-radius:12px;border:none;background:#f3961c;color:#fff;font-weight:600;cursor:pointer;transition:0.3s}.add-section button:hover{background:#fff;color:#f3961c;border:2px solid #f3961c}.add-section.gallery{max-width:250px;aspect-ratio:1/1;padding:15px;background:#fff;border-radius:30px;box-shadow:0 4px 12px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center}.add-section.gallery input{width:90%;padding:10px;margin-bottom:8px;border-radius:12px;border:1px solid #ddd;font-size:14px}.add-section.gallery button{width:90%;padding:10px;border-radius:12px;border:none;background:#f3961c;color:#fff;font-weight:600;cursor:pointer}.add-section.gallery button:hover{background:#fff;color:#f3961c;border:2px solid #f3961c}.edit-price-form,.edit-feedback-form{display:none}.orders-table{width:100%;border-collapse:collapse;margin-top:20px;background:#fff;border-radius:15px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.05)}.orders-table th,.orders-table td{padding:12px;text-align:center;border-bottom:1px solid #eee}.orders-table th{background:#f3961c;color:#fff;font-weight:600;text-transform:uppercase}.orders-table tr:last-child td{border-bottom:none}.status-Pending{color:#f59e0b;font-weight:600}.status-Delivered{color:#22c55e;font-weight:600}.status-Cancelled{color:#ef4444;font-weight:600}.delete{background:#ef4444;color:#fff;padding:6px 10px;border-radius:10px;border:none;cursor:pointer;transition:0.3s}.delete:hover{background:#fff;color:#ef4444;border:2px solid #ef4444}select{padding:6px;border-radius:8px;border:1px solid #ccc;cursor:pointer;transition:0.3s} 
</style>
</head>
<body>
<div class="dashboard">
<div class="sidebar">
<h2>Admin</h2>
<a class="active" id="dashboardBtn">Dashboard</a>
<a id="manageMenuBtn">Manage Menu</a>
<a id="manageGalleryBtn">Gallery</a>
<a id="manageOrdersBtn">Orders</a>
<a id="manageFeedbackBtn">Feedback</a>
<a id="manageAdminsBtn">Admins</a>
<a href="logout.php">Logout</a>
</div>
<div class="main">
<h2 class="title-welcome">Mirësevini, Admin</h2>
<div id="dashboardCards" class="cards">
<div class="card c1"><h4>New Orders</h4><p><?=count($orders)?></p></div>
<div class="card c2"><h4>Menu Items</h4><p><?=count($menuItems)?></p></div>
<div class="card c3"><h4>Photos</h4><p><?=count($galleryImages)?></p></div>
<div class="card c4"><h4>Feedback</h4><p><?=count($feedbacks)?></p></div>
</div>
<div id="menuSection" style="display:none">
<div class="add-section">
<form method="post">
<input type="text" name="new_name" placeholder="Emri" required>
<input type="number" step="0.01" name="new_price" placeholder="Çmimi" required>
<input type="text" name="new_desc" placeholder="Përshkrimi" required>
<input type="text" name="new_image" placeholder="Imazhi" required>
<button>Shto Produkt</button>
</form>
</div>
<div class="admin-section">
<?php foreach($menuItems as $item): ?>
<div class="menu-card">
<img src="<?=$item->image?>">
<h3><?=$item->name?></h3>
<p><?=$item->desc?></p>
<p><strong>$<?=number_format($item->price,2)?></strong></p>
<div class="card-buttons">
<form method="post"><input type="hidden" name="delete_menu_id" value="<?=$item->id?>"><button>Fshij</button></form>
<button class="toggle">Edito Çmimin</button>
<form method="post" class="edit-price-form"><input type="hidden" name="edit_id" value="<?=$item->id?>"><input type="number" step="0.01" name="edit_price" value="<?=$item->price?>"><button>Ruaj</button></form>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
<div id="gallerySection" style="display:none">
<div class="add-section gallery">
<form method="post">
<input type="text" name="new_image_src" placeholder="Src e fotos" required>
<input type="text" name="new_image_alt" placeholder="Alt tekst" required>
<button>Shto Foto</button>
</form>
</div>
<div class="admin-section">
<?php foreach($galleryImages as $img): ?>
<div class="gallery-card">
<img src="<?=$img['src']?>" alt="<?=$img['alt']?>">
<h3>Foto</h3>
<p><?=$img['alt']?></p>
<div class="card-buttons">
<form method="post"><input type="hidden" name="delete_image_id" value="<?=$img['id']?>"><button>Fshij</button></form>
<button class="toggle">Edit Foto</button>
<form method="post" class="edit-price-form"><input type="hidden" name="edit_image_id" value="<?=$img['id']?>"><input type="text" name="edit_image_src" value="<?=$img['src']?>" required><input type="text" name="edit_image_alt" value="<?=$img['alt']?>" required><button>Ruaj</button></form>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
<div id="ordersSection" style="display:none">
<h3>All Orders</h3>
<table class="orders-table">
<tr><th>Emri</th><th>Produktet</th><th>Çmimi</th><th>Numri Telefonit</th><th>Vendbanimi</th><th>Statusi</th><th>Veprime</th></tr>
<?php foreach($orders as $order):
$status=$order['status']??'Pending';
?>
<tr>
<td><?=htmlspecialchars($order['name']??'')?></td>
<td><?=htmlspecialchars(implode(", ",$order['items']??[]))?></td>
<td>$<?=htmlspecialchars($order['total']??0)?></td>
<td><?=htmlspecialchars($order['phone']??'')?></td>
<td><?=htmlspecialchars($order['address']??'')?></td>
<td class="status-<?=$status?>"><?=$status?></td>
<td>
<form method="post" style="display:inline-block;"><input type="hidden" name="delete_order_id" value="<?=$order['id']?>"><button type="submit" class="delete">Fshij</button></form>
<form method="post" style="display:inline-block;"><input type="hidden" name="update_status_id" value="<?=$order['id']?>"><select name="update_status_value" onchange="this.form.submit()"><option value="Pending" <?=$status=='Pending'?'selected':''?>>Pending</option><option value="Delivered" <?=$status=='Delivered'?'selected':''?>>Delivered</option><option value="Cancelled" <?=$status=='Cancelled'?'selected':''?>>Cancelled</option></select></form>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>
<div id="feedbackSection" style="display:none">
<div class="add-section">
<form method="post">
<input type="text" name="new_feedback_name" placeholder="Emri" required>
<input type="text" name="new_feedback_comment" placeholder="Koment" required>
<input type="text" name="new_feedback_image" placeholder="Imazhi" required>
<button>Shto Feedback</button>
</form>
</div>
<div class="admin-section">
<?php foreach($feedbacks as $f): ?>
<div class="feedback-card">
<img src="<?=htmlspecialchars($f['image'])?>" alt="<?=htmlspecialchars($f['name'])?>" class="user-image">
<h3><?=htmlspecialchars($f['name'])?></h3>
<p><?=htmlspecialchars($f['comment'])?></p>
<div class="card-buttons">
<form method="post"><input type="hidden" name="delete_feedback_id" value="<?=$f['id']?>"><button>Fshij</button></form>
<button class="toggle">Edit Feedback</button>
<form method="post" class="edit-feedback-form">
<input type="hidden" name="edit_feedback_id" value="<?=$f['id']?>">
<input type="text" name="edit_feedback_name" value="<?=htmlspecialchars($f['name'])?>" required>
<input type="text" name="edit_feedback_comment" value="<?=htmlspecialchars($f['comment'])?>" required>
<input type="text" name="edit_feedback_image" value="<?=htmlspecialchars($f['image'])?>" required>
<button>Ruaj</button>
</form>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
<div id="adminsSection" style="display:none">
<div class="add-section">
<form method="post">
<input type="text" name="new_admin_username" placeholder="Username" required>
<input type="password" name="new_admin_password" placeholder="Password" required>
<button>Shto Admin</button>
</form>
</div>
<div class="admin-section">
<?php foreach($admins as $a): ?>
<div class="menu-card">
<h3><?=htmlspecialchars($a['username'])?></h3>
<div class="card-buttons">
<form method="post"><input type="hidden" name="delete_admin_id" value="<?=$a['id']?>"><button>Fshij</button></form>
<button class="toggle">Ndrysho Password</button>
<form method="post" class="edit-price-form"><input type="hidden" name="change_admin_id" value="<?=$a['id']?>"><input type="password" name="new_password" placeholder="Password i ri" required><button>Ruaj</button></form>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
<script>
document.getElementById('dashboardBtn').onclick=()=>{document.getElementById('menuSection').style.display='none';document.getElementById('gallerySection').style.display='none';document.getElementById('ordersSection').style.display='none';document.getElementById('feedbackSection').style.display='none';document.getElementById('dashboardCards').style.display='grid';document.getElementById('adminsSection').style.display='none';};
document.getElementById('manageMenuBtn').onclick=()=>{document.getElementById('menuSection').style.display='block';document.getElementById('gallerySection').style.display='none';document.getElementById('ordersSection').style.display='none';document.getElementById('feedbackSection').style.display='none';document.getElementById('dashboardCards').style.display='none';document.getElementById('adminsSection').style.display='none';};
document.getElementById('manageGalleryBtn').onclick=()=>{document.getElementById('menuSection').style.display='none';document.getElementById('gallerySection').style.display='flex';document.getElementById('ordersSection').style.display='none';document.getElementById('feedbackSection').style.display='none';document.getElementById('dashboardCards').style.display='none';document.getElementById('adminsSection').style.display='none';};
document.getElementById('manageOrdersBtn').onclick=()=>{document.getElementById('menuSection').style.display='none';document.getElementById('gallerySection').style.display='none';document.getElementById('ordersSection').style.display='block';document.getElementById('feedbackSection').style.display='none';document.getElementById('dashboardCards').style.display='none';document.getElementById('adminsSection').style.display='none';};
document.getElementById('manageFeedbackBtn').onclick=()=>{document.getElementById('menuSection').style.display='none';document.getElementById('gallerySection').style.display='none';document.getElementById('ordersSection').style.display='none';document.getElementById('feedbackSection').style.display='block';document.getElementById('dashboardCards').style.display='none';document.getElementById('adminsSection').style.display='none';};
document.getElementById('manageAdminsBtn').onclick=()=>{document.getElementById('menuSection').style.display='none';document.getElementById('gallerySection').style.display='none';document.getElementById('ordersSection').style.display='none';document.getElementById('feedbackSection').style.display='none';document.getElementById('adminsSection').style.display='block';document.getElementById('dashboardCards').style.display='none';};
document.querySelectorAll('.toggle').forEach(b=>{b.onclick=()=>b.nextElementSibling.style.display=b.nextElementSibling.style.display==='block'?'none':'block'});
</script>
</body>
</html>
