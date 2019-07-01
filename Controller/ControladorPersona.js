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
					"<a class='btn btn-warning btn-sm btnTable' id='"+i+"' onclick='Modificar(this.id)'>Edit</a>" +
				    "<a class='btn btn-danger btn-sm btnTable'>Delete</a>"
				]).draw();
            }	            
		}
	});	
}

function Modificar(id) {
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


$(document).ready(function(e){
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'submit.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    $('#fupForm')[0].reset();
                    $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                }else{
                    $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                }
                $('#fupForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });
    
});