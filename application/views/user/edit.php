   
<script src="<?php echo base_url() ?>assets/js/script.js"></script> 

<div class="panel panel-default">
	<div class="panel-heading"><h5 class="panel-title">Informacion de Usuario</h5></div>			
	<div class="panel-body">
		<div class="well">
		    <div class="errorresponse"> </div>
		     <form method="post" class="form" id="frm_user_update" role="form" >
		   
		    <!--
		    <form class="form" id="frmupdate" role="form" action="<?php echo base_url() ?>user/update" method="POST">
		        -->  
		      <div class="form-group">
		        <label for="exampleInputEmail2">Nombres</label>
		        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre?>">
		      </div>
		      <div class="form-group">
		        <label for="exampleInputEmail2">Apellidos</label>
		        <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo $apellidos?>">
		      </div>
		      <div class="form-group">
		        <label for="exampleInputEmail2">Email</label>
		        <input class="form-control" name="email" id="email" type="email" value="<?php echo $email?>" >
		      </div>
		      <div class="form-group">
		        <label for="exampleInputPassword2">Login</label>
		        <input type="text" class="form-control" name="login" id="login" value="<?php echo $username?>">
		      </div>
		      <!--
		      <div class="form-group">
		        <label for="exampleInputPassword2">facebook link</label>
		        <input type="text" name="facebook" class="form-control" value="<?php //echo $row->facebook_link?>">
		      </div>-->
		        <div class="form-group">
		            <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
		            <input type="hidden" name="opcion" id="opcion" value="update"/>
		            <input type="button" class="btn btn-success update-user" value="update">
		      </div>
		    </form>
		</div>
	</div>
</div>
