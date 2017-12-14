<?php 

class Cliente extends ClasseBase{

	/**
	 * Nome do cliente.
	 * @var string
	 */
	private $nome;
	/**
	 * Telefone do cliente.
	 * @var string
	 */
	private $telefone;
	/**
	 * Email do cliente.
	 * @var string
	 */
	private $email;
	/**
	 * Senha do cliente.
	 * @var string
	 */
	private $senha;
	/**
	 * Data de registro do cliente.
	 * @var string
	 */
	private $dataRegistro;
	
	/**
	 * Construtor com os dados do Cliente
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 */
	public function __construct($nome = "", $telefone = "",$email = "",$senha = "", $dataRegistro = "")
	{
		$this->setNome($nome);
		$this->setTelefone($telefone);
		$this->setEmail($email);
		$this->setSenha($senha);
		$this->setDataRegistro($dataRegistro === "" ? new DateTime() : $dataRegistro);
	}

	/**
	 * Retorna o nome do cliente.
	 * @return string
	 */
	public function getNome()
	{
		return $this->nome;
	}

	/**
	 * Seta o nome do cliente no objeto.
	 * @param string Nome do cliente
	 */
	public function setNome($value)
	{
		$this->nome = $value;
	}

	/**
	* Retorna o telefone do cliente.
 	* @return string
 	*/
	public function getTelefone()
	{
		return $this->telefone;
	}

	/**
	 * Seta o telefone do cliente no objeto.
	 * @param string
	 */
	public function setTelefone($value)
	{
		$this->telefone = $value;
	}

	/**
	 * Retorna o email do cliente.
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Seta o e-mail do cliente no objeto.
	 * @param string
	 */
	public function setEmail($value)
	{
		$this->email = $value;
	}

	/**
	 * Retorna a senha do cliente no objeto.
	 * @return string
	 */
	public function getSenha()
	{
		return $this->senha;
	}

	/**
	 * Seta a senha do usuário no objeto.
	 * @param string
	 */
	public function setSenha($value)
	{
		$this->senha = $value;
	}

	/**
	 * Retorna a data de registro do cliente.
	 * @return string
	 */
	public function getDataRegistro()
	{
		return $this->dataRegistro;
	}

	/**
	 * Seta a data de registro do cliente no objeto.
	 * @param string
	 */
	public function setDataRegistro($value)
	{
		$this->dataRegistro = $value;
	}

	/**
	 * Retorna o objeto em formato Json.
	 * @return json
	 */
	public function __toString()
	{
		return json_encode(array(
			'Id' => $this->getId(),
			'Nome' => $this->getNome(),
			'Telefone' => $this->getTelefone(),
			'Email' => $this->getEmail(),
			'Senha' => $this->getSenha(),
			'DataRegistro' => $this->getDataRegistro()->format("d/m/Y H:i:s")
		));
	}

	/**
	 * Seta os dados no objeto.
	 * @param array
	 */
	public function setData($data)
	{
		$this->setId($data['Id']);
		$this->setNome($data['Nome']);
		$this->setTelefone($data['Telefone']);
		$this->setEmail($data['Email']);
		$this->setSenha($data['Senha']);
		$this->setDataRegistro(new DateTime($data['DataRegistro']));
	}

	/**
 	* Pesquisa o cliente pelo ID e seta os dados no objeto.
 	* @param  int
 	*/
	public function getById($id)
	{
		$banco = new Conexao();

		$resultado = $banco->select("SELECT * FROM Clientes WHERE Id = :ID ", array(
			':ID'=>$id
		));

		if(isset($resultado[0]))
			$this->setData($resultado[0]);
	}

	/**
	 * Retorna uma lista de todos os clientes cadastrados
	 * @return array
	 */
	public static function getList()
	{
		$banco = new Conexao();
		return $banco->select("SELECT * FROM Clientes");
	}

	/**
	 * Método de pesquisa de clientes pelo nome.
	 * @param  string
	 * @return array
	 */
	public static function search($search)
	{
		$banco = new Conexao();

		return $banco->select("SELECT * FROM Clientes WHERE Nome LIKE :SEARCH ORDER BY Nome ASC;",array(
			":SEARCH"=>"%".$search."%"
		));
	}

	/**
	 * Metódo de verificação de login no banco de dados.
	 * @param  string
	 * @param  string
	 */
	public function login($email,$senha)
	{
		$banco = new Conexao();
		$resultado = $banco->select("SELECT * FROM Clientes WHERE Email = :EMAIL AND Senha = :SENHA;", array(
			':EMAIL' => $email,
			':SENHA' => $senha
		));
		if(isset($resultado[0]))
			$this->setData($resultado[0]);	
		else
			throw new Exception("E-mail ou senha incorreto!");
			
	}

	/**
	 * Método de inserir um cliente, ele pega os dados do objeto e insere no banco.
	 */
	public function insert()
	{
		$banco = new Conexao();

		$resultado = $banco->select("CALL sp_clientes_insert(:NOME,:TELEFONE,:EMAIL,:SENHA);", array(
			':NOME' => $this->getNome(),
			':TELEFONE' => $this->getTelefone(),
			':EMAIL' => $this->getEmail(),
			':SENHA' => $this->getSenha()
		));

		if(count($resultado) > 0)
			$this->setData($resultado[0]);
	}

	/**
	 * Método de update do objeto cliente.
	 */
	public function update()
	{
		$banco = new Conexao();

		$banco->query("UPDATE Clientes SET Nome = :NOME, Telefone = :TELEFONE, Email = :EMAIL, Senha = :SENHA WHERE Id = :ID",array(
			':NOME' => $this->getNome(),
			':TELEFONE' => $this->getTelefone(),
			':EMAIL' => $this->getEmail(),
			':SENHA' => $this->getSenha(),
			':ID' => $this->getId()
		));
	}

	/**
	 * Método de exclusão do objeto cliente.
	 */
	public function delete()
	{
		$banco = new Conexao();

		$banco->query("DELETE FROM Clientes WHERE Id = :ID;",array(
			':ID' => $this->getId()
		));

		$this->setId(0);
		$this->setNome("");
		$this->setTelefone("");
		$this->setEmail("");
		$this->setSenha("");
		$this->setDataRegistro(new DateTime());
	}
}
 ?>
