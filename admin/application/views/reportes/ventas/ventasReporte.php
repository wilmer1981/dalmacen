<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Reporte Ventas</span></h3>
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
            echo form_open("reportes/ventas", $attr);
          ?>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="nomeCliente" class="control-label">Fecha Inicial<span class="required"></span></label>
                           
                    <div class="input-group date" id="fecha_inicial">
                      <input type="text" class="form-control" id="txtFechaInicial" name="txtFechaInicial" value="<?php echo set_value('txtFechaInicial'); ?>" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                       
                </div>          
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="nomeCliente" class="control-label">Fecha Final<span class="required"></span></label>
                           
                    <div class="input-group date" id="fecha_final">
                      <input type="text" class="form-control" id="txtFechaFinal" name="txtFechaFinal" value="<?php echo set_value('txtFechaFinal'); ?>" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                       
                </div>          
              </div>
              <div class="col-md-3">
                        <div class="form-group">
                            <label for="nomeCliente" class="control-label">Tipo Pedido:</label><br>               
                    
                                <select class="form-control" name="cboTipoPedidos" id="cboTipoPedidos">
                                  
                                     <option value="" >-- TODO --</option>   
                                                              
                                        <?php foreach ($pedidostipo as $t) {
                                           $nombre = mb_strtoupper($t->nombre, 'UTF-8');                                   
                                          if(isset($_POST['cboTipoPedidos']) and $_POST['cboTipoPedidos']==$t->id){
                                            $selected='selected';
                                          }else{
                                            $selected='';
                                          }                                        

                                          echo '<option value="'.$t->id.'"'.$selected.'>'.$nombre.'</option>';
                                        } 
                                        ?>
                                </select> 

                        </div>
              </div>
        
              <div class="col-md-3">        
                <div class="form-group">
                  <label for="nomeCliente" class="control-label"></label><br>
                  <input id="btn_search" name="btn_search" type="submit" class="btn btn-danger" value="Buscar" />
                  <a href="<?php echo base_url(). "reportes/listado"; ?>" class="btn btn-primary">Mostrar Todo</a>         
                </div>              
              </div>

            </div>
            <div class="row">
              <div class="col-md-9">
                  <div id="resultado"></div>
              </div>
              <div class="col-md-3">        
                <div class="form-group">              
                  <button id="btn_export" name="btn_export" type="button" class="btn btn-default">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                  <button id="btn_export_excel" name="btn_export_excel" type="button" class="btn btn-default">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>               
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
                                    <th>Cliente</th>                                
                                    <th>TipoPedido</th>
                                    <th>Documento</th>
                                     <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pedidos as $r) {   
                                  
                                  if($r->estado==1){
                                    $estado="<span class='label label-success'>PROCESADO</span>";
                                  }else{
                                    $estado="<span class='label label-warning'>ANULADO</span>";
                                  }

                                    $oDate = strtotime($r->fech_reg);
                                    $sDate = date("d/m/Y",$oDate);

                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->codigo." - ".$r->cliente.'</td>';
                                    echo '<td>'.$r->tipopedido.'</td>';
                                    echo '<td>['.$r->serie_comprobante." - ".$r->num_pedido.']</td>';
                                     echo '<td>'.$sDate.'</td>';
                                    echo '<td>'.$r->total.'</td>';
                                    echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                         
                                   
                                   if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                      echo '<a href="'.base_url().'pedidos/visualizar/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver detalle" data-id="'.$r->id.'"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                      //echo '<a href="'.base_url().'pedidos/ImprimeVenta/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                      echo '<a style="margin-right: 1%" class="btn btn-primary btn-xs btn-imprimir" title="Imprimir" data-id="'.$r->id.'"><i class="glyphicon glyphicon-print"></i></a>'; 
                                      //echo '<a href="'.base_url().'pedidos/ImprimeVenta/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    
                                    }

                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                         /*echo'<button id="btn_export_id" name="btn_export_id" type="button" class="btn btn-danger btn-xs" data-id="'.$r->id.'" data-tipo="'.$r->id.'">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';*/

                  echo'<a class="btn btn-small btn-danger btn-xs btn_export_id" data-id="'.$r->id.'" data-tipo="'.$r->id.'" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';

                                      /*echo '<a href="'.base_url().'pedidos/exportarFpdf/'.$r->id.'" style="margin-right: 1%" class="btn btn-danger btn-xs" title="Ver detalle" data-id="'.$r->id.'"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>'; 
                                      */
                                      //echo '<a href="'.base_url().'pedidos/ImprimeVenta/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }
                                   
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




