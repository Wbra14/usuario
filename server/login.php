<?php
  // se toma la clase creada para ser usada por partes de cada clase
  require('conector.php');

  $con = new ProfileBD("186.4.141.14","WEBFCPC","WEB@123FCPC");
  $response['conexion'] = $con->Connect_bd("FOJUPEC");

  if ($response['conexion']=='OK') {
    $sql =  "SELECT cod_cliente FROM mae_cliente WHERE ( ruc_ci = '".$_POST['usuario']."' ) AND ( clave = '".$_POST['password']."' ) ";
    $consulta = $con->select_bd($sql);
    if ($consulta != 0) {
      //echo "Consulta Realizada";
      // obtengo nro filas y codigo participe
      $row_count = sqlsrv_num_rows( $consulta );
      if ($row_count == 1) {
        $fila = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC);
        $response['acceso'] = 'CONCEDIDO';
        $response['motivo'] = 'USUARIO CORRECTO';
        // variable Super Global
        session_start();
        $_SESSION['cod_cliente'] = $fila['cod_cliente'];
      } else {
        $response['acceso'] = 'RECHAZADO';
        $response['motivo'] = 'USUARIO INCORRECTO';
      }
    }else{
      $response['acceso'] = 'RECHAZADO';
      $response['motivo'] = 'ERROR EN LA CONSULTA';
    }
  }
  echo json_encode($response);
  $con->Disconnect_bd();


 ?>
