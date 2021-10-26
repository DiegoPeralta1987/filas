var tabla;

//Función que se ejecuta al inicio
function init(){
    mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});


}

//Función limpiar
function limpiar()
{
	$("#asistencia").val("");

}
//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#btncliente").show();
		 ///$("#nuevoValor").show();
 

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
		detalles=0;
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}
//Función mostrar formulario
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{

//	var fecha_inicio = $("#fecha_inicio").val();
//	var fecha_fin = $("#fecha_fin").val();
	//var idenvios = $("#idcliente").val();

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		      /*     'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'*/
		        ],
		"ajax":
				{
					url: '../ajax/ujieres.php?op=listadoOk',
				//	data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
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
//Función para guardar o editar
/*
function guardaryeditar(e)
{
	var idreserva_cabecera=$("#idreserva_cabecera").val();
	var ci_persona=$("#ci_persona").val();
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ujieres.php?op=editarAsistencia",
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
*/



function mostrar(idreserva_cabecera)
{
	$.post("../ajax/ujieres.php?op=mostrar",{idreserva_cabecera : idreserva_cabecera}, 
	function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idreserva_cabecera").val(data.idreserva_cabecera);
		$("#ci_persona").val(data.ci_persona);
		$("#nombre").val(data.nombre);
		$("#telefono").val(data.telefono);
		
		
		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
	 });

	$.post("../ajax/ujieres.php?op=listarDetallee&id="+idreserva_cabecera,function(r){
		$("#detalles").html(r);
});	
}

function recargar(){
	tabla.ajax.reload();
//	location.reload(true);
}

function desactivar(ci_persona)
{
	//var formData = new FormData($("#formulario")[0]);
	bootbox.confirm("Cancelar asistencia?", function(result){
		if(result)
        {
        	$.post("../ajax/ujieres.php?op=desactivar", {ci_persona : ci_persona}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})

}

//Función para activar registros
function activar(ci_persona,idreserva_cabecera)
{
	bootbox.confirm("Tomar asistencia de esta persona?", function(result){
		if(result)
        {
        	$.post("../ajax/ujieres.php?op=activar", {ci_persona : ci_persona,idreserva_cabecera:idreserva_cabecera}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})


	
}



init();