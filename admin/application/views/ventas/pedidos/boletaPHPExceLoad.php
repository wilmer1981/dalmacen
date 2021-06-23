<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//load Excel template file
$objTpl = PHPExcel_IOFactory::load("boleta.xlsx");
//$objTpl = PHPExcel_IOFactory::load("facturas.xls");
$objTpl->setActiveSheetIndex(0);  //set first sheet as active

/*
$objTpl->getActiveSheet()->setCellValue('C2', date('Y-m-d'));  //set C1 to current date
$objTpl->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified

$objTpl->getActiveSheet()->setCellValue('C3', stripslashes($_POST['txtName']));
$objTpl->getActiveSheet()->setCellValue('C4', stripslashes($_POST['txtMessage']));

$objTpl->getActiveSheet()->getStyle('C4')->getAlignment()->setWrapText(true);  //set wrapped for some long text message

$objTpl->getActiveSheet()->getColumnDimension('C')->setWidth(40);  //set column C width
$objTpl->getActiveSheet()->getRowDimension('4')->setRowHeight(120);  //set row 4 height
$objTpl->getActiveSheet()->getStyle('A4:C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); //A4 until C4 is vertically top-aligned
*/

////////////////////////////////////////////////////////////////////////////////
            $objTpl->getActiveSheet()->setCellValue('Z3', $pedido[0]->num_pedido);

             //Ingresamo el X's texto en la celda A1
            $cliente   = mb_strtoupper($pedido[0]->cliente, 'UTF-8');
            $direccion = mb_strtoupper($pedido[0]->direccion, 'UTF-8');
            $empleados = explode(" ", $pedido[0]->empleado);
            // echo $porciones[0]; // porción1
            $vendedor  = mb_strtoupper($empleados[0], 'UTF-8');

            $objTpl->getActiveSheet()->setCellValue('E7', $cliente);           
            $objTpl->getActiveSheet()->setCellValue('E8', $pedido[0]->num_documento);
             $objTpl->getActiveSheet()->setCellValue('E9', $direccion);

          
            if($pedido[0]->tipo_pago=='CRE') {$formapago="CREDITO";  }else{ $formapago="CONTADO"; }
            $objTpl->getActiveSheet()->setCellValue('O8', $formapago);  
            $objTpl->getActiveSheet()->setCellValue('S8', $pedido[0]->tipoprecio);

            $objTpl->getActiveSheet()->setCellValue('AA7', '111111');//num guia
            $objTpl->getActiveSheet()->setCellValue('AA8', $vendedor);
           // $objTpl->getActiveSheet()->setCellValue('AA9', $vendedor);//fecha
         


///////////////////////////////////////////////////////////////////////////////


                $fila=12;  
                $SUBTOTAL=0;
                $currencyFormat = html_entity_decode("$ 0,0.00",ENT_QUOTES,'UTF-8');
                foreach ($pedidoitems as $key){ 
                    
                    $product = utf8_decode($key->descripcion); 
                   // $importe = number_format($key->precio_venta * $key->cantidad,2); 

                    $precio_dscto = $key->precio_venta * $key->descuento;
                    $importe      = $key->cantidad * $precio_dscto;

                    //$SUBTOTAL=$SUBTOTAL+ $key->precio_venta * $key->cantidad; 
                    $SUBTOTAL=$SUBTOTAL+ $importe; 

                    $objTpl->getActiveSheet()->setCellValue('B'.$fila, $key->cantidad);                 
                    $objTpl->getActiveSheet()->setCellValue('D'.$fila, $key->unidad);                   
                    $objTpl->getActiveSheet()->setCellValue('F'.$fila, $product); 
                    $objTpl->getActiveSheet()->setCellValue('X'.$fila, $key->cod_producto);    
                    $objTpl->getActiveSheet()->setCellValue('Z'.$fila, number_format($precio_dscto,2)); 
                   // $objTpl->getActiveSheet()->setCellValue('AB'.$fila, $importe);   
                           
                                             
                    $fila++;                                                              
                      
                } //fin foreach 

                $objTpl->getActiveSheet()->setCellValue('D25', num_to_letras(number_format($SUBTOTAL,2),'DOLARES AMERICANO',''));
               // $objTpl->getActiveSheet()->setCellValue('D25', num_to_letras($pedido[0]->total,'DOLARES AMERICANO',''));
          





///////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////



//prepare download
//$filename=mt_rand(1,100000).'.xls'; //just some random filename

/*
$filename='facturass.xls'; //just some random filename
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
*/

//$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
//$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!

$filename='boletass.xlsx'; //just some random filename
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');


$objWriter->save($filename);
exit; //done.. exiting!

/*

 
                    //Asumiendo que ya hayamos solicitado la libreria iniciamos la primera hoja
                    $this->excel->setActiveSheetIndex(0);

                    //Le colocamos el nombre a la primera hoja o pestaña
                    $this->excel->getActiveSheet()->setTitle('FACTURA');

                    $this->excel->getDefaultStyle()->getFont()->setName('Calibri');
                    $this->excel->getDefaultStyle()->getFont()->setSize(9);

                    //$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(3);

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1);//6 pixeles
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
                $this->excel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->excel->getActiveSheet()->getRowDimension('12')->setRowHeight(16);
                  $this->excel->getActiveSheet()->getRowDimension('24')->setRowHeight(22);
                  $this->excel->getActiveSheet()->getRowDimension('25')->setRowHeight(20);

                    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
                    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
                    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(3);
                    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(2);
                    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(1);
                    $this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);
                    //$this->excel->getActiveSheet()->getColumnDimension('H:Y')->setWidth(200);                    
                    $this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(2);

                    $this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(3);
                    $this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth(4);
                    $this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth(4);

                    //////////////////////////////////////////////////////////////////////////
                
                    $this->excel->getActiveSheet()->setCellValue('Z3', $pedido[0]->num_pedido);
                    ///////////////////////////////////////////////////////////////////////////

                    //Ingresamo el X's texto en la celda A1
                    $cliente   = mb_strtoupper($pedido[0]->cliente, 'UTF-8');
                    $direccion = mb_strtoupper($pedido[0]->direccion, 'UTF-8');
                    $empleados = explode(" ", $pedido[0]->empleado);
                   // echo $porciones[0]; // porción1
                    $vendedor  = mb_strtoupper($empleados[0], 'UTF-8');

                    $this->excel->getActiveSheet()->setCellValue('E7', $cliente);
                    $this->excel->getActiveSheet()->mergeCells('E7:H7');
                    //Cambiamos el tamaño de letra para la Celda A1
                    //$this->excel->getActiveSheet()->getStyle('E7')->getFont()->setSize(9);

                    $this->excel->getActiveSheet()->setCellValue('E8', $direccion);
                    $this->excel->getActiveSheet()->mergeCells('E8:H8');
                    //$this->excel->getActiveSheet()->getStyle('E8')->getFont()->setSize(9);

                    $this->excel->getActiveSheet()->setCellValue('E9', $pedido[0]->num_documento);
                    $this->excel->getActiveSheet()->mergeCells('E9:H9');
                    $this->excel->getActiveSheet()->getStyle('E9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                    //$this->excel->getActiveSheet()->getStyle('E9')->getFont()->setSize(9);

                    $this->excel->getActiveSheet()->setCellValue('E10', $pedido[0]->tipoprecio);
                    $this->excel->getActiveSheet()->mergeCells('E10:H10');
                   // $this->excel->getActiveSheet()->getStyle('E10')->getFont()->setSize(9);



                    ///////////////////////////////////////////////////
                     if($pedido[0]->tipo_pago=='CRE') {$formapago="CREDITO";  }else{ $formapago="CONTADO"; }
                    $this->excel->getActiveSheet()->setCellValue('AA7', $formapago);
                   // $this->excel->getActiveSheet()->getStyle('AA7')->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->mergeCells('AA7:AD7');

                    $this->excel->getActiveSheet()->setCellValue('AA8', $vendedor);
                   // $this->excel->getActiveSheet()->getStyle('AA8')->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->mergeCells('AA8:AD8');

                    $this->excel->getActiveSheet()->setCellValue('AA9', '123456');
                    //$this->excel->getActiveSheet()->getStyle('AA9')->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->mergeCells('AA9:AD9');
                    $this->excel->getActiveSheet()->getStyle('AA9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                $this->excel->getActiveSheet()->setCellValue('AA10', date('d/m/Y',  strtotime($pedido[0]->fech_reg)));
               // $this->excel->getActiveSheet()->getStyle('AA10')->getFont()->setSize(9);
                $this->excel->getActiveSheet()->mergeCells('AA10:AD10');

                /////////////////////////////////////////////////////

                $fila=13;  
                $SUBTOTAL=0;
                $currencyFormat = html_entity_decode("$ 0,0.00",ENT_QUOTES,'UTF-8');
                foreach ($pedidoitems as $key){ 
                    
                    $product = utf8_decode($key->descripcion); 
                   // $importe = number_format($key->precio_venta * $key->cantidad,2); 

                    $precio_dscto = $key->precio_venta * $key->descuento;
                    $importe      = $key->cantidad * $precio_dscto;

                    //$SUBTOTAL=$SUBTOTAL+ $key->precio_venta * $key->cantidad; 
                    $SUBTOTAL=$SUBTOTAL+ $importe; 

                    $this->excel->getActiveSheet()->setCellValue('B'.$fila, $key->cantidad);
                 
                    $this->excel->getActiveSheet()->setCellValue('D'.$fila, $key->unidad);                 

                    $this->excel->getActiveSheet()->setCellValue('E'.$fila, $key->cod_producto);                  
                    $this->excel->getActiveSheet()->mergeCells('E'.$fila.':F'.$fila);

                    $this->excel->getActiveSheet()->setCellValue('H'.$fila, $product);                  
                    $this->excel->getActiveSheet()->mergeCells('H'.$fila.':Y'.$fila);
                    //$sheet->mergeCells('A1:B1');
                    //$this->excel->getActiveSheet()->getColumnDimension('H'.$fila)->setAutoSize(true);

                    $this->excel->getActiveSheet()->setCellValue('Z'.$fila, number_format($precio_dscto,2));
                    $this->excel->getActiveSheet()->getStyle('Z'.$fila)->getNumberFormat()->setFormatCode($currencyFormat); 

                    $this->excel->getActiveSheet()->setCellValue('AB'.$fila, $importe);
                    //$this->excel->getActiveSheet()->getStyle('AB'.$fila)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('AB'.$fila)->getNumberFormat()->setFormatCode($currencyFormat); 
                    $this->excel->getActiveSheet()->mergeCells('AB'.$fila.':AD'.$fila);                            
                           
                                             
                                $fila++; 
                                                             
                      
                    } //fin foreach 
                




                /////////////////////////////////////////////////////////

                $this->excel->getActiveSheet()->setCellValue('D25', num_to_letras($pedido[0]->total,'DOLARES AMERICANO',''));
               // $this->excel->getActiveSheet()->getStyle('D25')->getFont()->setSize(9);
                ///////////////////////////////////////////////////////////
                $SUBTOTALS=$SUBTOTAL - $pedido[0]->impuesto_total;
                

                $this->excel->getActiveSheet()->getRowDimension('27')->setRowHeight(17);
                $this->excel->getActiveSheet()->getRowDimension('28')->setRowHeight(17);
                $this->excel->getActiveSheet()->getRowDimension('29')->setRowHeight(17);

                //$this->excel->getActiveSheet()->setCellValue('AB27', number_format($SUBTOTALS,2));
               // $this->excel->getActiveSheet()->getStyle('AB27')->getFont()->setSize(9);
                $this->excel->getActiveSheet()->setCellValue('AB27', number_format($pedido[0]->total-$pedido[0]->impuesto_total,2));
                $this->excel->getActiveSheet()->getStyle('AB27')->getNumberFormat()->setFormatCode($currencyFormat); 
                $this->excel->getActiveSheet()->mergeCells('AB27:AD27');

                $this->excel->getActiveSheet()->setCellValue('AB28', number_format($pedido[0]->impuesto_total,2));
                //$this->excel->getActiveSheet()->getStyle('AB28')->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle('AB28')->getNumberFormat()->setFormatCode($currencyFormat); 
                $this->excel->getActiveSheet()->mergeCells('AB28:AD28');

                $this->excel->getActiveSheet()->setCellValue('AB29', number_format($pedido[0]->total,2));
               // $this->excel->getActiveSheet()->getStyle('AB29')->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle('AB29')->getNumberFormat()->setFormatCode($currencyFormat); 
                $this->excel->getActiveSheet()->mergeCells('AB29:AD29');

                $this->excel->getActiveSheet()->setCellValue('Z28', '18');
                $this->excel->getActiveSheet()->getStyle('Z28')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                ////////////////////////////////////////////////////////////

         

                    //Aca le asignamos el nombre al archivo
                    $filename='docVentas.xlsx';             

                     // redireccionamos la salida al navegador del cliente (Excel2007)
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="'.$filename.'"');
                    header('Cache-Control: max-age=0');
                     
                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
                    //$objWriter->save('php://output');
                    $objWriter->save($filename);


                    */

?>
