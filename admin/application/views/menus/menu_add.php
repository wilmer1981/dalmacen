    <?php	
	$idtipo   = $this->uri->segment(3);
	$link_ant = $_SERVER['HTTP_REFERER'];
	$array    = explode("/", $link_ant);

	$parte1=$array[0];
	$parte2=$array[1];
	$parte3=$array[2];
	$parte4=$array[3];
	$parte5=$array[4];
	//$parte6=$array[5];
	//$parte7=$array[6];
	//$parte8=$array[7];
	//echo "Parte : ".$parte7; 

	?>
 <div class="page-content">
    <div class="page-header">
        <h1>Adicionar
            <small><i class="ace-icon fa fa-angle-double-right"></i> Niveles de Acceso</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-menu" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>		
    </div>		         
    <div class="row">		
		<?php if ($custom_error != '') {
			echo '<div class="alert alert-danger">' . $custom_error . '</div>';
		} ?>
		<form role="form" action="<?php echo current_url(); ?>" name="form-menu" id="form-menu" method="post" enctype="multipart/form-data">
    	<div class="col-md-12">
			<div  class="row">	
				<div  class="col-md-8">	
					<div class="form-group">
						<label class="control-label">Titulo:(<span class="required">*</span>)</label>
						<div class="controls">
						  <input id="txtTitulo" type="text" maxlength="20" name="txtTitulo" required="" class="form-control" placeholder="Ingrese Titulo" autofocus="">
						</div>
					</div>												
				</div>
				<div  class="col-md-4">					
					<div class="form-group">				
						<label class="control-label">Alias :</label>
						<div class="controls">									
							  <input id="txtAlias" type="text" maxlength="40" name="txtAlias" class="form-control" placeholder="Autogenerado desde el título" readonly >
						</div>
					</div>
				</div>						
			</div>
		
		
			<div class="row">
			<div  class="col-md-12">
			<div class="tabbable">			
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#seccionA">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							General
						</a>
					</li>
					<li>
						<a data-toggle="tab" href="#sectionB">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							Dato                                                    
						</a>
					</li>			
				</ul>
				
				<div class="tab-content">		
					<div id="sectionA" class="tab-pane fade in active">			
						<div  class="row">	
							<div  class="col-md-12">																			
								<div class="control-group ">
									<label class="control-label">Descripcion :<span class="required"></span></label>
									<div class="controls">								
										 <textarea name="txtDescripcion" id="txtDescripcion" rows="20" class="form-control" type="textarea"  ></textarea>
									</div>
								</div>													
							</div>							
						</div>
					</div>							
				</div>    
												  
							  
			</div>           
			</div>      
            </div> 
		</div>                     
        </form>
	</div>
	</div>





