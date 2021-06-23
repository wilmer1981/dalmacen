 <div class="page-content">
    <div class="page-header">
        <h1>Adicionar
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
						<input name="txtNombre" type="text" id="txtNombre" required="" autofocus="" class="form-control" />
						</div>
					</div>
					<div class="col-md-6">
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
                                                        <input name="cSistema" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Sistema</span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label>
                                                        <input name="cUsuario" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Usuarios</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="cCotizacion" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Cotizacion</span>
                                                    </label>
                                                </td>
                                                 <td>
                                                    <label>
                                                        <input name="cProducto" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Productos</span>
                                                    </label>
                                                </td>                                 
                                            </tr>
                                            <tr><td colspan="4"></td></tr>
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input name="cContenido" class="marcar" type="checkbox" value="1" />
                                                        <span class="lbl"> Configurar Contenido</span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label>
                                                        <input name="cMenu" class="marcar" type="checkbox" value="1" />
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
                                                <input name="vUsuario" class="marcar" type="checkbox" value="1" />
                                                 <span class="lbl"> Gestionar Usuario</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aUsuario" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Usuario</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eUsuario" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Usuario</span>
                                            </label>
                                        </td>  
										<td>
                                            <label>
                                                <input name="dUsuario" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Usuario</span>
                                            </label>
                                        </td>										
                                    </tr>   								
                                    <tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="vGrupo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Grupo Usuario</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aGrupo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Grupo</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eGrupo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Grupo</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="dGrupo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Grupo</span>
                                            </label>
                                        </td>
                                     
                                    </tr>
									
									<tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="vPermiso" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Nivel Acceso</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aPermiso" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Nivel Acceso</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="ePermiso" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Nivel Acceso</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="dPermiso" class="marcar" type="checkbox" value="1" />
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
                                                <input name="vArticulo" class="marcar" type="checkbox" value="1" />
                                                 <span class="lbl"> Gestionar Articulos</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aArticulo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Articulo</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eArticulo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Articulo</span>
                                            </label>
                                        </td>  
										<td>
                                            <label>
                                                <input name="dArticulo" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Articulo</span>
                                            </label>
                                        </td>										
                                    </tr>   								
                                    <tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="vCategoria" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Categorias</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aCategoria" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Categoria</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eCategoria" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Categoria</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="dCategoria" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Categoria</span>
                                            </label>
                                        </td>
                                     
                                    </tr>
									
									<tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="vBanner" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Banner</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aBanner" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Banner</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eBanner" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Banner</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="dBanner" class="marcar" type="checkbox" value="1" />
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
                                                <input name="vMenu" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Menu</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aMenu" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Menu</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="eMenu" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Menu</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="dMenu" class="marcar" type="checkbox" value="1" />
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
                                                <input name="vProducto" class="marcar" type="checkbox" value="1" />
                                                 <span class="lbl"> Gestionar Producto</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aProducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Producto</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eProducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Producto</span>
                                            </label>
                                        </td>  
										<td>
                                            <label>
                                                <input name="dProducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Producto</span>
                                            </label>
                                        </td>										
                                    </tr>   								
                                    <tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="vCatproducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Categorias</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aCatproducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Categoria</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eCatproducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Categoria</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="dCatproducto" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Eliminar Categoria</span>
                                            </label>
                                        </td>
                                     
                                    </tr>
									
									<tr><td colspan="4"></td></tr>                    
                                    <tr>
                                        <td>
                                            <label>
                                                <input name="vMarca" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Marca</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aMarca" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Marca</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="eMarca" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Marca</span>
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="dMarca" class="marcar" type="checkbox" value="1" />
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
                                                <input name="vCotizacion" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Gestionar Cotizacion</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="aCotizacion" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Agregar Cotizacion</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="eCotizacion" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Editar Cotizacion</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="dCotizacion" class="marcar" type="checkbox" value="1" />
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
                                                <input name="vSistema" class="marcar" type="checkbox" value="1" />
                                                <span class="lbl"> Configuracion Global</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input name="vBackup" class="marcar" type="checkbox" value="1" />
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