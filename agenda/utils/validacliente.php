<?php 

include("conectadb.php");

session_start();
//SEGURANÇA ANTI VARIAVEL DE SESSÃO VAZIA
if(isset($_SESSION['idcliente'])){
//PREENCHE IDCLIENTE COM VARIAVEL DE SESSÃO
$idcliente = $_SESSION['idcliente'];

//COLETA O NOME DO INDIVIDUO
$sql = "SELECT CLI_NOME from clientes WHERE CLI_ID = $idcliente"=;
$enviaquery = mysqli_query($link, $sql);

$nomecliente = mysqli_fetch_array($enviaquery) [0];

}
?>