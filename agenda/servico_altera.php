<?php

include("utils/conectadb.php");
include("utils/verificalogin.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $nomeservico = $_POST['txtnome'];
    $descricaoservico = $_POST['txtdescricao'];
    $precoservico = $_POST['txtpreco'];
    $temposervico = $_POST['txttempo'];
    $ativo = $_POST['ativo'];   

    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK){
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem = file_get_contents($imagem_temp);
        $imagem_base64 = base64_encode($imagem);
    };

    if($imagem_atual == $imagem_base64){
        $sql = "UPDATE catalogo SET CAT_NOME = '$nomeservico', CAT_DESCRICAO = '$descricaoservico', CAT_PRECO = '$precoservico', CAT_TEMPO = '$temposervico', CAT_ATIVO = '$ativo' WHERE CAT_ID = '$id'";
        
        $enviaquery = mysqli_query($link, $sql);
         echo "<script>window.alert('PRODUTO ALTERADO!');</script>";
        echo "<script>window.location.href='servico_lista.php';</script>";
    }
    else{
        $sql = "UPDATE catalogo SET CAT_NOME = '$nomeservico', CAT_DESCRICAO = '$descricaoservico', CAT_PRECO = '$precoservico', CAT_TEMPO = '$temposervico', CAT_ATIVO = '$ativo', CAT_IMAGEM = '$imagem_base64' WHERE CAT_ID = '$id'";
        $enviaquery = mysqli_query($link, $sql);
        echo "<script>window.alert('PRODUTO ALTERADO!');</script>";
        echo "<script>window.location.href='servico_lista.php';</script>";
    }
    

}

$id = $_GET['id'];

$sql = "SELECT * FROM catalogo WHERE CAT_ID = '$id'";
$enviaquery = mysqli_query($link, $sql);

while($tbl = mysqli_fetch_array($enviaquery)){
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
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="css/global.css">
    <link href="https://fonts.cdnfonts.com/css/master-lemon" rel="stylesheet">
    <title>CADASTRO DE SERVIÇOS</title>
</head>
<body>
    <div class="global">
        <!-- AJUSTE DA IMAGEM A PARTE -->
        <div class='imagem'>
            
            <img name='imagem_atual' src="data:image/jpeg;base64,<?= $imagem_atual?>">
        
        </div>
        
        <div class="formulario">
<!-- FIRULAS Y FIRULAS -->
 
            <a href="servico_lista.php"><img src='icons/arrow47.png' width=50 height=50 ></a>
            
            <form class='login' action="servico_altera.php" method="post" enctype="multipart/form-data">
                
                <!-- QUANDO GRAVAR, ELE COLETA O QUE VEIO DO BANCO PRA FAZER O UPDATE CORRETO -->
                <input type='hidden' name='id' value='<?= $id ?>'>

                <label>NOME DO SERVIÇO</label>
                <input type='text' name='txtnome' placeholder='Digite o nome do Serviço' value='<?= $nomeservico ?>' required>
                <br>
                <label>DESCRIÇÃO</label>
                <textarea name='txtdescricao' placeholder='Digite a Descrição do Serviço'><?= $descricaoservico?></textarea>
                <br>
                <label>PREÇO</label>
                <input type='decimal'name='txtpreco' placeholder='HUE$' value='<?= $precoservico?>'>
                <br>
                <label>DURAÇÃO (Em Minutos)</label>
                <!-- <input type='number' name='txttempo' placeholder='Digite o tempo em Minutos' value='' required> -->
                <select name='txttempo' class='opt'>
                    <option value='<?= $temposervico?>'><?= $temposervico?></option>
                    <option value='0'>SEM TEMPO IRMÃO/IRMÃ</option>
                    <option value='30'>30 MINUTOS</option>
                    <option value='60'>1 HORA</option>
                    <option value='90'>1:30 HORA</option>
                    <option value='120'>2 HORAS</option>
                    <option value='180'>2:30 HORAS</option>
                    <option value='240'>3:00 HORAS</option>
                    <option value='400'>3:30 HORAS</option>
                    <option value='460'>4 HORAS</option>
                </select>
                
                <br>
                <!-- INPUT DE IBAGEM PARA O BANDO DE DADOS -->
                <label>FAÇA O UPLOAD DA IMAGEM</label>
                <input type='file' name='imagem'>
                <br>
                <br>
          
                <label>STATUS DO SERVIÇO:</label>
                <div class='rbativo'>
                    
                    <input type="radio" name="ativo" id="ativo" value="1" checked><label>ATIVO</label>
                    <br>
                    <input type="radio" name="ativo" id="inativo" value="0"><label>INATIVO</label>
                </div>

       
                
                <br>
                
                <input type='submit' value='ALTERAR'>
            </form>
            <br>
        </div>
        

    </div>

</body>
</html>