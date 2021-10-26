<?php 
require_once "../modelos/Registro.php";

$registro = new Registro();

//$ci_titular=isset($_POST["ci_titular"])? limpiarCadena($_POST["ci_titular"]):"";
$idservicio=isset($_POST["idservicio"])? limpiarCadena($_POST["idservicio"]):"";
$ci_persona=isset($_POST["ci_persona"])? limpiarCadena($_POST["ci_persona"]):"";
$doctype=isset($_POST["doctype"])? limpiarCadena($_POST["doctype"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idreserva_cabecera)){
			$rspta=$registro->insertar($ci_persona,$idservicio,$_POST["doctype"],$_POST["nombre"],$_POST["telefono"],$_POST["correo"],$_POST["direccion"],$_POST["ciudad"]);
			echo $rspta ? "Persona Registrada" : "No se pudo Registrar";
		}
		else {
		}
	break;

	case 'desactivar':
		$rspta=$registro->desactivar($idregistro);
 		echo $rspta ? "Eventos Desactivado" : "Eventos no se puede desactivar";
	break;


	case 'eliminar':
		$rspta=$registro->eliminar($idregistro);
 		echo $rspta ? "Eventos Eliminado" : "Eventos no se puede eliminar";
 	
	break;
	
	case 'activar':
		$rspta=$registro->activar($idregistro);
 		echo $rspta ? "Eventos Actualizado" : "Eventos no se puede actualizar";
	break;

	case 'mostrar':
		$rspta=$registro->mostrar($idregistro);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

 		
	case 'listar':
		$rspta=$registro->listar();
 		
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idregistro.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idregistro.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idregistro.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idregistro.')"><i class="fa fa-check"></i></button>',
 	
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