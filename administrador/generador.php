<?php
function generarCodigo($longitud) {
 $key = 'G';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}
 
//Ejemplo de uso
 
echo generarCodigo(6); // genera un código de 6 caracteres de longitud.
?>