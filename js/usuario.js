// Inicio proceso
$(document).ready(function() {
  //console.log("Ok index.js");
  // Inicia bnt Ingresar
  $("#btn_ingresar").click(function functionName() {
      event.preventDefault();
      var ls_usua = $("#inp_usua").val();
      var ls_pass = $("#inp_pass").val();
      console.log(ls_usua +' - ' +ls_pass);

      $.ajax({
        url:"./server/login.php",
        type:'POST',
        data:{usuario: ls_usua,
              password: ls_pass
            },
        beforeSend:function() {
          console.log("Enviando información...");
        } ,
        success: function (response,estado,xhr) {
          if (xhr.status == 200) {
            console.log(response + 'dentro del if');
            if (php_response.conexion=="OK") {
          if (php_response.acceso == 'CONCEDIDO') {
            window.location.href = 'welcome.html';
          }else {
            alert(php_response.motivo);
          }
        }else{
          alert(php_response.conexion);
        }

          }

        },
        error: function () {
          console.log('Error en la Comunicación');
        }
      }).done(function(data) {
        console.log("Se establecio Comunicación");
      });
    }); // Fin btn Ingresar






}); // Final de Document
