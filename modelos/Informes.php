<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Informes
{
	//Implementamos nuestro constructor
	public function __construct()  
	{

    }
    

	public function insertar($id_asientos,$cantidad,$lugares,$idservicio)
	{
		$sql="INSERT INTO stock (id_asientos,cantidad,lugares,idservicio,estado)
		VALUES ('$id_asientos','$cantidad','$lugares','$idservicio','1')";
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

		public function listar($fecha_inicio)
		{
			$sql="SELECT re.ci_persona, re.doctype,re.nombre,re.telefono,re.correo,re.direccion,re.ciudad,re.cod_lugar,
            r.che,r.idservicio,ser.fecha,re.idreserva_cabecera,re.asistencia,re.feha
            FROM filas.reserva_detalle re
            INNER JOIN reserva_cabecera r on re.idreserva_cabecera=r.idreserva_cabecera
            INNER JOIN servicios ser ON r.idservicio=ser.idservicio
            where re.idservicio='$fecha_inicio' and re.asistencia !=2";
			return ejecutarConsulta($sql);		
		}
   
   public function total()
		{
			$sql="SELECT re.ci_persona, re.doctype,re.nombre,re.telefono,re.correo,re.direccion,re.ciudad,
        ser.fecha,ser.horario,re.asistencia,ev.evento
        FROM filas.reserva_detalle re
        INNER JOIN reserva_cabecera r on re.idreserva_cabecera=r.idreserva_cabecera
        INNER JOIN servicios ser ON r.idservicio=ser.idservicio
        INNER JOIN eventos ev ON ser.ideventos=ev.ideventos
        where re.asistencia !=2 and re.asistencia=1";
			return ejecutarConsulta($sql);		
		}
    
    
    public function listadoMixtoA()
		{
			$sql="SELECT re.ci_persona, re.doctype,re.nombre,re.telefono,re.correo,re.direccion,re.ciudad,re.cod_lugar,
			r.che,r.idservicio,ser.fecha,re.idreserva_cabecera,re.asistencia,re.feha,ser.horario,ev.evento
			FROM filas.reserva_detalle re
			INNER JOIN reserva_cabecera r on re.idreserva_cabecera=r.idreserva_cabecera
			INNER JOIN servicios ser ON r.idservicio=ser.idservicio
            INNER JOIN eventos ev on ser.ideventos=ev.ideventos
			where ser.estado=1 and re.asistencia !=2 and ser.horario <'12:00:00' ";
			return ejecutarConsulta($sql);		
		}

		public function listadoMixtoB()
		{
			$sql="SELECT re.ci_persona, re.doctype,re.nombre,re.telefono,re.correo,re.direccion,re.ciudad,re.cod_lugar,
			r.che,r.idservicio,ser.fecha,re.idreserva_cabecera,re.asistencia,re.feha,ser.horario
			FROM filas.reserva_detalle re
			INNER JOIN reserva_cabecera r on re.idreserva_cabecera=r.idreserva_cabecera
			INNER JOIN servicios ser ON r.idservicio=ser.idservicio
			where ser.estado=1 and re.asistencia !=2 and ser.horario > '12:00:00'";
			return ejecutarConsulta($sql);		
		}
        public function controlAsistencia(){
        
        $sql="SELECT r.idreserva_detalle,r.ci_persona, r.nombre, r.asistencia,r.telefono, s.fecha,s.horario, e.evento
            FROM reserva_detalle r
            INNER JOIN servicios s on r.idservicio=s.idservicio
            INNER JOIN eventos e on s.ideventos=e.ideventos
            order by r.ci_persona";
        return ejecutarConsulta($sql);	
        }
	
		public function desactivar($ci_persona,$idreserva_cabecera)
		{
			$sql="UPDATE reserva_detalle SET asistencia=0 WHERE ci_persona='".$ci_persona."'  and idreserva_cabecera='".$idreserva_cabecera."'";
			return ejecutarConsulta($sql);
		}
	
		//Implementamos un m?todo para activar categor?as
		public function activar($ci_persona, $idreserva_cabecera)
		{
			$sql="UPDATE reserva_detalle SET asistencia=1 ,fechaModificada=CURRENT_TIMESTAMP() 
			 WHERE  ci_persona='".$ci_persona."'  and idreserva_cabecera='".$idreserva_cabecera."'";
			return ejecutarConsulta($sql);
      
		}
		public function cancelacion($idservicio)
		{
			$sql="UPDATE reserva_detalle SET asistencia=2 ,fechaCanceCompleta=CURRENT_TIMESTAMP() 
			WHERE asistencia=0 AND idservicio='$idservicio'";
			return ejecutarConsulta($sql);
		}
   
   		public function serviciosActivos()
		{
			$sql="SELECT s.idservicio, s.fecha, s.horario, e.evento, s.estado
          FROM servicios s 
          INNER JOIN eventos e on s.ideventos=e.ideventos
          WHERE s.estado=1
          ORDER BY s.estado desc";
			return ejecutarConsulta($sql);
		}
	
   

		public function ausentes($idservicio)
		{
			$sql="SELECT count(*) as ausente,(SELECT count(*) as ausentes FROM reserva_detalle where asistencia=1 and  idservicio='$idservicio') as presente,
      (SELECT total from stock where idservicio='$idservicio') as total
       FROM reserva_detalle where asistencia=0 and  idservicio='$idservicio'";
			return ejecutarConsulta($sql);
		}
	
	
		//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrarNO($idstock)
		{
			$sql="SELECT * FROM stock WHERE idstock='$idstock'";
			return ejecutarConsultaSimpleFila($sql);
		}

	public function eliminar($ci_persona, $idreserva_cabecera)
		{
			$sql="UPDATE reserva_detalle SET asistencia=2 ,fechaCancelacion=CURRENT_TIMESTAMP() 
			WHERE  ci_persona='$ci_persona'  and idreserva_cabecera='$idreserva_cabecera'";
			return ejecutarConsulta($sql);
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
   
   public function filasColumnas()
   {
   $sql="
        SELECT ci_persona,nombre,
        SUM(CASE WHEN asistencia=1 then asistencia else 0 end) as presente,
        count(CASE WHEN asistencia>=0 then asistencia else 0 end) as total
        from reserva_detalle 
        group by ci_persona,nombre
        order by  presente desc";  
        			return ejecutarConsulta($sql);  
   }
    
    

}