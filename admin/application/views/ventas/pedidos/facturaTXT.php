<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//enviamos cabezales http para no tener problemas
//header("Content-Type: text/html; charset=iso-8859-1 ");
/*
header("Content-Type: application/force-download");                                        
header("Content-Transfer-Encoding", "binary");
header('Cache-Control: maxage=3600'); 
header('Pragma: public');
*/
                       
 

   //eliminar archivo existente
   //unlink('reportes/facturaTxt.txt');
   unlink('facturaTxt.txt');
   
   //creamos nuevo archivo
  // $archivo = 'reportes/facturaTxt.txt';
   $archivo = 'facturaTxt.txt';

   //$fp=fopen($archivo,"x");
   $fp=fopen($archivo,"a+");   

   	//echo chr(13).chr(10);

    $cliente   = mb_strtoupper($pedido[0]->cliente, 'UTF-8');
    $direccion = mb_strtoupper($pedido[0]->direccion, 'UTF-8');
    $empleados = explode(" ", $pedido[0]->empleado);
    $vendedor  = mb_strtoupper($empleados[0], 'UTF-8');
    $ruc       = $pedido[0]->num_documento;
    $codigo    = $pedido[0]->tipoprecio;
    $fecha     = date('d/m/Y',  strtotime($pedido[0]->fech_reg));

    if($pedido[0]->tipo_pago=='CRE') {$formapago="CREDITO";  }else{ $formapago="CONTADO"; }

    $cabecera = "".chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
   	$cabecera .= "\t\t". $cliente ."\t\t\t\t\t\t\t\t\t". $formapago .chr(13).chr(10);
   	$cabecera .= "\t\t". $direccion ."\t\t\t\t\t\t\t\t". $vendedor .chr(13).chr(10);
   	$cabecera .= "\t\t". $ruc ."\t\t\t\t\t\t\t\t\t". '123456' .chr(13).chr(10);
   	//$cabecera .= "\t\t". $ruc ."\t\t\t\t\t". '123456' .'\n';
   	//fwrite($variable, $campo1 . PHP_EOL); 
   	$cabecera .= "\t\t". $codigo ."\t\t\t\t\t\t\t\t\t\t". $fecha .chr(13).chr(10);
   	$cabecera .= "".chr(13).chr(10).chr(13).chr(10);

    fwrite($fp,$cabecera);

    $SUBTOTAL=0;

    //$rows = $pedidoitems->num_rows;
	$filas=0;
	foreach ($pedidoitems as $r){		
		//$linea = ''.$r->categoria.'|'.$r->servicio.'|'.$r->especialidad.'|'.$r->total.'|'.$r->fech_reg."\n\r";
		//fputs($fp,$linea);	
		//fputs($fp,chr(13).chr(10)); // Genera salto de linea  
		//date('d/m/Y');

		//$fecha   = date('d/m/Y',strtotime($r->fech_reg));//
		//$emision = date('d/m/Y',strtotime($r->emision));//
		

		$product      = utf8_decode($r->descripcion); 
		$precio_dscto = number_format($r->precio_venta * $r->descuento,2);
    $importe      = number_format($r->cantidad * $precio_dscto,2);

    $SUBTOTAL     = $SUBTOTAL+ $importe; 

		/*if($tipod==2){// si es factura
			$ruc=$r->num_documento;
		}else{
			$ruc='00000000';
		}		*/
		
		//$linea = $r->cantidad ."|". $r->unidad ."|". $r->cod_producto ."|". $product ."|". $precio_dscto. "|". $importe.chr(13).chr(10);

		$linea = $r->cantidad ."\t". $r->unidad ."\t". $r->cod_producto ."\t". $product ."\t". $precio_dscto. "\t". $importe.chr(13).chr(10);
	
		fwrite($fp,$linea);
		$filas++;
		                 
							
    } //fin foreach  

    $total_texto = num_to_letras($pedido[0]->total,'DOLARES AMERICANO','');
    $SUBTOTALS   = $SUBTOTAL - $pedido[0]->impuesto_total;
    $total       = number_format($pedido[0]->total,2);
    $impuesto    = number_format($pedido[0]->impuesto_total,2);
    $SUBTOTALSS  = number_format($pedido[0]->total-$pedido[0]->impuesto_total,2);

    if($filas==1){
    	$piepagina = "".chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
    }

    if($filas==2){
    	$piepagina = "".chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
    }
    if($filas==3){
    	$piepagina = "".chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
    }
    
   	$piepagina .= "\t\t". $filas.'-'.$total_texto .chr(13).chr(10).chr(13).chr(10);

    $piepagina .= "\t\t\t\t\t\t\t\t\t\t\t\t\t". $SUBTOTALSS .chr(13).chr(10);
    $piepagina .= "\t\t\t\t\t\t\t\t\t\t\t\t\t". $impuesto .chr(13).chr(10);
    $piepagina .= "\t\t\t\t\t\t\t\t\t\t\t\t\t". $total .chr(13).chr(10);
   //	$piepagina .= "".chr(13).chr(10).chr(13).chr(10);
   	fwrite($fp,$piepagina);

   fclose($fp) ;

$size = filesize($archivo);

/*header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
header('Cache-Control: private', false); 
//header('content-type: '.$tipo.'');
header("Content-Type: application/force-download");
header('content-disposition: attachment; filename="'.basename($archivo).'"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.$size);
*/

header("Content-Transfer-Encoding", "binary");
header('Cache-Control: maxage=3600'); 
header('Pragma: public');

readfile($archivo);

/*
    header("Pragma: public"); 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Content-Type: application/force-download"); 
    header("Content-Type: application/octet-stream"); 
    header("Content-Type: application/download"); 
    header("Content-Disposition: attachment; filename=".$archivo.";"); 
    header("Content-Transfer-Encoding: binary"); 
   // header("Content-Length: ".filesize($VAR['FileName'])); 
*/
    



?>