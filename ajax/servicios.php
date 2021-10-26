<?php 
require_once "../modelos/Servicios.php";

$articulo = new Servicios();
//$ididservicio,$id_asientos,$cantidad,$cant_reserva,$idservicio

$idservicio=isset($_POST["idservicio"])? limpiarCadena($_POST["idservicio"]):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$horario=isset($_POST["horario"])? limpiarCadena($_POST["horario"]):"";
$ideventos=isset($_POST["ideventos"])? limpiarCadena($_POST["ideventos"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
	    //$rspta=$articulo->select($id_asientos,$cantidad)


		if (empty($idservicio)){
			$rspta=$articulo->insertar($fecha,$horario,$ideventos);
			echo $rspta ? "Fecha registrado" : "Fecha no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($idservicio,$fecha,$horario,$ideventos);
			echo $rspta ? "Fecha actualizado" : "Fecha no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idservicio);
 		echo $rspta ? "Fecha Desactivado" : "Fecha no se puede desactivar";
	break;



	
	case 'activar':
		$rspta=$articulo->activar($idservicio);
 		echo $rspta ? "Fecha Actualizado" : "Fecha no se puede actualizar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idservicio);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

 		
	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idservicio.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idservicio.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idservicio.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idservicio.')"><i class="fa fa-check"></i></button>',
 	
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
 
 	case "selectEventos":
		require_once "../modelos/Servicios.php";
		$servicios = new Servicios();

		$rspta = $servicios->selectEvento();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->ideventos . '>' . $reg->evento . '</option>';
				}
	break;



}
?>