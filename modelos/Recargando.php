<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Recargando
{
	//Implementamos nuestro constructor
	public function __construct()  
	{

    }
    

	public function insertar($fecha,$anho,$mes,$semana,$dia,$turno,$cantidad,$evento,$ideventos)
	{
	$sql="INSERT INTO asistencia_culto (fecha,anho,mes,semana,dia,turno,cantidad,evento,ideventos)
		VALUES ('$fecha','$anho','$mes','$semana','$dia','$turno',$cantidad,'$evento',$ideventos)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idstock,$id_asientos,$cantidad,$idservicio)
	{
		$sql="UPDATE stock SET id_asientos='$id_asientos',cantidad='$cantidad',
		idservicio='$idservicio' where idstock='$idstock'";
		return ejecutarConsulta($sql);
	}
 
 
  public function limpiar($idservicio)
	{

		$sql="UPDATE stock SET cantidad=0  where idservicio='$idservicio'";
		return ejecutarConsulta($sql);
	}
 	
	public function consultaEventos($ideventos)
	{
		$sql="SELECT * FROM eventos where ideventos=$ideventos";
		return ejecutarConsulta($sql);
	}
 
 	public function consultaDia($fecha)
	{
		$sql="SELECT DAYNAME('$fecha') as dia, monthname('$fecha') as mes, WEEK('$fecha', 5) - WEEK(DATE_SUB('$fecha', INTERVAL DAYOFMONTH('$fecha') - 1 DAY), 5) + 1 as semana,year('$fecha') as ano";
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

		public function listarEventos()
		{
			$sql="SELECT * FROM asistencia_culto;";
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
			$sql="SELECT * FROM eventos where condicion=1";
			return ejecutarConsulta($sql);
		}
    
    

}