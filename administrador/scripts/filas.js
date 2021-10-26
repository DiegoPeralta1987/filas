var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
 listarAu();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	$.post("../ajax/consulta.php?op=selectServicio", function(r){
		$("#idservicio").html(r);
		$('#idservicio').selectpicker('refresh');

	})
}

//Función limpiar
function limpiar()
{
	$("#idcategoria").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").show();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();

	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listarAu()
{

//	var idservicio = $("#idservicio").val(); 
	//var fecha_inicio = $("#fecha_inicio").val();
	var idservicio = $("#idservicio").val();

	tabla=$('#tbllistado2').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		        
		        ],
		"ajax":
				{
					url: '../ajax/informes.php?op=ausentes',
					data:{idservicio: idservicio},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
 

}

function listar()
{

//	var idservicio = $("#idservicio").val(); 
	//var fecha_inicio = $("#fecha_inicio").val();
	var idservicio = $("#idservicio").val();

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		          'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/informes.php?op=filasColumnas',
					data:{idservicio: idservicio},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
 //listarAu();

}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/categoria.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function presentes(idservicio)
{

	$.post("../ajax/informes.php?op=presentes",{idservicio : idservicio}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

	//	$("#ausentes").val(data.ausentes);
		$("#presentes").val(data.presentes);
 		$("#idservicio").val(data.idservicio);

	 })
	
	
}

function ausentes(idservicio)
{

	$.post("../ajax/informes.php?op=ausentes",{idservicio : idservicio}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#ausentes").val(data.ausentes);
	//	$("#presentes").val(data.presentes);
 	$("#idservicio").val(data.idservicio);

 	});
}




//Función para activar registros


function activar(ci_persona,idreserva_cabecera)
{
	

			$.post("../ajax/informes.php?op=activar", {ci_persona : ci_persona, idreserva_cabecera:idreserva_cabecera}, function(e){
				//bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
  
	
}



function desactivar(ci_persona,idreserva_cabecera)
{


			$.post("../ajax/informes.php?op=desactivar", {ci_persona : ci_persona, idreserva_cabecera:idreserva_cabecera}, function(e){
			//	bootbox.alert(e);
				tabla.ajax.reload();
			});	

}
init();