<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once APPPATH."/third_party/fpdf181/fpdf.php";
class PDF extends FPDF{
    var $widths;
    var $aligns;

        function SetWidths($w)
        {   //Set the array of column widths    

         $this->widths=$w;

        }

        function SetAligns($a)
        {   
        //Set the array of column alignments    

            $this->aligns=$a;

        }

        function Row($data)
        {
            //Calculate the height of the row
            $nb=0;
            for($i=0;$i<count($data);$i++)            
                $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
                
            $h=5*$nb;

            $this->CheckPageBreak($h);

            for($i=0;$i<count($data);$i++)
            {

                $w=$this->widths[$i];

                $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            
                $x=$this->GetX();
                $y=$this->GetY();
            
                $this->Rect($x,$y,$w,$h);
                //$this->MultiCell($w,5,$data[$i],0,$a,'true');
                $this->MultiCell($w,5,$data[$i],0,$a,'false');
                $this->SetXY($x+$w,$y);
            }

            $this->Ln($h);

        }

        function CheckPageBreak($h){

            if($this->GetY()+$h>$this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }



        function NbLines($w,$txt)
        {

            $cw=&$this->CurrentFont['cw'];
            if($w==0)
                $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            
            $s=str_replace("\r",'',$txt);
            
            $nb=strlen($s);
            
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb)
            {
                $c=$s[$i];
                if($c=="\n")
                {
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
                }
                if($c==' ')
                    $sep=$i;
                $l+=$cw[$c];
                if($l>$wmax)
                {
                    if($sep==-1)
                    {
                        if($i==$j)
                            $i++;
                    }
                    else
                        $i=$sep+1;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                }
                else
                    $i++;
            }
            return $nl;
        }



        function Cabecera($pedido){
       
            $this->setFont('Arial','',10);
            $this->setFillColor(255,255,255); //color de fondo
           // $this->cell(100,6,"Laporan daftar pegawai libreriaplenitud.com",0,0,'L',1); 
		   
		              
            $this->Ln(12);     

           // $this->SetFillColor(80, 150, 200); //color rectangulo
           // $this->Rect(10, 10, 95, 30, 'D'); //x, y, ancho, altura, estilo: (D, F): color elegido      
            $this->SetXY(15, 15);       
            $this->Image(base_url().'assets/images/logo-ie.png', 15, 8,75);

            //$this->SetXY(10, 24);
           // $this->cell(95,6,LEYENDA_EXTRA,0,1,'C',0);
            $this->SetXY(10, 30);         
            $this->cell(95,6,TELEFONOS,0,1,'C',0); 
            $this->SetXY(10, 34);       
            $this->cell(95,6,DIRECCION,0,1,'C',0);
            $this->SetXY(10, 38);            
            $this->cell(95,6,EMAILWEB,0,1,'C',0);
            //$this->cell(15,6,"ventas@ie-tools.com / www.ie-tools.com",0,1);  
            
            //===============================
            //CUADRO RUC
            //==============================
           //$this->SetFillColor(0, 128, 0);
            $this->Rect(140, 10, 60 , 30, 'D');         
            $this->SetXY(140, 13  );
            $this->SetFont('Arial','B',15);          
            $this->cell(60,6,RUC,0,1,'C',0); 

            $this->SetFillColor(220, 24, 24); //color de fondo:NEGRO
            $this->Rect(140, 20, 60 , 10, 'F');
            $this->SetXY(140, 23 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(240, 255, 240); //Letra color blanco
            $this->Cell(60, 6, 'COTIZACION', 0,1,'C',0);
 
/*
            $this->SetXY(145, 32 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(0, 0, 0); //Letra color blanco       
            $this->Cell(25,6,$pedido[0]->serie_comprobante,0,1); */ 

            $this->SetXY(140, 32 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(0, 0, 0); //Letra color blanco     
            $this->Cell(60,6,"Nro. ".$pedido[0]->num_pedido,0,1,'C',0);  
             //$this->cell(15,6,"Fecha Impresion : " . date('d/m/Y'),0,1,'R',1); 

            //========================================
            //  Segundo bloque - 1 rectángulo       ==
            //========================================
            //CUADRO DATOS DEL CLIENTE
           // $this->SetFillColor(255, 215, 0);
           // $this->Rect(10, 45, 190, 20, 'D');
           // $this->Line(10, 45, 15, 40);
          //  $this->SetXY(15, 50);
            //$this->Cell(15, 6, '10, 35', 0 , 1);

             //INFO CLIENTE
            //$this->SetFillColor(124, 252, 0);
            //$this->Rect(10, 45, 130, 20, 'D');          
           // $this->SetXY(15, 160);
            //$this->Cell(15, 6, 'Texto ', 0 , 1);

            $this->setFont('Arial','B',10);
           // $this->setFillColor(255,255,255);
            //$this->cell(25,6,'dsfgfdgfd',0,0,'C',0); 
            $this->SetXY(12, 45);
            $this->cell(35,6,"Cliente :  ".$pedido[0]->cliente,0,1,'L',0); 

            $this->SetXY(12, 50);
            $this->cell(35,6,"Atencion : ".$pedido[0]->contacto,0,1,'L',0); 
            //$this->cell(35,6,"Fecha : ".date('d/m/Y',  strtotime($compra->fecha)),0,1,'L',1); 
            //$this->cell(100,6,"Fecha : ".date('M Y'),0,1,'L',1); 
            //$this->cell(25,6,'',0,0,'C',0); 
            $this->SetXY(12, 55);
            $this->cell(35,6,'Direccion :'.$pedido[0]->direccion,0,1,'L',0);  
           // $this->Cell(220,15,"ORDEN DE COMPRA",0,0,'C'); 

           if($pedido[0]->tipo_pago=='CRE') {$formapago="CREDITO";  }else{ $formapago="CONTADO"; }      
            $this->SetXY(12, 60);
            $this->cell(35,6,'Forma Pago:'.$formapago,0,1,'L',0);  




            //INFO VENDEDOR
            //$this->SetFillColor(160 ,82, 40);
          // $this->Rect(140, 45, 60, 20, 'D');      

            $this->setFont('Arial','B',10);
            $this->SetXY(140, 45);
            $this->cell(35,6,"RUC :      ".$pedido[0]->num_documento,0,1,'L',0); 

            $this->SetXY(140, 50);
            $this->cell(35,6,"Telefono : ".$pedido[0]->telefono,0,1,'L',0); 
            //$this->cell(35,6,"Fecha : ".date('d/m/Y',  strtotime($compra->fecha)),0,1,'L',1); 
            //$this->cell(100,6,"Fecha : ".date('M Y'),0,1,'L',1); 
            //$this->cell(25,6,'',0,0,'C',0); 
            $this->SetXY(140, 55);
            $this->cell(35,6,"CODIGO :   ".$pedido[0]->tipoprecio,0,1,'L',0);  
           // $this->Cell(220,15,"ORDEN DE COMPRA",0,0,'C');             
            $this->SetXY(140, 60);
            $this->cell(35,6,"Fecha :    ".date('d/m/Y',  strtotime($pedido[0]->fech_reg)),0,1,'L',0); 
        

       

            //========================================

             //========================================
            //  Segundo bloque - 1 rectángulo       ==
            //========================================

            //LISTA DE PRODUCTOS
            $this->SetFillColor(255, 99, 71);
            $this->Rect(10, 67, 190, 110, 'D'); // con borde y sin fondo
            $this->SetXY(10, 67);     
            $this->setFont('Arial','',12);
            //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
            $this->SetFillColor(232,232,232,232,232);                    
            $this->SetFont('Arial','B',10);
            $this->Cell(10,6,'COD','TB',0,'C',1); 
            $this->Cell(15,6,'CANT','TB',0,'C',1); 
            $this->Cell(10,6,'UNID','TB',0,'C',1); 
            $this->Cell(115,6,'DESCRIPCION','TB',0,'C',1);   
            $this->Cell(20,6,'PRECIO','TB',0,'C',1);
            $this->Cell(20,6,'IMPORTE','TB',0,'C',1); 
            //dibujamos lineas de division
            $this->Line(22, 67, 22, 177); 
            $this->Line(35, 67, 35, 177); 
            $this->Line(45, 67, 45, 177); 
            $this->Line(160, 67, 160, 177); 
            $this->Line(180, 67, 180, 177); 

            //========================================

             //CUADRO MONEDA EN LETRAS
            /*$this->SetFillColor(255, 99, 71);
            //$this->Rect(10, 135, 190, 10, 'DF'); // con borde y fondo
            $this->Rect(10, 135, 190, 7, 'D'); // con borde y fondo
       
                 */      

        }


        //////////////////// OK ///////////////////////////////////////////////
		function Content($pedido,$pedidoitems)
        {
               
              
                    $filas=1;  
					 
					$this->Ln(6);		

                    $SUBTOTAL=0;
                    $this->setFont('Arial','',9);  
                    foreach ($pedidoitems as $key){ 

                            $precio_dscto = $key->precio_venta * $key->descuento;
                            $importe      = $key->cantidad * $precio_dscto;

                                $SUBTOTAL=$SUBTOTAL+ $importe;                         
                             
								$product = utf8_decode($key->descripcion); 
                                $this->Cell(10,7,$key->cod_producto,0,0,'C',0);  
                                $this->Cell(15,7,$key->cantidad,0,0,'C',0);  
								$this->Cell(10,7,$key->unidad,0,0,'C',0);    
								$this->Cell(115,7,$product,0,0,'J',0);                           					 
                                $this->Cell(20,7,number_format($precio_dscto,2),0,0,'R',0);   
                                $this->Cell(20,7,number_format($importe,2),0,0,'R',0);     
                              
                                $this->Ln(7);  
								$filas++;                                
                      
                    } //fin foreach 
                
                 
                    //TOTAL EN LETRASD
                    $this->SetXY(10, 170);
                    $this->setFont('Arial','B',9);                 
                    $this->Cell(35,7,'',0,0,'R',0);                             
                    $this->Cell(115,7,'PRECIOS EN DOLARES AMERICANOS E INCLUYE IGV',0,0,'R',0); 

                    //TOTALES 
                    $SUBTOTAL= $SUBTOTAL - $pedido[0]->impuesto_total ;
                    $this->SetXY(10, 156);
                    $this->setFont('Arial','B',9);
                    $this->Cell(150,7,'',0,0,'C',0);  
                    $this->Cell(20,7,'SUBTOTAL',1,0,'R',1);                             
                    $this->Cell(20,7,number_format($SUBTOTAL,2),1,0,'R',0); 
                    $this->Ln(7); 
                    $this->Cell(150,7,'',0,0,'C',0);  
                    $this->Cell(20,7,'I.G.V',1,0,'R',1);                   
                    $this->Cell(20,7,$pedido[0]->impuesto_total,1,0,'R',0);    
                    $this->Ln(7); 
                    $this->Cell(150,7,'',0,0,'C',0);   
                    $this->Cell(20,7,'TOTAL',1,0,'R',1);                             
                    $this->Cell(20,7,$pedido[0]->total,1,0,'R',0);    

           

        }


        function Piepagina($pedido){
       
            
            //$this->SetWidths(array(30,50,30,40)); //columnas
            //$this->Row(array(GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence()));


            $this->SetWidths(array(190));

            //CUADRO IMPORTANTE
           // $this->SetFillColor(124, 252, 0);
           // $this->Rect(10, 190, 190, 40, 'D'); // con borde y sin fondo 
            $this->SetXY(10, 190); 
            $this->setFont('Arial','B',10);
            $this->Cell(190, 7, 'IMPORTANTE', 0 , 0,'Q');
            $this->Ln(7);
            $this->setFont('Arial','',10);
            $this->SetFillColor(255,255,255); //color de fondo blanco para row
            $this->SetDrawColor(255,255,255); //color de borde de la celda ---blanco
            //$this->SetLineWidth(.2);

            //$this->Cell(190, 7, '* Oferta valido por 15 dias o hasta agotar stock.', 1 , 0,'Q');
            $this->Row(array('* Oferta valido por 15 dias o hasta agotar stock.'));
           // $this->Ln(7);
            //$this->Cell(190, 7, '* De disponer de linea de credito, la compra minima es de $ 200.00, caso contrario sera al contado.', 1 , 0,'Q');
            $this->Row(array( '* De disponer de linea de credito, la compra minima es de $ 200.00, caso contrario sera al contado.'));
           // $this->Ln(7);
            // $this->Cell(190, 7, '* Los repartos son gartuitos(dentro de Lima) , la compra minima es dee $ 200.00, sujeto a disponibilidad de movilidad.', 1 , 0,'Q');
                 $this->Row(array('* Los repartos son gartuitos(dentro de Lima) , la compra minima es dee $ 200.00, sujeto a disponibilidad de movilidad.'));
            // $this->Ln(7);
            // $this->Cell(190, 7, '* Todo cambio se realiza dentro de los 07 dias posteriores a la entrega de la mercaderia, previa evaluacion.', 1 , 0,'Q');
              $this->Row(array( '* Todo cambio se realiza dentro de los 07 dias posteriores a la entrega de la mercaderia, previa evaluacion.'));

            // $this->Ln(7);
             //$this->Cell(190, 7, '* Todo producto que se modifique a solicitud del cliente no esta sujeto al cambio(corte, voltaje especial,, etc.).', 1 , 0,'Q');
            $this->Row(array('* Todo producto que se modifique a solicitud del cliente no esta sujeto al cambio(corte, voltaje especial, etc.)'));
           // $this->Ln(7);
            //$this->Cell(190, 7, '* Si su compra es al CONTADO y cancela con cheque o transferencia interbancaria, debera esperar que el dinero ingrese a nuestras cuenta, para antender su requerimiento.', 1 , 0,'Q');
            $this->Row(array('* Si su compra es al CONTADO y cancela con cheque o transferencia interbancaria, debera esperar que el dinero ingrese a nuestras cuenta, para antender su requerimiento.'));




            //$this->Ln(10);

           // $this->SetXY(10, 245); 
            //Verde
           // $this->SetFillColor(124, 252, 0);
            $this->SetDrawColor(0,0,0); //color de borde
            //$this->SetFillColor(160 ,82, 40); //color de fondo
           // $this->Rect(10, 245, 150, 25, 'D');     
            $this->SetXY(10, 245);
            $this->Cell(150, 5, 'Sirvase girar el cheque a nombre de IMPORT EXPORT TOOLS SAC o depositar en:', 0, 1,'L',0); 
            //$this->Text(10, 247, 'FECHA');           
            $this->Cell(150, 5, 'CUENTA CORRIENTE BCP', 0, 1,'L',0);           
            $this->Cell(150, 5, 'DOLARES: 191-2110941-1-45 / CCI: 00219-10021-10941-14550', 0, 1,'L',0); 
            $this->Cell(150, 5, 'SOLES: 191-2220332-0-95 / CCI: 00219-10022-20332-09551', 0, 1,'L',0); 

            //cuadro TOTALES
            $this->SetFillColor(220, 24, 24); //color de fondo
            //$this->Rect(160, 245, 40, 25, 'D');      
            $this->SetXY(160, 245);
            $this->setFont('Arial','B',10);
            $this->SetTextColor(240, 255, 240); //Letra color blanco
            $this->Cell(40, 5, 'Asesor Comercial', 0 , 1,'C',1); 

            
            $this->setFont('Arial','B',10);
            $this->SetTextColor(0, 0, 0); //Letra color 
            $this->SetXY(160, 250); 
            $this->Cell(40, 5, 'SAUL ANGULO C.', 0 , 1,'L',0); 
            $this->SetXY(160, 255);  
            $this->Cell(40, 5, 'CEL :981367039', 0 , 1,'L',0); 
            $this->SetXY(160, 260); 
            $this->Cell(40, 5, 'TELF:(01)-334-9632', 0 , 1,'L',0); 
            $this->setFont('Arial','',10);
            $this->SetTextColor(0, 0, 0); //Letra color 
            $this->SetXY(160, 265); 
            $this->Cell(40, 5, 'ventas@ie-tools.com', 0 , 1,'L',0);  
                        

        }



        function Footer(){
            /*
            $this->SetY(-15);
            $this->SetFont('Arial','B',8);
            //$this->Cell(0,10,'Pagina'.$this->PageNo(),0,0,'C');
            //Número de página 
            $this->Cell(0,10,'Pagina'.$this->PageNo().'/{nb}',0,0,'C'); 
            //$this->Cell(100,10,'Historial medico',0,0,'L');
            */
            
            //atur posisi 1.5 cm dari bawah
            $this->SetY(-15);
            //buat garis horizontal
            $this->Line(10,$this->GetY(),210,$this->GetY());
            //Arial italic 9
            $this->SetFont('Arial','I',9);
            $this->Cell(0,10,'copyright Import Export' . date('Y'),0,0,'L');
            //nomor halaman
            $this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'R');

        }

}


    
    //unlink('docVenta.pdf');
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Cabecera($pedido);
	$pdf->Content($pedido,$pedidoitems);
    $pdf->Piepagina($pedido);
    //enviamos cabezales http para no tener problemas
    header("Content-Transfer-Encoding", "binary");
    header('Cache-Control: maxage=3600'); 
    header('Pragma: public');

    //$pdf->Output('facturaFPD.pdf', 'F');
    $pdf->Output('docVenta.pdf', 'F');
    

//finaliza y muestra en pantalla pdf
//$fpdf->Output($nombre.".pdf","I");

?>
