    <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-user-plus" aria-hidden="true"></i> Editar Modelo</span></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
            
                <div class="box-body">
					<div class="col-sm-14" id="VerForm" style="display: block;">
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>
					<form role="form" action="<?php echo current_url(); ?>" name="frmModelo" id="frmModelo" method="post">
                      <div class="row">
                          <div class="col-lg-12 left">
                              <div class="row">
                         
                                    <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Marca:</label>
                                        <select id="cboMarca" name="cboMarca" class="form-control">
                                          <option value="" disabled selected>-- Escoje Marca --</option>                                   
                                        <?php 
                                          foreach($marcas as $fila ){
                                            if($fila->id == $result->id_marca){ $selected = 'selected';}else{$selected = '';}
                                              echo '<option value="'.$fila->id.'"'.$selected.'>'.strtoupper($fila->nombre).'</option>';
                                          }
                                        ?>

											  
                                        </select>
                                      </div>
                                  </div>
								           <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Modelo:</label>
                                          <input id="txtNombre" type="text" maxlength="50" name="txtNombre" required="" class="form-control" placeholder="Ingrese modelo" value="<?php echo $result->nombre ?>">
                                      </div>
                                  </div>

                              </div>                              
                          </div>                  
					
					  </div>           
                  </div>      
                </div>                
                <div class="box-footer no-padding aling-der">
                   <div class="row">
                          <div class="col-lg-12">
								<div class="botones">
								
								<a href="<?php echo base_url('modelos')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>
								<button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Modificar</button>
							
								</div>  					 
						</div>  
					</div>  
					
					
                </div>
          
                </form>
    </div>




