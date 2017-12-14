<?php 

class Conexao extends PDO {

	/**
	 * Instância da conexão PDO
	 * @var object
	 */
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

	/**
	 * Método que executa uma query no banco de dados.
	 * @param  string
	 * @param  array
	 * @return object
	 */
	public function query($rawQuery, $params = array())
	{
		$stmt = $this->conexao->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}

	/**
	 * Executa uma query e retorna um array com o resultado.
	 * @param  string
	 * @param  array
	 * @return array
	 */
	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Método que seta os parâmetros no statement passado.
	 * @param object
	 * @param array
	 */
	private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value)
			$this->setParam($statement, $key, $value);	
	}

	/**
	 * Método que seta um parâmetro no statament passado.
	 * @param object
	 * @param string
	 * @param string
	 */
	private function setParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}
}
 ?>