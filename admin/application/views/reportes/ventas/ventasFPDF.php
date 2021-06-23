<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
                $this->MultiCell($w,5,$data[$i],'LTR',$a,'true');
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



        function Footer(){
         
            
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




        function Cabecera($fechini,$fechfin,$usuario){
         
            $this->setFont('Arial','',10);
            $this->setFillColor(255,255,255);
                 
            $this->Ln(12);   
        
          


            //====================================
            // LOGO - INFO - EMPRESA
            //===================================
            // $this->SetFillColor(80, 150, 200); //color rectangulo
            // $this->Rect(10, 10, 95, 30, 'D'); //rectangulo:D, F: color elegido
            $this->SetXY(15, 15);     
            $this->Image(base_url().'assets/images/logo-ie.png', 15, 8,65);
            $this->SetXY(10, 25);         
            $this->cell(95,5,TELEFONOS,0,1,'C',0); 
            $this->SetXY(10, 30);         
            $this->cell(95,5,DIRECCION,0,1,'C',0);
            $this->SetXY(10, 35);         
            $this->cell(95,5,EMAILWEB,0,1,'C',0); 

            //===============================
            //CUADRO RUC
            //==============================
           //$this->SetFillColor(0, 128, 0);
            $this->SetFont('Arial','',7);
            $this->Rect(140, 10, 60 , 30, 'D');   
            $this->SetXY(140, 12);  
            $this->cell(60,4,"Fecha Impresion : ". date('d/m/Y'),0,1,'J',0); 
            $this->SetXY(140, 16); 
            $this->cell(60,4,"Hora Impresion : ". date('H:m:s'),0,1,'J',0); 

            $this->SetFillColor(0, 0, 0); //color de fondo:NEGRO
            $this->Rect(140, 20, 60 , 10, 'F');
            $this->SetXY(140, 23 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(240, 255, 240); //Letra color blanco
            $this->Cell(25, 6, 'REPORTE DE VENTAS', 0 , 1);

            $this->SetXY(150, 30 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(0, 0, 0); //Letra color blanco
            //$this->Cell(25,6,$compra->num_orden,1,0,'R',0);  
            //$this->Cell(25,6,'Nro. '.$compra->num_orden,0,1);   

            //========================================
            //  CUADRO DATOS REPORTE
            //========================================        
            // $this->SetFillColor(255, 215, 0);
            //$this->Rect(10, 45, 190, 12, 'D');
            $this->SetFillColor(232,232,232,232); 
            $this->SetFont('Arial','',8);
            $this->SetXY(10, 45);
            $this->Cell(35, 6, 'TIPO REPORTE',1,0,'C',1);
            $this->Cell(105, 6, 'RESUMEN DE VENTAS',1,0,'J',0);
            $this->SetXY(10, 51);
            $this->Cell(35, 6, 'USUARIO',1,0,'C',1);
            $this->Cell(105, 6, utf8_decode($usuario),1,0,'J',0);

            $this->SetXY(140, 45);
            $this->Cell(60, 6, 'FECHA REPORTE',1,0,'C',1);          
            $this->SetXY(140, 51);
            $this->Cell(12, 6, 'DESDE',1,0,'C',1);
            $this->Cell(18, 6, date('d/m/Y',strtotime($fechini)),1,0,'C',0);
            $this->SetXY(170, 51);
            $this->Cell(12, 6, 'HASTA',1,0,'C',1);
            $this->Cell(18, 6, date('d/m/Y',strtotime($fechfin)),1,0,'C',0);

            //$this->SetXY(15, 35);//
            $this->Ln(10);// salto de linea
            //========================================

             //========================================
            //  Segundo bloque - 1 rectángulo       ==
            //========================================

            //LISTA DE PRODUCTOS
            //$this->SetFillColor(255, 99, 71);
           // $this->Rect(10, 75, 190, 140, 'F');         
           
       
            //========================================                        

        }



       	

        //////////////////// OK ///////////////////////////////////////////////
		
		function Content($pedidos)
        {
                 //$this->SetXY(15, 40);
                    // $this->Ln(30);      
              
                    $filas=1;
									 
					//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
					$this->SetFillColor(232,232,232,232);					 
					$this->SetFont('Arial','B',10);
					$this->Cell(10,6,'N°',1,0,'C',1);
                    $this->Cell(60,6,'CLIENTE',1,0,'C',1);	
                    $this->Cell(25,6,'FECH.VENTA',1,0,'C',1);  
					$this->Cell(30,6,'DOCUMENTO',1,0,'C',1);	
                    $this->Cell(40,6,'TIPO PEDIDO',1,0,'C',1);    			
					$this->Cell(25,6,'MONTO',1,0,'C',1);
					 
					$this->Ln(6);					
                    $totales=0;
                    foreach ($pedidos as $r){
                            $totales=$totales+$r->total;
                            
                                //$image = 'http://www.libreriaplenitud.com/' . $key->products_image; 
								//$product = $key->isbn13 .' - '.utf8_decode($key->products_name);                   
								$this->Cell(10,10,$filas,1,0,'L',0);  
                                $this->Cell(60,10,utf8_decode($r->cliente),1,0,'J',0); 
                                $this->Cell(25,10,date('d/m/Y', strtotime($r->fech_reg)),1,0,'C',0); 
                                $this->Cell(30,10,$r->serie_comprobante." - ".$r->num_pedido,1,0,'C',0);  
                                $this->Cell(40,10,$r->tipopedido,1,0,'C',0); 										 
								$this->Cell(25,10,$r->total,1,0,'R',1);   								
                                //$this->Cell(30,15,$this->Image($image, $this->GetX()+5, $this->GetY()+5, 40, 40,'jpg','http://www.libreriaplenitud.com'),1,1,'C'); 
                               // $this->Cell(30,30,$this->Image($image, $this->GetX()+5, $this->GetY()+3, 20,25), 1, 0, 'C', false );
                              
                                $this->Ln(10);  
								$filas++;
                      
                    } //fin foreach  
                    $this->Cell(165,10,'TOTALES',1,0,'R',0); 
                    $this->Cell(25,10,$totales,1,0,'R',1);     


        }
		
		function Contentss($pagos)
        {
               
              
                    $filas=1;  

					$this->setFont('Arial','',14);
					$this->setFillColor(255,255,255);
					//$this->cell(25,6,'dsfgfdgfd',0,0,'C',0); 
                    $this->SetXY(12, 47);
					//$this->cell(35,6,"Proveedor : ".$compra->proveedor,0,1,'L',1); 
					//$this->cell(25,6,'',0,0,'C',0); 
                    $this->SetXY(12, 52);
					//$this->cell(35,6,"Fecha : ".date('d/m/Y',  strtotime($compra->fecha)),0,1,'L',1); 
					//$this->cell(100,6,"Fecha : ".date('M Y'),0,1,'L',1); 
					//$this->cell(25,6,'',0,0,'C',0); 
                    $this->SetXY(12, 57);
					//$this->cell(35,6,'Direccion :'.$compra->direccion,0,1,'L',1);  
                   // $this->Cell(220,15,"ORDEN DE COMPRA",0,0,'C');             
						

					$this->Ln(10);
					 
					//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
					$this->SetFillColor(232,232,232,232,232);					 
					$this->SetFont('Arial','B',10);
					$this->Cell(10,6,'Item',1,0,'C',1);	
					$this->Cell(115,6,'Descripcion',1,0,'C',1);
                    $this->Cell(20,6,'Cantidad',1,0,'C',1);				 
					$this->Cell(20,6,'Precio',1,0,'C',1);
					$this->Cell(20,6,'Importe',1,0,'C',1);
					 
					$this->Ln(10);					

                  foreach ($pagos as $key){                            
                             
								$product = $key->serie_comprobante; 
								$this->Cell(10,30,$filas,1,0,'L',0);    
								$this->Cell(115,30,$product,1,0,'J',0); 
                                //$this->MultiCell(115,30,$product);
								$this->Cell(20,30,$key->numero_comprobante,1,0,'R',0);   
                                $this->Cell(20,30,number_format($key->total,2),1,0,'R',0);   
                                $this->Cell(20,30,number_format($key->total,2),1,0,'R',0);        
                           
                              
                                $this->Ln(30);  
								$filas++;
                      
                    } 
					
					//fin foreach 
                   // $this->Ln(10);  
                   // $this->cell(100,6,'SUBTOTAL :'.number_format($compra->total-$compra->impuesto,2),0,1,'L',1);  
                  //  $this->cell(100,6,'IGV(%18) :'.number_format($compra->impuesto,2),0,1,'L',1);  
                  //  $this->cell(100,6,'TOTAL    :'.number_format($compra->total,2),0,1,'L',1);       

        }

}


    
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Cabecera($fechini,$fechfin,$usuario);
	$pdf->Content($pedidos);
//    $pdf->Output("reporte.pdf",'D'); 

//enviamos cabezales http para no tener problemas
header("Content-Transfer-Encoding", "binary");
header('Cache-Control: maxage=3600'); 
header('Pragma: public');


//enviamos el documento creado con un nombre nuevo y forzamos su descarga.
//$pdf->Output('recibos.pdf', 'D');
$pdf->Output('reporteVentas.pdf', 'F');
	
//finaliza y muestra en pantalla pdf
//$fpdf->Output($nombre.".pdf","I");

?>
