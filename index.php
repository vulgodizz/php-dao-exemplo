<?php 
require_once("config.php");

$cliente = new Cliente();

$cliente->getById(3);

echo $cliente;

 ?>