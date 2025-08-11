<?php
include("utils/conectadb.php");
include("utils/verificalogin.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nomeservico = $_POST['txtnome'];
    $descricaoservico = $_POST['txtdescricao'];
    $precoservico = $_POST['txtpreco'];
    $temposervico = $_POST['txttempo'];
    $ativo = $_POST['ativo'];
    $imagem_base64 = $_POST['imagem'];
    $imagem_atual = $_POST['imagem_atual'];

    // IMAGEM ⛧
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem = file_get_contents($imagem_temp);
        $imagem_base64 = base64_encode($imagem);
    }

    //VALIDAÇÃO SE IMAGEM FOR ALTERADA
    if($imagem_atual == $imagem_base64){
        $sql = "UPDATE catalogo SET CAT_NOME = '$nomeservico',
        CAT_DESCRICAO = '$descricaoservico', CAT_PRECO = '$precoservico',CAT_TEMPO = '$temposervico',CAT_ATIVO = $ativo WHERE CAT_ID = 'id'";
        mysqli_query($link, $sql);

        echo "<script>window.alert('SERVICO ALTERADO COM SUCESSO!');</script>";
        echo"<script>window.location.href('servico_lista.php');</script>";
        }

        else{
            $sql = "UPDATE catalogo SET CAT_NOME = '$nomeservico',
        CAT_DESCRICAO = '$descricaoservico', CAT_PRECO = '$precoservico',CAT_TEMPO = '$temposervico',CAT_ATIVO = $ativo WHERE CAT_IMAGEM = '$imagem_base64' WHERE CAT_ID = 'id'";
        mysqli_query($link, $sql);

        echo "<script>window.alert('SERVICO ALTERADO COM SUCESSO!');</script>";
        echo"<script>window.location.href('servico_lista.php');</script>";
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

//COLETA O ID NA URL LISTANDO O BANCO

$id = $_GET['id'];
$sql = "SELECT * FROM catalogo WHERE CAT_ID = $id";
$enviaquery = mysqli_query($link, $sql);
while ($tbl = mysqli_fetch_array($enviaquery)) {
    $id = $tbl[0];
    $nomeservico = $tbl[1];
    $descricaoservico = $tbl[2];
    $precoservico = $tbl[3];
    $temposervico = $tbl[4];
    $ativo = $tbl[5];
    $imagem_atual = $tbl[6];
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
            
            <form class='login' action="servico_altera.php" method="post" enctype="multipart/form-data">
             <!-- QUANDO GRAVAR, ELE VAI COLETAR O QUE VEIO DO BANCO PARA FZR UPDATE CORRETAMENTE-->
                <input type='hidden' name='id' value='<?= $id ?>'>
            
                <label>NOME DO SERVIÇO</label>
                <input type='text' name='txtnome' placeholder='Digite o nome do Serviço' value='<?$nomeservico?>' required>
                <br>
                <label>DESCRIÇÃO</label>
                <textarea name='txtdescricao' placeholder='Digite a Descrição do Serviço'></textarea <? $descricaoservico?> >
                <br>
                <label>PREÇO</label>
                <input type='decimal'name='txtpreco' placeholder='HUE$'value='<?$precoservico?>'>
                <br>
                <label>DURAÇÃO</label>
                <input type='number' name='txttempo' placeholder='Digite o tempo em Minutos' value='<?$temposervico?>' required>
                <br>
                <!-- INPUT DE IMAGEM PARA O BANCO DE DADOS -->
                <label>FAÇA O UPLOAD DA IMAGEM</label>
                <input type='file' name='imagem'>
                <br>
                <br>
          
                <label>STATUS DO SERVIÇO :</label>
                <div class='rbativo'>
                    
                    <input type="radio" name="ativo" id="ativo" value="1" checked><label>ATIVO</label>
                    <br>
                    <input type="radio" name="ativo" id="inativo" value="0"><label>INATIVO</label>
                </div>

                  <!-- APRESENTAÇÃO IMAGEM-->
                   <div id='cat_imagem'>
                    <img src='data:image/jpeg;base64, <?= $imagem_atual?>' width=100 height=100>
                 </div>

                <br>
                <input type='submit' value='ALTERAR'>
            </form>
            
            <br>

        </div>
    </div>

</body>
</html>