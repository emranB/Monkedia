<?php

require_once 'Auth.php';

class DB extends Auth{


  private $config   = 'http://localhost/my_files/Monkedia/classes/config.pass';


  function __construct() {

  }

  /*
    Establish a connection to the Database
  */
  private function ConnectToDb() {
    $configString = file_get_contents($this->config);
    $configJson   = json_decode($configString, true);

    $Db_Obj       = $configJson['dbAuth'];
    $Db_host      = $Db_Obj['host'];
    $Db_username  = $Db_Obj['username'];
    $Db_password  = $Db_Obj['password'];
    $Db_db        = $Db_Obj['db'];

    $conn = mysqli_connect($Db_host, $Db_username, $Db_password, $Db_db);
    return $conn;
  }



  /*
    Get a List of all Users
  */
  public function GetUsers() {
    $conn  = $this->ConnectToDb();
    $users = array();

    $sql = <<<SQL
SELECT * FROM users
SQL;

    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
      $user = (object)[];
      foreach ($row as $key => $value) {
        if ($key != 'Password')
          $user->$key = $value;
      }
      array_push($users, $user);
    }

    return $users;
  }



  /*
    Get user by Username and password
  */
  public function GetUser($username, $password) {
    $conn = $this->ConnectToDb();
    $user = array();

    $sql = <<<SQL
SELECT * FROM users WHERE Username='$username' AND Password='$password'
SQL;

    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
      foreach ($row as $key => $value) {
        $user[$key] = $value;
      }
    }

    return $user;
  }

}





?>
