<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Ventas</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="botones">       
        <a href="<?php echo base_url('pedidos/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Nuevo</a> 
    </div>
  
    <div class="box-body">   
               
                  <div id="VerListado" class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>                                
                                    <th>TipoPedido</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pedidos as $r) {   

                                  if($r->estado==1){
                                    $estado="PENDIENTE";
                                  }else{$estado="PROCESADO"; }

                                           
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->codigo." ".$r->cliente.'</td>';
                                    echo '<td>'.$r->tipopedido.'</td>';
                                    echo '<td>'.$r->total.'</td>';
                                    echo '<td> <span class="label label-warning">'.$estado.'</span></td>';
                                    echo '<td>';

                                    echo '<div class="btn-group">
                                          <a class="btn btn-primary" href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
                                          <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                          </a>
                                          <ul class="dropdown-menu">
                                            <li><a href="'.base_url().'pedidos/editar/'.$r->id.'"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
                                            <li><a href="#"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
                                            <li><a href="'.base_url().'pedidos/visualizar/'.$r->id.'"><i class="fa fa-eye fa-fw" aria-hidden="true"></i>Visualizar</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#"><i class="fa fa-unlock"></i> Make admin</a></li>
                                          </ul>
                                        </div>';
                                   
                                  /*  if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                        echo '<a href="'.base_url().'clientes/visualizar/'.$r->customers_id.'-'.$r->customers_category.'-CC" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'eCliente')){
                                       // echo '<a href="'.base_url().'clientes/editar/'.$r->customers_id.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>'; 
                                        echo '<a href="'.base_url().'clientes/cuenta/'.$r->customers_id.'-'.$r->customers_category.'" style="margin-right: 1%" class="btn  btn-default btn-xs" title="Cambiar Clave"><i class="glyphicon glyphicon-user"></i></a>'; 
                                    }
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'eCliente')){
                                       // echo '<a href="'.base_url().'clientes/editar/'.$r->customers_id.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>'; 
                                        echo '<a href="'.base_url().'clientes/editar/'.$r->customers_id.'-'.$r->customers_category.'" style="margin-right: 1%" class="btn btn-info btn-xs" title="Editar Cliente"><i class="glyphicon glyphicon-pencil icon-white"></i></a>'; 
                                    }

                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'dCliente')){
                                        echo '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="'.$r->customers_id.'-'.$r->customers_category.'" style="margin-right: 1%" class="btn btn-danger btn-xs" title="Eliminar Cliente"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
                                    }     */         
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




