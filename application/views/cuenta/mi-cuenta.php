<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="container">
	<div class="content-cuenta">
	    <div class="row">	  	    
		    <div class="col-sm-3 hidden-xs column-left" id="column-left">
		      <div class="Categories left-sidebar-widget">
		        <h2 class="section-title">MENU DE USUARIO</h2>
				<!--
				 <div class="columnblock-title">MENU DE USUARIO</div>
				 -->		
		        <div class="category_block">
		        <?php  if(isset($menuser)){ $this->load->view($menuser);} ?>
		        </div>
		      </div>
		    </div>
		    <div class="col-sm-9" id="content">
				<div class="Categories right-sidebar-widget">
				<h2 class="section-title">Mis Datos Personales</h2>
				<span class="msg-response"></span>
				<div class="profile-form">
				<form method="post" id="formProfile" class="form-horizontal">
			      <div class="row">
			        <div class="col-sm-6">
			          <div class="form-group">
			            <label class="control-label col-sm-3" for="input-firstname">Nombres</label>
						<div class="col-sm-9">
			            <input type="text" name="txtNombres" value="<?php echo $registro[0]->nombres; ?>" placeholder="Nombres" id="txtNombres" class="form-control">
						</div>
					  </div>
			          <div class="form-group">
			            <label class="control-label col-sm-3" for="input-lastname">Apellidos</label>
						<div class="col-sm-9">
			            <input type="text" name="txtApellidos" value="<?php echo $registro[0]->apellidos; ?>" placeholder="Apellidos" id="txtApellidos" class="form-control">
			           </div>
					   </div>
					   <div class="form-group">
			            <label class="control-label col-sm-3" for="input-email">E-mail</label>
						<div class="col-sm-9">
			            <input type="text" name="txtEmail" value="<?php echo $registro[0]->email; ?>" placeholder="E-mail" id="txtEmail" class="form-control">
			           </div>
					   </div>
					    <div class="form-group">
			            <label class="control-label col-sm-3" for="input-email">Telefono</label>
						<div class="col-sm-9">
			            <input type="text" name="txtTelefono" value="<?php echo $registro[0]->telefono; ?>" placeholder="Telefono" id="txtTelefono" class="form-control">
			           </div>
					   </div>

			        </div>
					<div class="col-sm-6">
			          <div class="form-group">
			            <label class="control-label col-sm-4" for="input-firstname">Genero</label>
						<div class="col-sm-8">
							<div class="controls">
								<div class="btn-group">
								   <label class="radio-inline"><input type="radio" id="rdoGenero" name="rdoGenero" value="1"<?php if($registro[0]->genero=='1'){ echo "checked=true";}else{ echo "";}?> > Masculino</label>
								   <label class="radio-inline"><input type="radio" id="rdoGenero" name="rdoGenero" value="2"<?php if($registro[0]->genero=='2'){ echo "checked=true";}else{ echo "";}?>> Femenino</label>
								</div>											
							</div>
						</div>
					  </div>
			          <div class="form-group">
			            <label class="control-label col-sm-4" for="input-lastname">Fecha Nacimiento</label>
						<div class="col-sm-8">
			            <input type="text" name="txtFechNac" value="" placeholder="Fecha Nacimiento" id="txtFechNac" class="form-control">
			           </div>
					   </div>
					   <div class="form-group">
			            <label class="control-label col-sm-4" for="input-lastname">Contraseñ Actual</label>
						<div class="col-sm-8">
			            <input type="password" name="txtPassword" value="<?php echo $registro[0]->password; ?>" placeholder="Ingrese Password" id="txtPassword" class="form-control">
			           </div>
					   </div>
					   <section class="section-first list-address">	
					   <div class="text-center">
					   <button type="button" class="btn btn-warning btn-xsm" id="btn-updateUser" data-loading-text="Loading...">
								  GUARDAR
								</button>
								<!--
					    <input type="button" value="GUARDAR CAMBIOS" id="btn-updateUser" data-loading-text="Loading..." class="btn btn-primary">
						-->
						</div>
						</section>
					</div>
				
			      </div>
				  </form>
				  </div>
			    </div>
			</div>
	    </div>
    </div>
</div>
		