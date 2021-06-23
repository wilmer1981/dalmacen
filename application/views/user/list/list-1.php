<div class="container">
	<div class="row">
		<div class="panel panel-default">
				<div class="panel-heading">
 					<h2 class="panel-title">Lista de Usuario</h2>
				</div>			
				<div class="panel-body">	
					  <div class="col-sm-2">Foto</div>
					  <div class="col-sm-2">Nombre</div>
					  <div class="col-sm-2">Grupo</div>
					  <div class="col-sm-2">Estado</div>
					  <div class="col-sm-2">Opciones</div>
	 			</div>
	  </div>
	</div>
	<?php
    foreach($users as $fila)
    {
            ?>
            <div class="row">
            	<div class="panel panel-default">
		            	<div class="panel-body">
			                <div class="col-sm-2">foto</div>
			                <div class="col-sm-2"><?php echo $fila->apellidos;?></div>
			                <div class="col-sm-2"><?php echo $fila->grupo;?></div>
			                <div class="col-sm-2"><?php echo $fila->status;?></div>
			                <div class="col-sm-2">holaa</div>
		                </div>  
                </div>      
            </div>
    <?php
    }
    ?>
</div>

