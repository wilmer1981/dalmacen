<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login CodeIgniter</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url() ?>bootstrap/js/html5shiv.min.js"></script>
      <script src="<?php echo base_url() ?>bootstrap/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background:#eeeeee;">

    <p><br/></p>
    <div class="container">
	<div class="row">
  	    <div class="col-md-4"></div>
            <div class="col-md-4">
		<div class="panel panel-default">
  		<div class="panel-body">
		<h3><small>Silahkan Login Dulu!</small></h3><hr/>
		<?php echo form_open('Login'); ?>
  		     <div class="form-group">
    			<label for="username">Username</label>
    			<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                    </div>
  		    <div class="form-group">
    			<label for="password">Password</label>
    			<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
  		   </div>
  		   <button type="submit" class="btn btn-primary">Submit</button>
		<?php echo form_close(); ?>
            	</div>
            	</div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url() ?>bootstrap/js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>