<?php 

class Cliente extends ClasseBase{

	private $nome;
	private $telefone;
	private $email;
	private $dataRegistro;
	

	public function getNome()
	{
		return $this->nome;
	}
	public function setNome($value)
	{
		$this->nome = $value;
	}

	public function getTelefone()
	{
		return $this->telefone;
	}
	public function setTelefone($value)
	{
		$this->telefone = $value;
	}

	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($value)
	{
		$this->email = $value;
	}

	public function getDataRegistro()
	{
		return $this->dataRegistro;
	}
	public function setDataRegistro($value)
	{
		$this->dataRegistro = $value;
	}

	public function __toString()
	{
		return json_encode(array(
			'Id' => $this->getId(),
			'Nome' => $this->getNome(),
			'Telefone' => $this->getTelefone(),
			'Email' => $this->getEmail(),
			'DataRegistro' => $this->getDataRegistro()
		));
	}

	public function getById($id)
	{
		$banco = new Conexao();
		$resultado = $banco->select("SELECT * FROM Clientes WHERE Id = :ID ", array(
			':ID'=>$id
		));
		if(isset($resultado[0]))
		{
			$linha = $resultado[0];

			$this->setId($linha['Id']);
			$this->setNome($linha['Nome']);
			$this->setTelefone($linha['Telefone']);
			$this->setEmail($linha['Email']);
			$this->setDataRegistro($linha['DataRegistro']);
		}

	}
}
 ?>
