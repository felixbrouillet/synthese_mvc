<?php

namespace Controller;

use Base\Controller;
use Model\Utilisateur;
use Util\Upload;

class UtilisateurController extends Controller {

    /**
     * Affiche la page d'accueil contenant la connexion
     */
    public function index() {
        include("views/index.view.php");
    }

    /**
     * Affiche le formulaire de création de compte
     */
    public function creer() {
        include("views/compte.view.php");
    }

    /**
     * Traite les informations d'un nouvel utilisateur
     *
     * @return void
     */
    public function enregistrer() {
        // Validation
        if(empty($_POST["nom"]) || 
           empty($_POST["prenom"]) ||
           empty($_POST["courriel"]) ||
           empty($_POST["mdp"]) ||
           empty($_POST["confirmer_mdp"])){
                header("location: compte-creer?infos_absentes=1");
                exit();
           }

        if($_POST["mdp"] != $_POST["confirmer_mdp"]){
            header("location: compte-creer?mdp_incorrect=1");
            exit();
        }

        // Envoyer les infos au modèle
        $modele = new Utilisateur;
        $succes = $modele->ajouter($_POST["nom"],
                                   $_POST["prenom"],
                                   $_POST["courriel"],
                                   $_POST["mdp"]);

        // Rediriger si succès
        if($succes){
            header("location: index?succes_creation_compte=1");
            exit();
        }

        // Redirection si échec
        header("location: compte-creer?echec_creation_compte=1");
        exit();
    }

    /**
     * Valide et connecte l'utilisateur
     */
    public function connecter() { 
        // Valider les paramètres POST
        if(empty($_POST["courriel"]) ||
           empty($_POST["mdp"])) {
            header("location: index?infos_requises=1");
            exit();
        }

        // Récupérer l'utilisateur
        $modele = new Utilisateur;
        $utilisateur = $modele->parCourriel($_POST["courriel"]);

        // Valider que l'utilisateur existe ET que son mot de passe est valide
        if(!$utilisateur || !password_verify($_POST["mdp"], $utilisateur->mot_de_passe)){
            header("location: index?infos_invalides=1");
            exit();
        }

        // Créer la session
        $_SESSION["utilisateur_id"] = $utilisateur->id;
        $_SESSION["est_connecte"] = true;

        // Rediriger
        header("location: publications?succes_connexion=1");
        exit();
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function deconnecter() {
        session_destroy();
        header("location: index?succes_deconnexion=1");
        exit();
    }



}