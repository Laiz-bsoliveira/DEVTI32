<?php
// CONEXÃO COM O BANCO DE DADOS
include("utils/conectadb.php");
include("utils/verificalogin.php");

//APÓS O VAMOS CADASTRAR O FUN E O USU AO MESMO TEMPO
if($_SERVER['REQUEST_METHOD']=='POST'){
    
    // COLETAR CAMPOS DOS INPUTS POR NAMES PARA VARIÁVEIS PHPs
    $nomefun = $_POST['txtnome'];
    $cpffun = $_POST['txtcpf'];
    $funcaofun = $_POST['txtfuncao'];
    $contatofun = $_POST['txtcontato'];
    $ativofun = $_POST['ativo'];

    // COLETA PARA O USUARIO
    $usulogin = $_POST['txtusuario'];
    $ususenha = $_POST['txtsenha'];

    // INICIANDO QUERIES DE BANCO
    // VERIFICANDO SE O USUARIO EXISTE
    $sql = "SELECT COUNT(fun_cpf) FROM funcionarios
    WHERE fun_cpf = '$cpffun'";
    
    // ENVIANDO A QUERY PARA O BANQUINHO
    $enviaquery = mysqli_query($link, $sql);
    // RETORNO DO QUE VEM DO BANCO
    $retorno = mysqli_fetch_array($enviaquery) [0];

    // VALIDAÇÃO DO RETORNO
    if($retorno == 1){
        // INFORMA QUE O USUARIO JÁ EXISTE POIS RETORNO = 1
        echo("<script>window.alert('FUNCIONARIO JÁ EXISTE');</script>");

    }
    else{
        // CASO FUNCIONÁRIO NÃO ESTEJA CADASTRADO
        $sql = "INSERT INTO funcionarios (FUN_NOME, FUN_CPF, FUN_FUNCAO, FUN_TEL, FUN_ATIVO)
        VALUES ('$nomefun', '$cpffun', '$funcaofun', '$contatofun', $ativofun )";

        // CONECTA COM O BANCO E MANDA A QUERY
        $enviaquery = mysqli_query($link, $sql);

        // ROLE COM A TABELA DE USUARIOS
        // PERGUNTA PARA A TABELA DE FUNCIONÁRIO QUAL FOI O ULTIMO ID CADASTRADO
        // ANTES PRECISO SABER SE A VARIÁVEL USUFUN ESTÁ PREENCHIDA
        if($usulogin != null){
            // TRAZ O ID DO FUNCIONARIO CADASTRADO PARA PASSAR NO LOGIN
            $sql = "SELECT FUN_ID FROM funcionarios where FUN_CPF = '$cpffun'";
            $enviaquery = mysqli_query($link, $sql);
            $retorno = mysqli_fetch_array($enviaquery) [0];

            $usulogin = "Sem Cadastro";
            $ususenha = "Sem Cadastro";
            $ativofun = "0";
            // AGORA SALVAMOS TUDO NA TABELA DO USUARIO
            $sqlusu = "INSERT INTO usuarios (USU_LOGIN, USU_SENHA, FK_FUN_ID, USU_ATIVO)
            VALUES ('$usulogin', '$ususenha', $retorno, $ativofun)";
            $enviaqueryusu = mysqli_query($link, $sqlusu);
        }
        
        echo("<script>window.alert('FUNCIONARIO ALASTRADO COM SUCESSO!');</script>");
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
    <title>CADASTRO DE FUNCIONÁRIO</title>
</head>
<body>
    <div class="global">
           <div class="formulario">
                <a href="backoffice.php"> <button type="submit" class="btn-sair">🚪 Sair</button>
    </a>
            <form class='login' action="funcionario_cadastra.php" method="post">
                <label>NOME DO FUNCIONÁRIO</label>
                <input type='text' name='txtnome' placeholder='Digite o nome completo' required>
                <br>
                <label>CPF</label>
                <input type='text' id="cpf" name='txtcpf' placeholder="000.000.000-00" maxlength="14" oninput="formatarCPF(this)">
                <br>
                <label>FUNÇÃO</label>
                <input type='text' name='txtfuncao' placeholder='Digite a função' required>
                <br>
                <label>CONTATO</label>
                <input type='number' id='telefone' name='txtcontato' placeholder='Digite o telefone' maxlength="15" required>
                <br>
   
                <!-- AGORA CADASTRAMOS O USUARIO NO SISTEMA -->
                <label>DIGITE LOGIN</label>
                <input type='text' name='txtusuario' placeholder='Digite o login para cadastrar'>
                <br>
                <label>SENHA</label>
                <input type='password' name='txtsenha' placeholder='Senha aqui'>
                <br>

                <div class='rbativo'>
                <input type="radio" name="ativo" id="ativo" value="1" checked><label>ATIVO</label>
                <br>
                <input type="radio" name="ativo" id="inativo" value="0"><label>INATIVO</label>
                </div>


                <br>
                <input type='submit' value='CADASTRAR'>
            </form>
            
            <br>

        </div>
    </div>
    
</body>
</html>