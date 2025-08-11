<?php
include("utils/conectadb.php");
include("utils/verificalogin.php");

// CLICK ALTERAÇÃO DE SERVIÇO   
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nomeservico = $_POST['txtnome'];
    $descricaoservico = $_POST['txtdescricao'];
    $precoservico = $_POST['txtpreco'];
    $temposervico = $_POST['txttempo'];
    $ativo = $_POST['ativo'];


    // IMAGEM ⛧
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem = file_get_contents($imagem_temp);
        $imagem_base64 = base64_encode($imagem);
    }

    // VERIFICA O PRODUTO NA BASE

    $sql = "SELECT COUNT(CAT_ID) FROM catalogo WHERE CAT_NOME = '$nomeservico'";
    $enviaquery = mysqli_query($link, $sql);
    
    $retorno = mysqli_fetch_array($enviaquery) [0];
    
    if($retorno == 1){
        echo "<script>window.alert('PRODUTO JÁ CADASTRADO');</script>";
    }
    else {
        $sqlcadastra = "INSERT INTO catalogo (CAT_NOME, CAT_DESCRICAO, CAT_PRECO, CAT_TEMPO,
        CAT_ATIVO, CAT_IMAGEM)
        VALUES ('$nomeservico', '$descricaoservico', '$precoservico', '$temposervico', $ativo, '$imagem_base64')";
        $enviaquery = mysqli_query($link, $sqlcadastra);
        
        echo "<script>window.alert('CADASTRADO COM SUCESSO!');</script>";
        echo"<script>window.location.href('servico_lista.php');</script>";

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
    <link href="https://fonts.cdnfonts.com/css/master-lemon" rel="stylesheet">
    <title>CADASTRO DE SERVIÇOS</title>
</head>
<body>
    <div class="global">
        
        <div class="formulario">
 
            <a href="backoffice.php"><img src='icons/arrow47.png' width=50 height=50 ></a>
            
            <form class='login' action="servico_cadastra.php" method="post" enctype="multipart/form-data">
            
                <label>NOME DO SERVIÇO</label>
                <input type='text' name='txtnome' placeholder='Digite o nome do Serviço' required>
                <br>
                <label>DESCRIÇÃO</label>
                <textarea name='txtdescricao'></textarea>
                <br>
                <label>PREÇO</label>
                <input type='decimal'name='txtpreco'>
                <br>
                <label>DURAÇÃO</label>
                <input type='number' name='txttempo' placeholder='Digite o tempo em Minutos' required>
                <br>
                <!-- INPUT DE IMAGEM PARA O BANCO DE DADOS -->
                <label>FAÇA O UPLOAD DA IMAGEM</label>
                <input type='file' name='imagem'>
                <br>
                <br>
          
                <label>INICIAR SERVIÇO COMO:</label>
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