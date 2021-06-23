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
                $this->MultiCell($w,5,$data[$i],0,$a,'true');
                //$this->MultiCell($w,5,$data[$i],'LR',$a,'true');
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
  
            $this->SetXY(220, 1 );
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(0, 0, 0); //Letra color blanco     
            $this->Cell(25,6," Nro. ".$pedido[0]->num_pedido,0,1);  
             //$this->cell(15,6,"Fecha Impresion : " . date('d/m/Y'),0,1,'R',1); 

            //========================================
            //  Segundo bloque - 1 rectángulo       ==
            //========================================
         
             ////////////////////////////////////
			 ///////////////  INFO CLIENTE //////
			 ////////////////////////////////////

            $cliente   = mb_strtoupper($pedido[0]->cliente, 'UTF-8');
            $direccion = mb_strtoupper($pedido[0]->direccion, 'UTF-8');
            $empleados = explode(" ", $pedido[0]->empleado);    
            $vendedor  = mb_strtoupper($empleados[0], 'UTF-8');

               
            $this->setFont('Calibri','',9);      
            $this->SetXY(25, 12);
            $this->cell(35,4,"             ".$cliente,0,1,'L',0); //cliente

            $this->SetXY(25, 16);
            $this->cell(35,4,"             ".$direccion,0,1,'L',0); 
      
            $this->SetXY(25, 20);
            $this->cell(35,4,'             '.$pedido[0]->num_documento,0,1,'L',0);  
                  
            $this->SetXY(25, 24);
            $this->cell(35,4,'             '.$pedido[0]->tipoprecio,0,1,'L',0);  



            /////////////////////////////////
			////INFO VENDEDOR
			////////////////////////////////
			 if($pedido[0]->tipo_pago=='CRE') {$formapago="CREDITO";  }else{ $formapago="CONTADO"; }
            $this->setFont('Calibri','',9);
            $this->SetXY(240, 12);
            $this->cell(35,4,"                    ".$formapago,0,1,'L',0); //forma pago

            $this->SetXY(240, 16);
            $this->cell(35,4,"                    ".$vendedor,0,1,'L',0); //venbdedor
     
            $this->SetXY(240, 20);
            $this->cell(35,4,'                    ',0,1,'L',0);  //numero guia
           // $this->Cell(220,15,"ORDEN DE COMPRA",0,0,'C');             
            $this->SetXY(240, 24);
            $this->cell(35,4,'                    '.date('d/m/Y',  strtotime($pedido[0]->fech_reg)),0,1,'L',0); 
        

       

            //========================================

             //========================================
            //  Segundo bloque - 1 rectángulo       ==
            //========================================

            ////////////////////////////////////////////
			//////////////////  LISTA DE PRODUCTOS
			//////////////////////////////////////////
                   
            $this->SetXY(8, 37);               
            //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
          
            $this->SetFillColor(232,232,232,232,232);  
            $this->SetFont('Arial','B',8);
            $this->SetWidths(array(10,10,15,120,20,20)); 
           // $this->Row(array('CANT','UNID.','CODIGO','DESCRIPCION','PRECIO','IMPORTE'));   
                       
                            

        }


        //////////////////// OK ///////////////////////////////////////////////
		function Content($pedido,$pedidoitems)
        {
               
              
                    $filas=1;  
					 
					//$this->Ln(6);		

                    $SUBTOTAL=0;
                  //  $this->SetXY(5, 77);
                    $this->SetFillColor(255,255,255,255,255);  
                    $this->setFont('Arial','',8);  
                   // $this->SetWidths(array(10,10,15,120,20,20),0); 
                    foreach ($pedidoitems as $key){ 
                               $this->SetX(8);

                                //$SUBTOTAL=$SUBTOTAL+ $key->precio_venta * $key->cantidad; 
								$product = utf8_decode($key->descripcion);	

                                $precio_dscto = $key->precio_venta * $key->descuento;
                                $importe      = $key->cantidad * $precio_dscto;
                                $SUBTOTAL=$SUBTOTAL+ $importe; 
							
                           
								 
                                $this->Cell(15,4,$key->cantidad,0,0,'C',0);							 
                                $this->Cell(15,4,$key->unidad,0,0,'L',0);
                                $this->Cell(20,4,$key->cod_producto,0,0,'L',0);   
								$this->Cell(180,4,$product,0,0,'J',0);                           					 
                                $this->Cell(20,4,number_format($precio_dscto,2),0,0,'R',0);   
                                $this->Cell(20,4,number_format($importe,2),0,0,'R',0);
                                $this->Ln(4);  								
                             
                               // $this->Row(array($key->cantidad,$key->unidad,$key->cod_producto,$product,number_format($key->precio_venta,2),number_format($key->precio_venta * $key->cantidad,2)));     
                              
								$filas++; 
                                                             
                      
                    } //fin foreach 
                         $SUBTOTALS = $SUBTOTAL - $pedido[0]->impuesto_total;
                 
                    //TOTAL EN LETRASD
                    $this->SetXY(15, 87);
                    $this->setFont('Arial','B',9);                 
                    $this->Cell(15,6,'      ',0,0,'R',0);                             
                    $this->Cell(180,6,num_to_letras($pedido[0]->total,'DOLARES AMERICANO',''),0,0,'L',0); 

                    //TOTALES    
                    $this->SetXY(95, 93);
                    $this->setFont('Arial','B',9);
                    $this->Cell(145,6,'',0,0,'C',0);  
                    $this->Cell(20,6,'          ',0,0,'R',1);     //SUBTOTAL                        
                   // $this->Cell(20,6,"$ ".number_format($SUBTOTALS,2),0,0,'R',0); 
                    $this->Cell(20,6,"$ ".number_format($pedido[0]->total-$pedido[0]->impuesto_total,2),0,0,'R',0); 

                    $this->SetXY(95, 99);
                    $this->Cell(145,6,'',0,0,'C',0);  
                    $this->Cell(20,6,'18         ',0,0,'C',1); //IGV                  
                    $this->Cell(20,6,"$ ".number_format($pedido[0]->impuesto_total,2),0,0,'R',0);  

                    $this->SetXY(95, 105);
                    $this->Cell(145,6,'',0,0,'C',0);   
                    $this->Cell(20,6,'          ',0,0,'R',1);  //TOTAL                           
                    $this->Cell(20,6,"$ ".number_format($pedido[0]->total,2),0,0,'R',0);    

           

        }


        function Piepagina($pedido){
       
            $this->setFont('Calibri','',10);
            $this->setFillColor(255,255,255); //color de fondo
           // $this->cell(100,6,"Laporan daftar pegawai libreriaplenitud.com",0,0,'L',1); 
                 
            $this->SetXY(85, 105);        
            $this->Cell(60,6,"       ".date('d')."               ".date('M')."           ".date('Y'),0,1,'L',0);  //fecha
                        

        }


	/*
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
		*/

}


    
    //unlink('docVenta.pdf');
    //$pdf = new PDF();
	$pdf=new PDF('L','mm','A4'); //horizontal
	$pdf->AddFont('Calibri','','calibri.php');
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
