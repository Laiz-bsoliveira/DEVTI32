<?php
// include("../utils/conectadb.php");

include("conectadb.php");
session_start();

// MECANISMO DE SEGURANÇA ANTI VARIAVEL DE SESSÃO VAZIA
if(isset($_SESSION['idcliente'])){
    // PREENCHE IDFUNCIONARIO COM VARIAVEL DE SESSÃO
    $idcliente = $_SESSION['idcliente'];

    // COLETA O NOME DO INDIVIDUO INDIVIDUAL
    $sql = "SELECT CLI_NOME from clientes WHERE CLI_ID = $idcliente";
    $enviaquery = mysqli_query($link, $sql);

    $nomecliente = mysqli_fetch_array($enviaquery) [0];

}
else{

    echo"<script>window.alert('NÃO LOGADO MEU BOM');</script>";
    echo"<script>window.location.href='catalogo.php';</script>";

}

?>