 <?php $permisos = unserialize($result->permisos);?>
 <div class="page-content">
    <div class="page-header">
        <h1>Editar
            <small><i class="ace-icon fa fa-angle-double-right"></i> Niveles de Acceso</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-permiso" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>		
    </div>
	<div class="row">	
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>	
		
		<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-permiso" class="form-vertical">
		      
			<div class="col-md-12">
				<div class="row">			                 
					<div class="col-md-6">
					   <div class="form-group required">
						<label class="control-label">Nombre del Permiso</label>
						<input name="txtNombre" type="text" id="txtNombre" required="" autofocus="" class="form-control" value="<?php echo $result->nombre; ?>" />
						<input type="hidden" name="idpermiso" id="idpermiso" value="<?php echo $result->id; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Estado</label>
						    <select name="estado" id="estado" class="form-control browser-default custom-select custom-select-lg mb-3">
							<?php if($result->estado == 1){$sim = 'selected'; $nao ='';}else{$sim = ''; $nao ='selected';}?>
							<option value="1" <?php echo $sim;?>>Activo</option>
							<option value="0" <?php echo $nao;?>>Inactivo</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-check"><br><br>
							<input type="checkbox" class="form-check-input" value="1" id="marcarTodos" name="marcarTodos">
							<label class="form-check-label" for="exampleCheck1">Marcar Todos</label>
						</div>									
					</div>
				</div>	
			</div>	       
          
            <div class="col-md-12">
                <div class="control-group">
                    <label for="documento" class="control-label"></label>
                    <div class="controls">
                        <ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menuConfig">Configuracion</a></li>                          
							<li><a data-toggle="tab" href="#menuUsuario">Usuarios</a></li>
							<li><a data-toggle="tab" href="#menuContenido">Contenido</a></li>
							<li><a data-toggle="tab" href="#menuMenus">Menu</a></li>
							<li><a data-toggle="tab" href="#menuProductos">Productos</a></li>
							<li><a data-toggle="tab" href="#menuCotizacion">Cotizaciones</a></li>
							<li><a data-toggle="tab" href="#menuSistema">Sistema</a></li>
                      
                        </ul>

                        <div class="tab-content">
                            <div id="menuConfig" class="tab-pane fade in active">

                                <table class="table table-bordered">
                                        <tbody>          
                                 
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input <?php if(isset($permisos['cSistema'])){ if($permisos['cSistema'] == '1'){echo 'checked';}}?> name="cSistema" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Sistema</span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label>
                                                        <input <?php if(isset($permisos['cUsuario'])){ if($permisos['cUsuario'] == '1'){echo 'checked';}}?> name="cUsuario" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Usuarios</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input <?php if(isset($permisos['cCotizacion'])){ if($permisos['cCotizacion'] == '1'){echo 'checked';}}?> name="cCotizacion" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Cotizacion</span>
                                                    </label>
                                                </td>
                                                 <td>
                                                    <label>
                                                        <input <?php if(isset($permisos['cProducto'])){ if($permisos['cProducto'] == '1'){echo 'checked';}}?> name="cProducto" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Productos</span>
                                                    </label>
                                                </td>                                 
                                            </tr>
                                            <tr><td colspan="4"></td></tr>
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input <?php if(isset($permisos['cContenido'])){ if($permisos['cContenido'] == '1'){echo 'checked';}}?> name="cContenido" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Contenido</span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label>
                                                        <input <?php if(isset($permisos['cMenu'])){ if($permisos['cMenu'] == '1'){echo 'checked';}}?> name="cMenu" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Menu</span>
                                                    </label>
                                                </td>                                              
                                                <td colspan="2"></td>                                 
                                            </tr>
                                        </tbody>
                                </table>                    

                          </div>
              
                            <div id="menuUsuario" class="tab-pane fade">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vUsuario'])){ if($permisos['vUsuario'] == '1'){echo 'checked';}}?> name="vUsuario" class="marcar" type="checkbox" value="1" />
                                                 <span class="lbl"> Gestionar Usuario</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aUsuario'])){ if($permisos['aUsuario'] == '1'){echo 'checked';}}?> name="aUsuario" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Usuario</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eUsuario'])){ if($permisos['eUsuario'] == '1'){echo 'checked';}}?> name="eUsuario" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Usuario</span>
                                            </label>
                                        </td>  
										<td>
                                            <label>
                                                <input <?php if(isset($permisos['dUsuario'])){ if($permisos['dUsuario'] == '1'){echo 'checked';}}?> name="dUsuario" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Usuario</span>
                                            </label>
                                        </td>										
                                    </tr>   								
                                    <tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vGrupo'])){ if($permisos['vGrupo'] == '1'){echo 'checked';}}?> name="vGrupo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Grupo Usuario</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aGrupo'])){ if($permisos['aGrupo'] == '1'){echo 'checked';}}?> name="aGrupo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Grupo</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eGrupo'])){ if($permisos['eGrupo'] == '1'){echo 'checked';}}?> name="eGrupo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Grupo</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['dGrupo'])){ if($permisos['dGrupo'] == '1'){echo 'checked';}}?> name="dGrupo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Grupo</span>
                                            </label>
                                        </td>
                                     
                                    </tr>
									
									<tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vPermiso'])){ if($permisos['vPermiso'] == '1'){echo 'checked';}}?> name="vPermiso" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Nivel Acceso</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aPermiso'])){ if($permisos['aPermiso'] == '1'){echo 'checked';}}?> name="aPermiso" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Nivel Acceso</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['ePermiso'])){ if($permisos['ePermiso'] == '1'){echo 'checked';}}?> name="ePermiso" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Nivel Acceso</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['dPermiso'])){ if($permisos['dPermiso'] == '1'){echo 'checked';}}?> name="dPermiso" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Nivel Acceso</span>
                                            </label>
                                        </td>
                                     
                                    </tr>     
                            
                                                  
                                </tbody>
                        </table>
                          </div>
                            <div id="menuContenido" class="tab-pane fade">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vArticulo'])){ if($permisos['vArticulo'] == '1'){echo 'checked';}}?> name="vArticulo" class="marcar" type="checkbox" value="1" />
                                                 <span class="lbl"> Gestionar Articulos</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aArticulo'])){ if($permisos['aArticulo'] == '1'){echo 'checked';}}?> name="aArticulo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Articulo</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eArticulo'])){ if($permisos['eArticulo'] == '1'){echo 'checked';}}?> name="eArticulo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Articulo</span>
                                            </label>
                                        </td>  
										<td>
                                            <label>
                                                <input <?php if(isset($permisos['dArticulo'])){ if($permisos['dArticulo'] == '1'){echo 'checked';}}?> name="dArticulo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Articulo</span>
                                            </label>
                                        </td>										
                                    </tr>   								
                                    <tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vCategoria'])){ if($permisos['vCategoria'] == '1'){echo 'checked';}}?> name="vCategoria" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Categorias</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aCategoria'])){ if($permisos['aCategoria'] == '1'){echo 'checked';}}?> name="aCategoria" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Categoria</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eCategoria'])){ if($permisos['eCategoria'] == '1'){echo 'checked';}}?> name="eCategoria" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Categoria</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['dCategoria'])){ if($permisos['dCategoria'] == '1'){echo 'checked';}}?> name="dCategoria" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Categoria</span>
                                            </label>
                                        </td>
                                     
                                    </tr>
									
									<tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vBanner'])){ if($permisos['vBanner'] == '1'){echo 'checked';}}?> name="vBanner" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Banner</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aBanner'])){ if($permisos['aBanner'] == '1'){echo 'checked';}}?> name="aBanner" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Banner</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eBanner'])){ if($permisos['eBanner'] == '1'){echo 'checked';}}?> name="eBanner" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Banner</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['dBanner'])){ if($permisos['dBanner'] == '1'){echo 'checked';}}?> name="dBanner" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Banner</span>
                                            </label>
                                        </td>
                                     
                                    </tr>     
                            
                                                  
                                </tbody>
                        </table>
                          </div>
							
							<div id="menuMenus" class="tab-pane fade">
                            <table class="table table-bordered">
                                <tbody>                     
         
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vMenu'])){ if($permisos['vMenu'] == '1'){echo 'checked';}}?> name="vMenu" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Menu</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aMenu'])){ if($permisos['aMenu'] == '1'){echo 'checked';}}?> name="aMenu" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Menu</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eMenu'])){ if($permisos['eMenu'] == '1'){echo 'checked';}}?> name="eMenu" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Menu</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['dMenu'])){ if($permisos['dMenu'] == '1'){echo 'checked';}}?> name="dMenu" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Menu</span>
                                            </label>
                                        </td>                                 
                                    </tr>                 

                                </tbody>
                        </table>
                          </div>
							
							 <div id="menuProductos" class="tab-pane fade">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vProducto'])){ if($permisos['vProducto'] == '1'){echo 'checked';}}?> name="vProducto" class="marcar" type="checkbox" value="1" />
                                                 <span class="lbl"> Gestionar Producto</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aProducto'])){ if($permisos['aProducto'] == '1'){echo 'checked';}}?> name="aProducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Producto</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eProducto'])){ if($permisos['eProducto'] == '1'){echo 'checked';}}?> name="eProducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Producto</span>
                                            </label>
                                        </td>  
										<td>
                                            <label>
                                                <input <?php if(isset($permisos['dProducto'])){ if($permisos['dProducto'] == '1'){echo 'checked';}}?> name="dProducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Producto</span>
                                            </label>
                                        </td>										
                                    </tr>   								
                                    <tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vCatproducto'])){ if($permisos['vCatproducto'] == '1'){echo 'checked';}}?> name="vCatproducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Categorias</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aCatproducto'])){ if($permisos['aCatproducto'] == '1'){echo 'checked';}}?> name="aCatproducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Categoria</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eCatproducto'])){ if($permisos['eCatproducto'] == '1'){echo 'checked';}}?> name="eCatproducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Categoria</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['dCatproducto'])){ if($permisos['dCatproducto'] == '1'){echo 'checked';}}?> name="dCatproducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Categoria</span>
                                            </label>
                                        </td>
                                     
                                    </tr>
									
									<tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vMarca'])){ if($permisos['vMarca'] == '1'){echo 'checked';}}?> name="vMarca" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Marca</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aMarca'])){ if($permisos['aMarca'] == '1'){echo 'checked';}}?> name="aMarca" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Marca</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eMarca'])){ if($permisos['eMarca'] == '1'){echo 'checked';}}?> name="eMarca" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Marca</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['dMarca'])){ if($permisos['dMarca'] == '1'){echo 'checked';}}?> name="dMarca" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Marca</span>
                                            </label>
                                        </td>
                                     
                                    </tr>     
                            
                                                  
                                </tbody>
                        </table>
                          </div>
							
							<div id="menuCotizacion" class="tab-pane fade">
                            <table class="table table-bordered">
                                <tbody>                     
         
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vCotizacion'])){ if($permisos['vCotizacion'] == '1'){echo 'checked';}}?> name="vCotizacion" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Cotizacion</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['aCotizacion'])){ if($permisos['aCotizacion'] == '1'){echo 'checked';}}?> name="aCotizacion" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Cotizacion</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['eCotizacion'])){ if($permisos['eCotizacion'] == '1'){echo 'checked';}}?> name="eCotizacion" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Cotizacion</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['dCotizacion'])){ if($permisos['dCotizacion'] == '1'){echo 'checked';}}?> name="dCotizacion" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Cotizacion</span>
                                            </label>
                                        </td>                                 
                                    </tr>                 

                                </tbody>
                        </table>
                          </div>
						
						<div id="menuSistema" class="tab-pane fade">
                            <table class="table table-bordered">
                                <tbody>                     
         
                                    <tr>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vSistema'])){ if($permisos['vSistema'] == '1'){echo 'checked';}}?> name="vSistema" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Configuracion Global</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input <?php if(isset($permisos['vBackup'])){ if($permisos['vBackup'] == '1'){echo 'checked';}}?> name="vBackup" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Backup</span>
                                            </label>
                                        </td>
										 <td></td> 
										 <td></td> 
                                                                     
                                    </tr>                 

                                </tbody>
                        </table>
                          </div>
							
						
						</div>



                    </div>
                </div>
					
    </div>

		</form>
	</div>
</div>