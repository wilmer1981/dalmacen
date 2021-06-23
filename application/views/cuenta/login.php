<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
  <div class="login-signup">
    <div class="row">
    	<div class="col-sm-3"></div>
      <div class="col-sm-6 nav-tab-holder">
        <ul class="nav nav-tabs row" role="tablist">
          <li role="presentation" class="active col-sm-6"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Inicar Sesion</a></li>
          <li role="presentation" class="col-sm-6"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">Crear Cuenta</a></li>
        </ul>
      </div>
      <div class="col-sm-3"></div>
    </div>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="login">
        <div class="row">
        	<div class="col-sm-3"></div>
          <div class="col-sm-6">
            <article role="login">
              <h3 class="text-center"><i class="fa fa-lock"></i> Ingresa a tu cuenta</h3>
              <form class="signup" name="formLogin" id="formLogin"  method="post">
              	<div class="row">
              		<div class="col-sm-6 sin-espacio">
                    <div class="form-group col-sm-12">
                    	<label class="form-label required" for="login_form_email">Email</label>
                      <input type="email" class="form-control" placeholder="ejemplo@correo.com" name="txtEmail" id="txtEmail">
                    </div>
                  </div>                
              		<div class="col-sm-6 sin-espacio">
                    <div class="form-group col-sm-12"> 
                      <label class="form-label required" for="login_form_password">Contraseña</label>   
                      <div class="input-group spacio-bottom">
                          <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Contraseña" required="">      
                          <span class="input-group-addon bg_ld" id="ver-password"><i class="fa fa-eye-slash icons"> </i></span>
                      </div>
                    </div>
                      <!--
                    <div class="form-group col-sm-12">
                    	<label class="form-label required" for="login_form_password">Contraseña</label>
                      <input type="password" class="form-control" placeholder="Password" name="txtPassword" id="txtPassword">
                    </div>
                  -->
		              </div>
	              </div>
                <div class="row">
              		<div class="col-sm-6 sin-espacio">
                    <div class="form-group col-sm-12">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" class="custom-control-input" name="remember" id="remember">Recordar contraseña.
                        </label>
                      </div>
                    </div>
		              </div>
                  <div class="col-sm-6 sin-espacio">              
                    <div class="form-group col-sm-12">
                      <div class="checkbox">
                      <label class="form-label" for="login_form_email">
                        <a class="pormayorUnico-text negrita" href="<?php echo base_url('cuenta/forgot'); ?> ">Olvidé mi contraseña</a>
                      </label>     
                      </div>                
                    </div>
                  </div>
	              </div>
            		<div class="row">
                		<div class="col-sm-12 sin-espacio">
                    <div class="form-group col-sm-12">
                        <button type="button" class="btn btn-success btn-block" id="login-in"><i class="fa fa-fw fa-lock"></i> Iniciar sesión segura</button>
                    </div>
                    </div>
                </div>
              </form>
              <footer role="signup" class="text-center">
                <p class="help-phone">
                  <div class="viewport_progress"></div>
                </p>       
              </footer>
            </article>
          </div>
          <div class="col-sm-3"></div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="account">
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <article role="login">
              <h3 class="text-center"><i class="fa fa-user-circle-o"></i> Crear cuenta de usuario</h3>
              <form class="signup" name="formRegister" id="formRegister" method="post">
              	<div class="row">
              		<div class="col-sm-12 sin-espacio">
		                <div class="form-group col-sm-6">
		                <label class="form-label required" for="login_form_email">Nombres</label>
		                  <input type="text" class="form-control" placeholder="Ingresa tu nombre" name="txtNombres" id="txtNombres">
		                </div>
		                <div class="form-group col-sm-6">
		                	<label class="form-label required" for="login_form_email">Apellidos</label>
		                  <input type="text" class="form-control" placeholder="Ingresa tu apellido" name="txtApellidos" id="txtApellidos">
		                </div>
		              </div>
		            </div>
                
             		<div class="row">
                  	<div class="col-sm-12 sin-espacio">
    		                <div class="form-group col-sm-6">
    		                	<label class="form-label required" for="login_form_email">Email</label>
    		                  <input type="email" class="form-control" placeholder="Ingresa tu correo electrónico" name="txtEmail" id="txtEmail">
    		                </div>
                        <!--
                        <div class="form-group col-sm-6"> 
                          <label class="form-label required" for="login_form_password">Contraseña</label>   
                          <div class="input-group spacio-bottom">
                              <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Ingresa tu contraseña" required>                                                   
                              <span class="input-group-addon bg_ld" id="ver-password"><i class="fa fa-eye-slash icons"> </i></span>
                          </div>
                        </div>-->
                     
    		                <div class="form-group col-sm-6">
    		                	<label class="form-label required" for="login_form_password">Contraseña</label>
    		                  <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="txtPassword" id="txtPassword">
    		                </div>                
    		            </div>
    		        </div>
    		        <div class="row">
                  	<div class="col-sm-12 sin-espacio">
    		                <div class="form-group col-sm-12">
    		                  <div class="checkbox">
    		                    <label>
    		                      <input type="checkbox" id="chk-terminos" name="chk-terminos"> Acepto los <a href="<?php echo base_url('contenido/terminos-condiciones'); ?>">Términos y Condiciones</a> y las <a href="<?php echo base_url('contenido/privacidad'); ?>">Políticas de Privacidad y Confidencialidad de la información</a>
    		                    </label>
    		                    <label>
                              <input type="checkbox" id="chk-promocion" name="chk-promocion" checked="checked"> Acepto recibir material promocional en mi correo.
    		                      </label>
    		                  </div>
    		                </div>
    		            </div>
    		        </div>
    		        <div class="row">
                  	<div class="col-sm-12 sin-espacio">
    		                <div class="form-group col-sm-12">
    		                  <button type="button" class="btn btn-success btn-block" id="register"><i class="fa fa-fw fa-lock"></i> Crea tu cuenta D'Almacen</button>
    		                </div>
    		            </div>
    		        </div>
              </form>
              <footer role="signup" class="text-center">
                <p class="help-phone">
                  <div class="viewport_progresss"></div>
                </p>           
              </footer>
            </article>
          </div>
          <div class="col-sm-3"></div>
        </div>
      </div>
    </div>
  </div>
</div>