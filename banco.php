<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Classe de conexão ao banco
 *
 * Conecta no banco de dados e retorna ou insere dados
 *
 * PHP version 5.3.10
 * 
 * @category  Banco
 * @package   Banco
 * @author    Hernanes <albert@questa.com.br>
 * @copyright 2014-2015 The PHP Group
 * @license   https://github.com/freedfelipe/simplecrud  Github do autor
 * @version   GIT: $Id$
 * @link      simplecrud/banco.php
 */


/**
* banco
*
* Conecta no banco de dados e retorna ou insere dados
*
* @category Banco 
* @package  Banco  
* @author   Hernanes <albert@questa.com.br>
* @license  Github do autor https://github.com/freedfelipe/simplecrud
* @link     simplecrud/banco.php
*/
class Banco
{
    
    private $_host       = 'localhost';
    private $_db         = 'crud';
    private $_user       = 'root';
    private $_pass       = '123qwe';
    
    private $_conexao    = null;
    private $_query      = null;
        
    /**
    * Class constructor
    *
    * @return void
    */
    public function __construct()
    {
        $this->conecta();
    }
        
    /**
    * Method constructor
    * 
    * @access public
    * @return string
    */
    public function conecta()
    {
        $this->_conexao = mysql_connect($this->_host, $this->_user, $this->_pass) or die(mysql_error());
        $status = mysql_select_db($this->_db, $this->_conexao) or die(mysql_error());
    
        return $status;
    }
    
    
    /**
    * Method rodaquery
    * 
    * @param string $query é requerida
    * 
    * @access public
    * @return void
    */    
    public function rodaquery($query)
    {
        $this->_query = mysql_query($query) or die(mysql_error());
    }
    
    
    /**
    * Method contaLinhas
    * 
    * @access public
    * @return string
    */    
    public function contaLinhas()
    {
        $linhas = mysql_num_rows($this->_query);
    
        return $linhas;
    }
    
    /**
    * Method retornaDados
    *
    * @param bool $linha é requerida
    * 
    * @access public
    * @return array
    */ 
    public function retornaDados($linha = false)
    {
        $retorno    = Array();
    
        if ($linha) {
            $retorno = mysql_fetch_assoc($this->_query);
        } else {
            while ($dados = mysql_fetch_assoc($this->_query)) {
                $retorno[] = $dados;
            }
        }
    
        return $retorno; 
    }
    
    /**
    * Method salvar
    *
    * @param numeric $id   variavel requerida
    * @param array   $data variavel requerida
    * 
    * @access public
    * @return bool
    */ 
    public function salvar($id, $data = array())
    {
        if (intval($id) > 0) {
            $retorno = mysql_query('UPDATE funcionario SET nome="'.$this->limpaString($data['nome']).'", profissao="'.$this->limpaString($data['profissao']).'"  WHERE id = "'.$id.'"') or die(mysql_error() );
        } else {
            $retorno = mysql_query('INSERT INTO funcionario (nome, profissao) VALUES("'.$this->limpaString($data['nome']).'", "'.$this->limpaString($data['profissao']).'")') or die(mysql_error());
        }
        
        if ($retorno) {
            return true;
        }
        
        return false;
    }
    
    
    /**
    * Method apagar
    *
    * @param numeric $id variavel requerida
    * 
    * @access public
    * @return bool
    */ 
    public function apagar($id)
    {
        $retorno = mysql_query('DELETE FROM funcionario WHERE id ="'.$id.'"');
        
        if ($retorno) {
            return true;
        }
        
        return false;
    }
    
    
    /**
    * Method disconnect
    *   
    * @access public
    * @return void
    */ 
    public function disconnect()
    {
        mysql_close($this->_conexao);
        $this->_conexao = null;
    }
    
    /**
    * Method limpaString
    *
    * @param string $value variavel requerida
    * 
    * @access public
    * @return string
    */ 
    function limpaString($value)
    { 
        return mysql_real_escape_string($value); 
    }
}
    
    $banco = new banco();
?>