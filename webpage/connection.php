<?php
include('users.php');

$db = new PDO('mysql:host=localhost;dbname=blog', 'xuri', '1006');
$usersRepo = new UsersRepo($db);
?>