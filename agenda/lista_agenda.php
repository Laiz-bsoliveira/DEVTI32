<?php
// CONEXÃO COM O BANCO
include("utils/conectadb.php");
include("utils/verificalogin.php");

// TRAZ OS FUNCIONÁRIOS DO BANCO
$sqlcli = "SELECT * FROM clientes WHERE CLI_ATIVO = 1";
$enviaquery = mysqli_query($link, $sqlcli);


// AQUI FILTRA AS MINHAS ESCOLHAS
$ativo = 1;

// AGORA FUNÇÕES DE CADA CLICK
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ativo = $_POST['filtro'];
    echo($ativo);
    
    if($ativo == 1){
        // VERIFICA SE ATIVO É IGUAL A 1
        $sql = "SELECT * FROM clientes WHERE CLI_ATIVO = 1";
        $enviaquery = mysqli_query($link, $sql);
    }
    else if($ativo == 0){
        // VERIFICA SE ATIVO É IGUAL A 0
        $sql = "SELECT * FROM clientes WHERE CLI_ATIVO = 0";
        $enviaquery = mysqli_query($link, $sql);
    }
    else{
    // VERIFICA SE ATIVO É DIFERENTE DE 1 E 0
        $sql = "SELECT * FROM clientes;";
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
            <a href="backoffice.php"><img src='icons/arrow47.png' width=50 height=50></a>
            <h1>LISTA DE CLIENTES</h1>
             <!-- CRIAÇÃO DE FILTRO DE TABLE -->
             <form action='cliente_lista.php' method='post'>
                <div class='filtro'>
                    <input type='radio' name='filtro' value='1' required onclick='submit()' <?= $ativo == '1'?'checked':''?>>ATIVOS
                   
                    <input type='radio' name='filtro' value='0' required onclick='submit()' <?= $ativo == '0'?'checked':''?>>INATIVOS 
                   
                    <input type='radio' name='filtro' value='2' required onclick='submit()' <?= $ativo == '2'?'checked':''?>>TODOS 

                </div>
            </form>
           
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

                <!-- COMEÇOU O PHP -->
                <?php
                    
                        while ($tbl = mysqli_fetch_array($enviaquery)){
                            // while($tbl2 = mysqli_fetch_array($enviaquery2)){
                ?>
                
                <tr class='linha'>
                    <td><?=$tbl[0]?></td> <!--COLETA CÓDIGO DO CLI [0] -->
                    <td><?=$tbl[1]?></td> <!--COLETA NOME DO CLI [1]-->
                    <td><?=$tbl[2]?></td> <!--COLETA CPF DO CLI [2]-->
                    <td><?=$tbl[3]?></td> <!--COLETA CONTATO DO CLI[3]-->
                    <td><?=$tbl[5]?></td> <!--COLETA STATUS DO CLI [4]-->
                    <td><?=$tbl[4] == 1? 'ATIVO':'INATIVO'?></td> <!--COLETA ATIVO DO CLI [5]-->
                    
                    
                    <!-- USANDO GET BRABO -->
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