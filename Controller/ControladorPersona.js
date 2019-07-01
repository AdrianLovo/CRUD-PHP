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
					"<p class='"+i+"'>"+ myJSON[i].idPersona	+" </p>",	
					"<p class='"+i+"'>"+ myJSON[i].nombre		+" </p>",	
					"<p class='"+i+"'>"+ myJSON[i].apellido		+" </p>",	
					"<p class='"+i+"'>"+ myJSON[i].edad			+" </p>",	
					"<p class='"+i+"'>"+ myJSON[i].genero		+" </p>",	
					"<p class='"+i+"'>"+ myJSON[i].fechaNac		+" </p>",	
					"<a class='btn btn-warning btn-sm btnTable' id='"+ i +"' onclick='EnviarModal(this.id)'>Edit</a>" +
				    "<a class='btn btn-danger btn-sm btnTable' id='"+ myJSON[i].idPersona +"'  onclick='Eliminar(this.id)'>Delete</a>"
				]).draw();
            }	            
		}
	});	
}

function Eliminar(id){
	datos = {"Funcion": 2, "idPersona": id};

	$.ajax({
		url: "../DTO/DTOPersona.php",
		type: "POST",
		data: datos,
		async: false,
		success: function(respuesta) {
			if(respuesta.trim() == 1){
				$('#datatable tbody').on('click', 'tr', function () {
        			$('#datatable').DataTable().row($(this)).remove().draw();
    			});
				alertify.success('Registro Eliminado');
			}
		},
		error: function() {
			alertify.error('Error al eliminar el Registro');        	
    	}
	});	
}

function EnviarModal(id) {
	var Datos = [];

	//Obtenemos la fila seleccionada a Editar y almacenaos los datos en un array
	$("."+id).each(function(){
		Datos.push($(this).text().trim());
	});

	$("#Modificar").modal("show");
	$("#inputId").val(Datos[0]);
	$("#inputNombre").val(Datos[1]);
	$("#inputApellido").val(Datos[2]);
	$("#inputEdad").val(Datos[3]);
	if(Datos[4] == "F"){
		$("#inputGenero option[value='F']").attr("selected", true);
	}else{
		$("#inputGenero option[value='M']").attr("selected", true);
	}
	$("#inputFechaNac").val(Datos[5]);
} 

function Modificar(){
	var idPersona = $("#inputId").val();
	var nombre = $("#inputNombre").val();
	var apellido = $("#inputApellido").val();
	var edad = $("#inputEdad").val();
	var genero = $('#inputGenero').val();
	var fechaNac =$("#inputFechaNac").val();
	
	datos = {"Funcion": 3, "idPersona": idPersona, "nombre": nombre, 
				"apellido": apellido, "edad": edad, "genero": genero, "fechaNac": fechaNac};

	$.ajax({
		url: "../DTO/DTOPersona.php",
		type: "POST",
		data: datos,
		async: false,
		success: function(respuesta) {
			if(respuesta.trim() == 1){
				alertify.success('Registro Modificado');
				$("#Modificar").modal("hide");
			}
		},
		error: function() {
			alertify.error('Error al modificar el Registro');        	
    	}
	});

}
