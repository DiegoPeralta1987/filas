<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Servicios
{
	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    

	public function insertar($fecha,$horario,$ideventos)
	{
		$sql="INSERT INTO servicios (fecha,horario,ideventos,estado)
		VALUES ('$fecha','$horario','$ideventos','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idservicio,$fecha,$horario,$ideventos)
	{
		$sql="UPDATE servicios SET  fecha='$fecha',horario='$horario', ideventos='$ideventos' where idservicio='$idservicio' ";
		return ejecutarConsulta($sql);
    }

    public function listar()
	{
		$sql="SELECT s.idservicio, s.fecha, s.horario, e.evento, s.estado
     FROM servicios s 
     INNER JOIN eventos e on s.ideventos=e.ideventos
     where e.condicion=1 and s.estado=1 ";
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

    public function mostrar($idservicio)
		{
			$sql="SELECT * FROM servicios WHERE idservicio='$idservicio'";
			return ejecutarConsultaSimpleFila($sql);
		}
    
    public function selectEvento()
		{
			$sql="SELECT * FROM eventos WHERE condicion='1' ";
			return ejecutarConsulta($sql);
		}

 
}   