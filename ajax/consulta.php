<?php 
require_once "../modelos/Consulta.php";

$articulo = new Consulta();
//$ididservicio,$id_asientos,$cantidad,$cant_reserva,$idservicio

$idstock=isset($_POST["idstock"])? limpiarCadena($_POST["idstock"]):"";
$id_asientos=isset($_POST["id_asientos"])? limpiarCadena($_POST["id_asientos"]):"";
$lugares=isset($_POST["lugares"])? limpiarCadena($_POST["lugares"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$cant_reserva=isset($_POST["cant_reserva"])? limpiarCadena($_POST["cant_reserva"]):"";
$idservicio=isset($_POST["idservicio"])? limpiarCadena($_POST["idservicio"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$horario=isset($_POST["horario"])? limpiarCadena($_POST["horario"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
	    //$rspta=$articulo->select($id_asientos,$cantidad)


		if (empty($idstock)){
			$rspta=$articulo->insertar($id_asientos,$cantidad,$lugares,$idservicio);
			echo $rspta ? "Evento registrado" : "Evento no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($idstock,$id_asientos,$cantidad,$lugares,$idservicio);
			echo $rspta ? "Evento actualizado" : "Evento no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idservicio);
 		echo $rspta ? "Estado Desactivado" : "Estado no se puede desactivar";
	break;


	case 'eliminar':
		$rspta=$articulo->eliminar($idstock);
 		echo $rspta ? "Esatdo Eliminado" : "Esatdo no se puede eliminar";
 	
	break;
	
	case 'activar':
		$rspta=$articulo->activar($idservicio);
 		echo $rspta ? "Estado Actualizado" : "Estadi no se puede actualizar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idservicio);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'limpiando':
		$rspta=$articulo->limpiar($idservicio);
 		//Codificar el resultado utilizando json
 			echo $rspta ? "Cantidad Bloqueada" : "Canitdad no se puede bloquear";
	break;
 
	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $articulo->listarDetalle($id);
		
		echo '<thead style="background-color:#A9D0F5">
									<th>Grupo Personas</th>
                                    <th>L. Disponible</th>
                                    <th>L. Reservado</th>
                                    <th>Fecha</th>
                                    <th>Horario</th>
                              
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas">
					
					<td>'.$reg->cantidad.'</td>
					<td>'.$reg->cantasiento.'</td>
					<td>'.$reg->cant_reserva.'</td>
					<td>'.$reg->fecha.'</td>
					<td>'.$reg->horario.'</td>
					</tr>';
					
				}
		echo '<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                  
                                </tfoot>';
	break;
 		
	case 'listar':
		$rspta=$articulo->listarServicio();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idservicio.')"><i class="fa fa-eye" title="Visualizar Cantidad"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idservicio.')"><i class="fa fa-times" title="Cerrar Evento"></i></button>'.
           ' <button class="btn btn-success" onclick="limpiando('.$reg->idservicio.')"><i class="fa fa-recycle" title="Bloquear Inscripcion"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idservicio.')"><i class="fa fa-eye" title="Visualizar Cantidad"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idservicio.')"><i class="fa fa-check" title="Habilitar Evento"></i></button> '.
           ' <button class="btn btn-success" onclick="limpiando('.$reg->idservicio.')"><i class="fa fa-recycle" title="Bloquear Inscripcion"></i></button>',
 	
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



	case "selectAsientos":
		require_once "../modelos/Consulta.php";

		$articulo = new Consulta();

		$rspta = $articulo->asientos();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_asientos . '>' .$reg->cantidad.  '</option>';
				}
	break;
	
	case "selectServicio":
		require_once "../modelos/Consulta.php";
		$articulo = new Consulta();

		$rspta = $articulo->servicios();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' .$reg->idservicio. '>' . $reg->fecha. '-' .$reg->horario. '-' .$reg->evento. '</option>';
				}
	break;
	
}
?>