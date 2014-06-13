<?php

    require_once 'banco.php';
    
    class bancoTest extends PHPUnit_Framework_TestCase {
        
        /**
         * @covers banco::conecta
         */
        public function testconecta()
        {
            $banco = new Banco();
            
            $this->assertTrue($banco->conecta());
        }
        
        /**
         * @covers banco::salvar
         * @covers banco::rodaquery
         * @covers banco::contaLinhas
         * @covers banco::limpaString
         */
        public function testadicionar()
        {
            $banco = new Banco();
            
            $this->assertTrue($banco->salvar(false, array('nome' => 'Felipe', 'profissao' => 'Programador')), 'Erro ao inserir');
            
            $banco->rodaquery('SELECT * FROM funcionario');
            $qtd = $banco->contaLinhas();
            
            $this->assertGreaterThanOrEqual(1, $qtd, "Falha na insercao");
        }
        
        /**
         * @covers banco::salvar
         * @covers banco::rodaquery
         * @covers banco::contaLinhas
         * @covers banco::limpaString
         */
        public function testadicionarFalse()
        {
            $banco = new Banco();
            
            $this->assertFalse($banco->salvar('teste', array('nome' => 'Felipe', 'profissao' => 'Programador')), 'Erro na falha ao inserir');
            
            $banco->rodaquery('SELECT * FROM funcionario');
            $qtd = $banco->contaLinhas();
            
            $this->assertGreaterThanOrEqual(1, $qtd, "Falha na falha da insercao");
        }
        
        /**
         * @covers banco::rodaquery
         * @covers banco::retornaDados
         * @covers banco::salvar
         * @covers banco::limpaString
         */
        public function testeditar()
        {
            $banco = new Banco();
            $banco->rodaquery('SELECT * FROM funcionario WHERE id ="1"');
            $data = $banco->retornaDados(true);
            
            $this->assertArrayHasKey('nome', $data, 'Consulta retornou vazio');
            
            $this->assertTrue($banco->salvar(1, array('nome' => 'Felipe Albert', 'profissao' => 'Tester'), 'Erro ao editar'));
        }
        
        /**
         * @covers banco::rodaquery
         * @covers banco::retornaDados
         * @covers banco::salvar
         * @covers banco::limpaString
         */
        public function testeditarFalse()
        {
            $banco = new Banco();
            $banco->rodaquery('SELECT * FROM funcionario WHERE id ="1"');
            $data = $banco->retornaDados(true);
            
            $this->assertArrayHasKey('nome', $data, 'Consulta retornou vazio');
            
            $this->assertFalse($banco->salvar('teste', array('nome' => 'Felipe Albert', 'profissao' => 'Tester'), 'Erro na falha ao editar'));
        }
        
        /**
         * @covers banco::apagar
         */
        public function testapagar()
        {
            $banco = new Banco();
            
            $this->assertTrue($banco->apagar(1), 'Falha ao apagar');
        }
        
        /**
         * @covers banco::rodaquery
         * @covers banco::retornaDados
         */
        public function testlistar()
        {
            $banco = new Banco();
            $banco->rodaquery('SELECT * FROM funcionario');
            $data = $banco->retornaDados(false);
            
            $this->assertGreaterThanOrEqual(1, count($data));
        }
        
        /**
         * @covers banco::limpaBanco
         * @covers banco::rodaquery
         */
        public function testlimpaBanco()
        {
            $banco = new Banco();
            $this->assertTrue($banco->limpaBanco());
        }
    }
?>