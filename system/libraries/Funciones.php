<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CI_Funciones{
   
   ////////////////////////////////////////////////////
   //Convierte fecha de mysql a español
   ////////////////////////////////////////////////////
   function fecha_mysql_a_espanol($fecha){
      ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
      $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
      return $lafecha;
   }

   ////////////////////////////////////////////////////
   //Convierte fecha de español a mysql
   ////////////////////////////////////////////////////
   function fecha_espanol_a_mysql($fecha){
      ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
      $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
      return $lafecha;
   } 

////////////////////////////////////////////////////
   //Corta cadenas y pone leer mas...
   ////////////////////////////////////////////////////
   function cut_string($string, $charlimit){
      if(substr($string,$charlimit-1,1) != ' ')
      {
         $string = substr($string,'0',$charlimit);
         $array = explode(' ',$string);
         array_pop($array);
         $new_string = implode(' ',$array);
       
         return $new_string.' ...';
      }
      else
      { 
      return substr($string,'0',$charlimit-1).' ...';
      }
 }


   
}

////////////////////////////////////////////////////
   //Corta cadenas y pone leer mas...
   ////////////////////////////////////////////////////
   function cut_string($string, $charlimit){
      if(substr($string,$charlimit-1,1) != ' ')
      {
         $string = substr($string,'0',$charlimit);
         $array = explode(' ',$string);
         array_pop($array);
         $new_string = implode(' ',$array);
       
         return $new_string.' ...';
      }
      else
      { 
      return substr($string,'0',$charlimit-1).' ...';
      }
 }
 
///////////////////////////////////////////////////
/////////Función para limpiar strings
//////////////////////////////////////////////////
function limpiarString($string) 
   {
      $string = strip_tags($string);
      $string = htmlentities($string);
      return stripslashes($string);  
// si llevaremos esto a mySQL deberímos agregar al final mysql_real_escape_string($string);
   }

/* Fin del fichero */
/* No necesito cerrar PHP y de hecho no se recomienda para no insertar saltos de línea al final */

function urls_amigabless($url) {
 
      // Tranformamos todo a minusculas
 
      $url = strtolower($url);
 
      //Rememplazamos caracteres especiales latinos
 
      $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
 
      $repl = array('a', 'e', 'i', 'o', 'u', 'n');
 
      $url = str_replace ($find, $repl, $url);
 
      // Añadimos los guiones
 
      $find = array(' ', '&', '\r\n', '\n', '+');
      $url = str_replace ($find, '-', $url);
 
      // Eliminamos y Reemplazamos otros carácteres especiales
 
      $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
 
      $repl = array('', '-', '');
 
      $url = preg_replace ($find, $repl, $url);
 
      return $url;
 
}