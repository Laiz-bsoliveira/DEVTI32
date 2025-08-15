<?php 

include("..utils/conectadb.php")
include("..utils/validacliente.php")

$id = $_GET['id'];

$sql = "SELECT *FROM catalogo WHERE CAT_ID ='$id'";
$enviaquery = mysqli_query ($link, $sql);

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
    <link href="https://fonts.cdnfonts.com/css/habibi" rel="stylesheet">
    <title>CADASTRO DE SERVIÇOS</title>
</head>
<body>
    <div class="global">
<!-- AJUSTE DA IMAGEM-->
 <div class='imagem'>
    <img name='imagem_atual' src="data:image/jpeg;base64,<?= $imagem_atual?>">
</div>
        
        <div class="formulario">
 
            <a href="servico_lista.php"><img src='icons/arrow47.png' width=50 height=50></a>
            
            <form class='login' action="servico_altera.php" method="post" enctype="multipart/form-data">

             <!-- QUANDO FOR GRAVAR, COLETA O QUE VEM DO BANCO PARA FAZER O UPDATE-->
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
<body>
    
</body>
</html>
