<?php
class utilisateursManager
{
    /**
     * 
     * @var PDO
     */
    private PDO $bdd;

    /**
     * 
     * @var bool|null
     */
    private ?bool $_result;

    /**
     * 
     * @var utilisateurs
     */
    private utilisateurs $_utilisateurs;

    /**
     * 
     * @var int
     */
    private int $_getLastInsertId;

    /**
     * 
     * @return PDO
     */
    public function getBdd(): PDO
    {
        return $this->bdd;
    }

    /**
     * 
     * @return bool|null
     */
    public function get_result(): ?bool
    {
        return $this->_result;
    }

    /**
     * 
     * @return articles
     */
    public function get_utilisateurs(): utilisateurs
    {
        return $this->_utilisateurs;
    }

    /**
     * 
     * @return int
     */
    public function get_getLastInsertId(): int
    {
        return $this->_getLastInsertId;
    }

    /**
     * 
     * @param PDO $bdd
     * @return self
     */
    public function setBdd(PDO $bdd): self
    {
        $this->bdd = $bdd;
        return $this;
    }

    /**
     * 
     * @param bool|null $_result
     * @return self
     */
    public function set_result(?bool $_result): self
    {
        $this->_result = $_result;
        return $this;
    }

    /**
     * 
     * @param articles $_article
     * @return self
     */
    public function set_article(articles $_article): self
    {
        $this->_article = $_article;
        return $this;
    }

    /**
     * 
     * @param int $_getLastInsertId
     * @return self
     */
    public function set_getLastInsertId(int $_getLastInsertId): self
    {
        $this->_getLastInsertId = $_getLastInsertId;
        return $this;
    }

    /**
     * 
     * @param PDO $bdd
     */
    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }
    public function get($id)
    {
        //preparer une requete de type select avec une clausse where selon l'id.
        $sql = 'SELECT * FROM utilisateurs WHERE id = :id';
        $req = $this->bdd->prepare($sql);

        //exectuionde la requete vaec l'attribution des valeurs aux marqeurs nominaux 
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        // on stocke les donnees obtenues dans un tableau 
        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $utilisateurs = new utilisateurs();
        $utilisateurs->hydrate($donnees);
        return $utilisateurs;
    }
    /**
     * 
     * @return array
     */

    /**
     * 
     * @param articles $articles
     * @return $this
     */

    public function add(utilisateurs $utilisateurs)
    {
        $sql = "INSERT INTO utilisateurs "
            . "(nom, prenom, mdp, emails) "
            . "VALUES (:nom, :prenom, :mdp, :emails)";
        $req = $this->bdd->prepare($sql);
        //Sécurisation les variables
        $req->bindValue(':nom', $utilisateurs->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $utilisateurs->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':mdp', $utilisateurs->getMdp(), PDO::PARAM_STR);
        $req->bindValue(':emails', $utilisateurs->getEmails(), PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
        if ($req->errorCode() == 00000) {
            $this->_result = true;
            $this->_getLastInsertId = $this->bdd->lastInsertId();
        } else {
            $this->_result = false;
        }
        return $this;
    }

    /**
     * 
     * @param string $email
     * @return utilisateurs
     */
    public function getByEmail(string $email): utilisateurs
    {
        // Prépare une requête de type SELECT avec une clause WHERE selon l'id.
        $sql = 'SELECT * FROM utilisateurs WHERE emails = :emails';
        $req = $this->bdd->prepare($sql);

        // Exécution de la requête avec attribution des valeurs aux marqueurs nominatifs.
        $req->bindValue(':emails', $email, PDO::PARAM_STR);
        $req->execute();

        // On stocke les données obtenues dans un tableau.
        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $donnees = !$donnees ? [] : $donnees;

        $utilisateurs = new utilisateurs();
        $utilisateurs->hydrate($donnees);
        //print_r2($utilisateurs);
        return $utilisateurs;
    }
    public function updateByEmail(utilisateurs $utilisateurs): self
    {
        $sql = "UPDATE utilisateurs SET sid = :sid WHERE emails = :emails";
        $req = $this->bdd->prepare($sql);
        //Sécurisation les variables
        $req->bindValue(':emails', $utilisateurs->getEmails(), PDO::PARAM_STR);
        $req->bindValue(':sid', $utilisateurs->getSid(), PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
        if ($req->errorCode() == 00000) {
            $this->_result = true;
        } else {
            $this->_result = false;
        }
        return $this;
    }
}
