<!DOCTYPE HTML>
<? require_once('controller.php'); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Simple Crud</title>
        
        <script type="text/javascript" src="jquery.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('.apagar').click(function(){
                    
                    $.ajax({
                        type: "POST",
                        url: "controller.php",
                        data: 'id='+$(this).attr('href')+'&metodo=delete',
                        success: function(retorno){
                            
                            if(retorno.falha == 'true'){
                                alert(retorno.mensagem);
                            }else{
                                alert(retorno.mensagem);
                                window.location.reload(true);
                            }
                        },
                        
                        dataType: 'json'
                    });
                    
                    return false; 
                });
            });
        </script>
        
    </head>
 
    <body>
        
        <h2>Simple crud</h2>
        
        <a href="adicionar.php">Adicionar</a>
        
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
                            <a href="editar.php?id=<?=$row['id'];?>">Editar</a>
                            <br />
                            <a class="apagar" href="<?=$row['id'];?>">Apagar</a>
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