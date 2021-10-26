<?php

include('datos.php');
class Conexion{
    function Conectar(){
        try{
          //  $conexion = new PDO("mysql:host=".SERVER.";dbname=".DBNAME,USER,PASSWORD);
            $conexion = new PDO("pgsql:host=".SERVER.";port=5433;dbname=".DBNAME,USER,PASSWORD);
            return $conexion;

        }catch (Excpetion $error){
            die("El error de la conexion es: ".$error->getMessage()); 

        }
    }
}


