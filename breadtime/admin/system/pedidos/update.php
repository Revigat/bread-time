<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Pedido:</h1>
        </header>

        <?php

        $readPedidos = new Read;
        $readPedidos->ExeRead("pedidos", "ORDER BY id_pedido DESC");

        $pedidoid = filter_input(INPUT_GET, 'pedidoid', FILTER_VALIDATE_INT);
        $ativo = filter_input(INPUT_GET, 'ativo', FILTER_VALIDATE_INT);

        if (isset($pedidoid) && isset($ativo)){

          foreach ($readPedidos->getResult() as $pedidos) {
            extract ($pedidos);

            if ($id_pedido == $pedidoid){
              require('../admin/_models/AdminPost.class.php');

              if ($ativo==1){
                $pedidos['status']=1;
              }else if($ativo==0){
                $pedidos['status']=0;
              }
              $Update = new Update;
              try {
                $Update->ExeUpdate("pedidos", $pedidos, "WHERE id_pedido = :id", "id=$id_pedido");
                header('Location: painel.php?exe=pedidos/index&modif=true&pedidoid='.$id_pedido.'&status='.$pedidos['status']);
              } catch (Exception $e) {
                WSErro($Update->getError()[0], $Update->getError()[1]);
              }
            }
          }
        }

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);


            $cadastra = new Update;

            try {
              $cadastra->ExeUpdate("pedidos", $data, "WHERE id_pedido = :id", "id=$pedidoid");
              header('Location: painel.php?exe=pedidos/index&update=true&pedidoid='.$pedidoid);
            } catch (Exception $e) {
              WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            }
        else:
            $read = new Read;
            $read->ExeRead("pedidos", "WHERE id_pedido = :id", "id={$pedidoid}");
            if (!$read->getResult()):
                header('Location: painel.php?exe=pedidos/index&empty=true');
            else:
                $data = $read->getResult()[0];
            endif;
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if($checkCreate && empty($cadastra)):

            WSErro("O produto <b>{$data['nome']}</b> foi cadastrado com sucesso no sistema! Continue atualizando a mesma!", WS_ACCEPT);
        endif;

        ?>

            <form name="PostForm" action="" method="post" enctype="multipart/form-data">

              <label class="label">
                  <span class="field">Número do Pedido: <?php if (isset($data)) echo $data['id_pedido']; ?></span>
              </label>

              <label class="label">
                  <span class="field">Nome:</span>
                  <input type="text" name="nome" value="<?php if (isset($data)) echo $data['nome']; ?>" />
              </label>

              <label class="label">
                  <span class="field">Email:</span>
                  <input type="text" name="email" value="<?php if (isset($data)) echo $data['email']; ?>" />
              </label>

              <label class="label">
                  <span class="field">Telefone:</span>
                  <input type="text" name="fone" value="<?php if (isset($data)) echo $data['fone']; ?>" />
              </label>

              <label class="label">
                  <span class="field">Cep: </span>
                  <input type="text" name="cep" value="<?php if (isset($data)) echo $data['cep']; ?>" />
              </label>

              <label class="label">
                  <span class="field">Kit Festa:</span>
                  <input type="text" name="festa" value="<?php if (isset($data)) echo $data['festa']; ?>" />
              </label>

              <label class="label">
                  <span class="field">Bolo:</span>
                  <input type="text" name="bolo" value="<?php if (isset($data)) echo $data['bolo']; ?>" />
              </label>

              <label class="label">
                  <span class="field">Coffee Break:</span>
                  <input type="text" name="coffe" value="<?php if (isset($data)) echo $data['coffe']; ?>" />
              </label>

              <label class="label">
                    <span class="field">Total do Pedido:</span>
                    <textarea name="valortotal" type="text"><?php if (isset($data)) echo $data['valortotal']; ?></textarea>
              </label>


              <div class="gbform"></div>

              <input type="submit" class="btn blue" value="Atualizar Pedido" name="SendPostForm" />
            </form>

        </article>

        <div class="clear"></div>
</div>

<!-- content home -->
