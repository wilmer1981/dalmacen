<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Inventarios</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
  
	<div class="botones">   
  <!--
   <button type="button" class="btn btn-success open-form" data-toggle="modal" data-target="#modal-register" >
    <i class="glyphicon glyphicon-plus icon-white"></i> Inventario inicial</button>  
    -->
<!--
        <a href="<?php echo base_url('inventarios/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Registrar Nuevo Inventario</a> 
        -->
        <a href="<?php echo base_url('inventarios/registerInventario')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Abrir Nuevo Inventario</a> 
    </div>
 
  
    <div class="box-body">       
               
                  <div id="VerListado" class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Saldo Inicial</th>
                                    <th>Entradas</th>
                                    <th>Salidas</th>  
                                    <th>Saldo</th>  
                                    <th></th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($saldos as $r) {                                  
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
                                    echo '<td>'.$r->producto.'</td>';
                                    echo '<td>'.$r->categoria.'</td>';
                                    echo '<td>'.$r->saldo_inicial.'</td>';
                                    echo '<td>'.$r->entrada.'</td>';
                                     echo '<td>'.$r->salida.'</td>';
                                    echo '<td>'.$r->stock.'</td>';
                                    echo '<td>';
                                   
                                  if($this->permission->checkPermission($this->session->userdata('permiso'),'vProducto')){
                                        echo '<a href="'.base_url().'clientes/visualizar/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }                             
                                        
                                echo '</td>';
                                   echo '</tr>';
                                }
                                ?>
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

<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Registrar Inventario Inical</span>
  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </button>
        </div>                   
            <form id="formUnidad" name="formUnidad" method="post">                 
            <div class="modal-body">            
              <div class="row">
                <div class="col-lg-12 left">
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group has-success">
                            <label for="inputMarca">Producto:</label> 
                             <input type="hidden" name="txtIdProd" id="txtIdProd" class="form-control input-sm" readonly />    
                             <input type="hidden" name="txtCodigoProd" id="txtCodigoProd" class="form-control input-sm" readonly />                               
                            <input type="text" name="BuscarProductoInv" id="BuscarProductoInv" class="form-control input-sm" autocomplete="off" placeholder="Ingrese codigo de producto y presione ENTER"  />
                        </div>
                    </div>
                    </div>

                     <div class="row">
                    <div class="col-xs-6">

                      <div class="form-group has-success">
                        <label for="inputMarca">Unidad</label>
                        <input id="txtUnidad" type="text" name="txtUnidad" class="form-control" readonly>
                      </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group has-success">
                        <label for="inputMarca">Marca:</label>
                        <input id="txtMarca" type="text" name="txtMarca" required="" class="form-control" readonly>
                      </div>
                      </div>
                    </div>


                     <div class="row">
                      <div class="col-xs-6">

                        <div class="form-group has-success">
                          <label for="inputMarca">Fecha Reg</label>
                           <div class="form-group">
                                            <div class='input-group date' id='datetimepicker'>
                                                <input type='text' class="form-control" id="txtFechaReg" name="txtFechaReg" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                        </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group has-success">
                          <label for="inputMarca">Cantidad:</label>
                          <input id="txtCantidad" type="text" maxlength="20" name="txtCantidad" required="" class="form-control" placeholder="Ingrese Cantidad" autofocus="">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group has-success">
                          <label for="inputMarca">Costo Unitario</label>
                          <input id="txtPrecio" type="text" maxlength="20" name="txtPrecio" required="" class="form-control" placeholder="0.00"  readonly="">
                        </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group has-success">
                          <label for="inputMarca">Costo Total:</label>
                          <input id="txtPrecioTotal" type="text" maxlength="20" name="txtPrecioTotal" required="" class="form-control" placeholder="0.00" readonly="">
                        </div>
                        </div>
                    </div>


                  </div>

                </div>
              </div> 


              <div class="modal-footer"> 
                <?php if (isset($custom_error) != '') {
                  echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>            
              <div id="status"></div>
                <input name="opcion" id="opcion" type="hidden" value="register">
                <button id="btn-cancelar" type="button" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-remove"></i> Cancelar</button> 
                <button id="btn-registerUnd" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>
                                                        
                </div>
                    </form>                 
                </div>              
      </div>
  </div>




