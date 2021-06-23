<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="container">
	<div class="content-cuenta">
		<div class="row">
		    <div class="col-sm-3 hidden-xs column-left" id="column-left">
		      <div class="Categories left-sidebar-widget">
		        <h2 class="section-title">MENU DE USUARIO</h2>
		        <div class="category_block">
		          <?php  if(isset($menuser)){ $this->load->view($menuser);} ?>	
		        </div>
		      </div>
		    </div>
		    <div class="col-sm-9" id="content">
				<div class="Categories right-sidebar-widget">
				<h2 class="section-title"> Mis Direcciones</h2>
				<div class="address-form">
				<form method="post" id="formAddressProfile">
			      <div class="row">
					<?php
						$i=0;
					foreach($direcciones as $r){			
						
					?>
					<div class="col-md-6 sin-espacio-der">	
							<div class="panel panel-default">				
								<div class="panel-body panel-body-color">
									<div class="row">
										<div class="col-md-12">							
										<div align="left">
								
										<?php 
												$ubigeo       = $r->cod_ubigeo;
																			
												$iddpto       = $r->CodDpto;
												$idprov       = $r->CodProv;  
												$nombdist     = $r->Nombre;
												
												$provincia    = getProvincia($iddpto,$idprov);
												$departamento = getDepartamento($iddpto);
												
												//echo "<b>".$cliente[0]->nombres." ".$cliente[0]->apellidos."</b><br>";
												echo $r->nombres." ".$r->apellidos."<br>";
												echo "Direccion  : <strong>".$r->direccion."</strong><br>";
												echo "Ubigeo     : <strong>".$departamento[0]->Nombre.", ".$provincia[0]->Nombre.", ".$nombdist."</strong><br>";
												echo "Telefono   : <strong>".$r->telefono."</strong><br>";
																											

										?>					
										</div>
										</div>
									</div>
											
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-12">	
											<div class="control-group">						
												<div class="radio defecto">
												  <label id="opcion_<?php echo $i;?>">									
													<input type="radio"  name="rdoOpcion[<?php echo $i;?>]" id="rdoOpcion_<?php echo $i;?>" data-id="<?php echo $r->id;?>"  value="<?php echo $r->predeterminado;?>"<?php if($r->predeterminado=='1'){ echo "checked=true";}else{ echo "";}?>>
													Direccion Predeterminado
												  </label>
												   <input type="hidden" name="rdoOpcion[<?php echo $i;?>][id]"  value="<?php echo $r->id;?>">
												</div>
											</div>						
										
										</div>	
									</div>	
								
								</div>
							</div>
						
					</div>
					<?php
						$i++;
					}
					?>
						
			      	<div class="col-sm-12">
						<section class="section-first list-address">			
						<div class="text-center">
								<button type="button" class="btn btn-warning btn-xsm"  data-toggle="modal" data-target="#new_addresses">
								  Agregar nueva dirección
								</button>
						<!--		
						<button class="btn-green-new new-address invert-green-btn" id="new_id_users_addresses" value="">Agregar nueva dirección</button>
						<button class="btn-green-new new-address" id="new_id_stores">Agregar nueva tienda de envío</button>
						-->
						
						</div>
						</section>
						<div id="message-address"></div>
					</div>
				
			      </div>
				  </form>
				  </div>
			    </div>
			</div>
		</div>
    </div>
</div>


<div class="modal fade" id="new_addresses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<form method="post" id="formAddress" name="formAddress" class="form-horizontal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva Dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div  class="row" id="ubigeos_content">
		<div class="col-md-4">
		<div class="form-group">
		<label for="id_ubigeos_3">Departamento</label>
		<div class="cont">
		<select id="cboDpto" name="cboDpto" class="form-control ubigeos">
			<option value="0">Seleccione</option>
			<?php
			 foreach($departamentos as $r){
				 $ubigeo = $r->CodDpto;
				 $nombre = $r->Nombre;
				 echo '<option value="'.$ubigeo.'">'.$nombre.'</option>';
			 }
			
			?>
		</select>
		</div>
		</div>
		</div>
		<div class="col-md-4">
		<div class="form-group"><label for="id_ubigeos_2">Provincia</label>
		<div class="cont">
		<select id="cboProvincia" name="cboProvincia" class="form-control ubigeos" disabled="disabled">
			<option value="0">Seleccione</option>
		</select>
		</div>
		</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="id_ubigeos">Distrito</label>
				<div class="cont">
					<select id="cboDistrito" name="cboDistrito" class="form-control" disabled="disabled">
						<option value="0">Seleccione</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
			<label for="address_description">Dirección <small class="error-text"></small></label>
			<textarea id="txtDireccion" name="txtDireccion" class="form-control" rows="2" placeholder="Ingrese dirección" required=""></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
			<label for="address_refer">Referencia <small class="error-text"></small></label>
			<textarea id="txtReferencia" name="txtReferencia" class="form-control" rows="3" placeholder="Ingresar referencia"></textarea>
			</div>
		</div>
		<div class="col-md-12" id="promotion_locker">
			<div class="form-group">
				<label for="address_default">Usar como direccion predeterminada <small class="error-text"></small></label>
				<div class="controls">
					   <label class="radio-inline"><input type="radio" id="rdoDefault" name="rdoDefault" value="1">  Si</label>
					   <label class="radio-inline"><input type="radio" id="rdoDefault" name="rdoDefault" value="0">  No</label>
					
				</div>
			</div>
		</div>
		</div>
      </div>
      <div class="modal-footer">
		<div id="message-error"></div>
        <button type="button" class="btn btn-primary btn-regAddress">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
	</form>
  </div>
</div>

