<?php
//CONEÇÃO COM O BANCO
include("utils/conectadb.php");
include("utils/verificalogin.php");

//filtro de essssssssscolhas
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

//TRAZ A LISTA DE FUNCIONÁRIOS DO BANCO
$sqlfun = "SELECT * FROM funcionarios INNER JOIN usuarios ON FK_FUN_ID = FUN_ID";
$enviaquery = mysqli_query($link, $sqlfun);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/lista.css">

    <title>LISTA FUNCIONÁRIOS</title>
</head>
<body>
    
 <div class='global'>
   <div class='tabela'>
    <a href=backoffice.php>
    <button type="submit" class="btn-sair">🚪 Sair</button></a>
    <h1>LISTA DE FUNCIONÁRIOS</h1>
    <form>
    <div class='filtro'>
        <input type='radio' name='filtro' value='1' required onclick= 'submit()' <?=$ativo == '1'?'checked':''?>>ATIVOS
        <br>
        <input type='radio' name='filtro' value='0' required onclick= 'submit()' <?=$ativo == '0'?'checked':''?>>INATIVOS

    </div>
    </form>
    <table>
        <tr>
            <th>ID FUNCIONARIO</th>
            <th>NOME</th>
            <th>CPF</th>
            <th>CARGO</th>
            <th>CONTATO</th>
            <th>STATUS</th>
            <!-- DADOS DO USUARIO-->
            <th>LOGIN</th>
        </tr>
        <!-- INICIO PHP -->
        <?php
        while ($tbl = mysqli_fetch_array($enviaquery)){
        ?>
        <tr>
            <td><?=$tbl[0]?></td> <!-- COLETA CODIGO DO FUN [0]-->
            <td><?=$tbl[1]?></td> <!-- COLETA NOME DO FUN [1]-->
            <td><?=$tbl[2]?></td> <!-- COLETA CPF DO FUN [2]-->
            <td><?=$tbl[3]?></td> <!-- COLETA CONTATO DO FUN [3]-->
            <td><?=$tbl[4]?></td> <!-- COLETA STATUS DO FUN [1]-->
            <td><?=$tbl[5]?></td> <!-- COLETA STATUS DO FUN [1]-->
            <td><?=$tbl[5] == 1? 'ATIVO':'INATIVO'?></td> <!--COLETA ATIVO DO FUN [5]-->
            <!-- NOME USUARIO DO FUNCIONARIO -->
            <td><?=$tbl[7]?></td> <!--COLETA LOGIN DO USU [7]-->
            <td><?= $tbl[10] == 1 ?"SIM":"NÃO"?></td> <!--COLETA STATUS DO USU [10]-->
            <td><a href='funcionario_altera.php?id<?= $tb1[0]?>'>
                <img src='icons/pencil1.png' width=20 style='border: 2px solid #fff; border-radius:3px; margin: 2px;'></a></td>
        </tr>
        <?php
        }
     }
        ?>
        </table>
  </div>

 </div>
</body>
</html>