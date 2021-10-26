<?php 
require_once "../modelos/Informes.php";

$categoria=new Informes();


$idservicio=isset($_POST["idservicio"])? limpiarCadena($_POST["idservicio"]):"";
$ci_persona=isset($_POST["ci_persona"])? limpiarCadena($_POST["ci_persona"]):"";
$doctype=isset($_POST["doctype"])? limpiarCadena($_POST["doctype"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$che=isset($_POST["che"])? limpiarCadena($_POST["che"]):"";
$cod_lugar=isset($_POST["cod_lugar"])? limpiarCadena($_POST["cod_lugar"]):"";
$idreserva_cabecera=isset($_POST["idreserva_cabecera"])? limpiarCadena($_POST["idreserva_cabecera"]):"";
$ausentes=isset($_POST["ausentes"])? limpiarCadena($_POST["ausentes"]):"";

switch ($_GET["op"]){


	case 'desactivar':
		$rspta=$categoria->cancelacion($idservicio);
 		echo $rspta ? "Lugares Regenerados" : "Lugares no se pudo regenerar";
 	
	break;

	case 'listar':
		$rspta=$categoria->serviciosActivos();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-danger" onclick="desactivar('.$reg->idservicio.')"><i class="fa fa-times"></i></button>':
 					' <button class="btn btn-danger" onclick="mostrar ('.$reg->idservicio.')"><i class="fa fa-eye"></i></button>',
 	
 				"1"=>$reg->fecha,
			  "2"=>$reg->horario,
	  	  "3"=>$reg->evento,
 				"4"=>($reg->horario<'12:00:00')?'<span class="label bg-yellow">AM</span>':'<span class="label bg-blue">PM</span>', 
 				"5"=>$reg->estado?'<span class="label bg-green">Habilitado</span>':'<span class="label bg-red">Desabilitado</span>'
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;





}
?>