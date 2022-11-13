<?php
if ($_COOKIE['username'] && $_COOKIE['password']) {
    setcookie('username', '', time() - 3600);
    setcookie('password', '', time() - 3600);
    setcookie('role', '', time() - 3600);
}
header('location: trangchu.php');
