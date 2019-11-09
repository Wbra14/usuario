// Inicio proceso
$(document).ready(function() {
  console.log("Ok info js");
  // Inicia nav cerrar sesion
  $("#salir").click(function functionName() {
      event.preventDefault();
      $.ajax({
        url:"./server/logout.php",
        type:'GET',
        success: function (parametro,estado,xhr) {
          if (xhr.status == 200) {
            window.location.href = './usuario.html';
            }
          },
        error: function () {
          alert("ERROR EN SERVER NO EXISTE");
        }
      });
    }); // Fin btn Ingresar






}); // Final de Document
