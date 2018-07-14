<?php

session_start();
require_once '../classes/DB.php';


$db = new DB();
echo json_encode($db->GetUsers());

?>
