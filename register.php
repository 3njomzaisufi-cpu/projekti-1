<?php
session_start();

class User {
    public $username;
    public $password;
    public $role;

    public function __construct($username, $password, $role = 'user') {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function register() {
        if (!isset($_SESSION['users'])) {
            $_SESSION['users'] = [];
        }
        $_SESSION['users'][$this->username] = [
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'role' => $this->role
        ];
    }
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$confirm  = trim($_POST['confirm_password'] ?? '');

if ($username === '' || $password === '' || $confirm === '') {
    die("Plotësoni të gjitha fushat! <a href='index.php'>Kthehu</a>");
}

if ($password !== $confirm) {
    die("Password-et nuk përputhen! <a href='index.php'>Kthehu</a>");
}

$user = new User($username, $password);
$user->register();

echo "Regjistrimi u krye me sukses! <a href='index.php'>Login</a>";
