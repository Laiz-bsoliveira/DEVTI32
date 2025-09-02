<?php
// CONEXÃO COM O BANCO DE DADOS
include("../utils/conectadb.php");

// ATIVA A VARIAVEL E USO DA SESSÃO
session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){
    // COLETA OS DADOS DO CAMPO DE TEXTO DO HTML
    $clientecpf = $_POST['txtcpf'];
    $senha = sha1($_POST['txtsenha']);

    // VERIFICAR SE CLIENTE EXISTE
    $sqlcli = "SELECT COUNT(CLI_ID) from clientes 
    WHERE CLI_CPF = '$clientecpf' AND CLI_SENHA = '$senha' AND CLI_ATIVO = 1";
    echo($sqlcli);
    $enviaquery = mysqli_query($link, $sqlcli);
    $retorno = mysqli_fetch_array($enviaquery) [0];

    // COLETANDO O NOME DO NOSSO CILENTE
    $sqlnome = "SELECT CLI_ID from clientes 
    WHERE CLI_CPF = '$clientecpf' AND CLI_SENHA = '$senha'";

    $enviaquery2 = mysqli_query($link, $sqlnome);
    $idcliente = mysqli_fetch_array($enviaquery2) [0];

    // VALIDAÇÃO DO RETORNO
    if($retorno == 1){

         // COLETAR O ID DO CLIENTE (OUTRA QUERY)
        $_SESSION['idcliente'] = $idcliente;
        Header("Location: catalogo.php");
    }
    else{
        echo("<script>window.alert('LOGIN OU SENHA INCORRETOS');</script>");
        echo("<script>window.location.href='logincliente.php';</script>");
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
    <link href="https://fonts.cdnfonts.com/css/master-lemon" rel="stylesheet">
    <title>LOGIN/CADASTRO DE CLIENTE</title>
</head>
<body>
    <div class="global">
        <h1>ACESSAR LOGIN/CADASTRO DE CLIENTE</h1>
        <div class="formulario">
            <a href="catalogo.php"><img src='../icons/arrow47.png' width=50 height=50></a>

            <form class='login' action="logincliente.php" method="post">
               
                <label>CPF</label>
                <input type='text' id='cpf' name='txtcpf' placeholder="000.000.000-00" maxlength='14' oninput="formatarCPF(this)" required>
                <br>
                <label>SENHA</label>
                <input type='password' id='password' name='txtsenha' placeholder='Senha aqui'>
                
                <!-- FAZ PARTE DO OLINHO -->
                <span class='togglePassword' id='togglePassword' style="margin: -35px 0px 0px 90%;">🔒</span>
                
                <br>
                <br>
                <input type='submit' value='ACESSAR'>


                <!-- JS DO OLHINHO + CPF -->
                <script>
                    const passwordInput = document.getElementById('password');
                    const togglePassword = document.getElementById('togglePassword');
                    togglePassword.addEventListener('click', 
                        function(){
                            const type = passwordInput.getAttribute('type') === 'password'?'text':'password';
                            passwordInput.setAttribute('type',type);;

                        this.textContent = type === 'password'?'🔒':'🔓';
                        
                    });
                    

                    // VALIDA A MASCARA DO CPFZIM
                    document.getElementById('cpf').addEventListener('input', function(event){
                    const input = event.target;
                    let valor = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
                    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
                    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                    input.value = valor;
                });    
                </script>
                <!-- FIM JS DO OLHINHO + CPF-->

                    
            </form>

            <a href='cliente_cadastra.php'>Não tem conta? Clique para alastrar</a>
            <br>

        </div>
       
    </div>
</body>
</html>