<!DOCTYPE html>
<html>
<head>
        <title>Admin | Dashboard</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">    
        
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        
        <!--
          <link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-login.css">
          -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

     	<script type="text/javascript">
  			var  BASE_URL = "<?php echo base_url(); ?>";
      </script>

    </head>
<body>

<div class="container">  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>    
    <div class="col-md-4">
      <section class="login-form">        
        <form method="post" role="login" id="formLogin">
          <img src="<?php echo base_url('assets/images/logo.png');?>" class="img-responsive" alt="" />   
        <div class="input-group spacio-bottom">
			<span class="input-group-addon bg_lg" id="basic-addon1"><i class="glyphicon glyphicon-user"> </i></span>
			<input type="text" class="form-control" id="username" name="username" placeholder="Username" aria-describedby="basic-addon1">
		</div>
		
		<div class="input-group spacio-bottom">
			<span class="input-group-addon bg_ly" id="basic-addon2"><i class="glyphicon glyphicon-asterisk"> </i></span>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" />
		</div>            
          
          
          <button type="button" id="login-in" name="login-in" class="btn btn-lg btn-primary btn-block" href="index.html"><i class="fa fa-fw fa-lock"></i> Iniciar Sesion</button>
          <div>
          <!--
            <a href="#">Create account</a> or <a href="#">reset password</a>
            -->
          </div>
          
        </form>
         <div class="viewport_progress"></div>
        <!--
        <div class="form-links">
          <a href="#">www.website.com</a>
        </div>
        -->
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div> 
  
  
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/validate.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.login.js"></script> 
</body>

</html>

