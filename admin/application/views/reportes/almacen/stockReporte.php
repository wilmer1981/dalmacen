<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Reporte Stock de Productos</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
  
  <div class="box-body">
        <!-- BUSCADOR-->
    <div class="row">
      <div class="col-md-12">     
        <div class="form-action" id="buscador">
          <span><?php //echo validation_errors(); ?></span>
          <?php 
            $attr = array("class" => "form-inline", "role" => "form", "id" => "formReporte", "name" => "formReporte");
            //echo form_open("reportes/search", $attr);
            echo form_open("reportes/almacenstock", $attr);
          ?>
            <div class="row">
              <div class="col-md-5">
                        <div class="form-group">
                            <label for="nomeCliente" class="control-label">Categoria:</label>    
                                <select class="form-control" name="cboCategoria" id="cboCategoria">
                                  
                                     <option value="" >-- TODO --</option>   
                                                              
                                        <?php foreach ($categorias as $t) {
                                           $nombre = mb_strtoupper($t->nombre, 'UTF-8');                                   
                                          if(isset($_POST['cboCategoria']) and $_POST['cboCategoria']==$t->id){
                                            $selected='selected';
                                          }else{
                                            $selected='';
                                          }                                        

                                          echo '<option value="'.$t->id.'"'.$selected.'>'.$t->nombre.'</option>';
                                        } 
                                        ?>
                                </select> 

                        </div>
              </div>
        
              <div class="col-md-3">        
                <div class="form-group">
                  <label for="nomeCliente" class="control-label"></label>
                  <input id="btn_search" name="btn_search" type="submit" class="btn btn-danger" value="Buscar" />
                  <a href="<?php echo base_url(). "reportes/listado"; ?>" class="btn btn-primary">Mostrar Todo</a>         
                </div>              
              </div>
              <div class="col-md-3">        
                <div class="form-group">              
                  <button id="btn_export_stock" name="btn_export_stock" type="button" class="btn btn-default">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                  <!--
                  <button id="btn_export_excel" name="btn_export_excel" type="button" class="btn btn-default">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>  
                  -->             
                </div>              
              </div>

            </div>
               <?php echo form_close(); ?>
        </div>
      </div>
    </div>
      <!-- FIN BUSCADOR-->


  
               
                  <div id="VerListado" class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                   <th>#</th>
                                    <th></th>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Stock Minimo</th>                           
                                    <th>Stock Actual</th>                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($productos as $r) { 

                                  if($r->estado==1){
                                    $estado="<span class='label label-success'>PROCESADO</span>";
                                  }else{
                                    $estado="<span class='label label-warning'>ANULADO</span>";
                                  }


                                     $img   =$r->url_imagen;         
                                    if($img){
                                        $image='uploads/'.$img;
                                        $image='<img class="thumbnail-image" src="'.base_url($image).'" />';
                                    }else{
                                        $image='assets/images/no_image.png';
                                        $image='<img class="thumbnail-image" src="'.base_url($image).'" />';
                                    }


                                    $oDate = strtotime($r->fech_reg);
                                    $sDate = date("m/d/Y",$oDate);

                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$image.'</td>';
                                    echo '<td>'.$r->codigo.'</td>';
                                    echo '<td>'.$r->nombre.'</td>';
                                    echo '<td>'.$r->categoria.'</td>';
                                    echo '<td><span style="font-weight: bold;">'.$r->stock_minimo.'</span></td>';                      
                                    echo '<td><span style="font-weight: bold;">'.$r->stock.'</span></td>';                   
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
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                  <!--
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">United States of America
                      <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                    <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                    </li>
                    <li><a href="#">China
                      <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                  </ul>
                  -->
                </div>
                <!-- /.footer -->
    </div>
    <!--
</section>
-->
<!-- page script -->
<!--
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
-->
<script type="text/javascript">
//var table;

</script>




