<?php
class database{
  
  private $db;
  private $id;
  private $nombre;

  public function __construct() {
    $this->db = new Conexion();
  }
  public function newUser($nombre,$apellido,$user,$pass,$tipo,$servicio){
    $sql = $this->db->query("SELECT * FROM users WHERE user = '$user'");
    if($this->db->rows($sql) == 0 ){
      $sql = $this->db->query("INSERT INTO users (nombre,apellido,user,password,type_user,status,id_servicio) VALUES ('$nombre','$apellido','$user','$pass','$tipo','ACTIVO','$servicio')");
      $respuesta = true;
    }
    else{
      $respuesta = false;
    }
    return $respuesta;
  }

  public function listUser(){
    $sql = $this->db->query("SELECT users.id_user, users.nombre, users.apellido, users.user, users.status, servicios.descripcion AS servicio FROM users JOIN servicios ON users.id_servicio = servicios.id_servicio WHERE users.type_user != 1");
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;
  }


  public function editUser($id_user){
    $sql = $this->db->query("SELECT users.id_user, users.nombre, users.apellido, users.user, users.status, users.type_user, users.id_servicio,servicios.descripcion AS servicio FROM users JOIN servicios ON users.id_servicio = servicios.id_servicio WHERE users.id_user = $id_user"); 
    if($this->db->rows($sql) > 0 ){
      while($data = $this->db->recorrer($sql)){
        $respuesta[] = $data;
      }
    }
    else{
      $respuesta = false;
    }
    return $respuesta;
  }

  public function updateUser($id,$nombre,$apellido,$status,$servicio){
    $sql = $this->db->query("UPDATE users SET nombre='$nombre',apellido='$apellido',status='$status',id_servicio='$servicio' WHERE id_user=".$id);

    $respuesta = true;

    return $respuesta;
  }

  public function updatePass($id,$newpass){
    $sql = $this->db->query("UPDATE users SET password = '$newpass' WHERE id_user = ".$id);
    $respuesta = true;

    return $respuesta;
  }

  public function servicio(){
    $sql = $this->db->query("SELECT * FROM servicios");
     if($this->db->rows($sql) > 0 ){
         while($data = $this->db->recorrer($sql)){
         $respuesta[] = $data;
        }
      }
      else{
        $respuesta = false;
      }
     return $respuesta; 
  } 

}

?>