<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Detalles Cliente</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	 <div class="botones">       
        <a href="<?php echo base_url('clientes/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Agregar Cliente</a> 
    </div>
  
    <div class="box-body">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Datos del Cliente</a></li>
        <li><a data-toggle="tab" href="#menu1">Historial de Pedidos</a></li>
        <!--
        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
        -->
        <div class="buttons">
              <a title="Editar Cliente" class="btn btn-primary btn-xs" href="<?php echo base_url('clientes/editar')?>"><i class="glyphicon glyphicon-pencil icon-white"></i> Editar</a>                    
        </div>
      </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
                       
             <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                      Informacion Cliente</a>
                    </h4>
                  </div>
                  <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                                    <table class="table table-bordered">
                                      <tbody>
                                            <tr>
                                              <td style="text-align: right; width: 30%"><strong>Razon Social</strong></td>
                                              <td><?php echo $cliente->cliente_nombre; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Tipo Documento</strong></td>
                                                <td><?php echo $cliente->id_tipodoc; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>DNI/NIE/NIF</strong></td>
                                                <td><?php echo $cliente->num_documento; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Fecha de Registro</strong></td>
                                                <td><?php echo date('d/m/Y',  strtotime($cliente->fech_reg)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                    </div>
                  </div>
                </div>
                <?php
                if($cliente->id_tipocliente=='2'){
                ?>
                  <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                      Informacion Contacto</a>
                    </h4>
                  </div>
                  <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                          <table class="table table-bordered">
                              <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Nombre</strong></td>
                                        <td><?php echo $cliente->cont_nombre.' '.$cliente->cont_apellido; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Telefono</strong></td>
                                        <td><?php echo $cliente->cont_telefono; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Celular</strong></td>
                                        <td><?php echo $cliente->cont_celular; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>E-mail</strong></td>
                                        <td><?php echo $cliente->cont_email; ?></td>
                                    </tr>
                              </tbody>
                          </table>
                    </div>
                  </div>
                </div>
                <?php
                }
                ?>

                <!--
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                      Collapsible Group 3</a>
                    </h4>
                  </div>
                  <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.</div>
                  </div>
                </div>
                -->
          </div>  
      </div>
      <div id="menu1" class="tab-pane fade">
        <h3>Menu 1</h3>
        <p>Some content in menu 1.</p>
      </div>
      <div id="menu2" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Some content in menu 2.</p>
      </div>
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




