<?php
require '../templates/helper.php';

$db = setupDb();
if (!$db) {
    echo 'Database failed to load!';
}

$sth = $db->prepare("SELECT `password` FROM `users` WHERE `name` = ?");
$sth->execute([$_POST['loginName']]);
$passArr = $sth->fetchAll();

if ($passArr[0]['loginPassword'] == $_POST['loginPassword']) {
    echo 'Login success';
} else {
    echo 'Login failed';
}