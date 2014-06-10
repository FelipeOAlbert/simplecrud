<?php

    require_once 'banco.php';
    
    class bancoTest extends PHPUnit_Framework_TestCase {
        
        public function testconecta()
        {
            $banco = new banco();
            
            $this->assertTrue($banco->conecta());
        }
        
        public function testadicionar()
        {
            $banco = new banco();
            
            $banco->rodaquery('SELECT * FROM funcionario');
            $qtd = $banco->contaLinhas();
            
            $this->assertEquals(0, $qtd, "Pre-Condicao");
            
            $this->assertTrue(TRUE, $banco->salvar(false, array('nome' => 'Felipe', 'profissao' => 'Programador')), 'Erro ao inserir');
            
            $banco->rodaquery('SELECT * FROM funcionario');
            $qtd = $banco->contaLinhas();
            
            $this->assertEquals(1, $qtd, "Falha na insercao");
        }
        
        public function testeditar()
        {
            $banco = new banco();
            $banco->rodaquery('SELECT * FROM funcionario WHERE id ="1"');
            $data = $banco->retornaDados();
            
            $this->assertArrayHasKey('nome', $data, 'Consulta retornou vazio');
            
            $this->assertTrue(TRUE, $banco->salvar(1, array('nome' => 'Felipe Albert', 'profissao' => 'Tester'), 'Erro ao editar'));
        }
        
        public function testapagar()
        {
            $banco = new banco();
            
            $banco->rodaquery('SELECT * FROM funcionario');
            $qtd = $banco->contaLinhas();
            
            $this->assertEquals(1, $qtd, "Pre-Condicao");
            
            $this->assertTrue(TRUE, $banco->apagar(1));
            
            $banco->rodaquery('SELECT * FROM funcionario');
            $qtd = $banco->contaLinhas();
            
            $this->assertEquals(0, $qtd, "falha ao apagar");
        }
    }
    
?>