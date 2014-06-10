<!DOCTYPE HTML>
<?php
    require_once('banco.php');
 
    $sql = new banco();
    
    $banco->rodaquery('SELECT * FROM funcionario');
?>
<html>
<head>
<meta charset=utf-8">
<title>Simple Crud</title>
</head>
 
<body>
    
    <a href="/adicionar">Adicionar</a>
    
    <table border="2">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Profissão</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            
            <?
                $dados = $banco->retornaDados();
                
                if($dados){
                    
                    foreach($dados as $row){
                    
            ?>
                <tr>
                    <td><?=$row['id'];?></td>
                    <td><?=$row['nome'];?></td>
                    <td><?=$row['profissao'];?></td>
                    <td>
                        <a href="/editar.php?<?=$row['id'];?>">Editar</a>
                        <br />
                        <a href="/apagar.php?<?=$row['id'];?>">Apagar</a>
                    </td>
                </tr>
            <?
                    }
                }else{
            ?>
                <tr>
                    <td colspan="4">Sem dados</td>
                </tr>
            <? } ?>
        </tbody>
    </table>
</body>
</html>