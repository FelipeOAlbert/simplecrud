<!DOCTYPE HTML>
<?php require_once('controller.php'); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Simple Crud</title>
        </head>
 
    <body>
        
        <h2>Simple crud</h2>
        
        <a href="/adicionar.php">Adicionar</a>
        
        <br />
        
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
                    $dados = $controller->index();
                    
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