var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})


}

//Función limpiar
function limpiar()
{
	$("#idservicio").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		detalles=0
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{

	tabla=$('#tbllistado').dataTable(
		{
			"aProcessing": true,//Activamos el procesamiento del datatables
			"aServerSide": true,//Paginación y filtrado realizados por el servidor
			dom: 'Bfrtip',//Definimos los elementos del control de tabla
			buttons: [		          
						
					],
			"ajax":
					{
						url: '../ajax/ujieres.php?op=listar',
						type : "get",
						dataType : "json",						
						error: function(e){
							console.log(e.responseText);	
						}
					},
			"bDestroy": true,
			"iDisplayLength": 5,//Paginación
			"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
		}).DataTable();
}

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
		/*$("#correo").val(data.correo);
		$("#direccion").val(data.direccion);
		$("#ciudad").val(data.ciudad);*/
		
		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
	 });
	 
	$.post("../ajax/ujieres.php?op=listarDetalle&id="+idreserva_cabecera,function(r)

	{
		$("#detalles").html(r);
	//	$("#ci_persona").val(data.ci_persona);
	});	


}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
//	$("#btnGuardar").prop("disabled",true);
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



//Función para desactivar registros
function desactivar(idstock)
{
	bootbox.confirm("Cambiar de estado de evento", function(result){
		if(result)
        {
        	$.post("../ajax/consulta.php?op=desactivar", {idstock : idstock}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idstock)
{
	bootbox.confirm("Volver a activar el estado?", function(result){
		if(result)
        {
        	$.post("../ajax/consulta.php?op=activar", {idstock : idstock}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();