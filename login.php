<?php
session_start();

class AuthForm {
    public $type; // 'login' ose 'register'
    public $fields = [];

    public function __construct($type, $fields = []) {
        $this->type = $type;
        $this->fields = $fields;
    }

    public function render() {
        $action = $this->type === 'login' ? 'login_process.php' : 'register_process.php';
        $title = $this->type === 'login' ? 'Kyquni për të vazhduar' : 'Regjistrohuni';
        $toggleText = $this->type === 'login' ? 'Nuk keni llogari? Regjistrohu' : 'Keni tashmë llogari? Login';
        $inputs = '';

        foreach ($this->fields as $field) {
            $inputs .= "<input type='{$field['type']}' name='{$field['name']}' placeholder='{$field['placeholder']}' required>";
        }

        return "
        <div class='auth-form' id='{$this->type}-form'>
            <h2>{$title}</h2>
            <form action='{$action}' method='post'>
                {$inputs}
                <button type='submit'>" . ucfirst($this->type) . "</button>
            </form>
            <div class='auth-toggle' onclick='toggleRegister()'>{$toggleText}</div>
        </div>
        ";
    }
}

$showLogin = !isset($_SESSION['user_id']);
$username = $_SESSION['user_id'] ?? '';

$loginForm = new AuthForm('login', [
    ['type'=>'text','name'=>'username','placeholder'=>'Username'],
    ['type'=>'password','name'=>'password','placeholder'=>'Password']
]);

$registerForm = new AuthForm('register', [
    ['type'=>'text','name'=>'emri_dhe_mbiemri','placeholder'=>'Emri dhe Mbiemri'],
    ['type'=>'text','name'=>'username','placeholder'=>'Username'],
    ['type'=>'text','name'=>'telefon','placeholder'=>'Numri i Telefonit'],
    ['type'=>'password','name'=>'password','placeholder'=>'Password']
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Burger House</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "header.php"; ?>

<main>
<section id="user-dashboard" style="background:#f5f5f5; padding:50px 20px 100px 20px; min-height:110vh; display:flex; justify-content:center; align-items:center; flex-direction:column;">
    <?php if ($showLogin): ?>
        <div class="auth-container">
            <?php
                echo $loginForm->render();
                echo $registerForm->render();
            ?>
        </div>

        <style>
            .auth-container { width:100%; max-width:700px; display:flex; justify-content:center; gap:40px; }
            .auth-form { background:#fff; padding:50px 40px; border-radius:25px; box-shadow:0 20px 40px rgba(0,0,0,0.15); display:none; flex-direction:column; width:100%; transition:all 0.3s ease; }
            .auth-form.active { display:flex; }
            .auth-form h2 { text-align:center; color:#f3961c; margin-bottom:30px; font-size:2rem; }
            .auth-form input { padding:15px; border-radius:15px; border:1px solid #ccc; font-size:1.1rem; margin-bottom:20px; width:100%; }
            .auth-form input:focus { border-color:#f3961c; outline:none; box-shadow:0 0 10px rgba(243,150,28,0.3); }
            .auth-form button { padding:15px 0; border-radius:30px; border:none; background:linear-gradient(90deg,#f3961c,#e07a14); color:#fff; font-weight:bold; font-size:1.1rem; cursor:pointer; transition:0.3s; width:100%; }
            .auth-form button:hover { background:linear-gradient(90deg,#e07a14,#f3961c); }
            .auth-toggle { text-align:center; margin-top:20px; cursor:pointer; color:#f3961c; font-weight:bold; font-size:1rem; }
            .auth-toggle:hover { color:#e07a14; }
        </style>

        <script>
            function toggleRegister(){
                document.getElementById('login-form').classList.toggle('active');
                document.getElementById('register-form').classList.toggle('active');
            }
            document.getElementById('login-form').classList.add('active');
        </script>
    <?php else: ?>
        <h2 style="text-align:center; color:#f3961c; margin-bottom:30px;">Jeni të kyçur si <?= htmlspecialchars($username) ?>!</h2>
        <div style="text-align:center;">
            <a href="logout.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" style="padding:15px 30px; border-radius:30px; background: linear-gradient(90deg,#f3961c,#e07a14); color:#fff; text-decoration:none; font-weight:bold;">Dil nga llogaria</a>
        </div>
    <?php endif; ?>
</section>
</main>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
