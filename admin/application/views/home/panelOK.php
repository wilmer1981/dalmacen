   <?php 
$creditos  =$estadistica_ventas->total_credito; 
$contados   =$estadistica_ventas->total_contado; 
$totales    =$estadistica_ventas->total_ventas; 

/*
if($pendiente!=0){
  $ppendiente = number_format(((100*$pendiente)/ $totales),0);  
}else{
  $ppendiente =0;
}

if($atendida!=0){
  $patendida = number_format(((100*$atendida)/ $totales),0);  
}else{
  $patendida =0;
}

if($totales!=0){
  $ptotal = number_format(100,0); 
}else{
  $ptotal = 0;
}*/

$totalesorden    =$estadistica_pedidos->total_orden;



   
?>

   <script type="text/javascript">
            // Estas variables pasaran al JS para mostrar en Chart
            var credito = "<?php echo $creditos; ?>";
            var contado = "<?php echo $contados; ?>";
    </script>


   <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $estadistica_ventas->total_ventas; ?></h3>

              <p>Total Ventas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $estadistica_ventas->total_contado; ?></h3>

              <p>Ventas Contado</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $estadistica_ventas->total_credito; ?></h3>

              <p>Ventas Credito</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $totalesorden; ?></h3>

              <p>Total Orden de Compra</p>
            </div>
            <div class="icon">
              <i class="fa fa-compass" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
        
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Ultimos</a></li>
              <!--
			  <li><a href="#sales-chart" data-toggle="tab">Credito</a></li>
			  -->
              <li class="pull-left header"><i class="fa fa-inbox"></i> Importaciones</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; ">
                 <table id="" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descripcion</th>                            
                                    <th>Tipo Archivo</th>
                                    <th>Total</th>
                                    <th>Estado</th>                          
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vcontados as $r) {   

                                 if($r->estado==1){
                                    $estado="<span class='label label-success'>PROCESADO</span>";
                                  }else{
                                    $estado="<span class='label label-warning'>ANULADO</span>";
                                  }

                                           
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->codigo." - ".$r->cliente.'</td>';
                                    //echo '<td>'.$r->tipopedido.'</td>';
                                    echo '<td>['.$r->seriefact." - ".$r->numfact.']['.$r->comprobante.']</td>';                         
                                    echo '<td>$ '.number_format($r->total,2).'</td>';
                                    echo '<td>'.$estado.'</td>';                                                     
                             
                                   echo '</tr>';
                                }
                                ?>
                           
                            </tbody>
                  </table> 

              </div>
          
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

   
          <!-- TO DO List -->
          <!--
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">To Do List</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
         
            <div class="box-body">
              <ul class="todo-list">
                <li>
                 
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
              
                  <input type="checkbox" value="">
               
                  <span class="text">Design a nice theme</span>
                 
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Make the theme responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Check your messages and notifications</span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
            
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>
          </div>
          -->
       

      

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
				
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">        
              <div class="pull-right box-tools">         
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>   
              <i class="fa fa-bar-chart-o" aria-hidden="true"></i>

              <h3 class="box-title">
                Descargas del año
              </h3>
            </div>
            <div class="box-body">
              <div id="ventas-chart" style="height: 250px; width: 100%;"></div>
            </div>          
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label"><i class="fa fa-circle-o text-green"></i> <b>Contado: <?php echo $estadistica_ventas->total_contado; ?></b></div>
                </div>
            
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label"><i class="fa fa-circle-o text-yellow"></i> <b>Credito: <?php echo $estadistica_ventas->total_credito; ?></b></div>
                </div>               
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label"><i class="fa fa-circle-o text-light-blue"></i> <b>Totales: <?php echo $estadistica_ventas->total_ventas; ?></b></div>
                </div>               
              </div>     
            </div>
          </div>

        </section>
      
      </div>
      <!-- /.row (main row) -->

