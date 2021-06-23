<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Login Page - Ace Admin</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css')?>" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fonts.googleapis.com.css')?>" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ace.min.css')?>" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/ace-part2.min.css')?>" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ace-rtl.min.css')?>" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/ace-ie.min.css')?>" />
    <![endif]-->

    <!-- HTML5shiv and Respond')?> for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo base_url('assets/js/html5shiv.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/respond.min.js')?>"></script>
    <![endif]-->
      <script type="text/javascript">
        var  BASE_URL = "<?php echo base_url(); ?>";
      </script>
  </body>
  </head>

  <body class="login-layout">
    <div class="main-container">
      <div class="main-content">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
              <div class="center">
                <h1>
                  <i class="ace-icon fa fa-leaf green"></i>
                  <span class="red">Prometheus</span>
                  <span class="white" id="id-text2">System</span>
                </h1>
                <h4 class="blue" id="id-company-text">&copy; Aquisher</h4>
              </div>

              <div class="space-6"></div>

              <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                  <div class="widget-body">
                    <div class="widget-main">
                      <h4 class="header blue lighter bigger">
					  <!--
                        <i class="ace-icon fa fa-coffee green"></i>
						-->
						<i class="ace-icon fa fa-power-off green"></i>
                        Ingresa a tu cuenta
                      </h4>

                      <div class="space-6"></div>

                      <form method="post" id="formLogin">
                        <fieldset>
                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="text" class="form-control" placeholder="Username" id="username" name="username" />
                              <i class="ace-icon fa fa-user"></i>
                            </span>
                          </label>

                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="password" class="form-control" placeholder="Password" id="password" name="password" />
                              <i class="ace-icon fa fa-lock"></i>
                            </span>
                          </label>

                          <div class="space"></div>

                          <div class="clearfix">
                            <label class="inline">
                              <input type="checkbox" class="ace" name="remember" id="remember">
                              <span class="lbl"> Recordar contraseña</span>
                            </label>

                            <button type="button" class="width-35 pull-right btn btn-sm btn-primary" id="login-in" name="login-in">
                              <i class="ace-icon fa fa-key"></i>
                              <span class="bigger-110">Login</span>
                            </button>
                          </div>

                          <div class="space-4"></div>
                        </fieldset>
                      </form>
                    
                      <div class="social-or-login center">
                        <span class="bigger-110"></span>
                        <!--<span class="bigger-110">Or Login Using</span>-->
                      </div>

                      <div class="space-6"></div>

                      <div class="social-login center">
                          <div class="viewport_progress"></div>
                        <!--
                        <a class="btn btn-primary">
                          <i class="ace-icon fa fa-facebook"></i>
                        </a>

                        <a class="btn btn-info">
                          <i class="ace-icon fa fa-twitter"></i>
                        </a>

                        <a class="btn btn-danger">
                          <i class="ace-icon fa fa-google-plus"></i>
                        </a>
                      -->
                      </div>
                    </div><!-- /.widget-main -->

                    <div class="toolbar clearfix">
                      <div>
                        <a href="#" data-target="#forgot-box" class="forgot-password-link">
                          <i class="ace-icon fa fa-arrow-left"></i>
                          Olvidé mi contraseña
                        </a>
                      </div>

                      <div>
					  <!--
                        <a href="#" data-target="#signup-box" class="user-signup-link">
                          Quiero registrarme
                          <i class="ace-icon fa fa-arrow-right"></i>
                        </a>
						-->
                      </div>
                    </div>
                  </div><!-- /.widget-body -->
                </div><!-- /.login-box -->

                <div id="forgot-box" class="forgot-box widget-box no-border">
                  <div class="widget-body">
                    <div class="widget-main">
                      <h4 class="header red lighter bigger">
                        <i class="ace-icon fa fa-key"></i>
                        Recuperar Contraseña
                      </h4>
                      <div class="space-6"></div>
                      <p>Ingrese su correo electrónico para recibir instrucciones</p>
                      <form method="post" id="formForgot">
                        <fieldset>
                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="email" name="email"  id="email" class="form-control" placeholder="Email" />
                              <i class="ace-icon fa fa-envelope"></i>
                            </span>
                          </label>

                          <div class="clearfix">
                            <button type="button" class="width-35 pull-right btn btn-sm btn-danger" id="forgot-in">
                              <i class="ace-icon fa fa-lightbulb-o"></i>
                              <span class="bigger-110">Enviar!</span>
                            </button>
                          </div>
                        </fieldset>
                      </form>
					  <div class="space-6"></div>

                      <div class="social-login center">
                        <div class="viewport_progres_forgot"></div>
                    
                      </div>
                    </div><!-- /.widget-main -->
                    <div class="toolbar center">
                      <a href="#" data-target="#login-box" class="back-to-login-link">
                        Atrás para iniciar sesión
                        <i class="ace-icon fa fa-arrow-right"></i>
                      </a>
                    </div>
                  </div><!-- /.widget-body -->
                </div><!-- /.forgot-box -->
				
				<div id="reset-box" class="signup-box widget-box no-border">
                  <div class="widget-body">
                    <div class="widget-main">
                      <h4 class="header green lighter bigger">
                        <i class="ace-icon fa fa-key blue"></i>
						Crea tu nueva contraseña
                      </h4>
                      <div class="space-6"></div>
                      <p> Ingrese sus datos para comenzar: </p>
                      <form method="post" id="formReset">
                        <fieldset>
                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="text" name="verifycode" id="verifycode" class="form-control" placeholder="Codigo de verificacion" />
                              <i class="ace-icon fa fa-cog"></i>
                            </span>
                          </label>

                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="password" name="password1" id="password1" class="form-control" placeholder="Nueva contraseña" />
                              <i class="ace-icon fa fa-lock"></i>
                            </span>
                          </label>

                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="password" name="password2" id="password2" class="form-control" placeholder="Repite la contraseña" />
                              <i class="ace-icon fa fa-retweet"></i>
                            </span>
                          </label>
							<!--
                          <label class="block">
                            <input type="checkbox" class="ace" />
                            <span class="lbl">
                              Acepto el 
                              <a href="#">acuerdo del Usuario</a>
                            </span>
                          </label>
						  -->

                          <div class="space-24"></div>

                          <div class="clearfix">
                            <button type="reset" class="width-30 pull-left btn btn-sm">
                              <i class="ace-icon fa fa-refresh"></i>
                              <span class="bigger-110">Reiniciar</span>
                            </button>

                            <button type="button" class="width-65 pull-right btn btn-sm btn-success" id="reset-in">
                              <span class="bigger-110">Restablecer</span>

                              <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>
                          </div>
                        </fieldset>
                      </form>
					  <div class="space-6"></div>
                      <div class="social-login center">
                        <div class="viewport_progres_reset"></div>                    
                      </div>
                    </div>

                    <div class="toolbar center">
                      <a href="#" data-target="#login-box" class="back-to-login-link">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Atrás para iniciar sesión
                      </a>
                    </div>
                  </div><!-- /.widget-body -->
                </div><!-- /.reset-box -->

                <div id="signup-box" class="signup-box widget-box no-border">
                  <div class="widget-body">
                    <div class="widget-main">
                      <h4 class="header green lighter bigger">
                        <i class="ace-icon fa fa-users blue"></i>
                        Registro de nuevo usuario
                      </h4>
                      <div class="space-6"></div>
                      <p> Ingrese sus datos para comenzar: </p>
                      <form method="post" id="formSignup">
                        <fieldset>
                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="email" class="form-control" placeholder="Email" />
                              <i class="ace-icon fa fa-envelope"></i>
                            </span>
                          </label>

                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="text" class="form-control" placeholder="Username" />
                              <i class="ace-icon fa fa-user"></i>
                            </span>
                          </label>

                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="password" class="form-control" placeholder="Password" />
                              <i class="ace-icon fa fa-lock"></i>
                            </span>
                          </label>

                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="password" class="form-control" placeholder="Repeat password" />
                              <i class="ace-icon fa fa-retweet"></i>
                            </span>
                          </label>

                          <label class="block">
                            <input type="checkbox" class="ace" />
                            <span class="lbl">
                              Acepto el 
                              <a href="#">acuerdo del Usuario</a>
                            </span>
                          </label>
						  -->

                          <div class="space-24"></div>

                          <div class="clearfix">
                            <button type="reset" class="width-30 pull-left btn btn-sm">
                              <i class="ace-icon fa fa-refresh"></i>
                              <span class="bigger-110">Reiniciar</span>
                            </button>

                            <button type="button" class="width-65 pull-right btn btn-sm btn-success">
                              <span class="bigger-110">Continuar</span>

                              <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>
                          </div>
                        </fieldset>
                      </form>
                    </div>

                    <div class="toolbar center">
                      <a href="#" data-target="#login-box" class="back-to-login-link">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Atrás para iniciar sesión
                      </a>
                    </div>
                  </div><!-- /.widget-body -->
                </div><!-- /.signup-box -->
              </div><!-- /.position-relative -->
				<!--
              <div class="navbar-fixed-top align-right">
                <br />
                &nbsp;
                <a id="btn-login-dark" href="#">Dark</a>
                &nbsp;
                <span class="blue">/</span>
                &nbsp;
                <a id="btn-login-blur" href="#">Blur</a>
                &nbsp;
                <span class="blue">/</span>
                &nbsp;
                <a id="btn-login-light" href="#">Light</a>
                &nbsp; &nbsp; &nbsp;
              </div>
			  -->
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.main-content -->
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js')?>"></script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
    </script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
      jQuery(function($) {
       $(document).on('click', '.toolbar a[data-target]', function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('.widget-box.visible').removeClass('visible');//hide others
        $(target).addClass('visible');//show target
       });
      });
      
      
      
      //you don't need this, just used for changing background
      jQuery(function($) {
       $('#btn-login-dark').on('click', function(e) {
        $('body').attr('class', 'login-layout');
        $('#id-text2').attr('class', 'white');
        $('#id-company-text').attr('class', 'blue');
        
        e.preventDefault();
       });
       $('#btn-login-light').on('click', function(e) {
        $('body').attr('class', 'login-layout light-login');
        $('#id-text2').attr('class', 'grey');
        $('#id-company-text').attr('class', 'blue');
        
        e.preventDefault();
       });
       $('#btn-login-blur').on('click', function(e) {
        $('body').attr('class', 'login-layout blur-login');
        $('#id-text2').attr('class', 'white');
        $('#id-company-text').attr('class', 'light-blue');
        
        e.preventDefault();
       });
       
      });
    </script>
    <script src="<?php echo base_url('assets/js/jquery.cookie.js')?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.functions.js')?>"></script>  
    
</html>
