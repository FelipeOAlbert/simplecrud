<?
    require_once('banco.php');

    class controller extends banco{
        
        private $post;
        private $mensagem;
        
        function __construct()
        {
            parent::__construct();
        }
        
        public final function index()
        {
            $this->rodaquery('SELECT * FROM funcionario');
            return $this->retornaDados();
        }
        
        public final function salvar_post()
        {
            $this->post = $_POST;
            
            $this->valida_post();
            
            if(!$this->mensagem){
                
                
                if($this->salvar(false, $this->post)){
                    $this->mensagem[] = "Dados salvos com sucesso";
                }else{
                    $this->mensagem[] = "Erro ao salvar dados";
                }
            }
            
            return $this->mensagem;
        }
        
        public final function valida_post()
        {
            if(empty($this->post['nome'])){
                $this->mensagem[] = "Campo nome obrigatório";
            }
            
            if(empty($this->post['profissao'])){
                $this->mensagem[] = "Campo profissão obrigatório";
            }
        }
    }
    
    $controller = new controller();
?>