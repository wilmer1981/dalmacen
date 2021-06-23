    <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-clipboard" aria-hidden="true"></i> Editar Documento</span></h3>
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
					<form role="form" action="<?php echo current_url(); ?>" name="frmDocumento" id="frmDocumento" method="post">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Nombre del documento:</label>
                                          <input id="txtNombre" type="text" maxlength="50" name="txtNombre" required="" class="form-control" placeholder="Nombre" value="<?php echo $documentos[0]->documento;?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Operacion:</label>
                                           <select class="form-control" name="cboOperacion" id="cboOperacion">
                                              <option value="">-- OPERACION --</option>
                                              <?php foreach ($documentostipo as $t) {
                                                 $documento = mb_strtoupper($t->nombre, 'UTF-8'); 
                                                if($documentos[0]->operacion==$t->sigla){ $select='selected';}else{$select='';}

                                                echo '<option value="'.$t->sigla.'"'.$select.' >'.$documento.'</option>';
                                              } ?>
                                          </select>  
                               
                                      </div>
                                  </div>

                              </div> 
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Serie:</label>
                                          <input id="txtSerie" type="text" maxlength="50" name="txtSerie" required="" class="form-control" placeholder="Serie" value="<?php echo $documentos[0]->serie;?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Numero:</label>
                                          <input id="txtNumero" type="text" maxlength="50" name="txtNumero" required="" class="form-control" placeholder="Numero Correlativo" value="<?php echo $documentos[0]->numero;?>">
                                      </div>
                                  </div>

                              </div>                              
                          </div>
              
         
                      </div>           
                  </div>      
                </div>                
                <div class="box-footer no-padding">
                    <div class="row">
          						<div class="col-md-12 left">
                          <div class="botones">                        
                            <a href="<?php echo base_url('documentos')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>
                             <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Modificar</button>
                          </div>               
                                        
          						</div>
          					</div>
                </div>
          
                </form>
    </div>




