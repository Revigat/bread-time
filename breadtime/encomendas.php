<?php require('_app/Config.inc.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Encomendas</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- //for-mobile-apps -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- js -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- //js -->
    <!-- animation-effect -->
    <link href="css/animate.min.css" rel="stylesheet">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->
    <link href='//fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <!-- start-smooth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
    <!--    start-smooth-scrolling-->
    <script>
        $(document).ready(function () {
            $(".flip1").click(function () {
                $(".panel1").toggle();
            });
        });
        $(document).ready(function () {
            $(".flip2").click(function () {
                $(".panel2").toggle();
            });
        });
        $(document).ready(function () {
            $(".flip3").click(function () {
                $(".panel3").toggle();
            });
        });
        $(document).ready(function () {
            $(".flip4").click(function () {
                $(".panel4").toggle();
            });
        });
        $(document).ready(function () {
            $(".flip5").click(function () {
                $(".panel5").toggle();
            });
        });
        $(document).ready(function () {
            $(".flip6").click(function () {
                $(".panel6").toggle();
            });
        });
        $(document).ready(function () {
            $(".flip7").click(function () {
                $(".panel7").toggle();
            });
        });
    </script>
    <style type="text/css">
        div.panel1, div.panel2, div.panel3, div.panel4, div.panel5, div.panel6, div.panel7, p.flip1, p.flip2, p.flip3, p.flip4, p.flip5, p.flip6, p.flip7 {
            line-height: 30px;
            margin: auto;
            font-size: 16px;
            padding: 10px;
            background: #555;
            border: solid 1px #666;
            border-radius: 3px;
        }

        div.panel1, div.panel2, div.panel3, div.panel4, div.panel5, div.panel6, div.panel7 {
            height: auto;
            display: none;
        }

        p.flip1, p.flip2, p.flip3, p.flip4, p.flip5, p.flip6, p.flip7 {
            cursor: pointer;
            color: #FFF;
            font-weight: bolder;
        }

    </style>
</head>

<body>
<!-- banner -->
<div class="banner-figures">
    <div class="banner1">
        <div class="container banner-drop">
            <div class="header1">
                <div class="header-right">
                    <nav>
                        <ul>
                            <li>
                                <a href="index.php"><i class="glyphicon glyphicon-home" aria-hidden="true"></i><span>Início</span></a>
                            </li>
                            <li class="active">
                                <a href="encomendas.php"><i class="glyphicon glyphicon-shopping-cart"
                                                            aria-hidden="true"></i><span>Encomendas</span></a>
                            </li>
                            <li>
                                <a href="noticias.php"><i class="glyphicon glyphicon-globe"
                                                          aria-hidden="true"></i><span>Notícias</span></a>
                            </li>
                            <li>
                                <a href="contato.php"><i class="glyphicon glyphicon-envelope"
                                                         aria-hidden="true"></i><span>Contato</span></a>
                            </li>
                            <li>
                                <a href="sobre.html"><i class="glyphicon glyphicon-exclamation-sign"
                                                        aria-hidden="true"></i><span>Sobre</span></a>
                            </li>
                        </ul>
                    </nav>
                    <!--<div class="menu-icon animated wow zoomIn" data-wow-duration="1000ms" data-wow-delay="800ms">
                    <span></span></div>-->
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="logo animated wow bounceInDown" data-wow-duration="800ms" data-wow-delay="250ms">
                <h1><a href="index.php"><img src="images/logob.png"/></a></h1>
            </div>
            <!--            <div class="social-icons animated wow bounceInDown" data-wow-duration="1000ms" data-wow-delay="800ms">
                            <ul>
                                  <li><a href="#" class="twitter"></a></li>
                                  <li><a href="#" class="google"></a></li>
                                  <li><a href="https://www.facebook.com/Familiamuczinski/" class="facebook" target="_blank"></a></li>
                                  </ul>
                            </div>-->
        </div>
    </div>
    <!--    <script>
                  (function ($) {
                    $(".menu-icon").on("click", function () {
                        $(this).toggleClass("open");
                        $(".container").toggleClass("nav-open");
                        $("nav ul li").toggleClass("animate");
                      });

                    })(jQuery);
                  </script>-->
</div>
<!-- //banner -->
<!-- CORPO DA PÁGINA -->
<div class="blog">
    <div class="container">

        <?php
        if (isset($_POST['SendPedido'])):
            $fields = array('festa' => $_POST['festa'], 'bolo' => $_POST['bolo'], 'coffe' => $_POST['coffe'], 'nome' => $_POST['nome'], 'email' => $_POST['email'], 'fone' => $_POST['fone'], 'cep' => $_POST['cep'], 'data' => $_POST['data']);
            $cadastra = new Create;
            try {
                if ($_POST['festa'] != "" || $_POST['bolo'] != "" || $_POST['coffe'] != ""):
                    $cadastra->ExeCreate('pedidos', $fields);
                    $cadastra->getResult();
                    unset($_POST['SendPedido']);
                    echo "<script>window.location.replace(\"encomendas.php?cad=true\");</script>";
                else:
                    echo "<script>window.location.replace(\"encomendas.php?cad=null\");</script>";
                endif;
            } catch (Exception $e) {
                echo "<script>window.location.replace(\"encomendas.php?cad=false\");</script>";
            }
        endif;

        if (isset($_GET['cad'])) {
            if ($_GET['cad'] == "true") {
                echo "<h2 style=\"margin: 0 auto; text-align: center;\"><div class=\"label label-success\">Aguarde o retorno. Entraremos em contato em no máximo 30min (horário comercial). </div></h2>";
                echo "<br><br><hr/>";
            } else if ($_GET['cad'] == "false") {
                echo "<h2 style=\"margin: 0 auto; text-align: center;\"><div class=\"label label-danger\" style=\"text-align: center;\">Ocorreu um erro ao registrar o pedido!</div></h2>";
                echo "<br><h4 style=\"margin: 0 auto; text-align: center;\">Por favor, tente novamente!</h4>";
                echo "<br><br><hr/>";
            } elseif ($_GET['cad'] == "null") {
                echo "<h2 style=\"margin: 0 auto; text-align: center;\"><div class=\"label label-danger\" style=\"text-align: center;\">Favor selecionar ao menos um produto!</div></h2>";
            }
        }
        ?>

        <br>

        <h1 style="margin: 0 auto; text-align: center;">Faça sua encomenda de kits de festa, bolos e coffe breaks</h1>
        <hr/>

        <div>
            <div style="width: 55%; float:left;">
                <div id="right">
                    <h2 style="">Kits para festa</h2>
                    <br>
                    <div class="label label-success label-topright">R$649,00 (80 pessoas).</div>
                    <p class="flip1">KIT FESTA OURO</p>

                    <div class="panel1">
                        <div class="well">
                            <img src="images/gold.png"/>
                            <ul style="overflow:auto; height:210px; width:300px; float:right">
                                <li class="list-group-item">8 Kg Bolo (Consulte sabores)</li>
                                <li class="list-group-item">650 Salgadinhos (Coxinha, Risoles, Bolinha Queijo, Kibe ou
                                    Mini
                                    pastel)
                                </li>
                                <li class="list-group-item">450 Docinhos (Brigadeiro, Dois Amores, Beijinho, Olho de
                                    Sogra ou
                                    Cajuzinho)
                                </li>
                                <li class="list-group-item">30 litros de refrigerante (Coca cola, Fanta, Kuat ou
                                    Sprit)
                                </li>
                                <li class="list-group-item">100 copos descartáveis</li>
                                <li class="list-group-item">100 guardanapos</li>
                                <li class="list-group-item">100 garfos</li>
                                <li class="list-group-item">80 Pratos</li>
                            </ul>
                        </div>
                    </div>

                    <br>

                    <div class="label label-success label-topright">R$ 399,90 (50 pessoas).</div>
                    <p class="flip2">KIT FESTA PRATA</p>

                    <div class="panel2">
                        <div class="well">
                            <img src="images/silver.png"/>
                            <ul style="overflow:auto; height:210px; width:300px; float:right">
                                <li class="list-group-item">5 Kg Bolo (Consulte sabores)</li>
                                <li class="list-group-item">400 Salgadinhos (Coxinha, Risoles, Bolinha Queijo, Kibe ou
                                    Mini
                                    pastel)
                                </li>
                                <li class="list-group-item">250 Docinhos (Brigadeiro, Dois Amores, Beijinho, Olho de
                                    Sogra ou
                                    Cajuzinho)
                                </li>
                                <li class="list-group-item">20 litros de refrigerante (Coca cola, Fanta, Kuat ou
                                    Sprit)
                                </li>
                                <li class="list-group-item">50 copos descartáveis</li>
                                <li class="list-group-item">50 guardanapos</li>
                                <li class="list-group-item">50 Pratos</li>
                                <li class="list-group-item">50 garfos</li>
                            </ul>
                        </div>
                    </div>

                    <br>

                    <div class="label label-success label-topright">R$ 299,99 (30 pessoas).</div>
                    <p class="flip3">KIT FESTA BRONZE</p>

                    <div class="panel3">
                        <div class="well">
                            <img src="images/bronze.png"/>
                            <ul style="overflow:auto; height:210px; width:300px; float:right">
                                <li class="list-group-item">3 Kg Bolo (Consulte sabores)</li>
                                <li class="list-group-item">250 Salgadinhos (Coxinha, Risoles, Bolinha Queijo, Kibe ou
                                    Mini
                                    pastel)
                                </li>
                                <li class="list-group-item">180 Docinhos (Brigadeiro, Dois Amores, Beijinho, Olho de
                                    Sogra ou
                                    Cajuzinho)
                                </li>
                                <li class="list-group-item">10 litros de refrigerante (Coca cola, Fanta, Kuat ou
                                    Sprit)
                                </li>
                                <li class="list-group-item">30 copos descartáveis</li>
                                <li class="list-group-item">50 guardanapos</li>
                                <li class="list-group-item">30 Pratos</li>
                                <li class="list-group-item">50 garfos</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br/>

                <div id="right">
                    <h2 style="">Coffee Break</h2>
                    <br>

                    <div class="label label-success label-topright">R$11,50 por pessoa (Min. 20)</div>
                    <p class="flip4">COFFEE BREAK OURO</p>

                    <div class="panel4">
                        <div class="well">
                            <img src="images/gold.png"/>
                            <ul style="width:50%; float:right">
                                <li class="list-group-item">Porção média de 10 itens por pessoa 400 ml de bebida por
                                    pessoa.
                                </li>
                                <li class="list-group-item">Dez opções do cardápio entre doces e salgados.</li>
                                <li class="list-group-item">Três opções de bebida + Descartável.</li>
                            </ul>
                        </div>
                    </div>

                    <br>

                    <div class="label label-success label-topright">R$ 9,50 por pessoa (Min. 20).</div>
                    <p class="flip5">COFFEE BREAK PRATA</p>

                    <div class="panel5">
                        <div class="well">
                            <img src="images/silver.png"/>
                            <ul style="width:50%; float:right">
                                <li class="list-group-item">Porção média de 8 itens por pessoa 350 ml de bebida por
                                    pessoa.
                                </li>
                                <li class="list-group-item">Oito opções do cardápio entre doces e salgados.</li>
                                <li class="list-group-item">Duas opções de bebida + Descartável..</li>
                            </ul>
                        </div>
                    </div>

                    <br>

                    <div class="label label-success label-topright">R$8,50 por pessoa (Min. 20)</div>
                    <p class="flip6">COFFEE BREAK BRONZE</p>

                    <div class="panel6">
                        <div class="well">
                            <img src="images/bronze.png"/>
                            <ul style="width:50%; float:right">
                                <li class="list-group-item">Porção média de 5 itens por pessoa 300 ml bebida por
                                    pessoa.
                                </li>
                                <li class="list-group-item">Cinco opções do cardápio entre doces e salgados.</li>
                                <li class="list-group-item">Duas opção de bebida + Descartável.</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <br/>

                <div id="right">
                    <h2 style="">Bolos</h2>
                    <br>

                    <div class="label label-success label-topright">A partir de R$32,90 por Kilo</div>
                    <p class="flip7">BOLOS</p>

                    <div class="panel7">
                        <div class="well" style="text-align: center;">
                            <img src="images/bolo1.jpg"
                                 style="width: 250px; height: 188px; border-radius: 5px; margin: 7px;"/>
                            <img src="images/bolo2.jpg"
                                 style="width: 250px; height: 188px; border-radius: 5px; margin: 7px;"/>
                            <img src="images/bolo3.jpg"
                                 style="width: 250px; height: 188px; border-radius: 5px; margin: 7px;"/>
                            <img src="images/bolo4.jpg"
                                 style="width: 250px; height: 188px; border-radius: 5px; margin: 7px;"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORMULÁRIO INÍCIO -->
            <div class="col-md-6 map-grid" style="border:solid 2px #666; float:right; border-radius: 5px; width: 400px; height: 840px;">
                <form method="post">
                    <fieldset>
                        <h3 style="padding-left: 35px;">Informações do <span>Cliente</span></h3>
                        <br>
                        <label>
                            Nome:
                            <br>
                            <input type="text" name="nome" style="margin: 7px; width: 300px;" required="true" size="255"
                                   placeholder="Informe seu nome"/>
                        </label>
                        <br>
                        <label>
                            E-mail:
                            <br>
                            <input type="email" name="email" style="margin: 7px; width: 300px;" required="true"
                                   size="255"
                                   placeholder="Ex. Email@host.com"/>
                        </label>
                        <br>
                        <label>
                            Telefone:
                            <br>
                            <input type="text" name="fone" style="margin: 7px; width: 300px;" required="true" size="255"
                                   placeholder="Ex. xx000000000"/>
                        </label>
                        <br>
                        <label>
                            Cep:
                            <br>
                            <input type="text" name="cep" style="margin: 7px; width: 300px;" required="true" size="255"
                                   placeholder="Ex. xxxxxxxx"/>
                        </label>
                    </fieldset>
                    <br>
                    <fieldset>
                        <h3 style="padding-left: 35px;">Informações do <span>Pedido</span></h3>
                        <br>
                        <h4 style="margin: 5px 0 0 0;">Kit Festa</h4>
                        <label>
                            <select style="margin: 20px; width: 250px;" name="festa">
                                <option value=""> Selecione o KIT FESTA:</option>
                                <?php
                                $readKit = new Read;
                                $readKit->ExeRead("produtos", "WHERE categoria = 'Kit Festa'");
                                if ($readKit->getRowCount() >= 1):
                                    foreach ($readKit->getResult() as $ses):
                                        echo "<option>{$ses['nome']}</option>";
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </label>
                        <br>
                        <h4 style="margin: 5px 0 0 0;">Coffe Break</h4>
                        <label>
                            <select style="margin: 20px; width: 250px;" name="coffe">
                                <option value=""> Selecione o Coffee Break:</option>
                                <?php
                                $readCoffee = new Read;
                                $readCoffee->ExeRead("produtos", "WHERE categoria = 'Coffee Break'");
                                if ($readCoffee->getRowCount() >= 1):
                                    foreach ($readCoffee->getResult() as $ses):
                                        echo "<option>{$ses['nome']}</option>";
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </label>
                        <br>
                        <h4 style="margin: 5px 0 0 0;">Bolos</h4>
                        <label>
                            <select style="margin: 20px; width: 250px;" name="bolo">
                                <option value=""> Selecione o Bolo:</option>
                                <?php
                                $readBolo = new Read;
                                $readBolo->ExeRead("produtos", "WHERE categoria = 'Bolo'");
                                if ($readBolo->getRowCount() >= 1):
                                    foreach ($readBolo->getResult() as $ses):
                                        echo "<option>{$ses['nome']}</option>";
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </label>
                    </fieldset>
                    <input type="hidden" name="data" value="<?php echo date('Y-m-d H:m'); ?>">
                    <input style="margin: 10px;" type="submit" value="Enviar pedido" name="SendPedido"/>
                </form>
            </div>
        </div>
        <!-- FORMULÁRIO FIM -->
    </div>
</div>
</div>
<!-- FIM DO CORPO DA PÁGINA -->
<!-- footer-top -->
<div class="footer-top animated wow zoomInDown" data-wow-duration="1000ms" data-wow-delay="200ms">
    <div class="container">
        <h3>Entre em contato conosco <span>(41) 3044-0442</span></h3>
        <!-- Abaixo existia informações da pagina-->
        <p><span> </span></p>

        <div class="more">
            <a href="contato.php">Contato</a>
        </div>
    </div>
</div>
<!-- //footer-top -->
<!-- footer -->
<!--<div class="footer-copy animated wow bounceInDown" data-wow-duration="1000ms" data-wow-delay="800ms">-->
<div class="footer-copy">
    <div class="container">
        <div class="footer-copy-grids">
            <div class="col-md-3 footer-copy-grid">
                <h3>Sobre <span>Muczinski</span></h3>
                <img src="images/muczinski1.jpg" alt=" " class="img-responsive"/>

                <p style="text-align: justify;">Inaugurada em 2010, A Panificadora e Confeitaria Família Muczinski é um
                    exemplo de empresa familiar
                    que deu certo!
                    Com um amplo mix de bolos, doces, salgados, kit festa e coffee break... <a href="sobre.html">
                        Continue lendo.</a></p>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <h3>Contato<span>.</span></h3>

                <form>
                    <input type="text" value="Nome" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Name';}" required="">
                    <input type="email" value="Email" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Email';}" required="">
                    <textarea type="text" onfocus="this.value = '';"
                              onblur="if (this.value == '') {this.value = 'Message...';}"
                              required="">Mensagem...</textarea>
                    <input type="submit" value="Enviar">
                </form>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <h3>Produtos <span>populares</span></h3>

                <div class="footer-copy-grids">
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/1.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/2.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/3.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="footer-copy-grids">
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/4.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/5.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/2.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <div class="col-md-3 footer-copy-grid">
                    <h3>Navegação</h3>
                    <ul>
                        <li><a href="index.php">Início</a></li>
                        <li><a href="encomendas.php">Encomendas</a></li>
                        <li><a href="noticias.php">Notícias</a></li>
                        <li><a href="contato.php">Contato</a></li>
                        <li><a href="sobre.html">Sobre</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--<div class="footer animated wow bounce" data-wow-duration="1000ms" data-wow-delay="800ms">-->
<div class="footer">
    <div class="container">
        <p>© 2016 Familia Muczinski. Todos os direitos reservados.</p>
    </div>
</div>
<!-- //footer -->
<script type="text/javascript">
    $(document).ready(function () {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({easingType: 'easeOutQuart'});

    });
</script>
</body>
</html>