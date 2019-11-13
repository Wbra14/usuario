<?php
  require('conector.php');
  session_start();

  if (isset($_SESSION['cod_cliente'])) {
    //echo "USUARIO VALIDO"."<br>";
    $con = new ProfileBD("186.4.141.14","WEBFCPC","WEB@123FCPC");
    $response['conexion'] = $con->Connect_bd("FOJUPEC");
    if ($response['conexion']=='OK') {
      $sql =  "SELECT mae_cliente.cod_cliente codigo, mae_division.agencia agencia ,mae_cliente.cod_empleado empleado,mae_cliente.descripcion nombre,mae_cliente.direccion direccion,mae_cliente.ruc_ci ci, mae_cliente.telefono telefono,
      mae_cliente.fec_nacimiento fecnac,mae_cliente.clave clave  FROM mae_cliente,   mae_division    WHERE ( mae_division.cod_division = mae_cliente.cod_division ) and  ( mae_cliente.cod_cliente = ".$_SESSION['cod_cliente']." )"  ;
      //echo $sql.'<br>';
      $consulta = $con->select_bd($sql);
      if ($consulta != 0) {
        // echo "Consulta Realizada"."<br>";
        // obtengo nro filas y codigo participe
        $i=0;
        $row_count = sqlsrv_num_rows( $consulta );
        if ($row_count == 1) { // por asegurar que es unico registro
          while ($fila = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC)) {
            $response['acceso'] = 'CONCEDIDO';
            $response['datos'][$i]['codigo']=$fila['codigo'];
            $response['datos'][$i]['agencia']=$fila['agencia'];
            $response['datos'][$i]['empleado']=$fila['empleado'];
            $response['datos'][$i]['nombre']=$fila['nombre'];
            $response['datos'][$i]['direccion']=$fila['direccion'];
            $response['datos'][$i]['ci']=$fila['ci'];
            $response['datos'][$i]['telefono']=$fila['telefono'];
            $response['datos'][$i]['fecnac']=$fila['fecnac'];
            $response['datos'][$i]['clave']=$fila['clave'];
            $i++;
          }

        } else {
          $response['acceso'] = 'RECHAZADO';
          $response['motivo'] = 'INCORRECTO DOS O MAS ROWS';
        }
      }else{
        $response['acceso'] = 'RECHAZADO';
        $response['motivo'] = 'ERROR EN LA CONSULTA';
      }
  } else {
    $response['acceso'] = 'RECHAZADO';
    $response['motivo'] = 'ERROR EN LA CONECCION BBDD';
  }
  echo json_encode($response);
  $con->Disconnect_bd();
} else { // usuario inactivo
    $response['acceso'] = 'RECHAZADO';
    $response['motivo'] = 'USUARIO INACTIVO';
    echo json_encode($response);
  }



 ?>
