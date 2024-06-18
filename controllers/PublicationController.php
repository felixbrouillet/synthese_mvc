<?php

namespace Controller;

use Base\Controller;
use Model\Publication;
use Util\Upload;


class PublicationController extends Controller {

    /**
     * Affiche la page des publications
     */
    public function index() {
        // Protection de la route /publications
        if(empty($_SESSION["utilisateur_id"]) == true){
            header("location: index");
            exit();
        }

        // Récupération des publications (et de l'utilisateur associé)
        $modele = new Publication;
        $publications = $modele->toutAvecUtilisateur();
        $categories = $modele->ToutesCategories();

        include("views/publications.view.php");
    }

    /**
     * Traite les informations d'une nouvelle publication
     */
    public function enregistrer() {
        // Protection de la route /publications
        if(empty($_SESSION["utilisateur_id"]) == true){
            header("location: index");
            exit();
        }

        // Validation des paramètres
        if (empty($_POST["titre"]) || empty($_POST["categorie_id"])) {
            header("location: publications?infos_requises=1");
            exit();
        }


        // Traitement de l'image s'il y a lieu
        $image = null;
        $upload = new Upload("image", ["jpeg", "jpg", "png", "webp", "gif"]);
        if($upload->estValide()){
            $image = $upload->placerDans("uploads");
        }

        // Récupération de l'id de l'utilisateur
        $utilisateur_id = $_SESSION["utilisateur_id"];

        // Ajouter la publication
        $modele = new Publication;
        $succes = $modele->ajouter($_POST["titre"],
                                   $image,
                                   $utilisateur_id,
                                   $_SESSION["utilisateur_id"]);

        
        // Redirection si échec
        if(!$succes){
            header("location: publications?echec_ajout=1");
            exit();
        }

        // Redirection si succès
        header("location: publications?succes_ajout=1");
        exit();

    }


    public function supprimer() {
        // Protection of the route /supprimer
        if (empty($_SESSION["utilisateur_id"])) {
            header("location: index");
            exit();
        }
    
        // Validation of the post ID
        $publicationId = $_POST["id"] ?? null;
        $utilisateurId = $_SESSION["utilisateur_id"];
    
        if ($publicationId) {
            $modele = new Publication;
            $succes = $modele->supprimer($publicationId, $utilisateurId);
    
            if ($succes) {
                header("location: publications?succes_suppression=1");
                exit();
            }
        }
    
        header("location: publications?erreur_suppression=1");
        exit();
    } 

}
