<?php

/**
 * AdminCategory.class [ MODEL ADMIN ]
 * Responável por gerenciar as categorias do sistema no admin!
 *
 * @copyright (c) 2016, BREAD TIME
 */
class AdminProdutos {

    private $Data;
    private $Produto;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const Entity = 'produtos';

    /**
     * <b>Cadastrar Categoria:</b> Envelope titulo, descrição, data e sessão em um array atribuitivo e execute esse método
     * para cadastrar a categoria. Case seja uma sessão, envie o category_parent como STRING null.
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Para cadastrar uma categoria, preencha todos os campos!', WS_ALERT];
        else:
            $this->setData();
            $this->setName();
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar Categoria:</b> Envelope os dados em uma array atribuitivo e informe o id de uma
     * categoria para atualiza-la!
     * @param INT $CategoryId = Id da categoria
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($ProdutoId, array $Data) {
        $this->Produto = (int) $ProdutoId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar o produto {$this->Data['nome']}, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->setName();
            $this->Update();
        endif;
    }

    /**
     * <b>Deleta categoria:</b> Informe o ID de uma categoria para remove-la do sistema. Esse método verifica
     * o tipo de categoria e se é permitido excluir de acordo com os registros do sistema!
     * @param INT $CategoryId = Id da categoria
     */
    public function ExeDelete($ProdutoId) {
        $this->Produto = (int) $ProdutoId;

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE produto_id = :delid", "delid={$this->Produto}");

        if (!$read->getResult()):
            $this->Result = false;
            $this->Error = ['Oppsss, você tentou remover um produto que não existe no sistema!', WS_INFOR];
        else:
            extract($read->getResult()[0]);
            $delete = new Delete;
            $delete->ExeDelete(self::Entity, "WHERE produto_id = :deletaid", "deletaid={$this->Produto}");
            $this->Result = true;
            $this->Error = ["O produto <b> {$nome}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
        endif;
    }

    /**
     * <b>Verificar Cadastro:</b> Retorna TRUE se o cadastro ou update for efetuado ou FALSE se não. Para verificar
     * erros execute um getError();
     * @return BOOL $Var = True or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com a mensagem e o tipo de erro!
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

     private function setData() {
         $this->Data['nome'] = Check::Name($this->Data['nome']);
     }

     //Verifica o NAME do produto. Se existir adiciona um pós-fix +1
     private function setName() {
         $Where = ( isset($this->Produto) ? "produto_id != {$this->Produto} AND" : '');

         $ReadName = new Read;
         $ReadName->ExeRead(self::Entity, "WHERE {$Where} nome = :t", "t={$this->Data['nome']}");
         if ($ReadName->getResult()):
             $this->Data['nome'] = $this->Data['nome'] . '-' . $ReadName->getRowCount();
         endif;
     }


     //Cadastra a empresa no banco!
     private function Create() {
         $Create = new Create;
         $Create->ExeCreate(self::Entity, $this->Data);
         if ($Create->getResult()):
             $this->Result = $Create->getResult();
             $this->Error = ["O produto <b>{$this->Data['nome']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
         endif;
     }

     //Atualiza a empresa no banco!
     private function Update() {
         $Update = new Update;
         $Update->ExeUpdate(self::Entity, $this->Data, "WHERE produto_id = :id", "id={$this->Produto}");
         if ($Update->getRowCount() >= 1):
             $this->Error = ["O produto <b>{$this->Data['nome']}</b> foi atualizado com sucesso!", WS_ACCEPT];
             $this->Result = true;
         endif;
     }


}
