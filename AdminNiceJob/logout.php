<?php

setcookie("userAdmin", '', time() - 3600);
setcookie("passAdmin", '', time() - 3600);
header("Location:../AdminNiceJob/login.php");
