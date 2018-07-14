<?php

require_once 'DB.php';


class Auth {

  private $username;
  private $password;
  private $db;

  function __construct($username, $password) {
    $this->username = $username;
    $this->password = $password;
    $this->db = new DB();
  }


  public function GetUsername() {
    return $this->username;
  }

  public function GetSession() {
    return $_SESSION;
  }

  public function LoginUser() {
    $user = $this->db->GetUser($this->username, $this->password);
    return $user;
  }

  public function LogoutUser() {
    session_unset();
    session_destroy();
    $_SESSION = false;
    return false;
  }

};



?>
