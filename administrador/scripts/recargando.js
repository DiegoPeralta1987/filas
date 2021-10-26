var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	mostrarform2(false);
	listar();

	$("#formulario2").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$.post("../ajax/consulta.php?op=selectAsientos", function(r){
		$("#id_asientos").html(r);
		$('#id_asientos').selectpicker('refresh');

	})

	$.post("../ajax/recargando.php?op=selectServicio", function(r){
		$("#ideventos").html(r);
		$('#ideventos').selectpicker('refresh');

	})

}

//Función limpiar
function limpiar()
{
	$("#id_asientos").val("");
 $("#idservicio").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
 	$("#lugares").val("");
  $("#cantidad").val("");
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
	}
}
function mostrarform2(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros2").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros2").hide();
		$("#btnagregar").show();
		
	}
}
//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform2(false);
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
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/recargando.php?op=listar',
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

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario2")[0]);

	$.ajax({
		url: "../ajax/recargando.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform2(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idservicio)
{
	$.post("../ajax/consulta.php?op=mostrar",{idservicio : idservicio}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		
	
		$("#idservicio").val(data.idservicio);
		$("#cantasiento").val(data.cantasiento);

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide(); 

	 });
	 $.post("../ajax/consulta.php?op=listarDetalle&id="+idservicio,function(r)

	 {
		 $("#detalles").html(r);
	
	 });	
	 
}

//Función para desactivar registros
function desactivar(idservicio)
{
	bootbox.confirm("Cambiar de estado de evento", function(result){
		if(result)
        {
        	$.post("../ajax/consulta.php?op=desactivar", {idservicio : idservicio}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}



function limpiando(idservicio)
{
	bootbox.confirm("Desea bloquear registracion", function(result){
		if(result)
        {
        	$.post("../ajax/consulta.php?op=limpiando", {idservicio : idservicio}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


//Función para activar registros
function activar(idservicio)
{
	bootbox.confirm("Volver a activar el estado?", function(result){
		if(result)
        {
        	$.post("../ajax/consulta.php?op=activar", {idservicio : idservicio}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();