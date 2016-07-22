<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>Área Restrita</title>
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]>
        <script src="../js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

    <?php
    $login = new Login(3);

    if ($login->CheckLogin()):
        header('Location: painel.php');
    endif;

    $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (!empty($dataLogin['AdminLogin'])):

        $login->ExeLogin($dataLogin);
        if (!$login->getResult()):
            WSErro($login->getError()[0], $login->getError()[1]);
        else:
            header('Location: painel.php');
        endif;

    endif;

    $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
    if (!empty($get)):
        if ($get == 'restrito'):
            WSErro('<b>Oppsss:</b> Acesso negado. Favor efetue login para acessar o painel!', WS_ALERT);
        elseif ($get == 'logoff'):
            WSErro('<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada. Volte sempre!', WS_ACCEPT);
        endif;
    endif;
    ?>

    <div class="boxin">
        <div class="container">
            <img src="../img/logo.png"/>

            <form class="form-signin" name="AdminLoginForm" action="" method="post">
                <h2 class="form-signin-heading">Área Restrita</h2>
                <label for="inputEmail" class="sr-only">Login</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Login" name="user" required autofocus><br/>
                <label for="inputPassword" class="sr-only">Senha</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Senha" name="pass" required>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="lembrarme"> Lembrar-me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="AdminLogin">Entrar</button>
            </form>
        </div>
    </div><!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
    </body>
    </html>
<?php
ob_end_flush();
