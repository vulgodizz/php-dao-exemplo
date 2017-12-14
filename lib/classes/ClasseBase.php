<?php
 
abstract class ClasseBase{

	private $id;

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value;
	}
}
 ?>
