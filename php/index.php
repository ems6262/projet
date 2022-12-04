<?php require './config/config.php'; ?>
<?php include './include/header.php'; ?>
<?php include './include/menu.php'; ?>

<div class="container">
    <div class="text-center mt-5">
        <h1>Blog</h1>
    </div>
    <div class="row mb-5">
        <form id="" method="GET" action="recherche.php">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" name="search" value="" placeholder="Mot clé....">
            </div>
            <div class="col-6 mb-2">
                <button type="submit" id="submit" value="recherche" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
    </div>

    <?php

    require_once './vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates/');
    $twig = new \Twig\Environment($loader, ['debug' => true]);

    $page = !empty($_GET['page']) ? $_GET['page'] : 1;

    $articlesManager = new articlesManager($bdd);
    $nbArticlesTotalAPublie = $articlesManager->countArticles();

    $nbPages = ceil($nbArticlesTotalAPublie / nb_articles_par_page);

    $indexDepart = ($page - 1) * nb_articles_par_page;

    $listeArticle = $articlesManager->getListArticlesAAfficher($indexDepart, nb_articles_par_page);


    ?>
    <?php
    if (isset($_SESSION['notification'])) {
    ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-<?= $_SESSION['notification']['result'] ?>" role="alert">
                    <?= $_SESSION['notification']['message'] ?>
                    <?php unset($_SESSION['notification']) ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>


    <div class="row">
        <?php
        foreach ($listeArticle as $article) {
        ?>
            <div class="col-6 mb-4">
                <div class="card">
                    <img src="img/<?php echo $article->getId() ?>.jpg" style="width: 100" class="card-img-top" alt=" ">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $article->getTitre(); ?></hh5>
                            <p class="card-text"><?php echo $article->getTexte(); ?></p>
                            <a href="#" class="btn btn-primary"><?php echo $article->getDate(); ?></a>
                            <a href="http://localhost/php/article.php?id=<?php echo $article->getId() ?>" class="btn btn-primary">modifier</a>

                            <a href="http://localhost/php/commentaire.php?id=<?php echo $article->getId() ?>" class="btn btn-primary">commenter</a>

                    </div>
                </div>
            </div>
        <?php
        }
        ?>


    </div>
    <nav aria-label="...">
        <ul class="pagination pagination-sm">
            <li class="page-item active" aria-current="page">
            </li>
            <?php
            for ($i = 1; $i <= $nbPages; $i++) { ?>
                <li class="page-item"><a class="page-link" href="http://localhost/php/index.php?page=<?php echo $i ?>"> <?php echo $i ?> </a></li>
            <?php
            }
            ?>

        </ul>
    </nav>

</div>
</body>

<?php include './include/footer.php'; ?>