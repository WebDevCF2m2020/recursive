<?php
/*
 * Test with
 * https://jsfiddle.net/bootstrapious/j6zkyog8/
 */

// dépendances
require_once "connectPDO.php";
require_once "06-createMenuMultiBootstrap.php";


// sélections de toutes les rubriques ordonnées par rubriques_order
$sql = "SELECT * FROM rubriques ORDER BY rubriques_order ASC";

// récupération des rubriques
$request = $connexion->query($sql);

// si on récupère au moins une rubrique on la/les met dans un tableau indexé contenant des tableaux associatifs, sinon c'est un tableau vide
$rubriques = ($request->rowCount()) ? $request->fetchAll(PDO::FETCH_ASSOC) : [];

// récupération de l'idrubriques si elle existe
$idrub = (isset($_GET['rub']) && ctype_digit($_GET['rub']))
    ? (int)$_GET['rub']
    : 0;

// dans un rubrique
if($idrub){
    // sélection de tous les articles dans une rubrique ou dans le premier niveau de sous-rubrique
    $sql = "SELECT a.* FROM articles a 
        INNER JOIN articles_has_rubriques h
        ON h.articles_idarticles = a.idarticles
        INNER JOIN rubriques r
        ON h.rubriques_idrubriques = r.idrubriques
        WHERE r.idrubriques = $idrub OR r.idrubriques IN (SELECT ri.idrubriques FROM rubriques ri WHERE $idrub=ri.rubriques_idrubriques)
        ORDER BY a.articles_date DESC";

// accueil
}else{
    // sélection de tous les articles sur l'accueil
    $sql = "SELECT a.* FROM articles a 
        INNER JOIN articles_has_rubriques h
        ON h.articles_idarticles = a.idarticles
        INNER JOIN rubriques r
        ON h.rubriques_idrubriques = r.idrubriques
        ORDER BY a.articles_date DESC";
}



// récupération des articles
$request = $connexion->query($sql);

// nombre d'articles
$nbArticles = $request->rowCount();

// si on a au moins un article
$articles = ($nbArticles)
    ? $request->fetchAll(PDO::FETCH_ASSOC)
    : [];


// création du menu récursif
$menu = createMenuMultiBootstrap(0, 0, $rubriques);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Multilevel Bootstrap 4 Dropdown</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="icon" href="img/favicon.ico">

    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > a:after {
            content: "\f0da";
            float: right;
            border: none;
            font-family: 'FontAwesome';
        }

        .dropdown-submenu > .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: 0px;
            margin-left: 0px;
        }

        body {
            background: #4568DC;
            background: -webkit-linear-gradient(to right, #4568DC, #B06AB3);
            background: linear-gradient(to right, #4568DC, #B06AB3);
            min-height: 100vh;
        }

        code {
            color: #B06AB3;
            background: #fff;
            padding: 0.1rem 0.2rem;
            border-radius: 0.2rem;
        }

        @media (min-width: 991px) {
            .dropdown-menu {
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
<!-- Navigation menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
    <div class="container">
        <a href="08-menu-recursif-bootrstap-PDO-requete-imbriquee.php" class="navbar-brand font-weight-bold">Accueil</a>
        <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars"
                aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id='navbarContent' class='collapse navbar-collapse'>
            <?= $menu ?>
        </div>
    </div>
</nav>

<!-- sous entête -->
<section class="py-5 text-white">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-9 mx-auto text-center">
                <h1 class="display-5">Bootstrap 4 Multilevel dropdown</h1>
                <h2 class="display-5">Nos articles</h2>
                <hr>
                <p class="lead">Nombre d'articles : <?= $nbArticles ?></p>
                <hr>
            </div>
        </div>
        <!-- container principal -->
        <main role="main" class="container">
            <div class="starter-template">
                <?php
                foreach ($articles as $item):
                    ?>
                    <h3><?= $item['articles_title'] ?></h3>
                    <p><?= $item['articles_text'] ?></p>
                    <p><?= $item['articles_date'] ?></p>
                    <hr>
                <?php
                endforeach;
                ?>
            </div>

        </main>
        <!-- /.container -->

        <!-- JS Jquery and Bootstrap -->
        <script src="js/jquery-3.5.1.slim.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script>
            $(function () {
                // ------------------------------------------------------- //
                // Multi Level dropdowns
                // ------------------------------------------------------ //
                $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    $(this).siblings().toggleClass("show");


                    if (!$(this).next().hasClass('show')) {
                        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                    }
                    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
                        $('.dropdown-submenu .show').removeClass("show");
                    });

                });
            });
        </script>
</body>
</html>