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


    <!-- Custom styles for this template -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/for-menu-bootstrap.css" rel="stylesheet">
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
                <p class="lead">Nombre d'articles : <?= count($allArticles) ?></p>
                <hr>
            </div>
        </div>
        <!-- container principal -->
        <main role="main" class="container">
            <div class="starter-template">
                <?php
                foreach ($allArticles as $item):
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
