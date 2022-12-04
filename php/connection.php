<?php include './config/config.php'; ?>
<?php include './include/header.php'; ?>
<?php include './include/menu.php'; ?>

<body>


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
    <?php } ?>
    <div class="container">
        <div class="text-center mt-5">
        </div>
        <div class="row">
            <div class="col-4">

            </div>
            <?php
            if (isset($_POST['envoyer'])) {
                //Création de l'utilisateur
                $utilisateursFormulaire = new utilisateurs();
                $utilisateursFormulaire->hydrate($_POST);
                $utilisateursManager = new utilisateursManager($bdd);
                $utilisateursEnBdd = $utilisateursManager->getByEmail($utilisateursFormulaire->getEmails());

                $isConnect = password_verify($utilisateursFormulaire->getMdp(), $utilisateursEnBdd->getMdp());

                if ($isConnect == true) {
                    $sid = md5($utilisateursEnBdd->getEmails() . time());
                    //Création du cookie
                    //setcookie('sid', $sid, time() + 86400);
                    $pre = $utilisateursEnBdd->getPrenom();
                    setcookie('sid', $pre, time() + 86400);

                    //Mise en bdd du sid
                    $utilisateursEnBdd->setSid($sid);
                    $utilisateursManager->updateByEmail($utilisateursEnBdd);
                }

                if ($isConnect == true) {
                    $_SESSION['notification']['result'] = 'success';
                    $_SESSION['notification']['message'] = 'Vous êtes connecté !';
                    header("Location: ./index.php");
                    exit();
                } else {
                    $_SESSION['notification']['result'] = 'danger';
                    $_SESSION['notification']['message'] = 'Vérifiez votre login / mot de passe !';
                    header("Location: ./connection.php");
                    exit();
                }
            };
            ?>

            <!-- Page content-->
            <div class="container">
                <div class="text-center mt-5">
                    <h1>connection</h1>
                </div>
                <form action="connection.php" enctype="multipart/form-data" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Login</label>
                        <input type="Text" class="form-control" name="emails">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Mot de passe</label>
                        <input type="Text" class="form-control" name="mdp">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="envoyer" value="ajouté">connection</button>
                    </div>
                </form>
            </div>
</body>


<?php include './include/footer.php'; ?>