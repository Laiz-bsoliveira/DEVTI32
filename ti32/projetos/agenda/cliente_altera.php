<?php

// CONEXÃO COM O BANCO DE DADOS
include("utils/conectadb.php");
include("utils/verificalogin.php");


//APÓS ALTERAÇÕES FAZER O SAVE NO BANCO
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // COLETAR CAMPOS DOS INPUTS POR NAMES PARA VARIÁVEIS PHPs
    $id = $_POST['id'];

    
    // COLETAR CAMPOS DOS INPUTS POR NAMES PARA VARIÁVEIS PHPs
    $nomecli = $_POST['txtnome'];
    $cpfcli = $_POST['txtcpf'];
    $contatocli = $_POST['txtcontato'];
    $ativocli = $_POST['ativocli'];
    $datanasccli = $_POST['dtdata'];
    // COLETA SENHA DE USUARIO
    $senhacli = sha1($_POST['txtsenha']);


    //INICIANDO QUERIES DE BANCO
    $sql = "UPDATE clientes SET CLI_NOME = '$nomecli', CLI_TEL = '$contatocli', CLI_ATIVO = $ativocli, CLI_DATANASC = '$datanasccli', CLI_SENHA = '$senhacli' WHERE CLI_ID = '$id'";
    mysqli_query($link, $sql);


    echo "<script>window.alert('$nomecli alterado com sucesso!');</script>";
    echo "<script>window.location.href='cliente_lista.php';</script>";
    
}


// COLETANDO E PREENCHENDO OS DADOS NOS CAMPOS
$id = $_GET['id']; //COLETANDO O ID VIA GET NA URL

$sql = "SELECT * FROM clientes WHERE CLI_ID = '$id'";
$enviaquery = mysqli_query($link, $sql);

// PREENCHENDO OS CAMPOS COM WHILE
    while($tbl = mysqli_fetch_array($enviaquery)){
        $id = $tbl[0];
        $nomecli = $tbl[1];
        $cpfcli = $tbl[2];
        $contatocli = $tbl[3];
        $ativocli = $tbl[4];
        $datanasccli = $tbl[5];
        $senhacli = $tbl[6];
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
            
            <form class='login' action="cliente_altera.php" method="post">
                
                <!-- PARA GRAVARMOS REALMENTE O ID DO FUNCIONÁRIO -->
                <input type='hidden' name='id' value='<?= $id?>'>

                <label>NOME DO CLIENTE</label>
                <input type='text' name='txtnome' value = "<?= $nomecli ?>" required>
                <br>
                <label>CPF</label>
                <input type='number' name='txtcpf' value="<?= $cpfcli ?>" disabled required>
                <br>
                <label>CONTATO</label>
                <input type='text' name='txtcontato' value="<?= $contatocli ?>" required>
                <br>
                <label>DATA NASCIMENTO</label>
                <input type='date' name='dtdata' value="<?= $datanasccli ?>" required>
                <br>
                <label>ATUALIZAR SENHA</label>
                <input type='password' name='txtsenha' value="<?= $senhacli ?>" required>
                
                <!-- ESSE RADIO VERIFICA FUNCIONARIO -->
                <div class='rbativo'>
                    <!-- VERIFICAR POR QUE DESSE VALUE == 1 ANTES DO ROLÊ -->
                    <input type="radio" name="ativocli" id="ativo" value="1" <?= $ativocli == 1? 'checked' : ''?>><label>ATIVO</label>
                    <br>
                    <input type="radio" name="ativocli" id="inativo" value="0" <?= $ativocli == 0? 'checked' : ''?>><label>INATIVO</label>
                </div>
                
                <br>
                <br>
                <input type='submit' value='SALVAR ALTERAÇÕES'>
            </form>
            
            <br>

        </div>
    </div>
    
</body>
</html>