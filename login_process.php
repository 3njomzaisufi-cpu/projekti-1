<?php
session_start();

class User {
    private $username;
    private $password;
    private $role;

    private static $users = [
        'admin' => 'admin123',
        'user'  => 'user123'
    ];

    public function __construct($username, $password) {
        $this->username = trim($username);
        $this->password = trim($password);
    }

    public function validateInput() {
        if ($this->username === '' || $this->password === '') {
            die("Ju lutem plotësoni të gjitha fushat! <a href='index.php'>Kthehu</a>");
        }
    }

    public function authenticate() {
        if (isset(self::$users[$this->username]) && $this->password === self::$users[$this->username]) {
            $_SESSION['user_id'] = $this->username;
            $_SESSION['username'] = $this->username;
            $_SESSION['role'] = ($this->username === 'admin') ? 'admin' : 'user';

            if ($_SESSION['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: order.php");
            }
            exit;
        } else {
            die("Username ose password gabim! <a href='index.php'>Kthehu</a>");
        }
    }
}

$user = new User($_POST['username'] ?? '', $_POST['password'] ?? '');
$user->validateInput();
$user->authenticate();

