<?php
class Basket extends CI_Controller {
	
 public function __construct() {
        parent::__construct();
    }

  //last step to confir order
  public function confirmar(){
  	
  		try{ 
  			
  			//load order
  			$this->load->library('Mercadopago');		
  			
  			///Here some data ex: validateion, addOrder to database, mailsend... 			
  			//items basket
  			$products_mp = array();
			foreach($items_carrito as $it){
				
				$products_mp[] = array(
										"id" => $it->producto_id,	
										"title" =>(trim($it->nombre)),
										"quantity" => (int) $it->cantidad,
										"currency_id" => "ARS",
										"unit_price" => round($it->precio,1) 
									);
					
				
			}	
				
				
			//options to SDK mercadopago....
			$preference_data = array(
						"payer_email" => "payer@email.com",
						"external_reference" => "Bla bla",
						"back_urls"=> array (
											"success"=> "http://example.com/",
											"failure"=> "http://example.com/"
									),						
						"items" => $products_mp,
						"auto_return"=>"approved",
						
									
					);
							
			 $preference = $this->mercadopago->create_preference($preference_data);
					
			 
			 if(isset($preference->init_point)){
				 //link pay gateway MP
				 $datos['MP_link_pay'] = $preference->init_point;
			 }else{
				throw new Exception("Some errors in MercadoPago's gateway");	 	
			 }
  		
			

			 $this->load->view('public/site/checkout', $datos);
			
			
		}catch (Exception $e) {
			//atendemos la excepcion....			
		}
  	}	
		
		
  }
  