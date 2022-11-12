<?php
$email = 'hirashihiro@gmail.com';
$pieces = explode("@", $email);
$star = strlen($pieces[0]) - 3;
$star_string = str_repeat('*', $star);

// echo str_replace($pieces[0], $star_string, $email);

echo $pieces[0] . " " . $pieces[1];
