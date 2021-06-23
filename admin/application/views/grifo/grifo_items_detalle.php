<div class="modal-dialog">
  <div class="modal-content">
  	<!--
	<div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Transportistas</span>
	</div>  
	-->
		
  
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Detalle Factura</span></h3>
			<div class="box-tools pull-right">		
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
			</div>
		</div>
  
		<div class="box-body">
			           
			<div class="row"> 
				<div class="col-md-12"> 
					<div class="row"> 
                    <div class="col-md-4">
                          <div class="form-group has-success">
                              <label for="inputMarca">Nº Factura:</label>                                
                              <input type="text" name="txtPlaca" id="txtPlaca" class="form-control input-sm" value="<?php echo $factura[0]->factura; ?>"  readonly>
                          </div>
                    </div>
                    <div class="col-md-4">
                          <div class="form-group has-success">
                              <label for="inputMarca">Ciudad:</label>                                
                              <input type="text" name="txtLicencia" id="txtLicencia" class="form-control input-sm" value="<?php echo $factura[0]->ciudad; ?>" readonly>
                          </div>
                    </div>
					    <div class="col-md-4">
                          <div class="form-group has-success">
                              <label for="inputMarca">Estacion:</label>                                
                              <input type="text" name="txtLicencia" id="txtLicencia" class="form-control input-sm" value="<?php echo $factura[0]->estacion; ?>"  readonly>
                          </div>
                    </div>
					</div>
					<div class="row"> 
                    <div class="col-md-4">
                          <div class="form-group has-success">
                              <label for="inputMarca">Surtidor:</label>                                
                              <input type="text" name="txtPlaca" id="txtPlaca" class="form-control input-sm" value="<?php echo $factura[0]->surtidor; ?>"  readonly>
                          </div>
                    </div>
                    <div class="col-md-4">
                          <div class="form-group has-success">
                              <label for="inputMarca">Manguera:</label>                                
                              <input type="text" name="txtLicencia" id="txtLicencia" class="form-control input-sm" value="<?php echo $factura[0]->manguera; ?>" readonly>
                          </div>
                    </div>
					    <div class="col-md-4">
                          <div class="form-group has-success">
                              <label for="inputMarca">Caja:</label>                                
                              <input type="text" name="txtLicencia" id="txtLicencia" class="form-control input-sm" value="<?php echo $factura[0]->caja; ?>"  readonly>
                          </div>
                    </div>
					</div>
					<hr>
					<div class="row"> 
                    <div class="col-md-4">
                          <div class="form-group">
                              <label for="inputMarca">Cliente:</label>                                
                              <input type="text" name="txtPlaca" id="txtPlaca" class="form-control input-sm" value="<?php echo $factura[0]->nombre_cliente_1; ?>"  readonly>
                          </div>
                    </div>
                    <div class="col-md-4">
                          <div class="form-group">
                              <label for="inputMarca">Placa:</label>                                
                              <input type="text" name="txtLicencia" id="txtLicencia" class="form-control input-sm" value="<?php echo $factura[0]->placa; ?>" readonly>
                          </div>
                    </div>
					    <div class="col-md-4">
                          <div class="form-group">
                              <label for="inputMarca">Docum.Cliente:</label>                                
                              <input type="text" name="txtLicencia" id="txtLicencia" class="form-control input-sm" value="<?php echo $factura[0]->documento_cliente_1; ?>"  readonly>
                          </div>
                    </div>
					</div>
				</div>
            </div>
		
		
               
            <div class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <!--
									<th>Duracion</th>
									-->
                                    <th>Producto</th>
									<th>Precio</th>
									<th>Cantidad</th>
									<th>Importe</th>																											
                                    <!--
									<th>Estado</th>
									-->                                 
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($factura as $r) {  

                                    if($r->estado==1){
                                      $estado='<span class="label label-success">ACTIVO</label>';           
                                    }else{
                                      $estado='<span class="label label-danger">INACTIVO</label>';
                                    }

                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->fecha.'</td>';
                                   // echo '<td>'.$r->duracion.'</td>';
									echo '<td>'.$r->producto.'</td>';
									echo '<td>$ '.$r->precio.'</td>';
									echo '<td>'.number_format($r->cantidad,3).'</td>';
                                    echo '<td>$ '.number_format($r->dinero,2).'</td>';								
                                   // echo '<td>'.number_format($r->hr_anterior,3).'</td>';
									//echo '<td>'.number_format($r->hr_actual,3).'</td>';
									//echo '<td>'.$estado.'</td>';                         
                                   echo '</tr>';
                                }
                                ?>
                          
                            </tbody>
                        </table>  
                  </div>                
          
		</div>
         
		<div class="box-footer no-padding">
				 
		</div>            
    </div>	
</div>
</div>