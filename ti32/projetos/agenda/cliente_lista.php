<?php
// CONEXÃO COM O BANCO
include("utils/conectadb.php");
include("utils/verificalogin.php");

// TRAZ OS FUNCIONÁRIOS DO BANCO
$sqlcli = "SELECT * FROM clientes";
$enviaquery = mysqli_query($link, $sqlcli);

$ativo = 1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['filtro'];

    if($ativo ===1){
        $sql = "SELECT * FROM funcionarios INNER JOIN usuarios ON FK_FUN_ID = FUN_ID WHERE FUN_ATIVO = 1";
        $enviaquery = mysqli_query($link, $sql);    
    }
    else{$sql = "SELECT * FROM funcionarios WHERE FUN_ATIVO = 0";
        $enviaquery = mysqli_query($link, $sql);
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/lista.css">

    <title>LISTA CLIENTES</title>
</head>
<body>
    <div class='global'>
        <div class='tabela'>
            <!-- BOTÃO VOLTAR -->
            <a href=backoffice.php><button type="submit" class="btn-sair">🚪 Sair</button></a>
            <h1>LISTA DE CLIENTES</h1>
            
           
            <table>
                <tr> 
                    <th>ID CLIENTE</th>
                    <th>NOME</th>
                    <th>CPF</th>
                    <th>CONTATO</th>
                    <th>DATA NASCIMENTO</th>  
                    <th>STATUS</th>
                    <th>ALTERAÇÃO</th>
                </tr>

                <!-- INCIO PHP -->
                <?php
                    
                        while ($tbl = mysqli_fetch_array($enviaquery)){
                ?>
                
                <tr class='linha'>
                    <td><?=$tbl[0]?></td> <!--COLETA CÓDIGO DO CLI [0] -->
                    <td><?=$tbl[1]?></td> <!--COLETA NOME DO CLI [1]-->
                    <td><?=$tbl[2]?></td> <!--COLETA CPF DO CLI [2]-->
                    <td><?=$tbl[3]?></td> <!--COLETA CONTATO DO CLI[3]-->
                    <td><?=$tbl[5]?></td> <!--COLETA STATUS DO CLI [4]-->
                    <td><?=$tbl[4] == 1? 'ATIVO':'INATIVO'?></td> <!--COLETA ATIVO DO CLI [5]-->
                    
                    
                    <!-- USANDO GET-->
                    <td><a href='cliente_altera.php?id=<?= $tbl[0]?>'><img src='icons/pencil1.png' width=20 height=20></a></td>

                    
                </tr>
                <?php
                    }
                
                ?>
            </table>
        </div>

    </div>
    
    
</body>
</html>