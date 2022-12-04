<?php require './config/config.php'; ?>
<?php include './include/header.php'; ?>
<?php include './include/menu.php'; ?>


<?php
if (!empty($_POST['envoyer'])) {

    $articles = new articles();
    $articles->hydrate($_POST);
    $articles->setDate(date('Y-m-d'));
    print_r2($articles);
    print_r2($_FILES);

    //inserer l'article en BDD
    $articlesManager = new articlesManager($bdd);
    $articlesManager->add($articles);

    // si l'article est inserer en BDD
    if ($articlesManager->get_result() == true) {
        if ($_FILES['image']['error'] == 0) {
            $nomImage = $articlesManager->get_getLastInsertId();
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/img/" . $nomImage . ".jpg");
        }
    }

    $MessagesNotification = '';
    $MessagesNotification = $articlesManager->get_result() == true ? "Votre article a été ajouté" : "Une erreur est survenu lors de l'insertion";
    $resultNotifiaction = $articlesManager->get_result() == true ? "success" : "danger";

    $_SESSION['notification']['result'] = $resultNotifiaction;
    $_SESSION['notification']['message'] = $MessagesNotification;

    header("Location: index.php");
    exit();
}




if (!empty($_POST['update'])) {
    $articles = new articles();
    $articles->hydrate($_POST);
    $articles->setDate(date('Y-m-d'));

    $articlesManager = new articlesManager($bdd);
    $nb = $articlesManager->update($articles);

    header("Location: index.php");
} ?>



<div class="container">
    <div class="text-center mt-5">
        <h1>Ajout d'un article</h1>
        <?php
        if (isset($_GET['id'])) {
            $articlesManager = new articlesManager($bdd);
            $nb = $articlesManager->get($_GET['id']);
        } ?>
    </div>

    <form action="article.php" enctype="multipart/form-data" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Titre</label>
            <input id="id" name="id" type="hidden" value="<?php if (isset($_GET['id'])) {
                                                                echo $_GET['id'];
                                                            } ?>">
            <input type="Text" class="form-control" name="titre" value="<?php if (isset($_GET['id'])) {
                                                                            echo $nb->getTitre();
                                                                        } ?>">
        </div>
        <div class=" mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Le texte de mon article</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="texte"><?php if (isset($_GET['id'])) {
                                                                                                        echo $nb->getTexte();
                                                                                                    }
                                                                                                    ?></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">choisir une image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="publie" />
            <label class="form-check-label" for="exampleCheck1">Article publié ?</label>
        </div>
        <button type="submit" class="btn btn-primary" <?php if (isset($_GET['id'])) {
                                                        ?>name="update" <?php
                                                                    }
                                                                        ?> name="envoyer" value="ajouté">ajouter mon article</button>

    </form>
</div>
</body>


<?php include './include/footer.php'; ?>