<?php
class database{
  
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }

  public function listUser(){
    /*$sql = $this->db->query("SELECT users.id_user, users.nombre, users.apellido, users.user, users.status, servicios.descripcion AS servicio FROM users JOIN servicios ON users.id_servicio = servicios.id_servicio WHERE users.type_user != 1");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    } 
    else{
      $respuesta = false;
    }
    return $respuesta;*/
  }

}





















?>