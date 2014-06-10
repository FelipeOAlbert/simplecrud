<?
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $retorno = $controller->salvar_post();
        
        echo '<div><p>'.implode('<br>', $retorno).'</p></div>';
    }
?>



<form action="" method="post">
    <fieldset>
        <label>Nome</label>
        <input type="text" name="nome" value="<?=($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['nome'] : '';?>"/>
    </fieldset>
    <fieldset>
        <label>Profissão</label>
        <input type="text" name="profissao" value="<?=($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['profissao'] : '';?>"/>
    </fieldset>
    <fieldset>
        <input type="submit" value="Enviar"/>
        <br />
        <input type="reset" value="Limpar" />
    </fieldset>
</form>