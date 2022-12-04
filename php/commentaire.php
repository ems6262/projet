<?php require './config/config.php'; ?>
<?php include './include/header.php'; ?>
<?php include './include/menu.php'; ?>


<div class="container">
    <div class="text-center mt-5">
        <h1>Ajout d'un commentaire</h1>
    </div>

    <?php
    if (!empty($_POST['commentaire'])) {

        // $commentaire = new commentaire();
        // $commentaire->

        //     //inserer l'article en BDD
        // $commentaireManager = new commentaireManager($bdd);
        // $commentaireManager->add($commentaire);
        // header("Location: index.php");
    } ?>


    <form action="commentaire.php" enctype="multipart/form-data" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pseudo</label>
            <input id="id" name="id" type="hidden" value="">
            <input type="Text" class="form-control" name="titre">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">E-mail</label>
            <input type="Text" class="form-control" name="E-mail">
        </div>
        <div class=" mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Mon commentaire</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="commentaire"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="envoyer" value="ajouté">ajouter mon commentaire</button>

    </form>