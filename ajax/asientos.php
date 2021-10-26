<?php 
require_once "../modelos/Asientos.php";

$articulo = new Asientos();
//$ididservicio,$id_asientos,$cantidad,$cant_reserva,$idservicio

$id_asientos=isset($_POST["id_asientos"])? limpiarCadena($_POST["id_asientos"]):"";

$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
	    //$rspta=$articulo->select($id_asientos,$cantidad)


		if (empty($id_asientos)){
			$rspta=$articulo->insertar($cantidad);
			echo $rspta ? "Lugares registrado" : "Lugares no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($id_asientos,$cantidad);
			echo $rspta ? "Lugares actualizado" : "Lugares no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($id_asientos);
 		echo $rspta ? "Lugares Desactivado" : "Lugares no se puede desactivar";
	break;


	case 'eliminar':
		$rspta=$articulo->eliminar($id_asientos);
 		echo $rspta ? "Lugares Eliminado" : "Lugares no se puede eliminar";
 	
	break;
	
	case 'activar':
		$rspta=$articulo->activar($id_asientos);
 		echo $rspta ? "Lugares Actualizado" : "Lugares no se puede actualizar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($id_asientos);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

 		
	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_asientos.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_asientos.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_asientos.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_asientos.')"><i class="fa fa-check"></i></button>',
 	
 				"1"=>$reg->cantidad,
 				"2"=>$reg->estado?'<span class="label bg-green">Habilitado</span>':'<span class="label bg-red">Desabilitado</span>'
 				
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