<?php
  session_start();
  if (isset($_SESSION['cod_cliente'])) {
    session_destroy();
    //echo "OK";
  }
  
 ?>
