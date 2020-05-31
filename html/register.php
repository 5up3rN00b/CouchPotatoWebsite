<?php
require '../templates/helper.php';

$db = setupDb();
if (!$db) {
    echo 'Database failed to load!';
}

$sth = $db->prepare("START TRANSACTION;");
$sth->execute();

$sth = $db->prepare("SELECT * FROM `users` WHERE `name` = ?");
$sth->execute([$_POST['registerName']]);
$passArr = $sth->fetchAll();

if (!empty($passArr)) {
    echo 'Name already taken';
} else {
    $hashedPw = hash('sha256', $_POST['registerPassword']);

    $sth = $db->prepare("INSERT INTO `users` (`name`, `password`) VALUES (?, ?)");
    $sth->execute([$_POST['registerName'], $hashedPw]);
    $passArr = $sth->fetchAll();
    echo 'Registered successfully';
}

$sth = $db->prepare("COMMIT;");
$sth->execute();