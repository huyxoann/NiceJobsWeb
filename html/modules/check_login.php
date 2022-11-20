<?php
if (!(isset($_COOKIE["username"]) && isset($_COOKIE["password"]))) {
    header("location: login_signup_employee.php");
} else {
}
