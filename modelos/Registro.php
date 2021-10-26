<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Registro
{
	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    

	public function insertar($ci_persona,$idservicio,$doctype,$nombre,$telefono,$correo,$direccion,$ciudad)
	{
		$sql="INSERT INTO reserva_cabecera (ci_titular,idservicio)
		VALUES ('$ci_persona','$idservicio')";
		$idventanew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true; 

		while ($num_elementos < count($idservicio))
		{
			$sql_detalle = "INSERT INTO reserva_detalle(idreserva_cabecera, ci_persona,doctype,nombre,telefono,correo,direccion,ciudad,idservicio,asistencia,fechaCulto,culto)
             VALUES ('$idventanew', '$ci_persona','$doctype','$nombre',
             '$telefono','$correo','$direccion','$ciudad','$idservicio',1,CURRENT_TIMESTAMP(),1)";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		} 

		return $sw;
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