<?php 
require_once("config.php");

$cliente = new Cliente();

$cliente->login("diego@diego.com","124");

echo $cliente;

 ?>