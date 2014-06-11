<?php
    class banco {
        
        private $host       = 'localhost';
        private $db         = 'crud';
        private $user       = 'root';
        private $pass       = '123qwe';
        
        private $conexao    = null;
        private $query      = null;
        
        public function __construct()
        {
            return $this->conecta();
        }
        
        public function conecta()
        {
            $this->conexao = mysql_connect($this->host, $this->user, $this->pass) or die(mysql_error());
            $status = mysql_select_db($this->db, $this->conexao) or die(mysql_error());
            
            return $status;
        }
        
        public function rodaquery($query)
        {
            $this->query = mysql_query($query) or die(mysql_error());
        }
        
        public function contaLinhas()
        {
            $linhas = mysql_num_rows($this->query);
            
            return $linhas;
        }
        
        public function retornaDados($linha = false)
        {
            $retorno    = Array();
            
            if($linha){
                $retorno = mysql_fetch_assoc($this->query);
            }else{
                while($dados = mysql_fetch_assoc($this->query)) {
                    $retorno[] = $dados;
                }
            }
            
            return $retorno; 
        }
        
        public function salvar($id, $data = array())
        {
            if(intval($id) > 0){
                $retorno = mysql_query('UPDATE funcionario SET nome="'.$this->limpaString($data['nome']).'", profissao="'.$this->limpaString($data['profissao']).'" WHERE id = "'.$id.'"') or die(mysql_error());
            }elseif(is_string($id) == FALSE){
                $retorno = mysql_query('INSERT INTO funcionario (nome, profissao) VALUES("'.$this->limpaString($data['nome']).'", "'.$this->limpaString($data['profissao']).'")') or die(mysql_error());
            }
            
            if(isset($retorno) and $retorno == true){
                return true;
            }
            
            return false;
        }
        
        public function apagar($id)
        {
            $retorno = mysql_query('DELETE FROM funcionario WHERE id ="'.$id.'"');
            
            return true;
        }
        
        function limpaString($value)
        { 
            return mysql_real_escape_string($value); 
        }
        
        public function limpaBanco()
        {
            $this->rodaquery('TRUNCATE TABLE funcionario;');
            
            return true;
        }
    }
    
    $banco = new banco();
?>