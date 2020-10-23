<?php
require_once('config.php');

class autenticacionDB {

  protected $db;

  public function __construct()
  {
    $this->db=new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if($this->db->connect_errno){
      echo "Fallo al conectar a la base de datos <br>".$this->db->connect_errno;
      return;
    }
  }
}
?>