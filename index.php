<?php 
require_once("config.php");

$cliente = new Cliente();

$cliente->getById(1);

echo $cliente;
 ?>