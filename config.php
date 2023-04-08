<?php 

//Definição de configurações de conexão do banco de dados.
$driverDb = "mysql";
$hostDb = "192.168.0.1";
$dbName = "Loja";
$usuarioDb = "root";
$senhaDb = "";

//Definição de constantes de configurações
define("DRIVER_DB", $driverDb);
define("HOST_DB", $hostDb);
define("DATABASE_NAME",$dbName);
define("USUARIO_DB",$usuarioDb);
define("SENHA_DB", $senhaDb);


//Definição do autoload das classes.
spl_autoload_register(function($className){

	$pastas = array(
		'classes',
		'conexao'
	);
	
	foreach($pastas as $pasta)
	{
		$filename = "lib".DIRECTORY_SEPARATOR.$pasta.DIRECTORY_SEPARATOR.$className.".php";
		if(file_exists($filename))
		require_once($filename);
	}	
});
 ?>