<?php

require_once('autenticacion.php');

class categoria extends autenticacionDB {
  protected $categoria;
  protected $sub_categoria;
  protected $titulo;
  protected $descripcion;

  public function __construct()
  {
    parent::__construct();
  }


  public function consultar_categorias($instruccion) {

    $consulta=$this->db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

    if(!$resultado){
      echo "Fallo al consultar la base de datos";
    }
    else{
      return $resultado;
      $resultado->close();
      $this->db->close();
    }
  }

    public function consultar_sub_categorias($instruccion) {

    $consulta=$this->db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

    if(!$resultado){
      echo "Fallo al consultar la base de datos";
    }
    else{
      return $resultado;
      $resultado->close();
      $this->db->close();
    }
  }


    public function consultar_filtros($campo,$valor) {

    $instruccion = "CALL listar_filtros('".$campo."',".$valor."')";

    $consulta=$this->db->query($instruccion);
    

    if(!$resultado){
      echo "Fallo al consultar la base de datos";
    }
    else{
      return $resultado;
      $resultado->close();
      $this->db->close();
    }
  }

}