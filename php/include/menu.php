<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="./index.php">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="./utilisateurs.php">Ajouter un utilisateur</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href=" ./article.php">Ajouter un article</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="./connection">Connection</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="./deconnection">Deconnection</a></li>
                <li>
                    <class="nav-item" class="nav-link active" aria-current="page"><?php
                                                                                    if (isset($_COOKIE['sid'])) {
                                                                                        echo "connecté en tant que : " . $_COOKIE['sid'];
                                                                                    } else
                                                                                        echo "";
                                                                                    ?>
                </li>

                <li>
                    <hr class="dropdown-divider" />
                </li>
            </ul>
            </li>
            </ul>
        </div>
    </div>
</nav>