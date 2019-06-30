//document.getElementById("Nuevo").addEventListener("click", myFunction);

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
					"<p class='"+i+"'>"+myJSON[i].idPersona	+" </p>",	
					"<p class='"+i+"'>"+myJSON[i].nombre	+" </p>",	
					"<p class='"+i+"'>"+myJSON[i].apellido	+" </p>",	
					"<p class='"+i+"'>"+myJSON[i].edad		+" </p>",	
					"<p class='"+i+"'>"+myJSON[i].genero	+" </p>",	
					"<p class='"+i+"'>"+myJSON[i].fechaNac	+" </p>",	
					"<p class='"+i+"'>"+myJSON[i].imagen	+" </p>",	
					"<a data-original-title='Edit' class='btn btn-warning btn-sm' id='"+i+"' onclick='Modificar(this.id)'>Edit</a> " +
				    "<a data-original-title='Delete' class='btn btn-danger btn-sm'>Delete</a>"
				]).draw();
            }	            
		}
	});	
}

function Modificar(id) {
	var Datos = [];
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

	

} 