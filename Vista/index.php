<!DOCTYPE html>
<html>
<head>
    <title>PHP, Ajax CRUD Datatable - Adrian Lovo</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="alertify/css/alertify.min.css">


</head>


<body>

	<!-- Modal Agregar Nuevo Registro-->
	<div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Registro</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">

			    <form enctype="multipart/form-data" id="newForm">

			    	<div class="form-group row" style="display: none">
					    <label for="newInputFuncion" class="col-sm-2 col-form-label">Funcion</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="newInputFuncion" placeholder="Funcion" name="Funcion" readonly value="2">
					    </div>
				  	</div>
			      	<div class="form-group row">
					    <label for="newInputNombre" class="col-sm-2 col-form-label">Nombre</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="newInputNombre" placeholder="Nombre" name="nombre" maxlength="50">
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <label for="newInputApellido" class="col-sm-2 col-form-label">Apellido</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="newInputApellido" placeholder="Apellido" name="apellido" maxlength="50">
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <label for="newInputEdad" class="col-sm-2 col-form-label">Edad</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="newInputEdad" placeholder="Edad" name="edad">
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <label for="newInputGenero" class="col-sm-2 col-form-label">Genero</label>
					    <div class="col-sm-10">
					      <select id="newInputGenero" class="form-control" name="genero">
					        <option value="F">Femenino</option>
					        <option value="M">Masculino</option>
					      </select>
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <label for="newInputFechaNac" class="col-sm-2 col-form-label">Fecha</label>
					    <div class="col-sm-10">
					      <input type="date" id="newInputFechaNac" style="width: 100%;" min="1900-01-01" max="2050-12-31" name="fechaNac">
					    </div>
				  	</div>	
			  		<div class="form-group row">
					    <div class="col-sm-12">
					      <input type="file" class="form-control" id="file" name="file" required/>
					    </div>
				  	</div>

			      	<div class="modal-footer">
			      		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      		<input type="submit" name="submit" class="btn btn-success submitBtn" value="Guardar" onclick="Agregar()"/>
			      	</div>	
		      	</form>
	      	</div>
	       
	      
	    </div>
	  </div>	  
	</div>

	<!-- Modal Modificar Registro-->
	<div class="modal fade" id="ModalModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modificar Registro</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      	<div class="form-group row" style="display: none">
			    <label for="modInputFila" class="col-sm-2 col-form-label">Fila</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="modInputFila" placeholder="Fila" readonly>
			    </div>
		  	</div>

		  	<div class="form-group row" style="display: none">
			    <label for="modInputImagen" class="col-sm-2 col-form-label">Imagen</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="modInputImagen" placeholder="Imagen" readonly>
			    </div>
		  	</div>
	        
	        <div class="form-group row">
			    <label for="modInputId" class="col-sm-2 col-form-label">Id</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="modInputId" placeholder="Id" readonly>
			    </div>
		  	</div>
	      	<div class="form-group row">
			    <label for="modInputNombre" class="col-sm-2 col-form-label">Nombre</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="modInputNombre" placeholder="Nombre" maxlength="50">
			    </div>
		  	</div>
		  	<div class="form-group row">
			    <label for="modInputApellido" class="col-sm-2 col-form-label">Apellido</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="modInputApellido" placeholder="Apellido" maxlength="50">
			    </div>
		  	</div>
		  	<div class="form-group row">
			    <label for="modInputEdad" class="col-sm-2 col-form-label">Edad</label>
			    <div class="col-sm-10">
			      <input type="number" class="form-control" id="modInputEdad" placeholder="Edad">
			    </div>
		  	</div>
		  	<div class="form-group row">
			    <label for="modInputGenero" class="col-sm-2 col-form-label">Genero</label>
			    <div class="col-sm-10">
			      <select id="modInputGenero" class="form-control">
			        <option value="F">Femenino</option>
			        <option value="M">Masculino</option>
			      </select>
			    </div>
		  	</div>
		  	<div class="form-group row">
			    <label for="modInputFechaNac" class="col-sm-2 col-form-label">Fecha</label>
			    <div class="col-sm-10">
			      <input type="date" id="modInputFechaNac" style="width: 100%;" min="1900-01-01" max="2050-12-31">
			    </div>
		  	</div>		  	

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" onclick="Modificar()">Guardar Cambios</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Div principa con DataTable-->
	<div class="container">
		<center><p><h1>PHP, Ajax CRUD Datatable</h1></p></center>

	    <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAgregar">
		  Agregar Nuevo Registro
		</button></p>

	    <table class="table table-bordered data-table" id="datatable">
	        <thead>
	            <tr>
	                <th>Id</th>
	                <th>Nombre</th>
	                <th>Apellido</th>
	                <th>Edad</th>
	                <th>Genero</th>
	                <th>Fecha Nacimiento</th>
	                <th style="width:100px">Action</th>
	            </tr>
	        </thead>
	        <tbody>
	        </tbody>
	    </table>
	</div>

	    
</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Controlador -->
    <script type="text/javascript" src="../VistaController/ControladorPersona.js"></script>
    <script type="text/javascript" src="alertify/alertify.min.js"></script>
    <script type="text/javascript" src="js/TooltipImg.js"></script>

   

</html>