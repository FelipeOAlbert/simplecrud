<?php

    require_once 'banco.php';
    
    class bancoTest extends PHPUnit_Framework_TestCase {
        
        /**
         * @covers banco::conecta
         */
        public function testconecta()
        {
            $banco = new banco();
            
            $this->assertTrue($banco->conecta());
        }
        
        /**
         * @covers banco::salvar
         */
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
        
        /**
         * @covers banco::retornaDados
         * @covers banco::salvar
         */
        public function testeditar()
        {
            $banco = new banco();
            $banco->rodaquery('SELECT * FROM funcionario WHERE id ="1"');
            $data = $banco->retornaDados(true);
            
            $this->assertArrayHasKey('nome', $data, 'Consulta retornou vazio');
            
            $this->assertTrue(TRUE, $banco->salvar(1, array('nome' => 'Felipe Albert', 'profissao' => 'Tester'), 'Erro ao editar'));
        }
        
        /**
         * @covers banco::apagar
         */
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
        
        /**
         * @covers banco::rodaquery
         * @covers banco::retornaDados
         */
        public function testlistar()
        {
            $this->testadicionar();
            
            $banco = new banco();
            $banco->rodaquery('SELECT * FROM funcionario');
            $data = $banco->retornaDados();
            
            $this->assertCount(1, $data);
        }
    }
    
?>