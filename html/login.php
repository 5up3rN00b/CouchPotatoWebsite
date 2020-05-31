<?php
require '../templates/helper.php';

$db = setupDb();
if (!$db) {
    echo 'Database failed to load!';
}

$sth = $db->prepare("SELECT `password` FROM `users` WHERE `name` = ?");
$sth->execute([$_POST['loginName']]);
$passArr = $sth->fetchAll();

$hashedPw = hash('sha256', $_POST['loginPassword']);

if ($passArr[0]['password'] == $hashedPw) {
    echo 'Login success';
} else {
    echo 'Login failed';
}