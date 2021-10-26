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
		
		$rspta=$categoria->desactivar($ci_persona,$idreserva_cabecera);
 	  // echo $rspta ? "Asistencia Cancelada" : "Asistencia no se puede Cancelar";
	break;
	
	case 'activar':
	
		$rspta=$categoria->activar($ci_persona, $idreserva_cabecera);
	   // echo $rspta ? "Asistencia Registrada" : "Asistencia no se puede Registrar";
	break;

	case 'eliminar':
		$rspta=$categoria->eliminar($ci_persona, $idreserva_cabecera);
 		echo $rspta ? "Persona Eliminada" : "Persona no se puede eliminar";
 	
	break;
 
 	case 'presentes':
		$rspta=$categoria->presentes(idservicio);
 		echo $rspta ? "Persona Eliminada" : "Persona no se puede eliminar";
 	
	break;

 	case 'ausentes':
		$idservicio=$_GET["idservicio"];
	//	$idservicio=$_GET["idservicio"];

		$rspta=$categoria->ausentes($idservicio);
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
			 $data[]=array(
				"0"=>$reg->presente,
        "1"=>$reg->ausente,
        "2"=>$reg->total
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;


	case 'listar':
		$fecha_inicio=$_REQUEST["idservicio"];
	//	$idservicio=$_GET["idservicio"];

		$rspta=$categoria->listar($fecha_inicio);
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
			 $data[]=array(
				"0"=>($reg->asistencia)?'<button class="btn btn-warning"  onclick="desactivar('.$reg->ci_persona.','.$reg->idreserva_cabecera.')"><i class="fa fa-close"></i></button>':
				'<button class="btn bg-blue"  onclick="activar('.$reg->ci_persona.','.$reg->idreserva_cabecera.')"><i class="fa fa-check"></i></button>'.
        '<button class="btn btn-danger" onclick="eliminar('.$reg->ci_persona.','.$reg->idreserva_cabecera.')"><i class="fa fa-trash"></i></button>',
				
				"1"=>$reg->ci_persona,
				"2"=>$reg->doctype,
				"3"=>$reg->nombre,
				"4"=>$reg->telefono,
				"5"=>$reg->cod_lugar,
        "6"=>$reg->feha,
				"7"=>($reg->asistencia==0)?'<span class="label bg-red">Ausente</span>':
				'<span class="label bg-green">Presente</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
 
 case 'total':
	//	$fecha_inicio=$_REQUEST["idservicio"];
	//	$idservicio=$_GET["idservicio"];

		$rspta=$categoria->total();
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
			 $data[]=array(
				"0"=>($reg->asistencia)?'<button class="btn btn-warning"  onclick="('.$reg->idreserva_detalle.')"><i class="fa fa-close"></i></button>':
				'<button class="btn bg-blue"  onclick="('.$reg->idreserva_detalle.')"><i class="fa fa-check"></i></button>',
       
				
				"1"=>$reg->ci_persona,
				"2"=>$reg->doctype,
				"3"=>$reg->nombre,
				"4"=>$reg->telefono,
				"5"=>$reg->correo,
        "6"=>$reg->direccion,
        "7"=>$reg->ciudad,
        "8"=>$reg->fecha,
        "9"=>$reg->horario,
        "10"=>$reg->evento,
				"11"=>($reg->asistencia==0)?'<span class="label bg-red">Ausente</span>':
				'<span class="label bg-green">Presente</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
 
  case 'controlAsistencia':
	//	$fecha_inicio=$_REQUEST["idservicio"];
	//	$idservicio=$_GET["idservicio"];

		$rspta=$categoria->controlAsistencia();
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
			 $data[]=array(
				"0"=>($reg->asistencia)?'<button class="btn btn-warning"  onclick="('.$reg->idreserva_detalle.')"><i class="fa fa-close"></i></button>':
				'<button class="btn bg-blue"  onclick="('.$reg->idreserva_detalle.')"><i class="fa fa-check"></i></button>',
       
				
				"1"=>$reg->ci_persona,
				"2"=>$reg->nombre,
        "3"=>$reg->telefono,
				"4"=>$reg->fecha,
				"5"=>$reg->horario,
				"6"=>$reg->evento,
     		"7"=>($reg->asistencia==0)?'<span class="label bg-red">Ausente</span>':
				'<span class="label bg-green">Presente</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
 
 	case 'listar2':
		$fecha_inicio=$_REQUEST["idservicio"];
	//	$idservicio=$_GET["idservicio"];

		$rspta=$categoria->listar($fecha_inicio);
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
			 $data[]=array(
				"0"=>($reg->asistencia)?'<button class="btn btn-warning"  onclick="desactivar('.$reg->ci_persona.','.$reg->idreserva_cabecera.')"><i class="fa fa-close"></i></button>':
				'<button class="btn bg-blue"  onclick="activar('.$reg->ci_persona.','.$reg->idreserva_cabecera.')"><i class="fa fa-check"></i></button>',
				
				"1"=>$reg->ci_persona,
				"2"=>$reg->doctype,
				"3"=>$reg->nombre,
				"4"=>$reg->telefono,
				"5"=>$reg->cod_lugar,
				"6"=>($reg->asistencia==0)?'<span class="label bg-red">Ausente</span>':
				'<span class="label bg-green">Presente</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
 
 
 case 'listadoMixtoA':
		
	//	$idservicio=$_GET["idservicio"];

		$rspta=$categoria->listadoMixtoA();
 		//Vamos a declarar un array
 	
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
			 $data[]=array(
				"0"=>($reg->asistencia)?'<button class="btn btn-warning"  onclick="desactivar('.$reg->ci_persona.','.$reg->idreserva_cabecera.')"><i class="fa fa-close"></i></button>':
				'<button class="btn bg-blue"  onclick="activar('.$reg->ci_persona.','.$reg->idreserva_cabecera.')"><i class="fa fa-check"></i></button>',
				
				"1"=>$reg->ci_persona,
				"2"=>$reg->doctype,
				"3"=>$reg->nombre,
				"4"=>$reg->telefono,
				"5"=>$reg->cod_lugar,
				"6"=>$reg->evento,
				"7"=>($reg->asistencia==0)?'<span class="label bg-red">Ausente</span>':
				'<span class="label bg-green">Presente</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Informaci?n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
 
  
 case 'filasColumnas':
		
	//	$idservicio=$_GET["idservicio"];

		$rspta=$categoria->filasColumnas();
 		//Vamos a declarar un array
 	
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
			 $data[]=array(
				"0"=>($reg->asistencia)?'<button class="btn btn-warning"  onclick="('.$reg->ci_persona.')"><i class="fa fa-close"></i></button>':
				'<button class="btn bg-blue"  onclick="('.$reg->ci_persona.')"><i class="fa fa-check"></i></button>',
				
				"1"=>$reg->ci_persona,
				"2"=>$reg->nombre,
        "3"=>$reg->presente,
		  	"4"=>$reg->total
			
			
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Informaci?n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>