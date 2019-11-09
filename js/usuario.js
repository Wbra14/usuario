// Inicio proceso
$(document).ready(function() {
  //console.log("Ok index.js");
  // Inicia bnt Ingresar
  $("#btn_ingresar").click(function functionName() {
      event.preventDefault();
      var ls_usua = $("#inp_usua").val();
      var ls_pass = $("#inp_pass").val();

      $.ajax({
        url:"./server/login.php",
        type:'POST',
        data:{usuario: ls_usua,
              password: ls_pass
            },
        beforeSend:function() {
          console.log("Enviando información...");
        } ,
        success: function (parametro,estado,xhr) {
          if (xhr.status == 200) {
            var response = JSON.parse(parametro);
            if (response.conexion == "OK") {
              switch (response.acceso) {
                case 'CONCEDIDO':
                  window.location.href = 'informacion.html';
                  break;
                case 'RECHAZADO':
                  alert("USUARIO INCORRECTO");
                  break;
                default:
              }
            }else{
              alert(response.conexion);
            }
          }
        },
        error: function () {
          console.log('Error en la Comunicación');
          alert("ARCHIVO EN SERVER NO EXISTE");

        }
      }).done(function(data) {
        console.log("Se establecio Comunicación");
      });
    }); // Fin btn Ingresar






}); // Final de Document
