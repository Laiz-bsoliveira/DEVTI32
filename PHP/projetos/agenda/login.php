<?php
// CONEXÃO COM O BANCO DE DADOS
include "utils/conectadb.php";
 
// ATIVA A VARIAVEL E USO DA SESSÃO
session_start();
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    // COLETA OS DADOS DO CAMPO DE TEXTO DO HTML
    $login = $_POST['txtlogin'];
    $senha = $_POST['txtsenha'];
 
    // COLETA DE NOME DO FUNCIONÁRIO
    $sqlfun = "SELECT FK_FUN_ID from usuarios
    WHERE usu_login = '$login' AND usu_senha = '$senha'";
 
    $enviaquery2 = mysqli_query($link, $sqlfun);
    $idfuncionario = mysqli_fetch_array($enviaquery2) [0];
  
    // COMUNICA COM O BANCO MONTANDO AS QUERIES
    $sql = "SELECT COUNT(usu_id) FROM usuarios
    WHERE usu_login = '$login' AND usu_senha = '$senha'";
   
    // ENVIANDO A QUERY PARA O BANQUINHO
    $enviaquery = mysqli_query($link, $sql);
    // RETORNO DO QUE VEM DO BANCO
    $retorno = mysqli_fetch_array($enviaquery) [0];
 
    // VALIDAÇÃO DO RETORNO
    if($retorno == 1){
        $_SESSION['idfuncionario'] = $idfuncionario;
 
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
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/global.css">
    <link href="https://fonts.cdnfonts.com/css/habibi" rel="stylesheet">
    <title>LOGIN</title>
</head>
<body>
    <div class="global">
        <div class="formulario">
            <form class='login' action="login.php" method="post">
                <label>LOGIN</label>
               
                <input type='text' name='txtlogin' placeholder='Digite o seu Login'>
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
</body>
</html>