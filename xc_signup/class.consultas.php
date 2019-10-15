<?php
/*
Autor: Maxwell
*/
require("clases/config.php");

class conectorDB extends config
{
	private $conexion;
	public function __construct(){
		$this->conexion = parent::conectar(); //creo una variable con la conexión
		return $this->conexion;										
	}
	
	public function EjecutarSentencia($consulta, $valores = array()){  //funcion principal, ejecuta todas las consultas
		$resultado = false;
		
		if($statement = $this->conexion->prepare($consulta)){  //prepara la consulta
			if(preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)){ //tomo los nombres de los campos iniciados con :xxxxx
				$campo = array_pop($campo); //inserto en un arreglo
				foreach($campo as $parametro){
					$statement->bindValue($parametro, $valores[substr($parametro,1)]);
				}
			}
			try {
				if (!$statement->execute()) { //si no se ejecuta la consulta...
					print_r($statement->errorInfo()); //imprimir errores
					return false;
				}
				$resultado = $statement->fetchAll(PDO::FETCH_ASSOC); //si es una consulta que devuelve valores los guarda en un arreglo.
				$statement->closeCursor();
			}
			catch(PDOException $e){
				echo "Error de ejecución: \n";
				print_r($e->getMessage());
			}	
		}
		return $resultado;
		$this->conexion = null; //cerramos la conexión
	} /// Termina funcion consultarBD
}/// Termina clase conectorDB

class Json
{
	private $json;
	public function AddObjetoJson($clientes){
	    $fecha=date("Y-m-d h:i:s a");
        $pass= md5();
		$Insertar = false; //creamos una variable de control
		$consulta = "INSERT INTO users(user_nick, user_sexo, user_age, user_email, user_register) VALUES (:nombre, :sexo, :edad, :email, :fecha)";
		$valores  = array("nombre"=>$clientes->Nombre,"sexo"=>$clientes->cbSexo,"edad"=>$clientes->Edad,"email"=>$clientes->Email,"fecha"=>$fecha);
		$oConexion = new conectorDB; //instanciamos conector
		$Insertar= $oConexion->EjecutarSentencia($consulta, $valores);
		if($Insertar !== false){
			return true;
		}
		else{
			return false;
		}
	}
	public function JsonGuardaPassword($Password,$id_cliente){
		$registrar = false; //creamos una variable de control
		$consulta  = "UPDATE users SET user_passw=:Password WHERE id=:id";
		$valores   = array("Password"=>$Password,"id"=>$id_cliente);
		$oConexion = new conectorDB; //instanciamos conector
		$registrar = $oConexion->EjecutarSentencia($consulta, $valores);
	}
	public function AddActivacion($idcliente,$codigo_activacion,$fecha){
		$consulta = "INSERT INTO activaciones(id_cliente, codigo_activacion, fecha_generacion) VALUES (:id_cliente, :codigo_activacion, :fecha_generacion)";
		$valores  = array("id_cliente"=>$idcliente,"codigo_activacion"=>$codigo_activacion,"fecha_generacion"=>$fecha);
		$oConexion = new conectorDB; //instanciamos conector
		$Insertar= $oConexion->EjecutarSentencia($consulta, $valores);
	}
	public function JsonVerificaNombre($nombre){
		$consulta = "SELECT  * FROM users WHERE user_nick='".$nombre."'";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		if(!empty($this->json)){
			return true;
		}else{
			return false;
		}
	}
	public function JsonVerificaMail($email){
		$consulta = "SELECT  * FROM users WHERE user_email='".$email."'";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		if(!empty($this->json)){
			return true;
		}else{
			return false;
		}
	}
	public function JsonBuscoCodigoActivacion($id){
		$consulta = "SELECT * FROM activaciones WHERE id_cliente='".$this->LimpiarCadena($id)."' limit 1";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}
	public function JsonBuscarCliente($email){
		$consulta = "SELECT * FROM users WHERE user_email='".$email."' limit 1";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;

	}
	public function ActivarCuenta($id_cliente,$fecha_activacion,$codigo_activacion)
	{
		# code...
		$registrar = false; //creamos una variable de control
		$consulta  = "UPDATE users SET estatus=:estatus WHERE id=:id";
		$valores   = array("estatus"=>"1","id"=>$id_cliente);
		$oConexion = new conectorDB; //instanciamos conector
		$registrar = $oConexion->EjecutarSentencia($consulta, $valores);
		if($registrar !== false){
			$consulta = "UPDATE activaciones SET fecha_activacion=:fecha_activacion,  estatus=:estatus ";
			$consulta = $consulta." WHERE id_cliente=:id_cliente and codigo_activacion=:codigo_activacion";
			$valores  = array('fecha_activacion' => $fecha_activacion, 'estatus' => '1', 'id_cliente' => $id_cliente, 'codigo_activacion' => $codigo_activacion);
			$registrar = $oConexion->EjecutarSentencia($consulta, $valores);
			if($registrar !== false){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function JsonAcountActivo($id_cliente, $codigo_activacion){
		$consulta = "SELECT  * FROM activaciones WHERE id_cliente='".$id_cliente."' and codigo_activacion='".$codigo_activacion."'";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}
	public function JsonUltimoId(){
		$consulta = "SELECT MAX(id) AS ID FROM users";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}
	//Validamos nick
	public function verificanombre($Nombre){
	   if(strlen($Nombre) >= 4)
	      return true;
	   else
	     return false;
	
	}
	//Validamos email
	public function verificapassword($Password){
	   if(strlen($Password) >= 6)
	      return true;
	   else
	     return false;
	
	}
	//Validamos email
	public function verificaremail($email){ 
	   $Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
	   if(preg_match($Sintaxis,$email))
	      return true;
	   else
	     return false;
	}
	//Limpiar Caracteres
	function LimpiarCadena($texto)
	{
	      //$textoLimpio = preg_replace('([^A-Za-z0-9])', '', $texto);
	      $textoLimpio   = addslashes($texto);	     					
	      return $textoLimpio;
	}
	
}/// TERMINA CLASE  ///
