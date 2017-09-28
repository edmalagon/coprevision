<?php
	class base{
		private $id_conexion;
		private $id_resultado;
		private $error1;
		function base($server=IP_SERVER,$user=USER_DB,$pass=PASSWORD_DB,$based=DB,$puerto=PORT,$tipo_conexion="N"){
			$this->id_conexion=null;
			$this->id_resultado=null;
			$this->error1="";
			return($this->conectar($server,$user,$pass,$based,$puerto,$tipo_conexion));
		}// Fin constructor
		function conectar($server=IP_SERVER,$user=USER_DB,$pass=PASSWORD_DB,$based=DB,$puerto=PORT,$tipo_conexion="N" ){
			try {
			  switch($tipo_conexion){
				case "N":		// Conexion a B.D no persistente
					$this->id_conexion=@pg_connect("host=$server port=$puerto dbname=$based user=$user password=$pass");
					break;
				case "P":		// Conexion a B.D persistente
					$this->id_conexion=@pg_pconnect("host=$server port=$puerto dbname=$based user=$user password=$pass");
					break;
				default:		// Otros casos
					$this->id_conexion=@pg_connect("host=$server port=$puerto dbname=$based user=$user password=$pass");
					break;
			  }
			  if ($this->id_conexion) {
				//$this->id_conexion->set_charset(CODEC);
				return($this->id_conexion);
			  } else {
				  throw new Exception("Error 01: ".($this->id_conexion ? pg_error($this->id_conexion) : 'Servidor o B.D. no disponible'));
			  }
			} catch (Exception $e) {
				$this->error1=$e->getMessage();
				return (null);
			}
		}// Fin conectar
		function consulta($query){
			try {
				$this->id_resultado=@pg_query($this->id_conexion,$query);
				if ($this->id_resultado) {
					return($this->id_resultado);
				} else {
					throw new Exception("Error 02: ".pg_last_error($this->id_conexion));					
				}
			} catch (Exception $e) {
				$this->error1=$e->getMessage();
				return (null);
			}
		}
		function trae_fila($tipo_indice="A"){
			try {
				switch ($tipo_indice){
					case "A":		// Arreglo de datos con indice asociativo
						$fila = @pg_fetch_array($this->id_resultado,null,PGSQL_ASSOC);
						break;
					case "N":		// Arreglo de datos con indice numerico
						$fila = @pg_fetch_array($this->id_resultado,null,PGSQL_NUM);
						break;
					default:		// Otros casos
						$fila = @pg_fetch_array($this->id_resultado,null,PGSQL_BOTH);
						break;
				}
				if ($fila) {
					return ($fila);
				} else {
					throw new Exception((pg_last_error($this->id_conexion)==""? "" : "Error 03: ".pg_last_error($this->id_conexion)));

				}
			} catch (Exception $e) {
				$this->error1=$e->getMessage();
				return (null);
			}
		}// fin trae_fila
		function desconectar(){
			try {
				if (@pg_close($this->id_conexion)) { // Cerrar la Base de Datos
					return (true);
				} else {
					return (false);
				}
			} catch (Exception $e) {
				$this->error1=$e->getMessage();
				return (null);
			}			
		}// Fin desconectar
		function obtener_conexion(){
			return ($this->id_conexion);
		}
		function obtener_error(){
			return ($this->error1);
		}
	}
	class subase extends base{
		function subase($server=IP_SERVER,$user=USER_DB,$pass=PASSWORD_DB,$based=DB,$puerto=PORT,$tipo_conexion="N"){
			$this->base($server,$user,$pass,$based,$puerto,$tipo_conexion);
		}
		function sub_fila($query,$tipo_indice="A"){
			if ( $this->consulta($query) ){
				return ($this->trae_fila($tipo_indice));
			}else{
				return (null);
			}
		}
		function sub_tuplas($query,$tipo_indice="A"){
			if ( $this->consulta($query) ){
				$tabla = array();
				while($fila = $this->trae_fila($tipo_indice)){
					$tabla[] = $fila;
				}
				return ($tabla);
			}else{
				return (null);
			}
		}		
	}// Fin subclase subase
?>