<?
    require_once('banco.php');

    class controller extends banco{
        
        private $post;
        private $mensagem;
        
        function __construct()
        {
            parent::__construct();
            
            $this->mensagem['mensagem'] = null;
            $this->mensagem['falha']    = false;
            
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
            
            if(!$this->mensagem['falha']){
                
                
                if($this->salvar(false, $this->post)){
                    $this->mensagem['mensagem'][''] = "Dados salvos com sucesso";
                }else{
                    $this->mensagem['mensagem'][''] = "Erro ao salvar dados";
                }
            }
            
            return $this->mensagem;
        }
        
        public final function valida_post()
        {
            if(empty($this->post['nome'])){
                $this->mensagem['falha']        = true;
                $this->mensagem['mensagem'][''] = "Campo nome obrigatório";
            }
            
            if(empty($this->post['profissao'])){
                $this->mensagem['falha']        = true;
                $this->mensagem['mensagem'][''] = "Campo profissão obrigatório";
            }
        }
    }
    
    $controller = new controller();
?>