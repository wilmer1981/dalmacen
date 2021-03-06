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
       
       /*
            $this->setFont('Arial','',10);
            $this->setFillColor(255,255,255); //color de fondo
              
                      
            $this->Ln(10);     
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
            */

            //===============================
            //CUADRO RUC
            //==============================
           //$this->SetFillColor(0, 128, 0);
            /*
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
 
            */
            $this->SetXY(145, 30 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(0, 0, 0); //Letra color blanco       
            $this->Cell(25,6,"",0,1); 
           // $this->Cell(25,6,$pedido[0]->serie_comprobante,0,1);  

            $this->SetXY(155, 30 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(0, 0, 0); //Letra color blanco     
            $this->Cell(25,6," Nro. ".$pedido[0]->num_pedido,0,1);  
             //$this->cell(15,6,"Fecha Impresion : " . date('d/m/Y'),0,1,'R',1); 

            //========================================
            //  Segundo bloque - 1 rect??ngulo       ==
            //========================================
            //CUADRO DATOS DEL CLIENTE
           // $this->SetFillColor(255, 215, 0);
           // $this->Rect(10, 45, 190, 20, 'D');
           // $this->Line(10, 45, 15, 40);
          //  $this->SetXY(15, 50);
            //$this->Cell(15, 6, '10, 35', 0 , 1);

             //INFO CLIENTE
           // $this->SetFillColor(124, 252, 0);
            //$this->Rect(10, 44, 130, 16, 'D');          
            $this->setFont('Arial','',10);      
            $this->SetXY(12, 43);
            $this->cell(35,6,utf8_decode("             ".$pedido[0]->cliente),0,1,'L',0); 

            $this->SetXY(12, 48);            
            $this->cell(55,6,"             ".$pedido[0]->num_documento,0,1,'L',0); 

            $this->SetXY(12, 53);         
            $this->cell(55,6,"             ".$pedido[0]->direccion,0,1,'L',0);         
      

            //INFO VENDEDOR
            //$this->SetFillColor(160 ,82, 40);
            //$this->Rect(140, 44, 60, 16, 'D'); 
            $this->setFont('Arial','',10);
            $this->SetXY(170, 43);
            $this->cell(35,6,"              ",0,1,'L',0);  //numero de guia
            $this->SetXY(170, 48);
            $this->cell(35,6,"              ",0,1,'L',0);    //vendedor   
            $this->SetXY(170, 53);
            $this->cell(35,6,"              ".date('d/m/Y',  strtotime($pedido[0]->fech_reg)),0,1,'L',0);  //fecha
         
        

       

            //========================================

             //========================================
            //  Segundo bloque - 1 rect??ngulo       ==
            //========================================

            //LISTA DE PRODUCTOS
            //$this->SetFillColor(255, 99, 71);
           // $this->Rect(10, 65, 195, 66, 'D'); // con borde y sin fondo
   

            $this->SetXY(10, 63);     
            $this->setFont('Arial','',12);
            //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
          /*  $this->SetFillColor(232,232,232,232,232);                    
            $this->SetFont('Arial','B',10);
            $this->Cell(15,6,'CANT','TB',0,'C',1); 
            $this->Cell(20,6,'UNID.MED','TB',0,'C',1); 
            $this->Cell(95,6,'DESCRIPCION','TB',0,'C',1); 
            $this->Cell(20,6,'CODIGO','TB',0,'C',1);  
            $this->Cell(20,6,'PRECIO','TB',0,'C',1);
            $this->Cell(20,6,'IMPORTE','TB',0,'C',1); 
       */
            /*
  
            $this->Line(20, 65, 20, 131); 
            $this->Line(35, 65, 35, 131); 
            $this->Line(145, 65, 145, 131); 
            $this->Line(165, 65, 165, 131); 
            $this->Line(185, 65, 185, 131); 
            */

            //========================================

             //CUADRO MONEDA EN LETRAS
            //$this->SetFillColor(255, 99, 71);        
            //$this->Rect(10, 133, 190, 7, 'D'); // con borde y fondo                        

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
                                $this->Cell(10,6,$key->cantidad,0,0,'L',0);  
								$this->Cell(15,6,$key->unidad,0,0,'L',0);    
								$this->Cell(110,6,$product,0,0,'J',0);  
                                $this->Cell(20,6,$key->cod_producto,0,0,'C',0);      					 
                                $this->Cell(20,6,number_format($key->precio_venta,2),0,0,'R',0);   
                                $this->Cell(20,6,number_format($key->precio_venta * $key->cantidad,2),0,0,'R',0);     
                              
                                $this->Ln(6);  
								$filas++;                                
                      
                    } //fin foreach 

                     //TOTAL EN LETRASD
                    $this->SetXY(10, 131);
                    $this->setFont('Arial','B',9);                 
                    //$this->Cell(15,7,'SON :',1,0,'R',0);     
                    //$this->Cell(175,7,num_to_letras($pedido[0]->total,'DOLARES AMERICANO',''),1,0,'L',0);   
                    $this->Cell(15,7,'',0,0,'R',0);                         
                    $this->Cell(175,7,num_to_letras($pedido[0]->total,'DOLARES AMERICANO',''),0,0,'L',0); 

                    //TOTALES
                    $this->setFont('Arial','B',9);

                    $this->SetXY(20, 141);
                    $this->Cell(20,7,' ',0,0,'R',0);                             
                    $this->Cell(20,7,"$ ".number_format($SUBTOTAL,2),0,0,'R',0); 
                  
                   // $this->Cell(150,7,'',0,0,'C',0);  
                   // $this->Cell(20,7,'I.G.V',1,0,'R',1);                   
                    //$this->Cell(20,7,$pedido[0]->impuesto_total,1,0,'R',0);    
             
                    $this->SetXY(150, 141);                 
                    $this->Cell(20,7,' ',0,0,'R',0);                             
                    $this->Cell(20,7,"$ ".number_format($pedido[0]->total,2),0,0,'R',0);    

           

        }


        function Piepagina($pedido){
       
            $this->setFont('Arial','',10);
            $this->setFillColor(255,255,255); //color de fondo
           // $this->cell(100,6,"Laporan daftar pegawai libreriaplenitud.com",0,0,'L',1); 
           
      

                  //========================================
            //  Cuarto bloque - 6 rect??ngulos       ==
            //========================================
            //Verde
           /*
            $this->SetFillColor(124, 252, 0);
            $this->Rect(10, 150, 50, 25, 'D');          
            $this->SetXY(15, 150);
           // $this->Cell(15, 6, LEYENDA_PIE, 0 , 1);
            $this->Cell(50, 25, 'texto', 'TRLB' , 0,'Q');
         */
            //Caf??
            //$this->SetFillColor(160 ,82, 40);
           // $this->Rect(60, 150, 60, 10, 'D');     
            $this->SetXY(68, 153);        
            $this->Cell(60,6,date('d')."           ".date('m')."         ".date('Y'),0,1,'L',0);  //fecha
       
             //Azul
            /*$this->SetFillColor(0, 191, 255);
            $this->Rect(120, 150, 38, 25, 'D');      
            $this->SetXY(115, 150);
            $this->Cell(15, 6, 'Sello', 0 , 1);*/

            //cuadro TOTALES
            /*
            $this->SetFillColor(124, 252, 0);
            $this->Rect(160, 150, 40, 25, 'D');      
            $this->SetXY(165, 150);
            $this->Cell(15, 6, '', 0 , 1);   */
                        

        }




        function Footer(){
            /*
            $this->SetY(-15);
            $this->SetFont('Arial','B',8);
            //$this->Cell(0,10,'Pagina'.$this->PageNo(),0,0,'C');
            //N??mero de p??gina 
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


    ////////////////////////////IMPRIMIR AUTO ////////////////


////////////////////////////////////////////////////////////////////////////


    /////////////////////////////////////////////////////////////////////


}


    
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Cabecera($pedido);
	$pdf->Content($pedido,$pedidoitems);
    $pdf->Piepagina($pedido);

   // $pdf->AutoPrint();
   // $pdf->Output('docVenta.pdf');
   // $pdf->Output();


    //enviamos cabezales http para no tener problemas
    header("Content-Transfer-Encoding", "binary");
    header('Cache-Control: maxage=3600'); 
    header('Pragma: public');

    $pdf->Output('docVenta.pdf', 'F');
    

//finaliza y muestra en pantalla pdf
//$fpdf->Output($nombre.".pdf","I");

?>
