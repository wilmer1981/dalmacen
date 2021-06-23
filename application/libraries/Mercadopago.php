<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once APPPATH."/libraries/dx-php-master/init.php";

require_once APPPATH.'/libraries/vendor/autoload.php';


class Mercadopago
{
    public $config;
    
    public function __construct()
    {
        
        //get singleton instance.
        $CI = &get_instance();
		
        //load config file for credentials
		$CI->config->load("mercadopago", TRUE);
		$config = $CI->config->item('mercadopago');
        
        //setting config
        $mode 							= $config['mode'];
        $this->config['client_id'] 		= $config['ci'];
        $this->config['client_secret'] 	= $config['cs'];
        $this->config['public_key'] 	= $config['public_key_'.$mode];
        $this->config['access_token'] 	= $config['access_token_'.$mode];
        
        
        //set config on MP gateway
        MercadoPago\SDK::setClientId($this->config['client_id']);
		MercadoPago\SDK::setClientSecret($this->config['client_secret']);
      	MercadoPago\SDK::setAccessToken($this->config['access_token']);
		MercadoPago\SDK::setPublicKey($this->config['public_key']);
		       		
    }
    
    public function create_preference($preference_data)
    {
            	
          // Create a preference object
		  $preference = new MercadoPago\Preference();
		  
		  // set products basket
		  foreach($preference_data['items'] as $i){
		 	  # Create an item object
			  $item = new MercadoPago\Item();
			  $item->id = $i['id'];
			  $item->title = ($i['title']);
			  $item->quantity = $i['quantity'];
			  $item->currency_id = $i['currency_id'];
			  $item->unit_price = $i['unit_price'];
			  $array_items[] = $item;
		  }		  
		  
		  // Create a payer object
		  $payer = new MercadoPago\Payer();
		  $payer->email   = $preference_data["payer_email"];
		  $payer->name    = $preference_data["payer_name"];
		  $payer->surname = $preference_data["payer_surname"];
		  $payer->date_created = $preference_data["payer_datecreated"];
		  
		  // Setting preference properties
		  $preference->items = $array_items;
		  $preference->payer = $payer;		  
		 
		  //set same preference extra
		  $preference->external_reference 	= $preference_data['external_reference'];
		  $preference->back_urls   			= $preference_data['back_urls'];
		  $preference->auto_return 			= $preference_data['auto_return'];		  
		  	  
		  // Save and posting preference
		  $result = $preference->save();
		  
		  //we return object Preference with several data included URL to pay
		  return $preference;	  
    }

    
    
}