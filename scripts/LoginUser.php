<?php

session_start();
require_once '../classes/Auth.php';

$post = file_get_contents('php://input');
parse_str(json_decode($post), $data);
$username = $data['username'];
$password = $data['password'];

$user = new Auth($username, $password);
$_SESSION = $user->LoginUser();
echo json_encode($_SESSION);

?>
