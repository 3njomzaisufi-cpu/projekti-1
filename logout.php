<?php
session_start();

class SessionManager {
    public static function logout() {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}

SessionManager::logout();
