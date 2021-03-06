var tabla;

//Funci?n que se ejecuta al inicio
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

//Funci?n limpiar
function limpiar()
{
	$("#idcategoria").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
}

//Funci?n mostrar formulario
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

//Funci?n cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Funci?n Listar
function listar()
{

//	var idservicio = $("#idservicio").val(); 
	//var fecha_inicio = $("#fecha_inicio").val();
	var idservicio = $("#idservicio").val();

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginaci?n y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		          'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/informes.php?op=listar',
					data:{idservicio: idservicio},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginaci?n
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();


}
//Funci?n para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activar? la acci?n predeterminada del evento
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
	$.post("../ajax/informes.php?op=mostrar",{idservicio : idservicio}, function(data, status)
	{
	//	data = JSON.parse(data);		
	//	mostrarform(true);

	//	$("#ausentes").val(data.ausentes);
		$("#presentes").val(data.presentes);
 		$("#idservicio").val(data.idservicio);

	 })
	 
	
}

function mostrars(idservicio)
{
	$.post("../ajax/informes.php?op=mostrar",{idservicio : idservicio}, function(data, status)
	{
	//	data = JSON.parse(data);		
	//	mostrarform(true);

		$("#ausentes").val(data.ausentes);
	//	$("#presentes").val(data.presentes);
 		$("#idservicio").val(data.idservicio);

 	})
}




//Funci?n para activar registros


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

function eliminar(ci_persona,idreserva_cabecera)
{
	bootbox.confirm("?Est? Seguro de elimnar a esta persona?", function(result){
		if(result)
        {
        	$.post("../ajax/informes.php?op=eliminar", {ci_persona : ci_persona,idreserva_cabecera:idreserva_cabecera}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}
init();