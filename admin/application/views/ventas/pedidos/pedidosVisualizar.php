<div class="page-content">
	<div class="page-header">
		<h1>Lista de
			<small><i class="ace-icon fa fa-angle-double-right"></i> Pedidos</small>
		</h1>	
		<div class="botones pull-right">
		<!--
		<button type="button" data-toggle="tooltip" title="" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg" data-original-title="Filter"><i class="fa fa-filter"></i></button>
		<a href="<?php echo base_url('productos/adicionar');?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
		<button type="submit" form="form-products" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/copy&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Copy"><i class="fa fa-copy"></i></button>
		-->
		<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>	
	</div> 
	<div class="espacio-fila"></div>  
    <div class="row">
		<div class="col-md-8">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Datos del Cliente</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<form>
							<!-- <legend>Form</legend> -->
							<fieldset>
						<div class="row">             
						  <div class="col-md-12">
							 <table class="table table-bordered">                    
							  <tbody>
								 <tr>
								  <th scope="row" class="active"># Pedido</th>
								  <td><?php echo $NumOrder; ?>
									
								  </td>
								  <th scope="row" class="active">FORMA PAGO</th>
								  <td><?php echo $DocOrder[0]->id; ?></td>                              
								</tr>
								<tr>
								  <th scope="row" class="active">CLIENTE</th>
								  <td><?php echo $DocOrder[0]->cliente; ?></td>
								  <th scope="row" class="active">TIPO PRECIO</th>
								  <td><?php //echo $DocOrder[0]->tipoprecio; ?></td>
								</tr>
								<tr>
								  <th scope="row" class="active">RUC</th>
								  <td><?php //echo $DocOrder[0]->num_documento; ?></td>
								  <th scope="row" class="active">FECHA VENTA</th>
								  <td><?php echo $DocOrder[0]->fech_reg; ?></td>
								</tr>
								<tr>
								  <th scope="row" class="active">DIRECCION</th>
								  <td><?php //echo $DocOrder[0]->direccion; ?></td>
								   <th scope="row" class="active"># ORDEN</th>
								  <td>
								  <?php
								  //if($DocOrder[0]->id_tipocomprobante==9) //si es orden de compra
									 // echo $DocOrder[0]->serie_comprobante.' - '.$DocOrder[0]->num_pedido; 
								 // else
								   //   echo '-----';

								  ?>
									
								  </td>
								</tr>
							  </tbody>
							</table>          
						  </div>                       

					  </div>						
							</fieldset>
							<!--
							<div class="form-actions center">
								<button type="button" class="btn btn-sm btn-success">
									Submit
									<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
								</button>
							</div>
							-->
						</form>
					</div>
				</div>
			</div>
			
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Lista de Productos</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<form>
							<!-- <legend>Form</legend> -->
							<fieldset>
						           <div class="row">
              <div class="col-md-12">
                <table class="table">
                 <thead class="active">                   
                    <th>DESCRIPCION</th> 
					<th>CANT.</th>  					
                    <th>P.UNIT.</th>                                       
                    <th>IMPORTE</th>                
                  </thead>                                
                  <tbody>
                      <?php 
                      $suma    = 0;
					  $subtotal= 0;
					  $total   = 0;
                      foreach ($ListOrder as $r) {   
                         /* 
							$precio_dscto = $r->precio_venta * $r->descuento;
                          $importe      = $r->cantidad * $precio_dscto;
						  */
					
                        $importe     = $r->cantidad * $r->precio_unit;
						$suma        = $suma + $importe;
                          
                        echo '<tr>';                     
                        echo '<td>'.$r->producto.'</td>';                               
                        echo '<td>'.$r->cantidad.'</td>';   
                       echo '<td>'.number_format($r->precio_unit,2).'</td>';             
                        echo '<td align="right">'.number_format($importe,2).'</td>';                       
                        echo '</tr>';
                      }
					  $igv = $suma*0.18;
					  
					  $subtotal = $DocOrder[0]->total - $igv;
					  
					  $total = $subtotal + $igv;
                       ?>          
                  </tbody>                             
                  <tfoot>            
                  </tfoot>                              
                </table>
              </div>
        </div>
							
							</fieldset>
							<!--
							<div class="form-actions center">
								<button type="button" class="btn btn-sm btn-success">
									Submit
									<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
								</button>
							</div>
							-->
						</form>
					</div>
				</div>
			</div>
			
		</div>									
 
		<div class="col-md-4">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Totales</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<form>
							<!-- <legend>Form</legend> -->
							<fieldset>
							 <div class="row">             
						  <div class="col-md-12">
						   <table class="table table-bordered">             
                            <tbody>
                               <tr>                               
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">SUB-TOTAL S/ </label></td>
                                <td colspan="1" align="right"><label id="lblsubtotal" name="lblsubtotal"><?php echo number_format(($subtotal),2); ?></label>
                                <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0"/></td>
                              </tr>
                              <tr>                             
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">I.G.V(18%) S/ </label></td>
                                <td colspan="1" align="right"><label id="lbliva" name="lbliva"><?php echo number_format($igv,2); ?></label>
                                <input type="hidden" name="txtIva" id="txtIva" value="0"/></td>
                              </tr>
                              <tr>                               
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">TOTAL S/ </label></td>
                                <td colspan="1" align="right"><label id="lbltotal" name="lbltotal"> <?php echo number_format($DocOrder[0]->total,2); ?></label><input type="hidden" name="txtTotal" id="txtTotal" value="0"/></td>
                              </tr>
                            </tbody>                              
                          </table>         
						  </div>                       

					  </div> 
							
							</fieldset>
							<!--
							<div class="form-actions center">
								<button type="button" class="btn btn-sm btn-success">
									Submit
									<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
								</button>
							</div>
							-->
						</form>
					</div>
				</div>
			</div>  

       
        </div>

      </div>           
    </div>      
  </div>
 
</div>
</div>



