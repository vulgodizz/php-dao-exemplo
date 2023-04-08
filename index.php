<?php 
require_once("config.php");

/**
 * Para a utilização dos métodos descomente os códigos abaixo.
 */

//Cadastrando um cliente usando os métodos gets e sets.
//
/**
$clienteNovo = new Cliente();
$clienteNovo->setNome("Cliente Exemplo");
$clienteNovo->setTelefone("(31) 3333-4444");
$clienteNovo->setEmail("email@exemplo.com");
$clienteNovo->setSenha("12345");

$clienteNovo->insert();

echo $clienteNovo;
**/

//Cadastrando um cliente usando o contrutor da classe Cliente.
//
/**
$clienteNovo = new Cliente(
	"Cliente Exemplo",
	"(31) 3333-4444",
	"email@exemplo.com",
	"12345");
$clienteNovo->insert();

echo $clienteNovo;
**/

//Buscando um cliente pelo ID usando o método getById().
//
/**
$cliente = new Cliente();
$cliente->getById(6);

echo $cliente;
**/

//Gerando uma listagem com todos os clientes cadastrados no banco de dados.
//
/**
$listaDeClientes = Cliente::getList();

echo json_encode($listaDeClientes);
**/

//Buscando clientes pelo nome
//
/**
$clientesEncontrados = Cliente::search("exemplo");

echo json_encode($clientesEncontrados);
**/

//Atualizando os dados do cliente.
//
/**
$clienteParaAtualizar = new Cliente();
$clienteParaAtualizar->getById(6);
$clienteParaAtualizar->setNome("Novo nome");
$clienteParaAtualizar->update();

echo $clienteParaAtualizar;
**/

//Deletando um cliente do banco de dados.
//
/**
$clienteParaDeletar = new Cliente();
$clienteParaDeletar->getById(6);
$clienteParaDeletar->delete();

echo $clienteParaDeletar;
**/

//Usando o método de login para validar um usuário no banco de dados.
//
/**
$clienteParaLogin = new Cliente();
$clienteParaLogin->login("cliente@exemplo.com","12345");

echo $clienteParaLogin;
**/
echo "Para usar os métodos de exemplo descomente os códigos listados no arquivo <b>index.php</b>.";
 ?>