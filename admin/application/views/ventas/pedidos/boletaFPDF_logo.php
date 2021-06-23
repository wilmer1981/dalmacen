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

            $this->SetFillColor(0, 0, 0); //color de fondo:NEGRO
            $this->Rect(140, 20, 60 , 10, 'F');
            $this->SetXY(140, 23 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(240, 255, 240); //Letra color blanco
            $this->Cell(60, 6, 'BOLETA DE VENTA', 0,1,'C',0);
 

            $this->SetXY(145, 32 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(0, 0, 0); //Letra color blanco       
            $this->Cell(25,6,$pedido[0]->serie_comprobante,0,1);  

            $this->SetXY(155, 32 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(0, 0, 0); //Letra color blanco     
            $this->Cell(25,6," - Nro. ".$pedido[0]->num_pedido,0,1);  
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
            $this->SetFillColor(124, 252, 0);
            $this->Rect(10, 45, 130, 20, 'D');          
           // $this->SetXY(15, 160);
            //$this->Cell(15, 6, 'Texto ', 0 , 1);

            $this->setFont('Arial','',10);
           // $this->setFillColor(255,255,255);
            //$this->cell(25,6,'dsfgfdgfd',0,0,'C',0); 
            $this->SetXY(12, 45);
            $this->cell(35,6,"Cliente : ".$pedido[0]->cliente,0,1,'L',0); 

            $this->SetXY(12, 50);
            $this->cell(35,6,"Direccion : ".$pedido[0]->direccion,0,1,'L',0); 
            //$this->cell(35,6,"Fecha : ".date('d/m/Y',  strtotime($compra->fecha)),0,1,'L',1); 
            //$this->cell(100,6,"Fecha : ".date('M Y'),0,1,'L',1); 
            //$this->cell(25,6,'',0,0,'C',0); 
            $this->SetXY(12, 55);
            $this->cell(35,6,'RUC :'.$pedido[0]->num_documento,0,1,'L',0);  
           // $this->Cell(220,15,"ORDEN DE COMPRA",0,0,'C');             
            $this->SetXY(12, 60);
            $this->cell(35,6,'Cod.:'.$pedido[0]->num_documento,0,1,'L',0);  




            //INFO VENDEDOR
            $this->SetFillColor(160 ,82, 40);
            $this->Rect(140, 45, 60, 20, 'D');      

            $this->setFont('Arial','',10);
            $this->SetXY(140, 45);
            $this->cell(35,6,"Forma Pago : ",0,1,'L',0); 

            $this->SetXY(140, 50);
            $this->cell(35,6,"Vendedor : ",0,1,'L',0); 
            //$this->cell(35,6,"Fecha : ".date('d/m/Y',  strtotime($compra->fecha)),0,1,'L',1); 
            //$this->cell(100,6,"Fecha : ".date('M Y'),0,1,'L',1); 
            //$this->cell(25,6,'',0,0,'C',0); 
            $this->SetXY(140, 55);
            $this->cell(35,6,'Num.GUIA :',0,1,'L',0);  
           // $this->Cell(220,15,"ORDEN DE COMPRA",0,0,'C');             
            $this->SetXY(140, 60);
            $this->cell(35,6,'Fecha :'.date('d/m/Y',  strtotime($pedido[0]->fech_reg)),0,1,'L',0); 
        

       

            //========================================

             //========================================
            //  Segundo bloque - 1 rectángulo       ==
            //========================================

            //LISTA DE PRODUCTOS
            $this->SetFillColor(255, 99, 71);
            $this->Rect(10, 67, 190, 66, 'D'); // con borde y sin fondo
   

            $this->SetXY(10, 67);     
            $this->setFont('Arial','',12);
            //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
            $this->SetFillColor(232,232,232,232,232);                    
            $this->SetFont('Arial','B',10);
            $this->Cell(15,6,'CANT','TB',0,'C',1); 
            $this->Cell(20,6,'UNID.MED','TB',0,'C',1); 
            $this->Cell(115,6,'DESCRIPCION','TB',0,'C',1);   
            $this->Cell(20,6,'PRECIO','TB',0,'C',1);
            $this->Cell(20,6,'IMPORTE','TB',0,'C',1); 
       
            $this->Line(25, 67, 25, 133); 
            $this->Line(45, 67, 45, 133); 
            $this->Line(160, 67, 160, 133); 
            $this->Line(180, 67, 180, 133); 

            //========================================

             //CUADRO MONEDA EN LETRAS
            $this->SetFillColor(255, 99, 71);
            //$this->Rect(10, 135, 190, 10, 'DF'); // con borde y fondo
            $this->Rect(10, 135, 190, 7, 'D'); // con borde y fondo
       
/*
            $this->SetFillColor(0, 191, 255);
            $this->Rect(120, 150, 38, 25, 'D');      
            $this->SetXY(115, 150);
            $this->Cell(15, 6, 'Sello', 0 , 1);
*/
       
            //========================================
            //  Cuarto bloque - 6 rectángulos       ==
            //========================================
            //Verde
          /*  $this->SetFillColor(124, 252, 0);
            $this->Rect(10, 160, 50, 25, 'D');          
            $this->SetXY(15, 160);
            $this->Cell(15, 6, 'Texto ', 0 , 1);
            //Café
            $this->SetFillColor(160 ,82, 40);
            $this->Rect(60, 160, 60, 25, 'D');     
            $this->SetXY(65, 160);
            $this->Cell(15, 6, 'FECHA', 0 , 1); 

             //Azul
            $this->SetFillColor(0, 191, 255);
            $this->Rect(120, 160, 40, 25, 'D');      
            $this->SetXY(115, 160);
            $this->Cell(15, 6, 'TOTALES', 0 , 1);

            $this->SetFillColor(124, 252, 0);
            $this->Rect(162, 160, 38, 25, 'D');      
            $this->SetXY(165, 160);
            $this->Cell(15, 6, 'TOTALES', 0 , 1);

            */

            //Marrón
           /* $this->SetFillColor(128, 0 ,0);
            $this->Rect(10, 265, 40, 25, 'F');
            $this->Line(10, 265, 15, 270);
            $this->SetXY(15, 270);
            $this->Cell(15, 6, '10, 265', 0 , 1);
            //Morado
            $this->SetFillColor(153, 50, 204);
            $this->Rect(60, 265, 40, 25, 'F');
            $this->Line(60, 265, 65, 270);
            $this->SetXY(65, 270);
            $this->Cell(15, 6, '60, 265', 0 , 1);*/
            //Azul
           /* $this->SetFillColor(0, 191, 255);
            $this->Rect(110, 160, 90, 25, 'F');
           // $this->Line(110, 160, 115, 240);
            $this->SetXY(115, 160);
            $this->Cell(15, 6, '110, 235', 0 , 1);
            //Verde
             $this->SetFillColor(173, 255, 47);
            $this->Rect(110, 265, 90, 25, 'F');
            $this->Line(110, 265, 115, 270);
            $this->SetXY(115, 270);
            $this->Cell(15, 6, '110, 265', 0 , 1);*/
                        

        }

        //////////////////// OK ///////////////////////////////////////////////
		function Content($pedido,$pedidoitems)
        {
               
              
                    $filas=1; 

                    $SUBTOTAL=0;
                    $this->Ln(6);
                    $this->setFont('Arial','',9);   
                    foreach ($pedidoitems as $key){ 
                               
                                $SUBTOTAL=$SUBTOTAL+ $key->precio_venta * $key->cantidad;                         
                             
								$product = utf8_decode($key->descripcion); 
                                $this->Cell(15,7,$key->cantidad,0,0,'C',0);  
								$this->Cell(20,7,$filas,0,0,'C',0);    
								$this->Cell(115,7,$product,0,0,'J',0);                           					 
                                $this->Cell(20,7,number_format($key->precio_venta,2),0,0,'R',0);   
                                $this->Cell(20,7,number_format($key->precio_venta * $key->cantidad,2),0,0,'R',0);     
                              
                                $this->Ln(7);  
								$filas++;                                
                      
                    } //fin foreach 

                     //TOTAL EN LETRASD
                    $this->SetXY(10, 135);
                    $this->setFont('Arial','B',9);                 
                    $this->Cell(15,7,'SON :',1,0,'R',1);                             
                    $this->Cell(175,7,num_to_letras($pedido[0]->total,'DOLARES AMERICANO',''),1,0,'L',0); 

                    //TOTALES
                    $this->SetXY(10, 150);
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
       
            $this->setFont('Arial','',10);
            $this->setFillColor(255,255,255); //color de fondo
           // $this->cell(100,6,"Laporan daftar pegawai libreriaplenitud.com",0,0,'L',1); 
           
      

                  //========================================
            //  Cuarto bloque - 6 rectángulos       ==
            //========================================
            //Verde
            $this->SetFillColor(124, 252, 0);
            $this->Rect(10, 150, 50, 25, 'D');          
            $this->SetXY(15, 150);
           // $this->Cell(15, 6, LEYENDA_PIE, 0 , 1);
            $this->Cell(50, 25, 'texto', 'TRLB' , 0,'Q');
         
            //Café
            $this->SetFillColor(160 ,82, 40);
            $this->Rect(60, 150, 60, 25, 'D');     
            $this->SetXY(65, 150);
            $this->Cell(15, 6, 'FECHA', 0 , 1); 

             //Azul
            $this->SetFillColor(0, 191, 255);
            $this->Rect(120, 150, 38, 25, 'D');      
            $this->SetXY(115, 150);
            $this->Cell(15, 6, 'Sello', 0 , 1);

            //cuadro TOTALES
            $this->SetFillColor(124, 252, 0);
            $this->Rect(160, 150, 40, 25, 'D');      
            $this->SetXY(165, 150);
            $this->Cell(15, 6, '', 0 , 1);   
                        

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
