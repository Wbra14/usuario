<?php
/** En esta clase se realizara
 * 1.- conexion bbdd
 * 2.- funciones para envio de sentencias SQL
 */
class ProfileBD
{
  private $host;
  private $user;
  private $password;
  private $conexion;

  function __construct($host, $user, $password)
  {
    $this->host = $host;
    $this->user = $user;
    $this->password = $password;
  }

  // Funcion para conexion de bbdd
  function Connect_bd($nombre_db)
  {
    //$c = new PDO("sqlsrv:Server=localhost,1521;Database=testdb", "NombreUsuario", "Contraseña");
    $connectionInfo = array( "Database"=>$nombre_db, "UID"=>$this->user, "PWD"=>$this->password,"CharacterSet"=>"UTF-8");
    $this->conexion =  sqlsrv_connect( $this->host, $connectionInfo);
    if ($this->conexion) {
      return "OK";
    }else {
      return "Error Connect BBDD: ".sqlsrv_errors();
    }
  }

  // Funcion para desconectar la BBDD
  function Disconnect_bd()
  {
    sqlsrv_close($this->conexion);
  }

  // Funcion realiza consulta
  function select_bd($sql)
  {
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $this->conexion, $sql , $params , $options);
    return $stmt;
  }





} // fin de ;ase ProfileBD
 ?>
