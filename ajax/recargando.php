<?php 
require_once "../modelos/Recargando.php";

$articulo = new Recargando();
//$ididservicio,$id_asientos,$cantidad,$cant_reserva,$idservicio

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$turno=isset($_POST["turno"])? limpiarCadena($_POST["turno"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$ideventos=isset($_POST["ideventos"])? limpiarCadena($_POST["ideventos"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
	    
        

		if (empty($id)){
   
         $ideventos=$_POST['ideventos'];
		  	$rsptass=$articulo->consultaEventos($ideventos);
     
			  $fetch=$rsptass->fetch_object();
			if (isset($fetch)>0){
				$cantidadi['evento']=$fetch->evento;
				$evento=$fetch->evento;
        }
        
        $fecha=$_POST['fecha'];
		  	$rsptas=$articulo->consultaDia($fecha);
			  $fetchc=$rsptas->fetch_object();
       
			if (isset($fetchc)>0){
				$cantidadi['dia']=$fetchc->dia;
        $cantidadi['mes']=$fetchc->mes;
        $cantidadi['semana']=$fetchc->semana;
        $cantidadi['ano']=$fetchc->ano;
				$dia=$fetchc->dia;
        $mes=$fetchc->mes;
        $semana=$fetchc->semana;
        $anho=$fetchc->ano;
    
        }
        //Thursday
        //October
    
        
        switch($dia){
          case Monday:
            $diaa='Lunes';
          break;
          case Tuestday:
            $diaa='Martes';
          break;
          case Wednesday:
            $diaa='Miercoles';
          break;
          case Thursday:
            $diaa='Jueves';
          break;
          case Friday:
            $diaa='Viernes';
          break;
          case Saturday:
            $diaa='Sabado';
          break;
           case Sunday:
            $diaa='Domingo';
          break;
        }
        
            switch($mes){
          case Juanary:
            $mess='ENERO';
          break;
          case February:
            $mess='FEBRERO';
          break;
          case March:
            $mess='MARZO';
          break;
          case April:
            $mess='ABRIL';
          break;
          case May:
            $mess='MAYO';
          break;
          case June:
            $mess='JUNIO';
          break;
           case July:
            $mess='JULIO';
          break;
            case August:
            $mess='AGOSTO';
          break;
            case September:
            $mess='SEPTIEMBRE';
          break;
            case October:
            $mess='OCTUBRE';
          break;
            case November:
            $mess='NOVIEMBE';
          break;
            case December:
            $mess='DICIEMBRE';
          break;
        }
        
      	$rspta=$articulo->insertar($fecha,$anho,$mess,$semana,$diaa,$turno,$cantidad,$evento,$ideventos);
			echo $rspta ? "Evento registrado" : "Evento no se pudo registrar";
		}
		else {
		
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
		$rspta=$articulo->listarEventos();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->id)?'<button class="btn btn-success" ><i class="fa fa-check" title="Visualizar Cantidad"></i></button>':
 					' <button class="btn btn-danger" ><i class="fa fa-times" title="Cerrar Evento"></i></button>',
 	
 				"1"=>$reg->anho,
			  "2"=>$reg->mes,
	  	  "3"=>$reg->dia,
 				"4"=>$reg->turno, 
 				"5"=>$reg->cantidad,
        "6"=>$reg->evento
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	
	case "selectServicio":
	
		$rspta = $articulo->servicios();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' .$reg->ideventos. '>'  .$reg->evento. '</option>';
				}
	break;
	
}
?>