<?php
session_start();
if (!$_SESSION['logged']) {
    $url = $_SERVER['REQUEST_URI'];
    header("Location: /ac/session/login.php?redirects_to=$url");
    exit;
}
 ?>