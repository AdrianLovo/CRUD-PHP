$(document).ready(function(){
	listar();				
});

function listar(){
    datos = {"Funcion": 1};
    
	$.ajax({
		url: "../DTO/DTOPersona.php",
		type: "POST",
		data: datos,
		async: false,
		success: function (respuesta) {
			var myJSON = JSON.parse(respuesta);
			$('#datatable').DataTable().clear();
			for (var i = 0; i < myJSON.length; i++) {
				$("#datatable").DataTable().row.add([
					(i+1), myJSON[i].nombre, myJSON[i].apellido, myJSON[i].edad, myJSON[i].genero, myJSON[i].fechaNac, myJSON[i].imagen, 
					"<a data-toggle='tooltip' data-original-title='Edit' class='edit btn btn-primary btn-sm'>Edit</a> <a data-toggle='tooltip' data-original-title='Delete' class='btn btn-danger btn-sm'>Delete</a>"
				]).draw();
            }	            
		}
	});	
}