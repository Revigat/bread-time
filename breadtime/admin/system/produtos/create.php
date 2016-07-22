<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Criar Produto:</h1>
        </header>

        <?php
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);

            require('_models/AdminProdutos.class.php');
            $cadastra = new AdminProdutos;
            $cadastra->ExeCreate($data);

            if (!$cadastra->getResult()):
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            else:
                header('Location: painel.php?exe=produtos/update&create=true&produtoid=' . $cadastra->getResult());
            endif;
        endif;
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

            <input type="submit" class="btn green" value="Cadastrar Produto" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->
