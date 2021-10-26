<?php 
require_once "../modelos/Eventos.php";

$eventos = new Eventos();
$ideventos=isset($_POST["ideventos"])? limpiarCadena($_POST["ideventos"]):"";

$evento=isset($_POST["evento"])? limpiarCadena($_POST["evento"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($ideventos)){
			$rspta=$eventos->insertar($evento);
			echo $rspta ? "Eventos registrado" : "Eventos no se pudo registrar";
		}
		else {
			$rspta=$eventos->editar($ideventos,$evento);
			echo $rspta ? "Eventos actualizado" : "Eventos no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$eventos->desactivar($ideventos);
 		echo $rspta ? "Eventos Desactivado" : "Eventos no se puede desactivar";
	break;


	case 'eliminar':
		$rspta=$eventos->eliminar($ideventos);
 		echo $rspta ? "Eventos Eliminado" : "Eventos no se puede eliminar";
 	
	break;
	
	case 'activar':
		$rspta=$eventos->activar($ideventos);
 		echo $rspta ? "Eventos Actualizado" : "Eventos no se puede actualizar";
	break;

	case 'mostrar':
		$rspta=$eventos->mostrar($ideventos);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

 		
	case 'listar':
		$rspta=$eventos->listar();
 		
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->ideventos.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->ideventos.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->ideventos.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->ideventos.')"><i class="fa fa-check"></i></button>',
 	
 				"1"=>$reg->evento,
 				"2"=>$reg->condicion?'<span class="label bg-green">Habilitado</span>':'<span class="label bg-red">Desabilitado</span>'
 				
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