<?php

require_once('autenticacion.php');

class categoria extends autenticacionDB {

  public function __construct()
  {
    parent::__construct();
  }


  public function consultar_categorias() {
    $instruccion = "CALL listar_categorias()";

    $consulta=$this->db->query($instruccion);
    
    if($consulta !== false) {
      $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
      if($resultado) {
        return $resultado;
        $resultado->close();
        $this->db->close();
      }
    }
  }

  public function consultar_categorias_paginas($desde, $tamano){
  $instruccion = "CALL consultar_categorias_paginas('".$desde."','".$tamano."')";

  $consulta=$this->db->query($instruccion);
  
  if($consulta !== false) {
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
    if($resultado) {
      return $resultado;
      $resultado->close();
      $this->db->close();
    }
  }
}
    public function consultar_sub_categorias() {
    $instruccion = "CALL listar_sub_categorias()";

    $consulta=$this->db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

    if(!$resultado){
      echo "\n";
    }
    else{
      return $resultado;
      $resultado->close();
      $this->db->close();
    }
  }

    public function consultar_sub_categorias2($instruccion) {

    $consulta=$this->db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

    if(!$resultado){
      echo "\n";
    }
    else{
      return $resultado;
      $resultado->close();
      $this->db->close();
    }
  }


    public function consultar_filtros($campo,$valor) {
    $instruccion = "SELECT * from sub_categorias where $campo LIKE '%$valor%'";
    $consulta=$this->db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
    
    if(!$consulta){
      echo "\n";
    }
    else{
      return $resultado;
      $resultado->close();
      $this->db->close();
    }
  }
}