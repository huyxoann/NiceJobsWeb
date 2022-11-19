<?php
if ($_COOKIE['username'] && $_COOKIE['password']) {
    setcookie("id_user", '', time() - 1209600);
    setcookie("username", '', time() - 1209600);
    setcookie("password", '', time() - 1209600);
    setcookie("role", '', time() - 1209600);
    setcookie("email", '', time() - 1209600);
    setcookie("date", '', time() - 1209600);
}
header('location: trangchu.php');
