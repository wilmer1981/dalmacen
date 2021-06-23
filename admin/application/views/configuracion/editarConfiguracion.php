<?php
    $ajuste = getAjustes('config');
   // var_dump($ajuste);
	$empresa_name    	= $ajuste['config_name'];
	$empresa_email   	= $ajuste['config_email'];
	$empresa_telephone  = $ajuste['config_telephone'];
	$empresa_address    = $ajuste['config_address'];
	$empresa_ruc    	= $ajuste['config_fax'];
    $empresa_imgicon    = $ajuste['config_icon'];
    $empresa_imglogo    = $ajuste['config_logo'];
    $empresa_imglogin   = $ajuste['config_image'];
    $empresa_offline    = $ajuste['config_maintenance'];
    $empresa_access     = $ajuste['config_access'];

   //echo "Acceso: ".$empresa_access;

	$smtp_engine       = $ajuste['config_mail_engine'];
	$smtp_parameter    = $ajuste['config_mail_parameter'];
	$smtp_hostname     = $ajuste['config_mail_smtp_hostname'];
	$smtp_username     = $ajuste['config_mail_smtp_username'];
	$smtp_password     = $ajuste['config_mail_smtp_password'];
	$smtp_port         = $ajuste['config_mail_smtp_port'];
	$smtp_timeout      = $ajuste['config_mail_smtp_timeout'];
	
?>
<div class="page-content">
    <div class="page-header">
        <h1>Sistema<small><i class="ace-icon fa fa-angle-double-right"></i> Configuración Global</small></h1>
		<div class="botones pull-right">
	
			<button type="submit" form="form-config" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>	
    </div>
	<!-- /.page-header -->
		<!--
		<form role="form" name="frmGlobal" id="frmGlobal" enctype="multipart/form-data" action="Configuraciones/editar" method="post">
		<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-config" class="form-vertical">
	
		-->
    <form action="Configuraciones/editar" method="post" enctype="multipart/form-data" id="form-config" class="form-vertical">
	<div class="row">
        <div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-sm-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#home">
									<i class="green ace-icon fa fa-home bigger-120"></i>
									Sistema
								</a>
							</li>

							<li>
								<a data-toggle="tab" href="#mail">
									Mail
									<!--<span class="badge badge-danger">4</span>-->
								</a>
							</li>
							
							<li>
								<a data-toggle="tab" href="#imagenes">
									Imagenes
									<span class="badge badge-danger">3</span>
								</a>
							</li>						
						</ul>

						<div class="tab-content">
							<div id="home" class="tab-pane fade in active">
							<div class="row">
                            <div class="col-md-12 left">
                                <div class="row">
                                    <div class="col-md-6">                         
                                        <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Configuraciones de la empresa</legend>
                                        <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                    <label for="inputMarca">Nombre Empresa:</label>
													<input id="txtNombre" type="text" maxlength="100" class="form-control" name="txtNombre" required="" placeholder="Ingrese el nombre de la empresa" autofocus="" value="<?php echo $empresa_name; ?>">
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="inputMarca">RUC:</label>
                                                <input id="txtRuc" type="text" maxlength="11" class="form-control" name="txtRuc" placeholder="Ingrese numero de RUC" value="<?php echo $empresa_ruc; ?>">
                                            </div>
                                          </div>

                                        </div>
                                  
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputMarca">Direccion:</label>
                                                    <input id="txtDireccion" type="text" maxlength="200" class="form-control" name="txtDireccion" placeholder="Direcion de la empresa" value="<?php echo $empresa_address; ?>">
                                                </div>
                                            </div>
                               
                                        </div>

                                        <div class="row">  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputMarca">E-mail:</label>
                                                    <input id="txtEmail" type="email" class="form-control" name="txtEmail" placeholder="E-mail de la empresa" value="<?php echo $empresa_email; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputMarca">Telefono:</label>
                                                    <input id="txtTelefono" type="text" class="form-control" name="txtTelefono" placeholder="Numero de telefono de la empresa" value="<?php echo $empresa_telephone; ?>">
                                                </div>
                                            </div>
                      

                                        </div>
                                    </fieldset>                             
                                    </div>
                                    <div class="col-md-6">                         
                                        <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Ajuste del Sistema</legend>
                                        <div class="row">
                                            <div class="col-md-12">
												<div class="form-group">
													<label class="col-md-4 control-label">Sistema fuera de linea:</label>
													<div class="col-md-8">
													   <div class="radio">
														 <label>
															<input type="radio" name="rdOffline" value="1"<?php if($empresa_offline=='1'){ echo "checked=true";}else{ echo "";}?> > Si
														  </label>
														   <label>
															<input type="radio" name="rdOffline" value="0"<?php if($empresa_offline=='0'){ echo "checked=true";}else{ echo "";}?> > No
														  </label>
														</div>
													</div>
												</div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                               <div class="form-group">
                                                <label class="col-md-4 control-label">Roles de acceso predeterminado :</label>
                                                <div class="col-md-8">
                                                    <?php                                            
                                                    foreach ($permisos as $t) {
                                                        $id       = $t->id;                         
                                                        $nombre   = $t->nombre;
                                                        $urlnomb  = $t->url;
                                                        $accesos = unserialize($empresa_access);
                                                        //$accesos = unserialize($configuracion[0]->accesos);
                                                        
                                                        //var_dump($permisos);
                                                        //echo "Nombre: ".$permisos[$nombre];
                                                        $checked= "";
                                                        if(isset($accesos[$urlnomb])){ 
                                                            if($accesos[$urlnomb] == $id){
                                                                $checked= "checked";
                                                            }
                                                        }                                                  
                                                        echo '<input name="'.$urlnomb.'" type="checkbox" value="'.$id.'"'. $checked.'> '.$nombre.'<br>';
                                                    } ?>                                     
                                                </div>
                                              </div>
                                          </div>
                                        </div>                                
                                    </fieldset>                             
                                    </div>                    
                                </div>      
                            </div>
                            </div>
							
							</div>

								<div id="mail" class="tab-pane fade">
								  <div class="row">
                            <div class="col-md-12 left">
                                <div class="row">
                                    <div class="col-md-6">                         
                                        <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Configuración Servidor de correo de Salida SMTP</legend>
                                        <div class="row">
											<div class="col-md-12">
                                              <div class="form-group">
                                                    <label for="inputMarca" class="col-md-6">Protocolo de Correo:</label>
                                                    <div class="col-md-6">
													<select id="cboProtocolo" name="cboProtocolo" class="form-control">
													<option value="">-- SELECCIONE --</option>                                     
													<option value="mail"<?php if($smtp_engine=="mail"){ echo 'selected';}else{ echo '';} ?>> Mail</option>
													<option value="smtp"<?php if($smtp_engine=="smtp"){ echo 'selected';}else{ echo '';} ?>> SMTP</option>
																	  
													</select>
							
													</div> 
											  </div>   											  
                                            <div class="form-group">
                                              <label for="inputMarca" class="col-md-6">
											  <span data-toggle="tooltip" title="" data-original-title="Ingrese su dirección de correo electrónico. Ejemplo: username@example.com">Correo Electrónico:</label>
											   <div class="col-md-6">
                                                <input id="txtParamCorreo" type="text" class="form-control" name="txtParamCorreo" placeholder="Ejemplo: username@example.com" value="<?php echo $smtp_parameter; ?>">
                                            </div>   
											</div>   											

                                       
                                                <div class="form-group">
                                                    <label for="inputMarca" class="col-md-6">Nombre de Host SMTP:</label>
                                                    <div class="col-md-6">
													<input id="txtNameSMTP" type="text" class="form-control" name="txtNameSMTP" placeholder="Nombre Host SMTP" value="<?php echo $smtp_hostname; ?>">
                                                </div>
												</div>                    
                               
                                        
                                            
                                                <div class="form-group">
                                                    <label for="inputMarca" class="col-md-6">Nombre de usuario SMTP:</label>
													<div class="col-md-6">
														<input id="txtUserSMTP" type="text" class="form-control" name="txtUserSMTP" placeholder="Usuario SMTP" value="<?php echo $smtp_username; ?>">
													</div>
												</div>
                                            
                                                <div class="form-group">
                                                    <label for="inputMarca" class="col-md-6">Contraseña SMTP:</label>
													<div class="col-md-6">
													   <div class="input-group spacio-bottom">                                           
                                                        <input type="password" class="form-control" id="txtPasswordSMTP" name="txtPasswordSMTP" placeholder="Contraseña" required="" value="<?php echo $smtp_password; ?>" />                                                                   
                                                            <span class="input-group-addon bg_ld" id="ver-password"><i class="fa fa-eye-slash icons"> </i></span>
                                                        </div>
														<!--
														<input id="txtPasswordSMTP" type="text" class="form-control" name="txtPasswordSMTP" placeholder="Contraseña SMTP" value="<?php echo $smtp_password; ?>">
														-->
													</div>
												</div>
												<div class="form-group">
                                                    <label for="inputMarca" class="col-md-6">Puerto SMTP:</label>
													<div class="col-md-6">
														<input id="txtPortSMTP" type="number" class="form-control" name="txtPortSMTP" required="" placeholder="Puerto SMTP" value="<?php echo $smtp_port; ?>">
													</div>
												</div>
												<div class="form-group">
                                                    <label for="inputMarca" class="col-md-6">Tiempo espera SMTP:</label>
													<div class="col-md-6">
														<input id="txtTimeoutSMTP" type="number" class="form-control" name="txtTimeoutSMTP" placeholder="Tiempo de espera SMTP" value="<?php echo $smtp_timeout; ?>">
													</div>
												</div>
                                            </div>
										</div>
                                    </fieldset>                             
                                    </div>
									<!--
                                    <div class="col-md-6">                         
                                        <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Ajuste del Sistema</legend>
                                        <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <label class="col-md-4 control-label">Sistema fuera de linea :</label>
                                                <div class="col-md-8">
                                                   <div class="radio">
                                                     <label>
                                                        <input type="radio" name="offline" value="1"<?php if($configuracion[0]->site_offline=='1'){ echo "checked=true";}else{ echo "";}?> > Si
                                                      </label>
                                                       <label>
                                                        <input type="radio" name="offline" value="0"<?php if($configuracion[0]->site_offline=='0'){ echo "checked=true";}else{ echo "";}?> > No
                                                      </label>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                               <div class="form-group">
                                                <label class="col-md-4 control-label">Roles de acceso predeterminado :</label>
                                                <div class="col-md-8">
                                                    <?php                                     
                                                
                                                    foreach ($permisos as $t) {
                                                        $id       = $t->id;
                                                        //$nombre   = $t->titulo;
                                                        $nombre   = $t->nombre;
                                                        $urlnomb  = $t->url;
                                                        $accesos = unserialize($configuracion[0]->accesos);
                                                        //var_dump($permisos);
                                                        //echo "Nombre: ".$permisos[$nombre];
                                                        $checked= "";
                                                        if(isset($accesos[$urlnomb])){ 
                                                            if($accesos[$urlnomb] == $id){
                                                                $checked= "checked";
                                                            }
                                                        }                                                  
                                                        echo '<input name="'.$urlnomb.'" type="checkbox" value="'.$id.'"'. $checked.'> '.$nombre.'<br>';
                                                    } ?>                                     
                                                </div>
                                              </div>
                                          </div>
                                        </div>                                
                                    </fieldset>                             
                                    </div>                    
                                -->
								</div>      
                            </div>
                        </div>
						
								</div>

								<div id="imagenes" class="tab-pane fade">
									 <div class="row">
                            <div class="col-md-12 left">
                                <div class="row">  
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="inputMarca">Logo CPANEL:</label>
                                            <input id="imagenLogo" type="file" class="form-control filestyle" name="imagenLogo" data-placeholder="Seleccione imagen" data-buttonText="Buscar imagen" data-buttonName="btn-default" data-buttonBefore="true" data-size="md">

                                            <input id="txtRutaImgLogo" type="text" class="form-control" name="txtRutaImgLogo" value="<?php echo $empresa_imglogo; ?>" readonly>
                                        </div>
                                    </div>            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputMarca">Icono Usuario:</label>
                                            <input id="imagenIcon" type="file" class="form-control filestyle" name="imagenIcon" data-placeholder="Seleccione imagen" data-buttonText="Buscar imagen" data-buttonName="btn-default" data-buttonBefore="true" data-size="md">

                                            <input id="txtRutaImgIcon" type="text" class="form-control" name="txtRutaImgIcon" value="<?php echo $empresa_imgicon; ?>" readonly>
                                        </div>
                                    </div>           

                                </div>
                                  <div class="row">  
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="inputMarca">Logo Login:</label>
                                            <input id="imagenLogin" type="file" class="form-control filestyle" name="imagenLogin" data-placeholder="Seleccione imagen" data-buttonText="Buscar imagen" data-buttonName="btn-default" data-buttonBefore="true" data-size="md">

                                            <input id="txtRutaImgLogin" type="text" class="form-control" name="txtRutaImgLogin" value="<?php echo $empresa_imglogin; ?>" readonly>
                                        </div>
                                    </div>            
                                    <div class="col-md-6">
                                       
                                    </div>           

                                </div>
                            </div>     
                        </div> 	
								</div>

						</div>
					</div>
				</div><!-- /.col -->		
			</div><!-- /.row -->

            <div class="space"></div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
	</form>

</div>