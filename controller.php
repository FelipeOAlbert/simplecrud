<?
    require_once('banco.php');

    class controller extends banco{
        
        private $post;
        private $retorno;
        
        function __construct()
        {
            parent::__construct();
            
            $this->retorno  = array('mensagem' => null, 'falha' => false);
        }
        
        public final function index()
        {
            $this->rodaquery('SELECT * FROM funcionario');
            return $this->retornaDados();
        }
        
        public final function salvar_post($id)
        {
            $this->post = $_POST;
            
            $this->valida_post();
            
            if(!$this->retorno['falha']){
                if($this->salvar($id, $this->post)){
                    $this->retorno['mensagem'][] = "Dados salvos com sucesso";
                }else{
                    $this->retorno['mensagem'][] = "Erro ao salvar dados";
                }
            }
            
            return $this->retorno;
        }
        
        public final function getDados($id)
        {
            if(intval($id) > 0){                
                $this->rodaquery('SELECT * FROM funcionario WHERE id ="'.$id.'"');
                $this->retorno['data'] = $this->retornaDados(true);
            }else{
                $this->retorno['falha']        = true;
                $this->retorno['mensagem'][] = "ID não encontrado";
            }
            
            return $this->retorno;
        }
        
        public final function valida_post()
        {
            if(empty($this->post['nome'])){
                $this->retorno['falha']        = true;
                $this->retorno['mensagem'][] = "Campo nome obrigatório";
            }
            
            if(empty($this->post['profissao'])){
                $this->retorno['falha']        = true;
                $this->retorno['mensagem'][] = "Campo profissão obrigatório";
            }
        }
    }
    
    $controller = new controller();
?>