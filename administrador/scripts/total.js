var tabla;

//Funci�n que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	$.post("../ajax/consulta.php?op=selectServicio", function(r){
		$("#idservicio").html(r);
		$('#idservicio').selectpicker('refresh');

	})
}

//Funci�n limpiar
function limpiar()
{
	$("#idcategoria").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
}

//Funci�n mostrar formulario
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

//Funci�n cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Funci�n Listar
function listar()
{

//	var idservicio = $("#idservicio").val(); 
	//var fecha_inicio = $("#fecha_inicio").val();
	var idservicio = $("#idservicio").val();

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginaci�n y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		          'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/informes.php?op=total',
					data:{idservicio: idservicio},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginaci�n
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();


}
//Funci�n para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activar� la acci�n predeterminada del evento
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

function mostrar(idservicio)
{

}

function mostrars(idservicio)
{
}




//Funci�n para activar registros


function activar(ci_persona,idreserva_cabecera)
{
	

	
}



function desactivar(ci_persona,idreserva_cabecera)
{


}

function eliminar(ci_persona,idreserva_cabecera)
{
}
init();