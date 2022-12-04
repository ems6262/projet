<?php require './config/config.php'; ?>
<?php include './include/header.php'; ?>
<?php include './include/menu.php'; ?>

<?php

if (!empty($_POST['envoyer'])) {
    $utilisateurs = new utilisateurs();
    $utilisateurs->hydrate($_POST);
    $utilisateurs->setMdp(password_hash($utilisateurs->getMdp(), PASSWORD_DEFAULT));
    #$utilisateurs->setDate(date('Y-m-d'));
    print_r2($utilisateurs);
    print_r2($_FILES);
    print_r2($_POST);

    //inserer l'article en BDD
    $articlesManager = new utilisateursManager($bdd);
    $articlesManager->add($utilisateurs);

    print_r2($articlesManager);
    header("Location: index.php");

    // si l'article est inserer en BDD
    if ($articlesManager->get_result() == true) {
        if ($_FILES['image']['error'] == 0) {
            $nomImage = $articlesManager->get_getLastInsertId();
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/img/" . $nomImage . ".jpg");
        }
    }

    $MessagesNotification = '';
    $MessagesNotification = $articlesManager->get_result() == true ? "Votre utilisateurs à était ajouté" : "Une erreur est survenu ";
    $resultNotifiaction = $articlesManager->get_result() == true ? "success" : "danger";

    $_SESSION['notification']['result'] = $resultNotifiaction;
    $_SESSION['notification']['message'] = $MessagesNotification;


    header("Location: index.php");
    exit();
}

?>



<!-- Page content-->
<div class="container">
    <div class="text-center mt-5">
        <h1>Ajout d'un utilisateur</h1>
    </div>

    <form action="utilisateurs.php" enctype="multipart/form-data" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom</label>
            <input type="Text" class="form-control" name="nom">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Prenom</label>
            <input type="Text" class="form-control" name="prenom">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mot de Passe</label>
            <input type="Password" class="form-control" name="mdp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="Text" class="form-control" name="emails">
        </div>
        <button type="submit" class="btn btn-primary" name="envoyer" value="ajouté">ajouter mon utilisateurs</button>
    </form>



</div>
</body>


<?php include './include/footer.php'; ?>