<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
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

                    //Seteamos el mime
                  /*  header('Content-Type: application/vnd.ms-excel');
                    //Le enviamos al navegador el nombre del archivo para su respectiva descarga
                    header('Content-Disposition: attachment;filename="'.$filename.'"');
                    //Le indicamos que no deje en cache nada
                    header('Cache-Control: max-age=0');                                
                    //Se genera la mágia, y se construye TODO
                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                    //forzamos la entrega del archivo a nuestro navegador (Descarga pes...)
                    //$objWriter->save('php://output');
                    $objWriter->save('docVentas.xls');*/

                     // redireccionamos la salida al navegador del cliente (Excel2007)
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="'.$filename.'"');
                    header('Cache-Control: max-age=0');
                     
                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
                    //$objWriter->save('php://output');
                    $objWriter->save($filename);

?>
