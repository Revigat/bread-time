<!DOCTYPE html>
<html>
<head>
    <title>Notícias</title>
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
    <!-- start-smooth-scrolling -->
</head>

<body>
<!-- banner -->
<div class="banner-figures">
    <div class="banner1">
        <div class="container banner-drop">
            <div class="header1">
                <div class="header-right">
                    <nav >
                        <ul>
                            <li>
                                <a href="index.php"><i class="glyphicon glyphicon-home" aria-hidden="true"></i><span>Início</span></a>
                            </li>
                            <li>
                                <a href="encomendas.php"><i class="glyphicon glyphicon-shopping-cart"
                                                             aria-hidden="true"></i><span>Encomendas</span></a>
                            </li>
                            <li class="active">
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


<div class="blog">
    <div class="container">
        <div class="col-md-8 blog-left">
            <?php
            require('_app/Config.inc.php');
            $read = new Read;
            $readaut = new Read;
            $readcat = new Read;

            //Read Users e Categoria
            $readaut->ExeRead('ws_users', " ", "");
            $readcat->ExeRead('ws_categories', " ", "");

            //Get do paginação
            if (isset($_GET["page"])) {
                $pageID = $_GET["page"] + '';
            } else {
                $pageID = 1;
            }
            //Limit da leitura do BD
            $bdLimit = $pageID * 3;
            $read->ExeRead("ws_posts", "WHERE post_status='1'ORDER BY post_date DESC LIMIT " . $bdLimit);
            //Estabelecendo o Limit de posts
            $pageLimit = $bdLimit - 3;

            $filt_qublinha = array(chr(13));
            $filt_char = array("<br>");
            $ccPosts = 0;

            foreach ($read->getResult() as $post) {
                extract($post);

                if ($ccPosts >= $pageLimit) {

                    echo "<div class=\"comments-list hover14 column\" data-wow-duration=\"1200ms\" data-wow-delay=\"500ms\">";
                    //Titulo
                    echo "<ul>";
                    echo "<h3>$post_title</h3>";
                    //VER POST
                    echo "<li><a href=\"posts/post.php?id=$post_id\" class=\"bake\">Ver Post</a> <i>|</i></li>";
                    //DATA
                    echo "<li><span class=\"glyphicon glyphicon-calendar\" aria-hidden=\"true\"> " . date('d/m/Y', strtotime($post_date)) . "</span><i>|</i></li>";
                    //Categoria
                    if ($post_category != null) {
                        foreach ($readcat->getResult() as $category) {
                            extract($category);
                            if ($category_id == $post_category) {
                                echo "<li><a href=\"posts/categoria.php?catid=$post_category\"><span class=\"glyphicon glyphicon-tag\" aria-hidden=\"true\"></span>$category_name</a> <i>|</i></li>";
                            }
                        }
                    } else {
                        echo "<li><a href=\"#\"><span class=\"glyphicon glyphicon-tag\" aria-hidden=\"true\"></span>Categoria Desconhecida</a> <i>|</i></li>";
                    }
                    //Autor
                    if ($post_author != null) {
                        foreach ($readaut->getResult() as $user) {
                            extract($user);
                            if ($user_id == $post_author) {
                                echo "<li><a href=\"#\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span>$user_name</a>";
                            }
                        }
                    } else {
                        echo "<li><a href=\"#\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span>Autor Desconhecido</a>";
                    }

                    echo "</li>";
                    echo "</ul>";
                    echo "<div>";
                    //Imagem
                    echo "<figure><a href=\"posts/post.php?id=$post_id\"><img src=\"uploads/$post_cover\" alt=\" \" class=\"img-responsive\"/></a></figure>";
                    echo "</div>";
                    //Conteudo
                    echo "<p>" . str_replace($filt_qublinha, $filt_char, $post_content) . "</p>";
                    echo "</div>";

                }
                $ccPosts++;
            }


            ?>


            <nav>
                <ul class="pagination paging animated wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="500ms">
                    <?php

                    //Numero de Posts
                    $readAllPosts = new Read;
                    $readAllPosts->ExeRead("ws_posts", " WHERE post_status='1'");
                    $numPosts = count($readAllPosts->getResult());
                    //Declarando limite de paginas em cima dos posts.
                    $limitPagePost = ceil($numPosts / 3);

                    //Gerando botoes de paginas
                    if ($pageID > 1) {
                        $lastPage = $pageID - 1;
                        echo "<li>";
                        echo "<a href=\"../breadtime/noticias.php?page=$lastPage\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a>";
                        echo "</li>";
                    }

                    for ($i = 1; $i <= $limitPagePost; $i++) {
                        echo "<li><a href=\"../breadtime/noticias.php?page=$i\">$i</a></li>";
                    }

                    if ($pageID != $limitPagePost) {
                        $nextPage = $pageID + 1;
                        echo "<li>";
                        echo "<a href=\"../breadtime/noticias.php?page=$nextPage\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>

        <!--Mais populares-->

        <div class="col-md-4 blog-right">
            <div class="popular animated wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="500ms">
                <h3>Mais populares</h3>

                <div class="popular-grid">


                    <?php
                    //Ler do banco os posts populares
                    $readPopular = new read;
                    $readPopular->ExeRead("ws_posts", "ORDER BY post_views DESC LIMIT 3");
                    $countPost = 1;

                    //Imprimir na aba-populares
                    foreach ($readPopular->getResult() as $post) {
                        extract($post);

                        echo "<div class=\"popular-left\">";
                        echo "<h4>0$countPost.</h4>";
                        echo "</div>";
                        echo "<div class=\"popular-right\">";
                        echo "<h5><a href=\"posts/post.php?id=$post_id\">$post_title</a></h5>";
                        echo "<p>" . substr($post_content, 0, 80) . "...";
                        echo "<span>Postado em " . date('d/m/Y', strtotime($post_date)) . "</span></p><br>";
                        echo "</div>";
                        echo "<div class=\"clearfix\"></div>";

                        //Post Count
                        $countPost++;
                    }

                    ?>
                </div>
            </div>
            <!--<div class="subscribe animated wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="500ms">
                <h3>Newsletter</h3>

                <p>Inscreva-se para receber notícias em seu e-mail.</p>

                <form>
                    <input type="email" value="Email" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Email';}" required="">
                    <input type="submit" value="Enviar">
                </form>
            </div>-->
            <!--<div class="instagram animated wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="500ms">
                <h2>Instagram Posts</h2>

                <div class="instagram-grids">
                    <div class="instagram-grid">
                        <a href="#"><img src="images/1.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="instagram-grid">
                        <a href="#"><img src="images/2.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="instagram-grid">
                        <a href="#"><img src="images/3.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="instagram-grid">
                        <a href="#"><img src="images/4.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="instagram-grid">
                        <a href="#"><img src="images/5.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="instagram-grid">
                        <a href="#"><img src="images/1.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>-->
        <div class="clearfix"></div>
    </div>
</div>
</div>
<!-- //noticias -->
<!-- Rodapé - top -->
<div class="footer-top animated wow zoomInDown" data-wow-duration="500ms" data-wow-delay="200ms">
    <div class="container">
        <h3>Entre em contato conosco <span>(41) 3044-0442</span></h3>
        <!-- Abaixo existia informações da pagina-->
        <p><span> </span></p>

        <div class="more">
            <a href="contato.php">Contato</a>
        </div>
        <!-- Imagem do Footer removida.
        <div class="footer-top-image">
            <img src="images/1.png" alt=" " class="img-responsive" />
        </div>-->
    </div>
</div>
<!-- //footer-top -->
<!-- footer -->
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
    <div class="clearfix"></div>
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
