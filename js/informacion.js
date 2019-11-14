// Inicio proceso
$(document).ready(function() {
  //console.log("Ok info js");
  // Inicia valores alo que habre la pantalla
  getInitData();






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
          alert("ERROR EN LA COMUNICACION SERVER NO EXISTE");
        }
      });
    }); // Fin btn Ingresar

}); // Final de Document


// Inicializa Informacion
function getInitData() {
  console.log("iniciando informacion");
  $.ajax({
    url:"./server/informacion.php",
    type:'POST',
    beforeSend:function() {
      console.log("Enviando información...");
    } ,
    success: function (parametro,estado,xhr) {
      if (xhr.status == 200) {
        //console.log(parametro);
        var response = JSON.parse(parametro);
        switch (response.acceso) {
          case 'CONCEDIDO':
            document.getElementById("agencia").value = response.datos[0].agencia;
            document.getElementById("empleado").value = response.datos[0].empleado;
            document.getElementById("ci").value = response.datos[0].ci;
            document.getElementById("nombre").value = response.datos[0].nombre;
            document.getElementById("direccion").value = response.datos[0].direccion;

            //console.log("PROCESO OK");
            break;
          case 'RECHAZADO':
              console.log(parametro.motivo);
              window.location.href = './usuario.html';
              break;
          default:
            console.log("PROCESO DEFAULT");
            window.location.href = './usuario.html';
            break;
        }
      }
    },
    error: function () {
      window.location.href = './usuario.html';
      alert("ERROR EN LA COMUNICACION SERVER NO EXISTE");
    }
  });



} // fin inicializa informacion
