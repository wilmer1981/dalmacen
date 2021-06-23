<?php

if (!defined('BASEPATH')){exit('No direct script access allowed');}

if (!function_exists('urls_amigables')) {  
	function urls_amigables($url) {
		// Transformamos todo a minúsculas
		$url = strtolower($url);
		//Reemplazamos caracteres especiales latinos
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');
		$url = str_replace ($find, $repl, $url);
		// Añadimos los guiones
		$find = array(' ', '&', '\r\n', '\n', '+');
		$url = str_replace ($find, '-', $url);
		// Eliminamos y Reemplazamos demás caracteres especiales
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$url = preg_replace ($find, $repl, $url);
		return $url;
	}
}

if (!function_exists('normaliza')) {  
    function normaliza($cadena){
        $originales  = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        return utf8_encode($cadena);
    }
}


// está funcion toma una fecha con formato 01/12/2002 o 01-12-2002 
    // y lo transforma a 2002-12-01 antes de guardarlo en 
    // una base de datos mysql  
if (!function_exists('fentrada_mysql')) {   
   function fentrada_mysql($cad,$tipo){
    $uno  = substr($cad, 0, 2);
    $dos  = substr($cad, 3, 2);
    $tres = substr($cad, 6, 4);
    $cad2  = ($tres.$tipo.$dos.$tipo.$uno);
    return $cad2;
    }
}

// Está funcion hace lo contrario toma una fecha con 
// formato 2002/12/01 0 2002-12-01 y lo transforma a 01-12-2002
// antes de mostrarlo en una página, despues de leerlo desde una base de datos mysql
if (!function_exists('fsalida_mysql')) {   
	function fsalida_mysql($cad,$tipo){
		$tres=substr($cad, 0, 4);
		$dos=substr($cad, 5, 2);
		$uno=substr($cad, 8, 2);
		//$cad = ($uno."-".$dos."-".$tres);
		$cad2 = ($uno.$tipo.$dos.$tipo.$tres);
		return $cad2;
	}
}


////522,321.000 == 522321000
if (!function_exists('quitarComaPunto')) { 
	function quitarComaPunto($value) {
		return floatval(str_replace(',', '', str_replace('.', '', $value)));
	}
}
//1,701==1701
if (!function_exists('quitarComa')) { 
	function quitarComa($value) {
		return floatval(str_replace(',', '', $value));
	}
}

if (!function_exists('parsesFloat')) { 
function parsesFloat($value) {
    return floatval(preg_replace('#^([-]*[0-9\.,\' ]+?)((\.|,){1}([0-9-]{1,3}))*$#e', "str_replace(array('.', ',', \"'\", ' '), '', '\\1') . '.\\4'", $value));
}
}
if (!function_exists('tofloat')) { 
function tofloat($num) {
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : 
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
   
    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    } 

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}
}

if (!function_exists('getAjustes'))
{
    //function getAjuste($code,$one=false,$array='array')
	function getAjustes($code)
    {
		//para poder usar la base de datos en el helper debemos instanciar al core de codeigniter 
		$CI= & get_instance(); 
		//al ser instanciado es el equivalente a $this que se tiene en control
		//el siguiente proceso facil de entender igual no va al caso
			
		$setting_data = array();		

		$query = $CI->db->query("SELECT * FROM wsoft_configuraciones WHERE code = '" .$code. "'");
		$i=0;
		foreach ($query->result() as $result) {
			//if($result->serialized==0){				
				//$setting_data[$i][$result->key] = $result->value;
				$setting_data[$result->key] = $result->value;
			//}else{
			
				//$setting_data[$i][$result->key] = json_decode($result->value, true);
				//$setting_data[$result->key] = json_decode($result->value, true);
			//}
			$i++;
		}		

		return $setting_data;	
	}
}



if (!function_exists('parseFloat')) { 
	function parseFloats($ptString) { 
				if (strlen($ptString) == 0) { 
						return false; 
				} 
				 
				$pString = str_replace(" ", "", $ptString); 
				 
				if (substr_count($pString, ",") > 1) 
					$pString = str_replace(",", "", $pString); 
				 
				if (substr_count($pString, ".") > 1) 
					$pString = str_replace(".", "", $pString); 
				 
				$pregResult = array(); 
			 
				$commaset = strpos($pString,','); 
				if ($commaset === false) {$commaset = -1;} 
			 
				$pointset = strpos($pString,'.'); 
				if ($pointset === false) {$pointset = -1;} 
			 
				$pregResultA = array(); 
				$pregResultB = array(); 
			 
				if ($pointset < $commaset) { 
					preg_match('#(([-]?[0-9]+(\.[0-9])?)+(,[0-9]+)?)#', $pString, $pregResultA); 
				} 
				preg_match('#(([-]?[0-9]+(,[0-9])?)+(\.[0-9]+)?)#', $pString, $pregResultB); 
				if ((isset($pregResultA[0]) && (!isset($pregResultB[0]) 
						|| strstr($preResultA[0],$pregResultB[0]) == 0 
						|| !$pointset))) { 
					$numberString = $pregResultA[0]; 
					$numberString = str_replace('.','',$numberString); 
					$numberString = str_replace(',','.',$numberString); 
				} 
				elseif (isset($pregResultB[0]) && (!isset($pregResultA[0]) 
						|| strstr($pregResultB[0],$preResultA[0]) == 0 
						|| !$commaset)) { 
					$numberString = $pregResultB[0]; 
					$numberString = str_replace(',','',$numberString); 
				} 
				else { 
					return false; 
				} 
				$result = (float)$numberString; 
				return $result; 
	} 
} 



////////////GENERRAR CODIGO SIMPLE
if (!function_exists('generarCodigo')) {
    function generarCodigo($numero, $ceros=2){
       return sprintf("%0".$ceros."s", $numero); 
    }
}

if (!function_exists('generarCodigos')) {
	function generarCodigos($longitud, $tipo=0)
	{
		//creamos la variable codigo
		$codigo = "";
		//caracteres a ser utilizados
		$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		//el maximo de caracteres a usar
		$max=strlen($caracteres)-1;
		//creamos un for para generar el codigo aleatorio utilizando parametros min y max
		for($i=0;$i < $longitud;$i++)
		{
			$codigo.=$caracteres[rand(0,$max)];
		}
		//regresamos codigo como valor
		return $codigo;
	}
}


if (!function_exists('generarCodigoSimple')) {
    function generarCodigoSimple($codigo){
        $cod = $codigo;
        if($codigo){
            $codigo2=$cod+1; //seguna parte del codigo
        }else{
            $codigo2="1";
        }

        if($codigo2<10){
            $codigo2="0000".$codigo2;
        }elseif($codigo2>=10 and $codigo2<100 ){
            $codigo2="000".$codigo2;
        }elseif($codigo2>=100 and $codigo2<1000 ){
            $codigo2="00".$codigo2;
        }elseif($codigo2>=1000 and $codigo2<10000 ){
            $codigo2="0".$codigo2;
        }else{
            $codigo2=$codigo2;
        }

        $codigonuevo= $codigo2;

        return $codigonuevo;
    }
}

//queremos un helper que revise la base de datos y 
//sepa cual es el ultimo codigo que se tiene y a ese codigo le sumamos 1 
//para que sea consecutivo la secuencia de codigos (lo especial es como instaciamos para poder trabajar con la base de datos)
if (!function_exists('codigo_compra'))
{
    function codigo_compra()
    {
        //para poder usar la base de datos en el helper debemos instanciar al core de codeigniter 
        $CI= & get_instance(); 
        //al ser instanciado es el equivalente a $this que se tiene en control
        //el siguiente proceso facil de entender igual no va al caso
        if ($CI->db->get("pedidos")->num_rows()>0)
        {
            $num=$CI->db->order_by("id","desc")->get("pedidos")->row_array();
            $num= (int) $num["codigo"];
            return str_pad($num+1, 8, "0", STR_PAD_LEFT);
 
        }
        else 
        {
            return str_pad(1, 10, "0", STR_PAD_LEFT);
        }
    }
}


//contar iyems del menu
if (!function_exists('getCountItems'))
{
    function getCountItems($table,$where='',$one=false,$array='array')
    {
        //para poder usar la base de datos en el helper debemos instanciar al core de codeigniter 
        $CI= & get_instance(); 
        ///al ser instanciado es el equivalente a $this que se tiene en control
        ///el siguiente proceso facil de entender igual no va al caso      
             
        $CI->db->select('COUNT(IF(estado= "1",1,NULL)) as publicados,
                         COUNT(IF(estado= "0",1,NULL)) as despublicados',false);
        $CI->db->from($table);   
        if($where){
            $CI->db->where($where);
        } 
        
        $query = $CI->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
}


if (!function_exists('codigo_cliente'))
{
    function codigo_cliente()
    {
        //para poder usar la base de datos en el helper debemos instanciar al core de codeigniter 
        $CI= & get_instance(); 
        //al ser instanciado es el equivalente a $this que se tiene en control
        //el siguiente proceso facil de entender igual no va al caso
        if ($CI->db->get("clientes")->num_rows()>0)
        {
            $num=$CI->db->order_by("id","desc")->get("clientes")->row_array();
            $num= (int) $num["codigo"];
            return str_pad($num+1, 8, "0", STR_PAD_LEFT);
 
        }
        else 
        {
            return str_pad(1, 10, "0", STR_PAD_LEFT);
        }
    }
}

//consultar SUBCATEGORIAS
if (!function_exists('getSubcategoria'))
{
    function getSubcategoria($idcategoria,$one=false,$array='array')
    {
        //para poder usar la base de datos en el helper debemos instanciar al core de codeigniter 
        $CI= & get_instance(); 
        ///al ser instanciado es el equivalente a $this que se tiene en control
        ///el siguiente proceso facil de entender igual no va al caso       
        $where="c.id_categoria = ".$idcategoria;        
        $CI->db->select('c.id,c.titulo,c.id_categoria,c.estado');
        $CI->db->from('wsoft_categorias c'); 

 
        if($where){
            $CI->db->where($where);
        } 
        //$CI->db->group_by('c.id_categoria'); 
        
        $query = $CI->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
}


/**
 * Convierte un número en una cadena de letras, para el idioma
 * castellano, pero puede funcionar para español de mexico, de  
 * españa, colombia, argentina, etc.
 * 
 * Máxima cifra soportada: 18 dígitos con 2 decimales
 * 999,999,999,999,999,999.99
 * NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE BILLONES
 * NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES
 * NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE PESOS 99/100 M.N.
 * 
 * @author Ultiminio Ramos Galán <contacto@ultiminioramos.com>
 * @param string $numero La cantidad numérica a convertir 
 * @param string $moneda La moneda local de tu país
 * @param string $subfijo Una cadena adicional para el subfijo
 * 
 * @return string La cantidad convertida a letras
 */
if (!function_exists('num_to_letras'))
{
    function num_to_letras($numero, $moneda = 'PESO', $subfijo = 'M.N.')
    {
        $xarray = array(
            0 => 'CERO'
            , 1 => 'UNO', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE'
            , 'DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE', 'DIECIOCHO', 'DIECINUEVE'
            , 'VEINTI', 30 => 'TREINTA', 40 => 'CUARENTA', 50 => 'CINCUENTA'
            , 60 => 'SESENTA', 70 => 'SETENTA', 80 => 'OCHENTA', 90 => 'NOVENTA'
            , 100 => 'CIENTO', 200 => 'DOSCIENTOS', 300 => 'TRESCIENTOS', 400 => 'CUATROCIENTOS', 500 => 'QUINIENTOS'
            , 600 => 'SEISCIENTOS', 700 => 'SETECIENTOS', 800 => 'OCHOCIENTOS', 900 => 'NOVECIENTOS'
        );

        $numero = trim($numero);
        $xpos_punto = strpos($numero, '.');
        $xaux_int = $numero;
        $xdecimales = '00';
        if (!($xpos_punto === false)) {
            if ($xpos_punto == 0) {
                $numero = '0' . $numero;
                $xpos_punto = strpos($numero, '.');
            }
            $xaux_int = substr($numero, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
            $xdecimales = substr($numero . '00', $xpos_punto + 1, 2); // obtengo los valores decimales
        }

        $XAUX = str_pad($xaux_int, 18, ' ', STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
        $xcadena = '';
        for ($xz = 0; $xz < 3; $xz++) {
            $xaux = substr($XAUX, $xz * 6, 6);
            $xi = 0;
            $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
            $xexit = true; // bandera para controlar el ciclo del While
            while ($xexit) {
                if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                    break; // termina el ciclo
                }

                $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
                $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
                for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                    switch ($xy) {
                        case 1: // checa las centenas
                            $key = (int) substr($xaux, 0, 3);
                            if (100 > $key) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                                /* do nothing */
                            } else {
                                if (TRUE === array_key_exists($key, $xarray)) {  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                    $xseek = $xarray[$key];
                                    $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                    if (100 == $key) {
                                        $xcadena = ' ' . $xcadena . ' CIEN ' . $xsub;
                                    } else {
                                        $xcadena = ' ' . $xcadena . ' ' . $xseek . ' ' . $xsub;
                                    }
                                    $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                                } else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                    $key = (int) substr($xaux, 0, 1) * 100;
                                    $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                    $xcadena = ' ' . $xcadena . ' ' . $xseek;
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 0, 3) < 100)
                            break;
                        case 2: // checa las decenas (con la misma lógica que las centenas)
                            $key = (int) substr($xaux, 1, 2);
                            if (10 > $key) {
                                /* do nothing */
                            } else {
                                if (TRUE === array_key_exists($key, $xarray)) {
                                    $xseek = $xarray[$key];
                                    $xsub = subfijo($xaux);
                                    if (20 == $key) {
                                        $xcadena = ' ' . $xcadena . ' VEINTE ' . $xsub;
                                    } else {
                                        $xcadena = ' ' . $xcadena . ' ' . $xseek . ' ' . $xsub;
                                    }
                                    $xy = 3;
                                } else {
                                    $key = (int) substr($xaux, 1, 1) * 10;
                                    $xseek = $xarray[$key];
                                    if (20 == $key)
                                        $xcadena = ' ' . $xcadena . ' ' . $xseek;
                                    else
                                        $xcadena = ' ' . $xcadena . ' ' . $xseek . ' Y ';
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 1, 2) < 10)
                            break;
                        case 3: // checa las unidades
                            $key = (int) substr($xaux, 2, 1);
                            if (1 > $key) { // si la unidad es cero, ya no hace nada
                                /* do nothing */
                            } else {
                                $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                                $xsub = subfijo($xaux);
                                $xcadena = ' ' . $xcadena . ' ' . $xseek . ' ' . $xsub;
                            } // ENDIF (substr($xaux, 2, 1) < 1)
                            break;
                    } // END SWITCH
                } // END FOR
                $xi = $xi + 3;
            } // ENDDO
            # si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            if ('ILLON' == substr(trim($xcadena), -5, 5)) {
                $xcadena.= ' DE';
            }

            # si la cadena obtenida en MILLONES o BILLONES, entonces le agrega al final la conjuncion DE
            if ('ILLONES' == substr(trim($xcadena), -7, 7)) {
                $xcadena.= ' DE';
            }

            # depurar leyendas finales
            if ('' != trim($xaux)) {
                switch ($xz) {
                    case 0:
                        if ('1' == trim(substr($XAUX, $xz * 6, 6))) {
                            $xcadena.= 'UN BILLON ';
                        } else {
                            $xcadena.= ' BILLONES ';
                        }
                        break;
                    case 1:
                        if ('1' == trim(substr($XAUX, $xz * 6, 6))) {
                            $xcadena.= 'UN MILLON ';
                        } else {
                            $xcadena.= ' MILLONES ';
                        }
                        break;
                    case 2:
                        if (1 > $numero) {
                            $xcadena = "CERO CON {$xdecimales}/100 {$moneda} {$subfijo}";
                        }
                        if ($numero >= 1 && $numero < 2) {
                            $xcadena = "UN CON {$xdecimales}/100 {$moneda} {$subfijo}";
                        }
                        if ($numero >= 2) {
                            $xcadena.= " CON {$xdecimales}/100 {$moneda} {$subfijo}"; //
                        }
                        break;
                } // endswitch ($xz)
            } // ENDIF (trim($xaux) != "")

            $xcadena = str_replace('VEINTI ', 'VEINTI', $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
            $xcadena = str_replace('  ', ' ', $xcadena); // quito espacios dobles
            $xcadena = str_replace('UN UN', 'UN', $xcadena); // quito la duplicidad
            $xcadena = str_replace('  ', ' ', $xcadena); // quito espacios dobles
            $xcadena = str_replace('BILLON DE MILLONES', 'BILLON DE', $xcadena); // corrigo la leyenda
            $xcadena = str_replace('BILLONES DE MILLONES', 'BILLONES DE', $xcadena); // corrigo la leyenda
            $xcadena = str_replace('DE UN', 'UN', $xcadena); // corrigo la leyenda
        } // ENDFOR ($xz)
        return trim($xcadena);
    }
}

/**
 * Esta función regresa un subfijo para la cifra
 * 
 * @author Ultiminio Ramos Galán <contacto@ultiminioramos.com>
 * @param string $cifras La cifra a medir su longitud
 */
if (!function_exists('subfijo'))
{
    function subfijo($cifras)
    {
        $cifras = trim($cifras);
        $strlen = strlen($cifras);
        $_sub = '';
        if (4 <= $strlen && 6 >= $strlen) {
            $_sub = 'MIL';
        }

        return $_sub;
    }
}


////////////////////////////////////////////////////////////////////////////
if (!function_exists('buildDayDropdown'))
{
    function buildDayDropdown($name='',$value='')
    {
        $days = range(1, 31);
        $day_list[''] = 'Day';
        foreach($days as $day)
        {
            $day_list[$day] = $day;
        }       
        return form_dropdown($name, $day_list, $value);
    }
}   

if ( !function_exists('buildYearDropdown'))
{
    function buildYearDropdown($name='',$value='')
    {        
        //$years = range(1922, date("Y"));
        $years = range(date("Y"),1910);
        $year_list[''] = '-- SELECCIONE --';
        foreach($years as $year)
        {
            $year_list[$year] = $year;
        }    
        
        return form_dropdown($name, $year_list, $value,'class="form-control"');
    }
}

if (!function_exists('buildMonthDropdown'))
{
    function buildMonthDropdown($name='',$value='')
    {
        $month=array(
            ''  =>'-- SELECCIONE --',
            '01'=>'Enero',
            '02'=>'Febrero',
            '03'=>'Marzo',
            '04'=>'Abril',
            '05'=>'Mayo',
            '06'=>'Junio',
            '07'=>'Julio',
            '08'=>'Agosto',
            '09'=>'Septiembre',
            '10'=>'Octubre',
            '11'=>'Noviembre',
            '12'=>'Diciembre');
        return form_dropdown($name, $month, $value,'class="form-control"');
    }
}

if (!function_exists('buildCountryDropdown'))
{
    function buildCountryDropdown($name='',$value='')
    {
        $country=array(
            ''  =>'-- Select --',
            "PH"=>"Philippines",
            "GB"=>"United Kingdom",
            "US"=>"United States",          
            "AF"=>"Afghanistan",
            "AL"=>"Albania",
            "DZ"=>"Algeria",
            "AD"=>"Andorra",
            "AO"=>"Angola",
            "AI"=>"Anguilla",
            "AQ"=>"Antarctica",
            "AG"=>"Antigua and Barbuda",
            "AR"=>"Argentina",
            "AM"=>"Armenia",
            "AW"=>"Aruba",
            "AU"=>"Australia",
            "AT"=>"Austria",
            "AZ"=>"Azerbaijan",
            "BS"=>"Bahamas",
            "BH"=>"Bahrain",
            "BD"=>"Bangladesh",
            "BB"=>"Barbados",
            "BY"=>"Belarus",
            "BE"=>"Belgium",
            "BZ"=>"Belize",
            "BJ"=>"Benin",
            "BM"=>"Bermuda",
            "BT"=>"Bhutan",
            "BO"=>"Bolivia",
            "BA"=>"Bosnia and Herzegovina",
            "BW"=>"Botswana",
            "BR"=>"Brazil",
            "IO"=>"British Indian Ocean",
            "BN"=>"Brunei",
            "BG"=>"Bulgaria",
            "BF"=>"Burkina Faso",
            "BI"=>"Burundi",
            "KH"=>"Cambodia",
            "CM"=>"Cameroon",
            "CA"=>"Canada",
            "CV"=>"Cape Verde",
            "KY"=>"Cayman Islands",
            "CF"=>"Central African Republic",
            "TD"=>"Chad",
            "CL"=>"Chile",
            "CN"=>"China",
            "CX"=>"Christmas Island",
            "CC"=>"Cocos (Keeling) Islands",
            "CO"=>"Colombia",
            "KM"=>"Comoros",
            "CD"=>"Congo, Democratic Republic of the",
            "CG"=>"Congo, Republic of the",
            "CK"=>"Cook Islands",
            "CR"=>"Costa Rica",
            "HR"=>"Croatia",
            "CY"=>"Cyprus",
            "CZ"=>"Czech Republic",
            "DK"=>"Denmark",
            "DJ"=>"Djibouti",
            "DM"=>"Dominica",
            "DO"=>"Dominican Republic",
            "TL"=>"East Timor",
            "EC"=>"Ecuador",
            "EG"=>"Egypt",
            "SV"=>"El Salvador",
            "GQ"=>"Equatorial Guinea",
            "ER"=>"Eritrea",
            "EE"=>"Estonia",
            "ET"=>"Ethiopia",
            "FK"=>"Falkland Islands (Malvinas)",
            "FO"=>"Faroe Islands",
            "FJ"=>"Fiji",
            "FI"=>"Finland",
            "FR"=>"France",
            "GF"=>"French Guiana",
            "PF"=>"French Polynesia",
            "GA"=>"Gabon",
            "GM"=>"Gambia",
            "GE"=>"Georgia",
            "DE"=>"Germany",
            "GH"=>"Ghana",
            "GI"=>"Gibraltar",
            "GR"=>"Greece",
            "GL"=>"Greenland",
            "GD"=>"Grenada",
            "GP"=>"Guadeloupe",
            "GT"=>"Guatemala",
            "GN"=>"Guinea",
            "GW"=>"Guinea-Bissau",
            "GY"=>"Guyana",
            "HT"=>"Haiti",
            "HN"=>"Honduras",
            "HK"=>"Hong Kong",
            "HU"=>"Hungary",
            "IS"=>"Iceland",
            "IN"=>"India",
            "ID"=>"Indonesia",
            "IE"=>"Ireland",
            "IL"=>"Israel",
            "IT"=>"Italy",
            "CI"=>"Ivory Coast",
            "JM"=>"Jamaica",
            "JP"=>"Japan",
            "JO"=>"Jordan",
            "KZ"=>"Kazakhstan",
            "KE"=>"Kenya",
            "KI"=>"Kiribati",
            "KR"=>"Korea, South",
            "KW"=>"Kuwait",
            "KG"=>"Kyrgyzstan",
            "LA"=>"Laos",
            "LV"=>"Latvia",
            "LB"=>"Lebanon",
            "LS"=>"Lesotho",
            "LI"=>"Liechtenstein",
            "LT"=>"Lithuania",
            "LU"=>"Luxembourg",
            "MO"=>"Macau",
            "MK"=>"Macedonia, Republic of",
            "MG"=>"Madagascar",
            "MW"=>"Malawi",
            "MY"=>"Malaysia",
            "MV"=>"Maldives",
            "ML"=>"Mali",
            "MT"=>"Malta",
            "MH"=>"Marshall Islands",
            "MQ"=>"Martinique",
            "MR"=>"Mauritania",
            "MU"=>"Mauritius",
            "YT"=>"Mayotte",
            "MX"=>"Mexico",
            "FM"=>"Micronesia",
            "MD"=>"Moldova",
            "MC"=>"Monaco",
            "MN"=>"Mongolia",
            "ME"=>"Montenegro",
            "MS"=>"Montserrat",
            "MA"=>"Morocco",
            "MZ"=>"Mozambique",
            "NA"=>"Namibia",
            "NR"=>"Nauru",
            "NP"=>"Nepal",
            "NL"=>"Netherlands",
            "AN"=>"Netherlands Antilles",
            "NC"=>"New Caledonia",
            "NZ"=>"New Zealand",
            "NI"=>"Nicaragua",
            "NE"=>"Niger",
            "NG"=>"Nigeria",
            "NU"=>"Niue",
            "NF"=>"Norfolk Island",
            "NO"=>"Norway",
            "OM"=>"Oman",
            "PK"=>"Pakistan",
            "PS"=>"Palestinian Territory",
            "PA"=>"Panama",
            "PG"=>"Papua New Guinea",
            "PY"=>"Paraguay",
            "PE"=>"Peru",
            "PN"=>"Pitcairn Island",
            "PL"=>"Poland",
            "PT"=>"Portugal",
            "QA"=>"Qatar",
            "RE"=>"R&eacute;union",
            "RO"=>"Romania",
            "RU"=>"Russia",
            "RW"=>"Rwanda",
            "SH"=>"Saint Helena",
            "KN"=>"Saint Kitts and Nevis",
            "LC"=>"Saint Lucia",
            "PM"=>"Saint Pierre and Miquelon",
            "VC"=>"Saint Vincent and the Grenadines",
            "WS"=>"Samoa",
            "SM"=>"San Marino",
            "ST"=>"S&atilde;o Tome and Principe",
            "SA"=>"Saudi Arabia",
            "SN"=>"Senegal",
            "RS"=>"Serbia",
            "CS"=>"Serbia and Montenegro",
            "SC"=>"Seychelles",
            "SL"=>"Sierra Leon",
            "SG"=>"Singapore",
            "SK"=>"Slovakia",
            "SI"=>"Slovenia",
            "SB"=>"Solomon Islands",
            "SO"=>"Somalia",
            "ZA"=>"South Africa",
            "GS"=>"South Georgia and the South Sandwich Islands",
            "ES"=>"Spain",
            "LK"=>"Sri Lanka",
            "SR"=>"Suriname",
            "SJ"=>"Svalbard and Jan Mayen",
            "SZ"=>"Swaziland",
            "SE"=>"Sweden",
            "CH"=>"Switzerland",
            "TW"=>"Taiwan",
            "TJ"=>"Tajikistan",
            "TZ"=>"Tanzania",
            "TH"=>"Thailand",
            "TG"=>"Togo",
            "TK"=>"Tokelau",
            "TO"=>"Tonga",
            "TT"=>"Trinidad and Tobago",
            "TN"=>"Tunisia",
            "TR"=>"Turkey",
            "TM"=>"Turkmenistan",
            "TC"=>"Turks and Caicos Islands",
            "TV"=>"Tuvalu",
            "UG"=>"Uganda",
            "UA"=>"Ukraine",
            "AE"=>"United Arab Emirates",
            "UM"=>"United States Minor Outlying Islands",
            "UY"=>"Uruguay",
            "UZ"=>"Uzbekistan",
            "VU"=>"Vanuatu",
            "VA"=>"Vatican City",
            "VE"=>"Venezuela",
            "VN"=>"Vietnam",
            "VG"=>"Virgin Islands, British",
            "WF"=>"Wallis and Futuna",
            "EH"=>"Western Sahara",
            "YE"=>"Yemen",
            "ZM"=>"Zambia",
            "ZW"=>"Zimbabwe");
        return form_dropdown($name, $country, $value);
    }
}

if (!function_exists('buildHourDropdown'))
{
    function buildHourDropdown()
    {
        $hours = range(1, 24);
        foreach($hours as $hour)
        {
            $hour_list[$hour] = $hour;
        }       
        return $hour_list;
    }
}

if (!function_exists('buildMinuteDropdown'))
{
    function buildMinuteDropdown()
    {
        $minutes=array(
            '00'=>'00',
            '05'=>'05',
            '10'=>'10',
            '15'=>'15',
            '20'=>'20',
            '25'=>'25',
            '30'=>'30',
            '35'=>'35',
            '40'=>'40',
            '45'=>'45',
            '50'=>'50',
            '55'=>'55');
        return $minutes;
    }
}




function clean_header($array){
    $CI = get_instance();
    $CI->load->helper('inflector');
    foreach($array as $a){
        $arr[] = humanize($a);
    }
    return $arr;
}

//formatear dias transcurridos
if (!function_exists('get_format_date')) {  
function get_format_date($df) {

    $str = '';
    $str .= ($df->invert == 1) ? '  ' : '';
    if ($df->y > 0) {
        // years
        $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
    } if ($df->m > 0) {
        // month
        $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
    } if ($df->d > 0) {
        // days
        $str .= ($df->d > 1) ? $df->d . ' Dias ' : $df->d . ' Dia ';
    } if ($df->h > 0) {
        // hours
        $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
    } if ($df->i > 0) {
        // minutes
        $str .= ($df->i > 1) ? $df->i . ' Min ' : $df->i . ' Min ';
    } if ($df->s > 0) {
        // seconds
        $str .= ($df->s > 1) ? $df->s . ' Seg ' : $df->s . ' Seg ';
    }

    echo $str;
}
}

if(!function_exists('get_counter')){
	function get_counter()
	{
        //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$query = $ci->db->get('counter_values');
		return $query->result();

	}
}

if (!function_exists('reset_password_html'))
{
    function reset_password_html($data) {
          $html= '
          <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>    
            <link rel="stylesheet" href='.base_url("assets/bootstrap/css/bootstrap.min.css").'>  
            <link rel="stylesheet" href='.base_url("assets/css/style.css").'>
           <link rel="stylesheet" href='.base_url("assets/libs/font-awesome/css/font-awesome.min.css").'>
          </head>
          <body>
            <div class="container">
            <table width="520" bgcolor="#FBFBFB" border="0" cellspacing="0" cellpadding="0" align="center" style="text-align:center; margin-top:30px">
                <tbody>
                <tr>
                    <td><img src="'.base_url('upload/logo.png').'" class="img-responsive center-block"/></td>
                </tr>
                <tr>
                    <td><br><b>¡RESTABLECER CONTRASEÑA!</b></td>
                </tr>
                <tr>
                    <td>
                    <table width="450" border="0" cellspacing="0" cellpadding="0" bgcolor="white" align="center" style="text-align:left; margin:22px auto 40px auto; padding:30px">
                    <tbody>
                    <tr>
                    <td>Hola '.$data["nombre"].',<br><br>Alguien hizo una solicitud para restablecer la contraseña.<br>
                    Tu código de verificación es: <b>'.$data["codigo"].'</b><br><br>
                    <p>Si no fuiste tú, puedes ignorar este correo electrónico.</p>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                </tr>                   
                <tr>
                <td>
                    <p>Si tiene algún inconveniente, comunicate con el Administrador.</p>
                    <p>Microcys SAC</p>                 
                </td>
                </tr>
                </tbody>
            </table>
            </div>
          </body>
          </html>';   
            
        return $html;
    }
}








