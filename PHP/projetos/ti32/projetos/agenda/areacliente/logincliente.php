<?php
// CONEXÃO COM O BANCO DE DADOS
include "../utils/conectadb.php";
 
// ATIVA A VARIAVEL E USO DA SESSÃO
session_start();
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    // COLETA OS DADOS DO CAMPO DE TEXTO DO HTML
    $clientecpf = $_POST['txtcpf'];
    $senha = $_POST['txtsenha'];
 
    // COLETA DE NOME DO FUNCIONÁRIO
    $sqlcli = "SELECT FK_CLI_ID from clientes
    WHERE CLI_CPF = '$clientecpf' AND CLI_SENHA = '$senha'AND CLI_ATIVO = 1";
 
    $enviaquery = mysqli_query($link, $sqlcli);
    $idcliente = mysqli_fetch_array($enviaquery) [0];

    // VALIDAÇÃO DO RETORNO
    if($retorno == 1){
        $_SESSION['idcliente'] = $idcliente;
 
        Header("Location: backoffice.php");
    }
    else{
        echo("<script>window.alert('LOGIN OU SENHA INCORRETOS');</script>");
        echo("<script>window.location.href='login.php';</script>");
    }
 
 
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulario.css">
    <link rel="stylesheet" href="../css/global.css">
    <link href="https://fonts.cdnfonts.com/css/habibi" rel="stylesheet">
    <title>LOGIN/CADASTRO DE CLIENTES</title>
</head>
<body>
    <div class="global">
        <div class="formulario">
            <form class='login' action="login.php" method="post">
                <label>LOGIN/CADASTRO DE CLIENTES</label>
               
                <label>CPF</label>
                <input type='text' id='cpf' name='txtcpf' placeholder="000.000.000-00" maxlength='14' required>
                <br>
                <label>SENHA</label>
               
                <input type='password' name='txtsenha' placeholder='Senha aqui'>
 
                <br>
                <input type='submit' value='ACESSAR'>
            </form>
           
            <br>
 
        </div>
    
    </div>
        <style>
            @import url('https://fonts.cdnfonts.com/css/habibi');
        </style>

    <script src='./scripts/script.js'></script>
</body>
</html>