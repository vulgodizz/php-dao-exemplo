<?php 

class Conexao extends PDO {

	private $conexao;

	public function __construct()
	{
		$this->conexao = new PDO(
			DRIVER_DB.
			":host=".HOST_DB.
			";dbname=".DATABASE_NAME.";",
			USUARIO_DB,
			SENHA_DB);	
	}
	public function query($rawQuery, $params = array())
	{
		$stmt = $this->conexao->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}
	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value)
			$this->setParam($statement, $key, $value);	
	}
	private function setParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}
}
 ?>