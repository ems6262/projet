<?php

class utilisateurs
{

    /**
     * 
     * @var int
     */
    public ?int $id;

    /**
     * 
     * @var string
     */
    public string $nom;

    /**
     * 
     * @var string
     */
    public string $prenom;

    /**
     * 
     * @var string
     */
    public string $mdp;

    /**
     * 
     * @var string
     */
    public string $emails;

    /**
     * 
     * @var string
     */
    public string $sid;

    /**
     * 
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * 
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * 
     * @return string
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * 
     * @return string
     */
    public function getEmails(): String
    {
        return $this->emails;
    }
    public function getSid(): String
    {
        return $this->sid;
    }

    /**
     * 
     * @param int|null $id
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * 
     * @param string $titre
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * 
     * @param string $texte
     * @return self
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * 
     * @param string $date
     * @return self
     */
    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;
        return $this;
    }

    public function setEmails(String $emails): self
    {
        $this->emails = $emails;
        return $this;
    }

    public function setSid(String $sid): self
    {
        $this->sid = $sid;
        return $this;
    }

    /**
     * 
     * @param array $donnees
     * @return self
     */
    public function hydrate(array $donnees): self
    {

        if (!empty($donnees['id'])) {
            $this->setId($donnees['id']);
        } else {
            $this->setId(null);
        }

        if (!empty($donnees['nom'])) {
            $this->setNom($donnees['nom']);
        } else {
            $this->setNom('');
        }
        if (!empty($donnees['prenom'])) {
            $this->prenom = $donnees['prenom'];
        } else {
            $this->setPrenom('');
        }
        if (!empty($donnees['mdp'])) {
            $this->setMdp($donnees['mdp']);
        } else {
            $this->setMdp('');
        }
        if (!empty($donnees['emails'])) {
            $this->setEmails($donnees['emails']);
        } else {
            $this->setEmails(0);
        }

        return $this;
    }
}
