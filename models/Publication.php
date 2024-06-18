<?php

namespace Model;

use Base\Model;

class Publication extends Model {

    protected $table = "activites";

    /**
     * Ajoute une publication
     *
     * @param string $titre
     * @param string|null $image
     * @param int $categorie_id
     * @param int $utilisateur_id
     * @return bool
     */
    public function ajouter($titre, $image, $categorie_id, $utilisateur_id) {
        $sql = "INSERT INTO $this->table (titre, image, categorie_id, utilisateur_id) VALUES (:titre, :image, :categorie_id, :utilisateur_id)";

        $requete = $this->pdo()->prepare($sql);

        return $requete->execute([
            ":titre" => $titre,
            ":image" => $image,
            ":categorie_id" => $categorie_id,
            ":utilisateur_id" => $utilisateur_id
        ]);
    }

    /**
     * Récupère toutes les activites, incluant le prénom et nom de l'auteur
     *
     * @return array|false
     */
    public function toutAvecUtilisateur() {
        $sql = "SELECT activites.*,
                utilisateurs.prenom,
                utilisateurs.nom,
                categories.nom AS nom_categorie
                FROM activites
                JOIN utilisateurs ON activites.utilisateur_id = utilisateurs.id
                JOIN categories ON activites.categorie_id = categories.id";

        $requete = $this->pdo()->prepare($sql);

        $requete->execute();

        return $requete->fetchAll();
    }

    /**
     * Récupère toutes les categories pour le formulaire de création
     *
     * @return array|false
     */
    public function ToutesCategories() {
        $sql = "SELECT * FROM categories";

        $requete = $this->pdo()->prepare($sql);

        $requete->execute();

        return $requete->fetchAll();
    }

    /**
     * Supprime une publication
     *
     * @param int $publicationId
     * @param int $utilisateur_id
     * @return bool
     */
    public function supprimer($publicationId, $utilisateur_id) {
        $sql = "DELETE FROM $this->table WHERE id = :publicationId AND utilisateur_id = :utilisateur_id";

        $requete = $this->pdo()->prepare($sql);

        return $requete->execute([
            ":publicationId" => $publicationId,
            ":utilisateur_id" => $utilisateur_id
        ]);
    }

}
