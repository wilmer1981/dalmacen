<?php defined('BASEPATH') OR exit('No direct script access allowed'); 


?>
<div class="panel panel-default">
	<div class="panel-heading"><h5 class="panel-title">Edicion de Usuario</h5></div>	
		<div class="errorresponse"></div>			
	<div class="panel-body">

			<!--<?php if (validation_errors()) : ?>
				<div class="col-md-12">
					<div class="alert alert-danger" role="alert"><?php //echo validation_errors(); ?>	</div>
				</div>
			<?php endif; ?>
			<?php if (isset($error)) : ?>
				<div class="col-md-12">
					<div class="alert alert-danger" role="alert"><?php //echo $error; ?></div>
				</div>
			<?php endif; ?>-->
							
			<?php //echo form_open() ?>
			<form class="form-horizontal" id="frm_user_register" role="form" >
	
    <div class="form-group">
        <label class="control-label col-xs-3">Email:</label>
        <div class="col-xs-6">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $username; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Password:</label>
        <div class="col-xs-6">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
    </div>
    <!--
    <div class="form-group">
        <label class="control-label col-xs-3">Confirmar Password:</label>
        <div class="col-xs-6">
            <input type="password" class="form-control" id="inputPasswordConfirm" placeholder="Confirmar Password">
        </div>
    </div>-->
    <div class="form-group">
        <div class="col-xs-12"><hr>  </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Nombre:</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Apellidos:</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>">
        </div>
    </div>
    <div class="form-group">
    	<label class="control-label col-xs-3">Nivel:</label>
    	<div class="col-xs-3">
			<select class="form-control" name="tipo" id="tipo" >
                <option value="<?php echo $idgrupo; ?>"><?php echo $grupo; ?></option>
                <option value="">Tipo de usuario</option>
                <?php
					foreach($tipos as $fila)
					{
						$id=$fila->id;
						$nom=utf8_encode($fila->grupo);
						echo "<option value='$id'>$nom</option>";
					}
				?>
			</select>
		</div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3" >Telefono:</label>
        <div class="col-xs-3">
            <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
        </div>
    </div>
    <!--
    <div class="form-group">
        <label class="control-label col-xs-3">F. Nacimiento:</label>
        	<div id="datepicker" class="input-prepend date">
				<span class="add-on"><i class="icon-th"></i></span>
				<input class="span2" type="text" value="02-16-2012">
			</div>
        <div class="col-xs-2">
            <select class="form-control">
                <option>Dia</option>
                <option>01</option>
                <option>02</option>
            </select>
        </div>
        <div class="col-xs-2">
            <select class="form-control">
                <option>Mes</option>
                <option>Enero</option>
                <option>Febrero</option>
                <option>Marzo</option>
            </select>
        </div>
        <div class="col-xs-2">
            <select class="form-control">
            	<option>Año</option>
                <option>2015</option>
                <option>2014</option>
                <option>2013</option>
                <option>2012</option>
            </select>
        </div>
    </div>
-->
    <div class="form-group">
        <label class="control-label col-xs-3">Dirección:</label>
        <div class="col-xs-6">
            <textarea rows="3" class="form-control" name="direccion" id="direccion" placeholder="Dirección"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Genero:</label>
        <div class="col-xs-2">
            <label class="radio-inline">
                <input type="radio" name="gender" id="gender" value="M"> Maculino
            </label>
        </div>
        <div class="col-xs-2">
            <label class="radio-inline">
                <input type="radio" name="gender" id="gender"value="F"> Femenino
            </label>
        </div>        
    </div>
    <!--
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-9">
            <label class="checkbox-inline">
                <input type="checkbox" value="agree">  Accepto <a href="#">Terminos y condiciones</a>.
            </label>
        </div>
    </div>-->
    <br>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-6">          
            <input type="hidden" name="opcion" id="opcion" value="register"/>
            <input type="hidden" name="url" id="url" value="<?php echo base_url()?>index.php/user/add_user" /> 
   		    <input type="button" class="btn btn-success btn-register" value="Enviar">		
            <input type="reset" class="btn btn-default" value="Limpiar">          
        </div>
        <div class=" col-xs-3"><div class="resultado"></div></div>
    </div>
</form>
		
	</div>
</div>