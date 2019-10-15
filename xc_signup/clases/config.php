<?php
abstract class config {
	
	protected $datahost;
	protected function conectar($archivo = '2OaTj1RU8U9Ir6J_db_.ini'){
		
		if(!$ajustes = parse_ini_file($archivo, true)) throw new exception ('No se puede abrir el archivo ' . $archivo . '.');
			$controlador = $ajustes["database"]["driver"]; 
			$servidor 	 = $ajustes["database"]["host"]; 
			$puerto 	 = $ajustes["database"]["port"]; 
			$basedatos	 = $ajustes["database"]["schema"]; 

		try{
			return $this->datahost = new PDO (
										"$controlador:host=$servidor;port=$puerto;dbname=$basedatos",
										$ajustes['database']['username'], 
										$ajustes['database']['password'], 
										array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
										);
			}
		catch(PDOException $e){
				echo "Error en la conexión: ".$e->getMessage();
			}
	}
}
?>
