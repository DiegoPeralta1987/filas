<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consulta
{
	//Implementamos nuestro constructor
	public function __construct()  
	{

    }
    
//total usuario
		public function cantUsuario()
		{
			$sql="select count(*) as tot_us from usuario where condicion=1";
			return ejecutarConsulta($sql);	
		}
    
    // total eventos registrados
		public function cantServ()
		{
			$sql="select count(*) as tot_ser from servicios";
			return ejecutarConsulta($sql);	
		}
//total personas catastradas
		public function cantPer()
		{
			$sql="SELECT count(*) as tot_per FROM personas";
			return ejecutarConsulta($sql);
		}

		//funcion que cuenta inscriptos por eventos

		public function totEvento()
		{
			$sql="SELECT evento,count(*) tot_ins FROM filas.v_reservas group by evento";
			return ejecutarConsulta($sql);
		}
//total asistencia presencia y ausencia
		public function totAsistencia(){
			$sql="SELECT 'Presente' as asistencia,count(a.ci_persona) as total_asis from
				(select ci_persona,count(*) tot_asistencia 
				from filas.v_reservas 
				where asistencia='Presente' group by ci_persona)a
					union all
				select 'Ausente' as asistencia,count(a.ci_persona) as total_asis from
				(select ci_persona,count(*) tot_asistencia 
				from filas.v_reservas 
				where asistencia='Ausente' group by ci_persona)a";

				return ejecutarConsulta($sql);
		}

		public function totMes(){
			$sql="SELECT month(feha) as mes,count(*) total FROM filas.v_reservas group by month(feha)";
			return ejecutarConsulta($sql);
		}
}