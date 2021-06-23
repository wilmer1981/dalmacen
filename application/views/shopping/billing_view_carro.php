<?php defined('BASEPATH') OR exit('No direct script access allowed');

$grand_total = 0;
// Calculate grand total.
if ($cart = $this->cart->contents()):
    foreach ($cart as $item):
        $grand_total = $grand_total + $item['subtotal'];
    endforeach;
endif;
?>


<script type="text/javascript">
        // To conform clear all data in cart.
    function clear_cart() {
        var result = confirm('Are you sure want to clear all bookings?');
        if (result) {
            window.location = "<?php echo base_url(); ?>shopping/remove/all";
        } else {
            return false; // cancel button
        }
    }
</script>

<div class="container espacio-top">
	<div class="row">
		<div class="col-sm-9">

    <div data-wizard-init>
    <ul class="steps">
      <li data-step="1">Datos de Envio</li>
      <li data-step="2">Tipo de Envio</li>
      <li data-step="3">Informacion de Pago</li>
      <!--
      <li data-step="4">Finalizar</li>-->
    </ul>
    <?php 
    //if ($custom_error != '') {
      //  echo '<div class="alert alert-danger">' . $custom_error . '</div>';
    //}
     ?>
  
    <form role="form" id="formCompra" name="formCompra" method="post" class="form-horizontal" >
       <input type="hidden" name="userid" id="userid" class="form-control" value="<?php echo $this->session->userdata('userid'); ?>" >
                              
  
      <div class="steps-content">
       <!--Seccion 1 -->
      <div data-step="1">
      <div class="row" style="margin-top:0">
        <div class="col-md-12">
          <div class="widget-box">              
              <div class="widget-content nopadding">
                <div class="form-action"> 
                  <div class="row ">                        
                      <div class="col-md-12">                                           
                          <div class="form-group">
                              <label for="sd_lastname" class="col-md-2 control-label">Nombres:</label>
                              <div class="col-md-3">
                                  <input type="text" name="sd_lastname" id="sd_lastname" class="form-control" placeholder="Last Name" value="<?php echo $this->session->userdata('userid').'-'.$this->session->userdata('username'); ?>" tabindex="1" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="sd_firstname" class="col-md-2 control-label">Direccion de envio:</label>
                              <div class="col-md-5">
                                  <input type="text" name="sd_firstname" id="sd_firstname" class="form-control" placeholder="Direccion" value="<?php echo $this->session->userdata('direccion')?>" tabindex="2" readonly>
                              </div>
                          </div>
                                <div class="form-group">
                                  <label for="sel1" class="col-md-2 control-label">Departamento:</label>
                                  <div class="col-md-3">
                                  <select class="form-control" id="sel1">
                                    <option>Lima</option>
                                    <option>Huanuco</option>
                                    <option>La libertad</option>
                                    <option>Cuzco</option>
                                  </select>
                                   </div>
                                </div>
                                <div class="form-group">
                                  <label for="sel1" class="col-md-2 control-label">Provincia:</label>
                                  <div class="col-md-3">
                                  <select class="form-control" id="sel1">
                                    <option>Lima</option>
                                    <option>Huanuco</option>
                                    <option>La libertad</option>
                                    <option>Cuzco</option>
                                  </select>
                                   </div>
                                </div>
                                      <div class="form-group">
                                  <label for="sel1" class="col-md-2 control-label">Distrito:</label>
                                  <div class="col-md-3">
                                  <select class="form-control" id="sel1">
                                    <option>Lima</option>
                                    <option>Huanuco</option>
                                    <option>La libertad</option>
                                    <option>Cuzco</option>
                                  </select>
                                   </div>
                                </div>
                                <div class="form-group">
                                    <label for="sd_firstname" class="col-md-2 control-label">Telefono</label>
                                    <div class="col-md-3">
                                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" value="<?php echo $this->session->userdata('telefono')?>" tabindex="2" readonly>
                                    </div>
                                </div>
                      </div>
                  </div>
                </div>
      
              <?php 
                //echo $this->pagination->create_links();
              ?>
              <div class="row" id="contenedor">     
                <ul class="col-md-6" id="subcontenedor">      
          
                  </ul>
                  
              </div>
              <?php 
                //echo $this->pagination->create_links();
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>  
  
    <!-- fin seccion 1 -->
      
    <!-- Seccion 2: productos-->
      <div data-step="2">     
          <div class="row">
            <div class="col-md-12">
              <div class="widget-box">    
                <div class="widget-content nopadding">   
                  
                <div class="row ">  
                  <div class="col-md-12 form-cinicial">  
                   <section data-step="0">
                          <div class="form-group">
                               <div class="radio">
                              <label><input type="radio" name="optenvio" id="optenvio" value="ES">Envío estándar (3 días laborables) (S/. 5)</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="optenvio" id="optenvio" value="UPS">UPS (2 días laborables) (S/ 10)</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="optenvio" id="optenvio" value="EU">Envío urgente (1 días laborables) (S/ 20)</label>
                            </div>
                        </div>
                    </section>                 
                
                        
                    </div>                   
                  
                  </div>  
            
                  </div>
              </div>
          </div>
        </div>
      </div>

          <!-- Seccion 3: Confirmacion-->
    <div data-step="3">   
      <div class="row">
        <div class="col-md-12">          
            <section data-step="0">
              <div class="form-group">
        <div class="radio">
                  <label class="opciones"><input type="radio" name="optpago" id="optpago" value="E">Efectivo (Contra entrega)</label>
                </div>
                <div class="row form-E" style="display:none">
                           <div class="col-md-12">
                                      <div class="form-group">
                                          <label class="message"><br>
                                            Recuerda encontrarte en tu domicilio al momento de la entrega o dejar a alguien encargado de recibir y pagar tu orden. En caso no te encuentres en tu domicilio al momento de la entrega, vamos a contactarte para reprogramar la entrega. Es importante que nos dejes un número celular y número fijo en tus Datos Personales, para poder contactarte.
                                      </label>
                                      </div>
                                          
                             </div>
                       
                </div>
                <div class="radio">
                  <label class="opciones"><input type="radio" name="optpago" id="optpago" value="D">Deposito BANCARIO</label>
                </div>
                    <div class="row form-D"  style="display:none">
                      <label class="message">
                        <br>
                       Lo puede pagar en cualquier AGENCIA o AGENTES (mediante deposito en efectivo) o via INTERNET o CAJERO(mediante transferencia bancaria) de los siguientes bancos:<br>
                      </label>                  
                          <div class="col-md-4">                                
                            <img src="<?php echo base_url('assets/images/logobcp.jpg') ?>">
                            <div class="form-group">
                                          <label class="message">
                                     
                                            Cta. Ahorro (S/.):<br>
                                            191-31535308-0-45
                                            <hr>                                   
                                            Código de Cuenta Interbancario<br>
                                            002-191-131535308045-51
                                            <hr>
                                            <!--
                                                 Titular: Sr. Wilmer Saldaña-->
   
                                      </label>
                            </div>

                          </div> 
                              <div class="col-md-4"> 
                                <img src="<?php echo base_url('assets/images/logoscotiabank.jpg') ?>">         
                                <div class="form-group">
                                <label class="message">
                                     
                                            Cta. Ahorro (S/.):<br>
                                            131-0262249
                                           <hr>
                                   
                                            Código de Cuenta Interbancario<br>
                                            009-044-201310262249-96
                                            
                                             <hr>
                                             <!--
                                                 Titular: Sr. Wilmer Saldaña
                                            -->
                                      </label>
                                      </div>
                                          
                             </div>
                            <div class="col-md-4"> 
                                <img src="<?php echo base_url('assets/images/logointerbank.jpg') ?>">         
                                <div class="form-group">
                                           <label class="message">
                                     
                                            Cta. Ahorro (S/.):<br>
                                            200-3077472482
                                            <hr>
                                   
                                            Código de Cuenta Interbancario<br>
                                             003-200-013077472482-32
                                             
                                             <hr>
                                             <!--
                                                 Titular: Sr. Wilmer Saldaña
                                               -->
   
                                      </label>
                                      </div>
                                          
                             </div>
                             <label class="message">
                                   
                                         
                                          Luego nos envia el voucher de pago al correo de <span class="email">servicioalcliente@influxlife.com</span><br>
                                          Recuerda que tienes 24 horas para pagar tu pedido o será cancelado automáticamente.
                                      
                             </label>
                       
                </div>
                <div class="radio">
                  <label class="opciones"><input type="radio" name="optpago" id="optpago" value="P" disabled>Paypal</label>
                </div>
                <div class="row form-P"  style="display:none">
                           <div class="col-md-12">
                                      <div class="form-group">
                                          <label class="message">RECUERDA LOS SIGUIENTES PASOS:<br>
                                            Se te redireccionará a la página de SAFETYPAY
                                            Selecciona el banco con el que deseas realizar el pago. Recuerda que puedes elegir entre BCP, BBVA, Scotiabank, Interbank o Caja Tacna.
                                            Recuerda anotar el número órden y el monto total a cancelar.
                                            Entra a la banca por Internet de tu banco, busca la opción de Pago de Servicios o Recibos y seleccionar SafetyPay. Introduce el código que te asignamos al momento de realizar tu compra y el monto de la transacción.
                                            En caso de haber pasado 2 horas y NO haber completado el pago, tu pedido será cancelado automáticamente.
                                            Cualquier duda puedes llamarnos al 01 315 9250
                                      </label>
                                      </div>
                                          
                             </div>
                       
                </div>
              </div>
            </section>     
        </div>
      </div>
    </div>
    <!-- fin seccion 3 -->         
    </div>
    </form>  
    
  </div>
					
</div>
			
		<div class="col-sm-3">	
			<div class="panel panel-primary">
		
				 <div class="panel-heading heading-text" >
				 <h4>RESUMEN DE TU PEDIDO</h4></div>
				 
				<div class="errorresponse"></div>	
			
				<div class="panel-body panel-body-color">
					<div id="text"> 
					<?php  //$cart_check = $this->cart->contents();            
					// If cart is empty, this will show below message.
					 if(empty($cart_check)) {
					     echo ''; 
					 }  
					 ?>
					 </div>
        				  <?php 
        				  if ($cart = $this->cart->contents()): ?>
                		<form name="formBilling" id="formBilling" method="post" class="form-horizontal">
                		<!--
                    <form name="billing" method="post" action="<?php //echo base_url('shopping/save_order')?>" class="form-horizontal">
                    -->			   
                				  <div align="center">
                              <table class="table">						
                    						<thead>
                    						<tr>
                    							<th>RESUMEN PEDIDO</th>
                    							<th></th>
                    						</tr>
                    						</thead>
                                            <tr>
                    						<td>SubTotal(<?php echo $this->cart->total_items();?> articulos)</td>
                    						<td><strong>S/.<?php echo number_format($this->cart->total(),2);//echo number_format($grand_total, 2); ?></strong></td>
                    						</tr>
                                <tr><td>Costo Envio</td><td>S/.<?php echo number_format(0, 2); ?></td></tr>
                                <tr><td>TOTAL</td><td><strong>S/.<?php 
                    						echo number_format($this->cart->total(),2);
                    						//echo number_format($grand_total, 2); ?></strong></td></tr>

                    						<tr>
                    						<td colspan="2">
                    						<button type="button" id="btn-comprar"class ='btn btn-success'><i class="glyphicon glyphicon-floppy-save icon-white"></i> FINALIZAR PEDIDO</button></td>
                    						</tr>                                                
                              </table>
                          </div>
                    </form>	
        			<?php endif; ?>
                <div class="resultado"></div>	
				</div>
			</div>
	
		</div>


	</div>
</div>