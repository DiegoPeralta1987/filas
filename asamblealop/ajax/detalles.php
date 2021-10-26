<?php 
require_once "../modelos/Ujieres.php";

$articulo = new Ujieres();
//$ididservicio,$id_asientos,$cantidad,$cant_reserva,$idservicio

$idreserva_cabecera=isset($_POST["idreserva_cabecera"])? limpiarCadena($_POST["idreserva_cabecera"]):"";
$id_reserva_cabecera=isset($_POST["id_reserva_cabecera"])? limpiarCadena($_POST["id_reserva_cabecera"]):"";
$ci_titular=isset($_POST["ci_titular"])? limpiarCadena($_POST["ci_titular"]):"";
$ci_persona=isset($_POST["ci_persona"])? limpiarCadena($_POST["ci_persona"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$che=isset($_POST["che"])? limpiarCadena($_POST["che"]):"";
$fecha_registro=isset($_POST["fecha_registro"])? limpiarCadena($_POST["fecha_registro"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$asistencia=isset($_POST["asistencia"])? limpiarCadena($_POST["asistencia"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
	    //$rspta=$articulo->select($id_asientos,$cantidad)


		if (empty($idstock)){
			$rspta=$articulo->insertar($id_asientos,$cantidad,$idservicio);
			echo $rspta ? "Evento registrado" : "Evento no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($idstock,$id_asientos,$cantidad,$idservicio);
			echo $rspta ? "Evento actualizado" : "Evento no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($ci_persona);
 		echo $rspta ? "Estado Desactivado" : "Estado no se puede desactivar";
	break;

	case 'editarAsistencia':
		$rspta=$articulo->editarAsistencia($idreserva_detalle,$ci_persona);
 		echo $rspta ? "Asistencia Registrada" : "Asistencia no se pudo Registrar";
	break;


	case 'eliminar':
		$rspta=$articulo->eliminar($idstock);
 		echo $rspta ? "Esatdo Eliminado" : "Esatdo no se puede eliminar";
 	
	break;
	
	case 'activar':
		$rspta=$articulo->activar($ci_persona);
 		echo $rspta ? "Estado Actualizado" : "Estadi no se puede actualizar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idreserva_cabecera);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

 		


	case 'listarDetalle':
		//Recibimos el idingreso
		//$i_persona=$_GET['ci_persona'];
		$id_reserva_cabecera=$_GET['id_reserva_cabecera'];

		$rspta = $articulo->listadoOk($id_reserva_cabecera);
	//	$total=0;
		echo '<thead style="background-color:#A9D0F5">
								<th>Id</th>
								<th>Documento</th>
								<th>Nombre</th>
								<th>Asistencia</th>
								<th>Registrar</th>
		
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td>
					</td><td>'.$reg->id_reserva_cabecera.'</td>
					<td>'.$reg->ci_persona.'</td>
					<td>'.$reg->nombre.'</td>
					<td>'.$reg->telefono.'</td>
					<td>'.$reg->asistencia.'</td></tr>';
					
				}
		echo '<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                   
                                </tfoot>';
	break;





	
}
?>