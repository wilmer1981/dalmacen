<div class="box box-default">
    <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-lock" aria-hidden="true"></i> Registrar Permisos</span></h3>
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
		<form role="form" action="<?php echo current_url(); ?>" name="frmPermisos" id="frmPermisos" method="post" >
         <div class="row">        
			<div class="col-md-12">
				<div class="row">			                 
					<div class="col-md-6">
						<label>Nombre del Permiso</label>
						<input name="txtNombre" type="text" id="txtNombre" required="" autofocus="" class="span12" />
					</div>
					<div class="col-md-6">				
						<label>
							<input name="marcarTodos" type="checkbox" value="1" id="marcarTodos" />
							<span class="lbl"> Marcar Todos</span>
						</label>
						<br/>
					</div>
				</div>	
			</div>	       
          
            <div class="col-md-12">

                <div class="control-group">
                    <label for="documento" class="control-label"></label>
                    <div class="controls">
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#home">Mantenimiento</a></li>
                          <!--
                          <li><a data-toggle="tab" href="#menu1">Almacen</a></li>
                          <li><a data-toggle="tab" href="#menu2">Compras</a></li>
                          -->
                          <li><a data-toggle="tab" href="#menu3">Aplicaciones</a></li>
                          <li><a data-toggle="tab" href="#menu4">Reportes</a></li>
                      
                        </ul>

                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">

                                <table class="table table-bordered">
                                        <tbody>          
                                 
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input name="cUsuario" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Usuarios</span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label>
                                                        <input name="cEmpresa" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Empresa</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="cPermiso" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Permisos</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="cBackup" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Backup</span>
                                                    </label>
                                                </td>                                 
                                            </tr>
                                               <tr><td colspan="4"></td></tr>
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input name="cEmpleado" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Empleados</span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label>
                                                        <input name="cSucursal" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Sucursales</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="cTipodoc" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar TipoDocumentos</span>
                                                    </label>
                                                </td>
                                                <td colspan="1"></td>                                 
                                            </tr>
                                        </tbody>
                                </table>                    

                          </div>
              
                           <div id="menu3" class="tab-pane fade">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="mPex" class="marcar" type="checkbox" checked="checked" value="1" />
                                                 <span class="lbl"> Aplicacion PEX</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="mMolino" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Aplicacion Molino</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="mGrifo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Aplicacion Grifo</span>
                                            </label>
                                        </td>                                     
                                    </tr>   								
                                                         
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="vVenta" class="marcar" type="checkbox" checked="checked" value="1" />
                                                <span class="lbl"> Visualizar Carga</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aVenta" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Carga</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eVenta" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Carga</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="dVenta" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Carga</span>
                                            </label>
                                        </td>
                                     
                                    </tr>               
                            
                                                  
                                </tbody>
                        </table>
                          </div>
                           <div id="menu4" class="tab-pane fade">
                            <table class="table table-bordered">
                                <tbody>                     
         
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="rCliente" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Informe de Usuarios</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="rVenta" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Informe de Documentos</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="rCompra" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Informe de Cargas</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="rProducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Informe de Permisos</span>
                                            </label>
                                        </td>                                 
                                    </tr>                 

                                </tbody>
                        </table>
                          </div>
                        </div>



                    </div>
                </div>

              
    
            <div class="form-actions">
                <div class="span12">
                    <div class="span6 offset3">
					 
						<a href="<?php echo base_url('permisos')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>
                           <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Registrar</button>
                          
                    </div>
                </div>
            </div>
           
            </div>
     

                   
    </div>

</form>
		</div>
	</div>
</div>