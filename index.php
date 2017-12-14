<?php 
require_once("config.php");

$cliente = new Cliente();

$cliente->getById(1);
$cliente->setNome("Alterou");
$cliente->update();

echo $cliente;

 ?>