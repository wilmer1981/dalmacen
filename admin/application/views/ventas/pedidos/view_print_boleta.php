<html> 
    <head>
    <title>Simple invoice in PHP</title>
        <style type="text/css">
       /*@font-face {
            font-family:"1979 Dot Matrix Regular";
            src:url("../fonts/1979_dot_matrix.eot?") format("eot"),url("../fonts/1979_dot_matrix.woff") format("woff"),url("../fonts/1979_dot_matrix.ttf") format("truetype"),url("../fonts/1979_dot_matrix.svg#1979-Dot-Matrix") format("svg");
            font-weight:normal;
            font-style:normal;
        }*/
        
        body {      
        
            font-size:9pt; /*12px*/
           /* font-family: "1979 Dot Matrix Regular"; */
            font-family: "Calibri";
                             
            color: black;
        }

        @page{    
     
           margin: 0;   
        }
         
        div.invoice {
        border:0px solid #ccc;
        /*padding:10px;*/
        height:500pt;
         /*height:595pt;
        width:842pt;*/
        width:842pt;
        }
 
        div.company-address {
            border:0px solid #ccc;
            float:left;
            width:150pt;
            margin-left: 145px;
            margin-top:130px; 
        }
         
        div.invoice-details {
            border:0px solid #ccc;
            font-size:16px;
            float:left;
            width:80pt;
            margin-top:90px;
            margin-left: 480px;
        }
         
        div.customer-Info {
            border:0px solid #ccc;
            float:left;
            margin-bottom:24px;
            margin-top:25px;
            width:100pt;
            margin-left: 610px;
        }

        div.customer-totals-text{
            border:0px solid #ccc;
            /*background-color: #ccc;*/
            float:left;
            margin-bottom:0px;
            margin-top:5px;
           /* margin-top:145px;*/
            width:300pt;
            margin-left: 110px;
        }

        div.customer-totals-sub{
            border:0px solid #ccc;
            /*background-color: #ccc;*/
            float:right;
            margin-bottom:0px;
            margin-top:20px;
            width:100pt;
            margin-left: 700px;
        }

        div.customer-totals-igv{
            border:0px solid #ccc;
            /*background-color: #ccc;*/
            float:right;
            margin-bottom:0px;
            margin-top:5px;
            width:100pt;
            margin-left: 700px;
        }
        div.customer-totals-tot{
            border:0px solid #ccc;
            float:right;
            margin-bottom:0px;
            margin-top:5px;
            width:100pt;
            margin-left: 700px;
        }
        div.customer-fecha{
            border:0px solid #ccc;
            float:left;
            margin-bottom:0px;
            margin-top:230px;
            width:100pt;
            margin-left: 270px;
            position: absolute;
        }
        div.customer-dia{
            border:0px solid #ccc;
            float:left;
            margin-bottom:0px;
            margin-top:78px;
            /*margin-top:210px;*/
            width:10pt;
            margin-left: 330px;
            position: absolute;
        }
        div.customer-mes{
            border:0px solid #ccc;
            float:left;
            margin-bottom:0px;
            margin-top:78px;
            /*margin-top:210px;*/
            width:10pt;
            margin-left: 400px;
            position: absolute;
        }
        div.customer-anio{
            border:0px solid #ccc;
            float:left;
            margin-bottom:0px;
            margin-top:78px;
            /*margin-top:210px;*/
            width:15pt;
            margin-left: 490px;
            position: absolute;
        }
         
        div.clear-fix {
            clear:both;
            float:none;
        }

        div.tabla{
         margin-left: 50px;
         height: 170px;
         /*background-color: #ff0000;*/
        }
         
        table {   
        font-size:9pt;
        }
         
        th {
            text-align: left;
        }
         
        td {
           /* font-family: "sans-serif","Roman";*/
           font-size:9pt;
        }
         
        .text-left {
            text-align:left;
        }
         
        .text-center {
            text-align:center;
        }
         
        .text-right {
            text-align:right;
        }
         
        </style>
    </head>

<body onload="print();"> 
 <div class="invoice">

     <div class="company-address">
            <?php echo html_entity_decode($DocOrder[0]->cliente); ?><br />
            <?php echo utf8_decode($DocOrder[0]->direccion); ?><br />
            <?php echo utf8_decode($DocOrder[0]->num_documento); ?><br />
              <?php echo utf8_decode($DocOrder[0]->tipoprecio); ?><br />
        </div>
     
        <div class="invoice-details">
            <?php echo $DocOrder[0]->num_pedido; ?>    
        </div>
         
        <div class="customer-Info">
            <?php
            if($DocOrder[0]->tipo_pago=='CRE') {$formapago="CREDITO";  }else{ $formapago="CONTADO"; }
             echo $formapago;
              ?><br />
              <?php echo utf8_decode($DocOrder[0]->tipoprecio); ?><br />
              123456789<br />
            <?php echo date('d/m/Y',  strtotime($DocOrder[0]->fech_reg)); ?><br />
        </div>

 
        <div class="clear-fix"></div>
        <div class="tabla">
        <table border='0' cellspacing='0'>  
            <tr>
                    <td width="45" class="text-center"></td>
                    <td width="45" class="text-center"></td>
                    <td width="85" class="text-center"></td>
                    <td width="590" class="text-center"></td>                
                    <td width="105" class="text-center"></td>
                    <td width="110" class="text-center"></td>
            </tr>   
        <?php
                $SUBTOTAL=0;
                    foreach ($ListOrder as $key => $value) {
                        $cuantosLetras = strlen($value->descripcion);
                      /*  if($cuantosLetras >=13)
                        {
                            $cuantosLetras = 13;
                        }
                        if($cuantosLetras <=13)
                        {
                            $cuantosLetras = $cuantosLetras;
                        }*/
                        # code...
                         $SUBTOTAL=$SUBTOTAL+ $value->precio_venta * $value->cantidad; 

                        $precio_dscto = $value->precio_venta * $value->descuento;
                        $importe      = $value->cantidad * $precio_dscto;

                         echo '<tr>';
                         echo '<td class="text-center">'.$value->cantidad.'</td>';
                         echo '<td class="text-center">'.$value->unidad.'</td>';
                         echo '<td class="text-center">'.$value->cod_producto.'</td>';
                         echo '<td>'.substr($value->descripcion,0,$cuantosLetras).'</td>';
                         
                         echo '<td class="text-right">$ '.number_format($precio_dscto,2).'</td>';
                         //echo '<td class="text-right">$ '.($value->precio_venta) * ($value->cantidad).'</td>';
                         echo '<td class="text-right">$ '.number_format($importe,2).'</td>';
                         echo '</tr>';
                    }
                 ?>     
               
        </table>
        </div>

        <div class="customer-totals-text">
          <?php 
                echo num_to_letras($DocOrder[0]->total,'DOLARES AMERICANO','');
          ?>
        </div>

         <div class="customer-dia"><?php echo date('d');?></div>
         <div class="customer-mes"><?php echo date('M');?></div>
         <div class="customer-anio"><?php echo date('y');?></div>
        <div class="customer-totals-sub">
             <?php 
            /* echo("<table border='0' cellspacing='0'>");  
                    echo("<tr>");                 
                    echo("<td class='text-right'>$ " . number_format($SUBTOTAL- $DocOrder[0]->impuesto_total,2) . "</td>");
                    echo("</tr>");
                    echo("<tr>");
                    echo("<td class='text-right'>$ " . number_format($DocOrder[0]->impuesto_total,2) . "</td>");
                    echo("</tr>");
                    echo("<tr>");       
                    echo("<td class='text-right'><b>$ " . number_format($DocOrder[0]->total,2) . "</b></td>");
                    echo("</tr>");
            echo("</table>");
            */

           // echo '$ '.number_format($SUBTOTAL- $DocOrder[0]->impuesto_total,2);
             echo '$ '.number_format($DocOrder[0]->total- $DocOrder[0]->impuesto_total,2);
            ?>
        </div>
        <div class="customer-totals-igv">
            <?php 
              echo '$ '.number_format($DocOrder[0]->impuesto_total,2);
             ?>
        </div>
        <div class="customer-totals-tot">
            <?php 
           echo '$ '.number_format($DocOrder[0]->total,2);
             ?>    
        </div>


  </div>
<div id='all_table' style='page-break-after: always'></div> 
</body>
</html>