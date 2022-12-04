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
    if (!empty($_GET['search'])) {
        $articlesManager = new articlesManager($bdd);
        $listeArticle = $articlesManager->getListArticlesFromRecherche($_GET['search']);
    } else {
        $listeArticle = [];
    }




    $page = !empty($_GET['page']) ? $_GET['page'] : 1;

    $articlesManager = new articlesManager($bdd);
    $nbArticlesTotalAPublie = $articlesManager->countArticles();

    $nbPages = ceil($nbArticlesTotalAPublie / nb_articles_par_page);

    $indexDepart = ($page - 1) * nb_articles_par_page;

    $listeArticle = $articlesManager->getListArticlesAAfficher($indexDepart, nb_articles_par_page);


    ?>

    <div class="row">
        <?php
        $listeArticle2 = $articlesManager->getListArticlesFromRecherche($_GET['search']);
        foreach ($listeArticle2 as $article) {
        ?>
            <div class="col-6">
                <div class="card">
                    <img src="img/<?php echo $article->getId() ?>.jpg" style="width: 100" class="card-img-top" alt=" ">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $article->getTitre(); ?></hh5>
                            <p class="card-text"><?php echo $article->getTexte(); ?></p>
                            <a href="#" class="btn btn-primary"><?php echo $article->getDate(); ?></a>
                            <a href="http://localhost/php/article.php?id=<?php echo $article->getId() ?>" class="btn btn-primary">modifier</a>

                    </div>
                </div>
            </div>
        <?php
        }
        ?>


    </div>

</div>
</body>

<?php include './include/footer.php'; ?>