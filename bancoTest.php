<?php

    //require_once '/usr/share/php/PHPUnit/Framework.php';
    
    require_once 'banco.php';
    
    class bancoTest extends PHPUnit_Framework_TestCase {
        
        public function testconecta()
        {
            $banco = new banco();
            
            $this->assertTrue($banco->conecta());
        }
        
        //public function testconsulta()
        //{
        //    $this->assertTrue($banco->consulta());
        //}
        
        public function testadicionar()
        {
            $banco = new banco();
            
            $banco->rodaquery('SELECT * FROM funcionario');
            $qtd = $banco->contaLinhas();
            
            $this->assertEquals(0, $qtd, "Pre-Condicao");
            
            $this->assertTrue(TRUE, $banco->salvar(false, array('nome' => 'Felipe', 'cargo' => 'Programador')));
            
            $banco->rodaquery('SELECT * FROM funcionario');
            $qtd = $banco->contaLinhas();
            
            $this->assertEquals(1, $qtd, "fail add");
        }
        
    }
    
?>