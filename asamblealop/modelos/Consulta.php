<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consulta
{
	//Implementamos nuestro constructor
	public function __construct()  
	{

    }
    

	public function insertar($id_asientos,$cantidad,$lugares,$idservicio)
	{
		$sql="INSERT INTO stock (id_asientos,cantidad,total,lugares,idservicio,estado)
		VALUES ('$id_asientos','$cantidad','$cantidad','$lugares','$idservicio','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idstock,$id_asientos,$cantidad,$idservicio)
	{
		$sql="UPDATE stock SET id_asientos='$id_asientos',cantidad='$cantidad',
		idservicio='$idservicio' where idstock='$idstock'";
		return ejecutarConsulta($sql);
	}
		//Implementamos un método para editar registros
		public function mostrar($idservicio)
		{
			$sql="SELECT s.idstock,s.id_asientos,s.cantidad as cantasiento,s.cant_reserva,
			s.idservicio,s.estado, a.cantidad,se.fecha, se.horario
			FROM stock s
			INNER JOIN asientos a on s.id_asientos=a.id_asientos
			INNER JOIN servicios se on s.idservicio=se.idservicio
			WHERE s.idservicio='$idservicio'";
			return ejecutarConsulta($sql);		
		}

		public function listarDetalle($idservicio)
		{
			$sql="
			SELECT s.idstock,s.id_asientos,s.cantidad as cantasiento,
            s.cant_reserva,s.lugares,s.lugares_ocupados,
			s.idservicio,s.estado, a.cantidad,se.fecha, se.horario
			FROM stock s
			INNER JOIN asientos a on s.id_asientos=a.id_asientos
			INNER JOIN servicios se on s.idservicio=se.idservicio
			WHERE s.idservicio='$idservicio'";
			return ejecutarConsulta($sql);		
		}

		public function listarServicio()
		{
			$sql="SELECT s.idservicio, s.fecha, s.horario, e.evento, s.estado
     FROM servicios s 
     INNER JOIN eventos e on s.ideventos=e.ideventos
      ORDER BY s.estado desc";
			return ejecutarConsulta($sql);		
		}
	
		public function desactivar($idservicio)
		{
			$sql="UPDATE servicios SET estado='0' WHERE idservicio='$idservicio'";
			return ejecutarConsulta($sql);
		}
	
		//Implementamos un método para activar categorías
		public function activar($idservicio)
		{
			$sql="UPDATE servicios SET estado='1' WHERE idservicio='$idservicio'";
			return ejecutarConsulta($sql);
		}
	
		//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrarNO($idstock)
		{
			$sql="SELECT * FROM stock WHERE idstock='$idstock'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function eliminar($idstock)
		{
			$sql="DELETE FROM	 stock WHERE idstock='$idstock'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function asientos()
		{
			$sql="SELECT id_asientos, cantidad FROM asientos where estado=1";
			return ejecutarConsulta($sql);
		}

		public function servicios()
		{
			$sql="SELECT s.idservicio, s.fecha, s.horario, e.evento
			FROM filas.servicios s
			INNER JOIN eventos e on s.ideventos=e.ideventos
			where s.estado=1 and e.condicion=1";
			return ejecutarConsulta($sql);
		}
    
    

}