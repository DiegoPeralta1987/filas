var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(true);
//	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	$.post("../ajax/consulta.php?op=selectServicio", function(r){
		$("#idservicio").html(r);
		$('#idservicio').selectpicker('refresh');

	});
 

}

//Función limpiar
function limpiar()
{
	$("#ci_persona").val("");
	$("#nombre").val("");
	$("#telefono").val("");
	$("#correo").val("");
	$("#direccion").val("");
	$("#ciudad").val("");
// $("#idservicio").selectpicker('refresh');
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
		$("#btnagregar").show();
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
function listar()
{

	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();
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
					url: '../ajax/asientos.php?op=listar',
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
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/registro.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	      //    mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(id_asientos)
{
	$.post("../ajax/asientos.php?op=mostrar",{id_asientos : id_asientos}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#cantidad").val(data.cantidad);
		
 		$("#idasientos").val(data.id_asientos);

 	})
}

//Función para desactivar registros
function desactivar(id_asientos)
{
	bootbox.confirm("Cambiar de estado de evento", function(result){
		if(result)
        {
        	$.post("../ajax/asientos.php?op=desactivar", {id_asientos : id_asientos}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(id_asientos)
{
	bootbox.confirm("Volver a activar el estado?", function(result){
		if(result)
        {
        	$.post("../ajax/asientos.php?op=activar", {id_asientos : id_asientos}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


 
$(function()  {
  
           $("#ci_persona").autocomplete({
                source: "busqueConsulta.php",
                minLength: 2,
                select: function(event, ui) {
          event.preventDefault();
     
         $('#ci_persona').val(ui.item.ci_persona);
					$('#nombre').val(ui.item.nombre);
					$('#telefono').val(ui.item.telefono);
					$('#direccion').val(ui.item.direccion);
					$('#ciudad').val(ui.item.ciudad);
					$('#correo').val(ui.item.correo);
         			
			     }
			     
  
            });
      
    });


init();