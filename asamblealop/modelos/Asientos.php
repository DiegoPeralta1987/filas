<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Asientos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    

	public function insertar($cantidad)
	{
		$sql="INSERT INTO asientos (cantidad,estado)
		VALUES ('$cantidad','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_asientos,$cantidad)
	{
		$sql="UPDATE asientos SET  cantidad='$cantidad' where id_asientos='$id_asientos' ";
		return ejecutarConsulta($sql);
    }

    public function listar()
	{
		$sql="SELECT *FROM asientos";
		return ejecutarConsulta($sql);
    }
    public function desactivar($id_asientos)
    {
        $sql="UPDATE asientos SET estado='0' WHERE id_asientos='$id_asientos'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para activar categorías
    public function activar($id_asientos)
    {
        $sql="UPDATE asientos SET estado='1' WHERE id_asientos='$id_asientos'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($id_asientos)
		{
			$sql="SELECT * FROM asientos WHERE id_asientos='$id_asientos'";
			return ejecutarConsultaSimpleFila($sql);
		}
    

 
}   