<?php 
require_once "../modelos/Ujieres.php";

$articulo = new Ujieres();
//$ididservicio,$id_asientos,$cantidad,$cant_reserva,$idservicio

$idreserva_cabecera=isset($_POST["idreserva_cabecera"])? limpiarCadena($_POST["idreserva_cabecera"]):"";
//$idreserva_cabecera=isset($_POST["idreserva_cabecera"])? limpiarCadena($_POST["idreserva_cabecera"]):"";
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
 	    echo $rspta ? "Asistencia Cancelada" : "Asistencia no se puede Cancelar";
	break;
	
	case 'activar':
		$rspta=$articulo->activar($ci_persona, $idreserva_cabecera);
	    echo $rspta ? "Asistencia Registrada" : "Asistencia no se puede Registrar";
	break;
	
	case 'editarAsistencia':
		$rspta=$articulo->editarAsistencia($idreserva_cabecera,$ci_persona);
		 echo $rspta ? "Asistencia Registrada" : "Asistencia no se pudo Registrar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idreserva_cabecera);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	/*
	'<a  href="'.$url.$reg->idreserva_cabecera.'"> <button class="btn btn-danger"><i class="fa fa-eye"></i></button></a>':
					 '<a  href="'.$url.$reg->idreserva_cabecera.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'
	*/
 		
	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();
		 $url='../administrador/detalles.php?idreserva_cabecera=';
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				 "0"=>($reg->estado==0)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idreserva_cabecera.')"><i class="fa fa-eye"></i></button>':
				 '<button class="btn btn-warning" onclick="mostrar('.$reg->idreserva_cabecera.')"><i class="fa fa-eye"></i></button>',
 	
 				"1"=>$reg->ci_titular,
 				"2"=>$reg->nombre,
 				"3"=>$reg->che,
 				"4"=>$reg->cod_lugar,
        "5"=>$reg->fecha
 			
 				);
 		}   
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listarDetallee':
		//Recibimos el idingreso
		//$i_persona=$_GET['ci_persona'];
		$id=$_GET['id'];

		
		$rspta = $articulo->listadoOk($id);
	//	$total=0;
		echo '<thead style="background-color:#A9D0F5">
							
								<th>Documento</th>
								<th>Nombre</th>
								<th>Telefono</th>
								<th>Asistencia</th>
								<th>Registrar</th>
		
								</thead>';
								
			
		while ($reg = $rspta->fetch_object())
				{
					
			echo '
			
			<tr class="filas">
		
			<td>'.$reg->ci_persona.'</td>
			<td>'.$reg->nombre.'</td>
			<td>'.$reg->telefono.'</td>
			<td>'.$reg->asistencia.'</td>
			<td>'.'<button class="btn btn-warning" onclick="activar('.$reg->ci_persona.','.$reg->idreserva_cabecera.')"><i class="fa fa-check"></i></button>'.
			'<button class="btn btn-danger" onclick="desactivar('.$reg->ci_persona.')"><i class="fa fa-close"></i></button>'.'</td>
		
				 </tr>';
					
				}
			/// "3"=>($reg->horario=='10:00:00')?'<span class="label bg-yellow">AM</span>':'<span class="label bg-blue">PM</span>'

		echo '<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                    
                                   
								</tfoot>';
		
		
	break;


	case 'listarDetalle':
		//Recibimos el idingreso
		//$i_persona=$_GET['ci_persona'];
		$id=$_GET['id'];

		$rspta = $articulo->listadoOk($id);
	//	$total=0;
		echo '<thead style="background-color:#A9D0F5">
							
								<th>Documento</th>
								<th>Nombre</th>
								<th>Telefono</th>
								<th>Asistencia</th>
								<th>Registrar</th>
		
								</thead>';
								
			
		while ($reg = $rspta->fetch_object())
				{
					
			echo '
			
			<tr class="filas">
		
			<td>'.$reg->ci_persona.'</td>
			<td>'.$reg->nombre.'</td>
			<td>'.$reg->telefono.'</td>
			<td>'.$reg->asistencia.'</td>
			<td>'.'<button class="btn btn-warning" 
			onclick="editarAsistencia('.$reg->idreserva_cabecera.')"><i class="fa fa-check"></i></button>'.'</td>
		
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

	case 'listadoOk':

		
		$rspta=$articulo->listar();
		//Vamos a declarar un array
		$data= Array();
		$url='../administrador/detalles.php?idreserva_cabecera=';
		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>($reg->estado==0)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idreserva_cabecera.')"><i class="fa fa-eye"></i></button>':
				'<button class="btn btn-warning" onclick="mostrar('.$reg->idreserva_cabecera.')"><i class="fa fa-eye"></i></button>',
	
				"1"=>$reg->ci_titular,
				"2"=>$reg->nombre,
				"3"=>$reg->che,
				"4"=>$reg->evento,
        "5"=>$reg->fecha
			
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
					echo '<option value=' . $reg->idservicio . '>' . $reg->fecha . '|-|' .$reg->horario. '</option>';
				}
	break;
	
}
?>