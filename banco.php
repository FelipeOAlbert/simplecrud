<?php
    class banco {
        
        private $host       = 'localhost';
        private $db         = 'crud';
        private $user       = 'root';
        private $pass       = '123qwe';
        
        private $conexao    = null;
        private $query      = null;
        
        //public function conecta()
        public function conecta()
        {
            $this->conexao = mysql_connect($this->host, $this->user, $this->pass) or die(mysql_error());
            $status = mysql_select_db($this->db, $this->conexao) or die(mysql_error());
            
            return $status;
        }
        
        public function rodaquery($query)
        {
            $this->query = mysql_query($query) or die(mysql_error());;
            //return $this->query;
        }
        
        public function contaLinhas()
        {
            return mysql_num_rows($this->query);
        }
        
        public function salvar($id, $data = array())
        {
            return false;
        }
    }
    
    $banco = new banco();
?>