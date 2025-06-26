<?php
include("conectadb.php");

// PESQUISA NO BANCO
$sql = "SELECT * FROM usuarios";
$enviaquery = mysqli_query($link, $sql);



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA</title>
</head>
<body>
    <table class='lista'>
        <tr>
            <th>ID</th>
            <th>LOGIN</th>
            <th>ALTERAR</th>
        </tr>

        <!-- AQUI O CHORO É LIVRE -->
         <!-- AQUI LISTA OS USUARIOS -->
          <?php
            while($tbl = mysqli_fetch_array($enviaquery)){
              
            ?>
            <tr>
                <!-- COLETA O ID NA POSIÇÃO 0 DO BANCO -->
                <td><?= $tbl[0]?></td>
                <!-- COLETA LOGIN NA POSIÇÃO 1 DO BANCO -->
                <td><?= $tbl[1]?></td>
                <td><?= $tbl[2]?></td>
                <td><a href='alterar.php?=id<?=$tbl[0]?>'><button>ALTERAR</button></a></td>
            </tr>
            <!-- ABRIR PHP PARA FECHAR O WHILE ACIMA -->
            <?php
            }
            ?>
    </table>
    
</body>
</html>