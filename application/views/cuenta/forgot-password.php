<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-md-6">
					<article role="login">
						<div id="forgot-box" style="display: block;">
		                    <h3 class="text-center"><i class="fa fa-lock"></i> Restaurar Contraseña</h3>
		                	<p class="message-text">Ingresa correo electrónico y te enviaremos las instrucciones para restaurar tu contraseña.</p>
			                <form class="signup" name="formForgot" id="formForgot" method="post">
			                	<div class="row">
			                		<div class="col-sm-12 sin-espacio">
				                      <div class="form-group col-sm-12">
				                      	  <p class="help-block">
				                      	<label class="form-label required" for="login_form_email">Email</label>
				                        <input type="email" id="txtEmail" name="txtEmail" class="form-control" placeholder="Ejemplo: usuario@correo.com" autocomplete="off" autofocus="" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
				                          </p>
				                      </div>
				                    </div>
			                  
			                    </div>
			           		   <div class="row">
			              		    <div class="col-sm-12 sin-espacio">
					                    <div class="form-group col-sm-12">
						                  	    <p class="help-block">
						                           <button type="button" class="btn btn-success btn-block" id="forgot-in"><i class="fa fa-fw fa-lock"></i> Continuar</button>
						                       </p>						                 
					                        	<div class="bgd-o"><span>ó</span></div>					                         
												<p class="help-block recovery-pepito">
													<small><a type="button" class="btn btn-default btn-block" href="<?php echo base_url('cuenta/login'); ?>">Iniciar sesión</a></small>
												</p>
											
					                    </div>
					                </div>
					            </div>
			                </form>
		                </div>

		        		<div id="validate-box" style="display: none;">
		        			<h3 class="text-center"><i class="fa fa-lock"></i> Crea tu nueva contraseña</h3>
		        			<!--
		        			<h3 style="margin:10px 0 20px 0"><i class="ace-icon fa fa-key"></i>Crea tu nueva contraseña</h3>
		                	<p class="message-text">Ingresa correo electrónico y te enviaremos las instrucciones para restaurar tu contraseña.</p>
		                    -->
							<form class="signup" name="formReset" id="formReset" method="post">							
								<p class="message-text"></p>
								<div class="row">
			                		<div class="col-sm-12 sin-espacio">
				                        <div class="form-group col-sm-12">										
											<label for="email">Ingresa código de verificación</label>										
											<input type="text" class="form-control" id="txtCodigo" name="txtCodigo" placeholder="Codigo de verificacion" aria-describedby="basic-addon1" required="">
										</div>
									</div>
								</div>
								<div class="row">
			                		<div class="col-sm-12 sin-espacio">
				                        <div class="form-group col-sm-12">
				                        	<p class="help-block">
											<label for="email">Ingresa la nueva contraseña</label>
											<input type="password" min="6" max="10" class="form-control" id="txtPassword1" name="txtPassword1" placeholder="Al menos 6 caracteres" required="">
										    </p>
										</div>
							        </div>
								</div>
								<div class="row">
			                		<div class="col-sm-12 sin-espacio">
				                        <div class="form-group col-sm-12">
				                        	<p class="help-block">
											<label for="email">Confirma la contraseña</label>
									    	<input type="password" min="6" max="10" class="form-control" id="txtPassword2" name="txtPassword2" placeholder="Al menos 6 caracteres" required="">
									        </p>
								       </div>
								    </div>
								</div>
								<div class="row">
			              		    <div class="col-sm-12 sin-espacio">
					                    <div class="form-group col-sm-12">
					                    	<p class="help-block">
											<span class="span" style="display: none;"></span> 						
											<button type="button" class="btn btn-success btn-block" id="reset-in"><i class="fa fa-fw fa-lock"></i> Restablecer Contraseña</button>	
											</p>										
										</div>
									</div>
								</div>																
							</form>			    
						</div>
		                <footer role="signup" class="text-center">
		                	<p class="help-phone">
		                		<small>¿Necesitas ayuda adicional? No te preocupes, llámanos al <a href="tel:+5116159200"><strong>(511) 615-1200</strong></a>. 
		                		</small>
							</p>	       
		                </footer>
	                </article>
                </div>

            <!--
		
					<article role="login">
			
						<div class="viewport_progress" style="display: none;"></div>
						<div class="panel panel-default">
							<div class="panel-body">
							
								<div id="forgot-box" style="display: block;">
									<form method="post" id="formForgot">
									<h3 style="margin:10px 0 20px 0"><i class="ace-icon fa fa-key"></i> Restablecer contraseña</h3>
									<p class="message-text">Ingresa correo electrónico y te enviaremos las instrucciones para restaurar tu contraseña.</p>
									
									<div class="form-group">
										<label for="email">Correo electrónico</label>
										<input type="email" id="txtEmail" name="txtEmail" class="form-control" placeholder="Ejemplo: usuario@correo.com" autocomplete="off" autofocus="" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
									</div>								
									<button type="button" class="btn btn-success btn-block" id="forgot-in"><i class="fa fa-fw fa-lock"></i> Continuar</button>
																	
									<div class="bgd-o"><span>ó</span></div>
									<p class="help-block recovery-pepito">
									<small><a type="button" class="btn btn-default btn-block" href="<?php echo base_url('cuenta/login'); ?>">Iniciar sesión</a></small>
									</p>
									<p class="help-phone"><small>¿Necesitas ayuda adicional? No te preocupes, llámanos al <a href="tel:+5116159200"><strong>(511) 615-1200</strong></a>. </small></p>
									</form>
								</div>
								
								<div id="validate-box" style="display: none;">							
									<form method="post" id="formReset"> 
									
										<h3 style="margin:10px 0 20px 0">
												<i class="ace-icon fa fa-key"></i>
												Crea tu nueva contraseña
										</h3>
										<p class="message-text"></p>
										<div class="form-group">	
											<label for="email">Ingresa código de verificación</label>										
											<input type="text" class="form-control" id="txtCodigo" name="txtCodigo" placeholder="Codigo de verificacion" aria-describedby="basic-addon1" required="">
										</div>
										<div class="form-group">
											<label for="email">Ingresa la nueva contraseña</label>
											<input type="password" min="6" max="10" class="form-control" id="txtPassword1" name="txtPassword1" placeholder="Al menos 6 caracteres" required="">
										</div>
										
										<div class="form-group">										
											<label for="email">Confirma la contraseña</label>
											<input type="password" min="6" max="10" class="form-control" id="txtPassword2" name="txtPassword2" placeholder="Al menos 6 caracteres" required="">
										</div>										
										<span class="span" style="display: none;"></span> 						
										<button type="button" class="btn btn-primary btn-block" id="reset-in"><i class="fa fa-fw fa-lock"></i> Restablecer Contraseña</button>
										 <br>
										<p class="help-phone"><small>¿Necesitas ayuda adicional? No te preocupes, llámanos al <a href="tel:+5116159200"><strong>(511) 615-1200</strong></a>. </small></p>
															
									</form>       
							    
								</div>								
							</div>
						</div>
					</article>
				-->
			    <div class="col-sm-3"></div>
			</div>
		</div>
	</section><!--/form-->