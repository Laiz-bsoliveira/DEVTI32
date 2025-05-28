<?php
// CONEXÃO COM O BANCO DE DADOS
include("conectadb.php");
//ATIVA VARIAVEL E USO DA SESSÃO


if($_SERVER['REQUEST_METHOD']=='POST'){
    // COLETA OS DADOS DO CAMPO DE TEXTO DO HTML
    $login = $_POST['txtlogin'];
    $senha = $_POST['txtsenha'];

    // PESQUISA NO BANCO CONTANDO USUARIOS
    $sql = "SELECT COUNT(usu_login) FROM usuarios
    WHERE usu_login = '$login' AND usu_senha = '$senha'";
    
    // ENVIANDO A QUERY PARA O BANQUINHO
    $enviaquery = mysqli_query($link, $sql);
    // RETORNO DO QUE VEM DO BANCO
    $retorno = mysqli_fetch_array($enviaquery) [0];

    // VALIDAÇÃO DO RETORNO
    if($retorno == 0){

        $sql = "INSERT INTO usuarios (USU_LOGIN, USU_SENHA) VALUES ('$login', '$senha')";
        $_SESSION['nomeusuario'] = $login;
        $enviaquery = mysqli_query($link, $sql);
     Header("Location: home.php");
     echo"<script>window.alert('USUARIO CADASTRADO!');</script>";
     echo"<script>windows.location.href='login.php';</script>";

    }
    else{
        echo"<script>window.alert('USUARIO JA CADASTRADO!');</script>";
        echo"<script>windows.location.href='login.php';</script>";
    }


}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>LOGIN</title>
</head>
<body>
    <div class="global">
        <div class="formulario">
            <form action="cadastra.php" method="post">
                <label>CADASTRO</label>
                <br>
                <input type='text' name='txtlogin' placeholder='Digite o seu Login'>
                <br>
                <label>SENHA</label>
                <br>
                <input type='password' name='txtsenha' placeholder='Senha aqui'>

                <br>
                <input type='submit' value='FAZ O L...OGIN'>
            </form>

          

        </div>
    </div>
    
</body>
</html>
 