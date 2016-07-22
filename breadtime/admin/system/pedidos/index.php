<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href='//fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>
<link
    href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
    rel='stylesheet' type='text/css'/>
<div class="content list_content" style="width: 80%;">
    <h1>Pedidos</h1>
    <?php

    $checkModif = filter_input(INPUT_GET, 'modif', FILTER_VALIDATE_BOOLEAN);
    $checkUpdate = filter_input(INPUT_GET, 'update', FILTER_VALIDATE_BOOLEAN);
    $pedidoid = filter_input(INPUT_GET, 'pedidoid', FILTER_VALIDATE_INT);
    $ativo = filter_input(INPUT_GET, 'status', FILTER_VALIDATE_INT);
    if ($checkModif && isset($pedidoid)){
        if($ativo==1){
          WSErro("O pedido de Nº <b>$pedidoid</b> foi marcado como <b>concluido</b> no sistema!", WS_ACCEPT);
        }else if($ativo==0){
          WSErro("O pedido de Nº <b>$pedidoid</b> foi marcado como <b>em andamento</b> no sistema!", WS_INFOR);
        }
    }
    if ($checkUpdate){
      WSErro("O pedido de Nº <b>$pedidoid</b> foi atualizado com sucesso no sistema!", WS_ACCEPT);

    }


    $readPedidos = new Read;
    $readPedidos->ExeRead("pedidos", "ORDER BY id_pedido DESC");
    if ($readPedidos->getResult()): ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Nº</th>
            <th>Coffe Break</th>
            <th>Kit Festa</th>
            <th>Bolo</th>
            <th>Nome do Cliente</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>CEP</th>
            <th>Data</th>
            <th>Valor Total</th>
            <th>Editar</th>
            <th>Entregue</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($readPedidos->getResult() as $pedidos): extract($pedidos);
            if ($status == 1):?>
                <tr>
                    <td style="text-align: center;">
                        <?php echo $id_pedido; ?>
                    </td>
                    <td><?php echo $coffe; ?></td>
                    <td><?php echo $festa; ?></td>
                    <td><?php echo $bolo; ?></td>
                    <td><?php echo $nome; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $fone; ?></td>
                    <td><?php echo $cep; ?></td>
                    <td><?php echo $data; ?></td>
                    <td>R$: <?php echo $valortotal; ?></td>
                    <td style="text-align: center;">
                        <a href="#">
                            <img src="./icons/block_icon.png"/>
                        </a>
                    </td>
                    <td style="text-align: center;">
                            <a href="painel.php?exe=pedidos/update&pedidoid=<?=$id_pedido;?>&ativo=0">
                            <img src="./icons/tick_green.png"/>
                        </a>
                    </td>
                </tr>
              <?php endif;
                if ($status == 0):?>
                        <td style="text-align: center;">
                            <?php echo $id_pedido; ?>
                        </td>
                        <td><?php echo $coffe; ?></td>
                        <td><?php echo $festa; ?></td>
                        <td><?php echo $bolo; ?></td>
                        <td><?php echo $nome; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $fone; ?></td>
                        <td><?php echo $cep; ?></td>
                        <td><?php echo $data; ?></td>
                        <td>R$: <?php echo $valortotal; ?></td>
                        <td style="text-align: center;">
                            <a href="painel.php?exe=pedidos/update&pedidoid=<?=$id_pedido;?>">
                                <img src="./icons/edit_icon.png"/>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <a href="painel.php?exe=pedidos/update&pedidoid=<?=$id_pedido;?>&ativo=1">
                                <img src="./icons/tick_inprogress.png"/>
                            </a>
                        </td>
                    </tr>
            <?php endif; endforeach;
        else:
            WSErro("Desculpe, ainda não existem pedidos cadastrados!", WS_INFOR);
        endif;
        ?>
        </tbody>
    </table>
    <div class="clear"></div>
</div>
