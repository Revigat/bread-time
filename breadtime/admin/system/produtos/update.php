<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Produto:</h1>
        </header>

        <?php
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $produtoid = filter_input(INPUT_GET, 'produtoid', FILTER_VALIDATE_INT);
        $delete = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_BOOLEAN);
        require('_models/AdminProdutos.class.php');
        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);


            $cadastra = new AdminProdutos;
            $cadastra->ExeUpdate($produtoid, $data);

            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        else:
            $read = new Read;
            $read->ExeRead("produtos", "WHERE produto_id = :id", "id={$produtoid}");
            if (!$read->getResult()):
                header('Location: painel.php?exe=produtos/index&empty=true');
            else:
                $data = $read->getResult()[0];
            endif;
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if($checkCreate && empty($cadastra)):

            WSErro("O produto <b>{$data['nome']}</b> foi cadastrado com sucesso no sistema! Continue atualizando a mesma!", WS_ACCEPT);
        endif;

        if ($delete == true){
          $cadastra = new AdminProdutos;
          $cadastra->ExeDelete($produtoid);
          header('Location: painel.php?exe=produtos/index&delete=true&produtoid='.$produtoid);
        }

        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">


            <label class="label">
                <span class="field">Nome:</span>
                <input type="text" name="nome" value="<?php if (isset($data)) echo $data['nome']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea name="descricao" rows="5"><?php if (isset($data)) echo $data['descricao']; ?></textarea>
            </label>

            <label class="label">
                <span class="field">Preço:</span>
                <textarea name="preco" type="text"><?php if (isset($data)) echo $data['preco']; ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small left">
                    <span class="field">Categoria:</span>
                    <select name="categoria">
                        <option value="null"> Selecione a Categoria </option>
                        <option value="Kit Festa"> Kit Festa </option>
                        <option value="Bolos"> Bolos </option>
                        <option value="Coffee Break"> Coffee Break </option>
                    </select>
                </label>
            </div>

            <div class="gbform"></div>

            <input type="submit" class="btn blue" value="Atualizar Produto" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->
