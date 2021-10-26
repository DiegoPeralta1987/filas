<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Eventos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    

	public function insertar($evento)
	{
		$sql="INSERT INTO eventos (evento,condicion)
		VALUES ('$evento','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($ideventos,$evento)
	{
		$sql="UPDATE eventos SET  evento='$evento' where ideventos='$ideventos' ";
		return ejecutarConsulta($sql);
    }

    public function listar()
	{
		$sql="SELECT *FROM eventos";
		return ejecutarConsulta($sql);
    }
    public function desactivar($ideventos)
    {
        $sql="UPDATE eventos SET condicion='0' WHERE ideventos='$ideventos'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para activar categorías
    public function activar($ideventos)
    {
        $sql="UPDATE eventos SET condicion='1' WHERE ideventos='$ideventos'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($ideventos)
		{
			$sql="SELECT * FROM eventos WHERE ideventos='$ideventos'";
			return ejecutarConsultaSimpleFila($sql);
		}
    

 
}   