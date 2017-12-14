<?php
 
abstract class ClasseBase{

	/**
	 * ID do objeto no banco de dados.
	 * @var int
	 */
	private $id;

	/**
	 * Retorna o ID do objeto no banco de dados.
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Seta o ID do banco de dados no objeto.
	 * @param int
	 */
	public function setId($value)
	{
		$this->id = $value;
	}
}
 ?>
