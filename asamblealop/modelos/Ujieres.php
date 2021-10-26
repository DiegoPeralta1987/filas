<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ujieres
{
	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    

	public function insertar($id_asientos,$cantidad,$idservicio)
	{
		$sql="INSERT INTO stock (id_asientos,cantidad,idservicio,estado)
		VALUES ('$id_asientos','$cantidad','$idservicio','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idstock,$id_asientos,$cantidad,$idservicio)
	{
		$sql="UPDATE stock SET id_asientos='$id_asientos',cantidad='$cantidad',
		idservicio='$idservicio' where idstock='$idstock'";
		return ejecutarConsulta($sql);
	}
	public function editarAsistencia($idreserva_cabecera,$ci_persona)
	{ 

		$sql="UPDATE filas.reserva_detalle SET asistencia=1
		 WHERE idreserva_cabecera=$idreserva_cabecera 
		 and ci_persona='$ci_persona'
		 and asistencia=0";
		return ejecutarConsulta($sql);
	}
	
		//Implementamos un método para editar registros
		public function listar()
		{
			$sql="SELECT re.idreserva_cabecera,re.ci_titular,de.nombre, 
          re.che,re.idservicio,s.fecha,re.estado,re.cod_lugar,ev.evento
          FROM filas.reserva_cabecera re
          INNER JOIN reserva_detalle de on re.ci_titular= de.ci_persona
          INNER JOIN servicios s on re.idservicio=s.idservicio
          INNER JOIN eventos ev on s.ideventos=ev.ideventos
          WHERE de.idreserva_cabecera=re.idreserva_cabecera and s.estado=1 
          GROUP BY   re.idreserva_cabecera,re.ci_titular,de.nombre,
           re.che,re.idservicio,s.fecha,re.estado,ev.evento ";
			return ejecutarConsulta($sql);		
		} 
	
		public function desactivar($ci_persona)
		{
			$sql="UPDATE reserva_detalle SET asistencia=0 WHERE ci_persona='$ci_persona'";
			return ejecutarConsulta($sql);
		}
	
		//Implementamos un método para activar categorías
		public function activar($ci_persona, $idreserva_cabecera)
		{
			$sql="UPDATE reserva_detalle SET asistencia=1 ,fechaModificada=CURRENT_TIMESTAMP()  WHERE  ci_persona='$ci_persona'  and idreserva_cabecera='$idreserva_cabecera'";
			return ejecutarConsulta($sql);
		}
	
		//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrar($idreserva_cabecera)
		{
			$sql="SELECT idreserva_cabecera,ci_persona, nombre,telefono,correo,
			direccion, ciudad,asistencia
			FROM filas.reserva_detalle
			WHERE idreserva_cabecera='$idreserva_cabecera'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function eliminar($idstock)
		{
			$sql="DELETE FROM	 stock WHERE idstock='$idstock'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function listarDetalle($idreserva_cabecera)
		{
			$sql="SELECT idreserva_cabecera,ci_persona, nombre,telefono,correo,
			direccion, ciudad,asistencia
			FROM filas.reserva_detalle
			WHERE idreserva_cabecera='$idreserva_cabecera'";
			return ejecutarConsultaSimpleFila($sql); 
		}

		public function servicios()
		{
			$sql="SELECT idservicio, fecha, horario FROM filas.servicios where estado=1";
			return ejecutarConsulta($sql);
		}
    
		public function listadoOk($idreserva_cabecera)
		{
			$sql="SELECT idreserva_cabecera,ci_persona, nombre,telefono,correo,
		direccion, ciudad,asistencia
		FROM filas.reserva_detalle
		WHERE  idreserva_cabecera='$idreserva_cabecera' ";
			return ejecutarConsulta($sql);
	}


	public function listadk()
	{
		$sql="SELECT idreserva_cabecera,ci_persona, nombre,telefono,correo,
	direccion, ciudad,asistencia
	FROM filas.reserva_detalle";
		return ejecutarConsulta($sql);
}
}