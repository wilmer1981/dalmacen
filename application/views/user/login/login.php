<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php if (validation_errors()) : ?>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="alert alert-danger" role="alert"><?php echo validation_errors() ?></div>				
			</div>
			<div class="col-md-4"></div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="alert alert-danger" role="alert"><?php echo $error ?></div>
			</div>
			<div class="col-md-4"></div>
		<?php endif; ?>
		</div>
		<div class="col-md-12">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
 					<h2 class="panel-title">Login de Usuario</h2>
				</div>			
				<div class="panel-body">		
					<?php echo form_open() ?>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Your username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Your password">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-default" value="Login">
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
	</div><!-- .row -->
</div><!-- .container -->