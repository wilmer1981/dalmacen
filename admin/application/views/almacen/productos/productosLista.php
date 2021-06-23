<script src="<?php echo base_url();?>assets/js/jquery.functions.popup.js"></script>
<div class="modal-dialog">
  <div class="modal-content">
		<div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Productos</span>
		</div>  
  
		<div class="widget-content">
   
            <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                           
                            <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>                           
                            </thead>
                            <tbody>
                                <?php foreach ($productos as $r) {   

                                    $img   =$r->url_imagen;         
                                    if($img){
                                        $image='uploads/'.$img;
                                        $image='<img class="thumbnail-image" src="'.base_url($image).'" />';
                                    }else{
                                        $image='assets/images/no_image.png';
                                        $image='<img class="thumbnail-image" src="'.base_url($image).'" />';
                                    }


                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$image.'</td>';
                                    echo '<td>'.$r->nombre.'</td>';
                                    echo '<td>'.$r->categoria.'</td>';
                                    echo '<td>'.$r->subcategoria.'</td>';
                                    echo '<td>'.$r->estado.'</td>';
                                    echo '<td>';
									?>
									<input type="hidden" id="idproducto<?php echo $r->id;?>" value="<?php echo $r->id;?>">
                                    <input type="hidden" id="codproducto<?php echo $r->id;?>" value="<?php echo $r->codigo;?>">
									<input type="hidden" id="producto<?php echo $r->id;?>"   value="<?php echo $r->nombre;?>">
									<?php    
									echo '<a style="margin-right: 1%" class="btn  btn-default btn-xs close-modal-p" title="Agregar Proveedor" data-id="'. $r->id.'"><i class="glyphicon glyphicon-saved"></i></a>'; 									 
						       
                                echo '</td>';
                                   echo '</tr>';
                                }
                                ?>
                                <!--
                                <tr>
                                    
                                </tr>
                                -->
                            </tbody>
                        </table>  
        </div>    
    </div>
 </div>
