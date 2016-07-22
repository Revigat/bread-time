<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href='//fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>
<link
    href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
    rel='stylesheet' type='text/css'/>
<div class="content list_content" style="width: 80%;">
    <h1>Produtos: </h1>

    <?php



    $delete = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_BOOLEAN);
    $produtoid = filter_input(INPUT_GET, 'produtoid', FILTER_VALIDATE_INT);

    /*if($delete && isset($produtoid)){
      WSErro("O produto de Nº <b>$produtoid</b> foi excluido com sucesso!", WS_ACCEPT);
    }*/

    $readProdutos = new Read;
    $readProdutos->ExeRead("produtos", "ORDER BY produto_id DESC");
    if ($readProdutos->getResult()): ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <!--<th>Nº</th>-->
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Editar</th>
            <!--<th>Excluir</th>-->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($readProdutos->getResult() as $produtos): extract($produtos);
            ?>
                <tr>
                    <!--<td style="text-align: center;">
                        <?php //echo $produto_id; ?>
                    </td>-->
                    <td><?php echo $nome; ?></td>
                    <td><?php echo $categoria; ?></td>
                    <td><?php echo $preco; ?></td>
                    <td style="text-align: center;">
                        <a href="painel.php?exe=produtos/update&produtoid=<?=$produto_id;?>">
                            <img src="./icons/edit_icon.png"/>
                        </a>
                    </td>
                    <!--<td style="text-align: center;">
                        <a href="painel.php?exe=produtos/update&produtoid=<?=$produto_id;?>&delete=true">
                            <img src="./icons/tick_green.png"/>
                        </a>
                    </td>-->
                </tr>
            <?php endforeach;
        else:
            WSErro("Desculpe, ainda não existem produtos cadastrados!", WS_INFOR);
        endif;
        ?>
        </tbody>
    </table>
    <div class="clear"></div>
</div>
