<!DOCTYPE html>
<html>
<head>
    <title>PHP, Ajax CRUD Datatable - Adrian Lovo</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>


<body>

	<!-- Modal Agregar Nuevo Registro-->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Registro</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Modificar Registro-->
	<div class="modal fade" id="Modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modificar Registro</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        
	        <div class="form-group row">
			    <label for="inputId" class="col-sm-2 col-form-label">Id</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputId" placeholder="Id" readonly>
			    </div>
		  	</div>
	      	<div class="form-group row">
			    <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputNombre" placeholder="Nombre">
			    </div>
		  	</div>
		  	<div class="form-group row">
			    <label for="inputApellido" class="col-sm-2 col-form-label">Apellido</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputApellido" placeholder="Apellido">
			    </div>
		  	</div>
		  	<div class="form-group row">
			    <label for="inputEdad" class="col-sm-2 col-form-label">Edad</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputEdad" placeholder="Edad">
			    </div>
		  	</div>

		  	<div class="form-group row">
			    <label for="inputGenero" class="col-sm-2 col-form-label">Genero</label>
			    <div class="col-sm-10">
			      <select id="inputGenero" class="form-control">
			        <option value="F">Femenino</option>
			        <option value="M">Masculino</option>
			      </select>
			    </div>
		  	</div>

		  	


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary">Modificar</button>
	      </div>
	    </div>
	  </div>
	</div>

    
	<div class="container">
	    <center><p><h1>PHP, Ajax CRUD Datatable</h1></p></center>
	    
	    <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
	                <th>Imagen</th>
	                <th style="width:80px">Action</th>
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
    <script type="text/javascript" src="../Controller/ControladorPersona.js"></script>

   

</html>