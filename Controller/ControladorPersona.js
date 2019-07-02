$(document).ready(function(){
	Listar();
});

//Funciones principales Listar, Agregar, Eliminar y Modificar

function Listar(){
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

function Agregar(){
	ValidarTipoArchivo();

	$("#newForm").on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../DTO/DTOPersona.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(respuesta){
            	if(respuesta > 0){
                    alertify.success('Registro Agregado');
                    $("#ModalAgregar").modal("hide");
                    AgregarFila(respuesta);                    
                }else{
                	alertify.error('Error al agregar Registro');
                }
            }
        });
    });
}

function Eliminar(id){
	datos = {"Funcion": 3, "idPersona": id};

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

function Modificar(){
	var fila = $("#modInputFila").val();
	var idPersona = $("#modInputId").val();
	var nombre = $("#modInputNombre").val();
	var apellido = $("#modInputApellido").val();
	var edad = $("#modInputEdad").val();
	var genero = $('#modInputGenero').val();
	var fechaNac =$("#modInputFechaNac").val();

	$("#datatable").DataTable().cell(fila, 1).data(nombre);
	$("#datatable").DataTable().cell(fila, 2).data(apellido);
	$("#datatable").DataTable().cell(fila, 3).data(edad);
	$("#datatable").DataTable().cell(fila, 4).data(genero);
	$("#datatable").DataTable().cell(fila, 5).data(fechaNac);
	
	datos = {"Funcion": 4, "idPersona": idPersona, "nombre": nombre, "apellido": apellido, "edad": edad, "genero": genero, "fechaNac": fechaNac};

	$.ajax({
		url: "../DTO/DTOPersona.php",
		type: "POST",
		data: datos,
		async: false,
		success: function(respuesta) {
			if(respuesta.trim() == 1){
				alertify.success('Registro Modificado');
				$("#ModalModificar").modal("hide");
			}
		},
		error: function() {
			alertify.error('Error al modificar el Registro');        	
    	}
	});
}


// Funciones auxiliares
function EnviarModal(id) {
	var Datos = [];

	//Obtenemos la fila seleccionada a Editar y almacenaos los datos en un array
	$("."+id).each(function(){
		Datos.push($(this).text().trim());
	});

	$("#ModalModificar").modal("show");
	$("#modInputId").val(Datos[0]);
	$("#modInputNombre").val(Datos[1]);
	$("#modInputApellido").val(Datos[2]);
	$("#modInputEdad").val(Datos[3]);
	if(Datos[4] == "F"){
		$("#modInputGenero option[value='F']").attr("selected", true);
	}else{
		$("#modInputGenero option[value='M']").attr("selected", true);
	}
	$("#modInputFechaNac").val(Datos[5]);
	$("#modInputFila").val(id);
} 

function AgregarFila(idGenerado){
	var i = $('#datatable').DataTable().rows().count()
	$("#datatable").DataTable().row.add([
		"<p class='"+i+"'>"+ idGenerado +" </p>",	
		"<p class='"+i+"'>"+ $("#newInputNombre").val() +" </p>",	
		"<p class='"+i+"'>"+ $("#newInputApellido").val() +" </p>",	
		"<p class='"+i+"'>"+ $("#newInputEdad").val() +" </p>",	
		"<p class='"+i+"'>"+ $("#newInputGenero").val() +" </p>",	
		"<p class='"+i+"'>"+ $("#newInputFechaNac").val() +" </p>",	
		"<a class='btn btn-warning btn-sm btnTable' id='"+ i +"' onclick='EnviarModal(this.id)'>Edit</a>" +
    	"<a class='btn btn-danger btn-sm btnTable' id='"+ idGenerado +"'  onclick='Eliminar(this.id)'>Delete</a>"
	]).draw();
	 $('#newForm')[0].reset();
}

function ValidarTipoArchivo(){
	$("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alertify.error('Selecciona un formato valido (JPEG/JPG/PNG)');    
            $("#file").val('');
            return false;
        }
    });
}

