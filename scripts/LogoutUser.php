<?php

session_start();
require_once '../classes/Auth.php';

$username = '';
$password = '';

$post = file_get_contents('php://input');
parse_str(json_decode($post), $data);
if (isset($data['username']))
  $username = $data['username'];

if (isset($data['password']))
  $password = $data['password'];

$user = new Auth($username, $password);
$_SESSION = $user->LogoutUser();
echo json_encode($_SESSION);

?>
