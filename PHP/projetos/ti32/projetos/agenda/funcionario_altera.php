<?php

// CONEXÃO COM O BANCO DE DADOS
include("utils/conectadb.php");
include("utils/verificalogin.php");


//APÓS ALTERAÇÕES FAZER O SAVE NO BANCO
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // COLETAR CAMPOS DOS INPUTS POR NAMES PARA VARIÁVEIS PHPs
    $id = $_POST['id'];

    $nomefun = $_POST['txtnome'];
    // $cpffun = $_POST['txtcpf'];
    $funcaofun = $_POST['txtfuncao'];
    $contatofun = $_POST['txtcontato'];
    $ativofun = $_POST['ativofun'];
    
    // COLETA PARA O USUARIO
    $ususenha = $_POST['txtsenha'];
    $usuativo = $_POST['ativousu'];

    //INICIANDO QUERIES DE BANCO
    $sqlfun = "UPDATE funcionarios SET FUN_NOME = '$nomefun', FUN_FUNCAO = '$funcaofun', FUN_TEL = '$contatofun', FUN_ATIVO = $ativofun WHERE FUN_ID = $id";
    mysqli_query($link, $sqlfun);
    
    // //ATUALIZANDO OS DADOS DO USUARIO
    $sqlusu = "UPDATE usuarios SET USU_SENHA = '$ususenha', USU_ATIVO = $usuativo WHERE FK_FUN_ID = $id";
    mysqli_query ($link, $sqlusu);


    echo "<script>window.alert('$nomefun ALTERADO');</script>";
    echo "<script>window.location.href='funcionario_lista.php';</script>";
    
}


// COLETANDO E PREENCHENDO OS DADOS NOS CAMPOS
$id = $_GET['id']; //COLETANDO O ID VIA GET NA URL

$sql = "SELECT * FROM funcionarios INNER JOIN usuarios ON FK_FUN_ID = FUN_ID WHERE FUN_ID = '$id'";
$enviaquery = mysqli_query($link, $sql);

// PREENCHENDO OS CAMPOS COM WHILE
    while($tbl = mysqli_fetch_array($enviaquery)){
        $id = $tbl[0];
        $nomefun = $tbl[1];
        $cpffun = $tbl[2];
        $funcaofun = $tbl[3];
        $contatofun = $tbl[4];
        $ativofun = $tbl[5];

        // USUÁRIO
        $usulogin = $tbl[7];
        $ususenha = $tbl[8];
        $usuativo = $tbl[10];
        
    }

    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/global.css">
    <link href="https://fonts.cdnfonts.com/css/master-lemon" rel="stylesheet">
    <title>DADOS DE FUNCIONÁRIO</title>
</head>
<body>
    <div class="global">
        
        <div class="formulario">
<!-- FIRULAS Y FIRULAS -->
 
            <a href="backoffice.php"><img src='icons/arrow47.png' width=50 height=50></a>
            
            <form class='login' action="funcionario_altera.php" method="post">
                
                <!-- PARA GRAVARMOS REALMENTE O ID DO FUNCIONÁRIO -->
                <input type='hidden' name='id' value='<?= $id?>'>

                <label>NOME DO FUNCIONÁRIO</label>
                <input type='text' name='txtnome' value = "<?= $nomefun ?>" required>
                <br>
                <label>CPF</label>
                <input type='number' name='txtcpf' value="<?= $cpffun ?>" disabled required>
                <br>
                <label>FUNÇÃO</label>
                <input type='text' name='txtfuncao' value="<?= $funcaofun ?>" required>
                <br>
                <label>CONTATO</label>
                <input type='number' name='txtcontato' value="<?= $contatofun ?>" required>
                
                <!-- ESSE RADIO VERIFICA FUNCIONARIO -->
                <div class='rbativo'>
                    <!-- VERIFICAR POR QUE DESSE VALUE == 1 ANTES DO ROLÊ -->
                    <input type="radio" name="ativofun" id="ativo" value="1" <?= $ativofun == 1? 'checked' : ''?>><label>ATIVO</label>
                    <br>
                    <input type="radio" name="ativofun" id="inativo" value="0" <?= $ativofun == 0? 'checked' : ''?>><label>INATIVO</label>
                </div>
                
                <br>
                <br>
                <br>
                <br>
    
                <!-- AGORA CALASTRAMOS O USUARIO NO SISTEMA -->
                <label>DIGITE LOGIN</label>
                <input type='text' name='txtusuario' disabled value = "<?= $usulogin ?>">
                <br>
                <!-- IMPORTANTE O BANCO NÃO SABER A SENHA DO USUARIO -->
                <!-- NÃO TRAZER SENHA OU TRAZER CRIPTOGRAFADA  -->
                <label>SENHA</label>
                <input type='password' name='txtsenha' value = "<?= $ususenha ?>">
                <br>
          
                <label>INICIAR USUARIO COMO:</label>
                <div class='rbativo'>
                    <!-- ESSE RADIO VERIFICA USUARIO -->
                    <input type="radio" name="ativousu" id="ativo" value="1" <?= $usuativo == 1? 'checked' : ''?>><label>ATIVO</label>
                    <br>
                    <input type="radio" name="ativousu" id="inativo" value="0" <?= $usuativo == 0? 'checked' : ''?>><label>INATIVO</label>
                </div>

                <br>
                <input type='submit' value='SALVAR ALTERAÇÕES'>
            </form>
            
            <br>

        </div>
    </div>
    
</body>
</html>