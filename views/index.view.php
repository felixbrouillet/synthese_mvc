<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil épreuve synthèse</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <div class="accueil">
        <h1>Mes activités vraiment nice</h1>

        <?php if (isset($_GET["succes_creation_compte"])) : ?>
            <p class="msg succes">Compte créé!</p>
        <?php endif; ?>
        
        <?php if (isset($_GET["infos_absentes"]) || isset($_GET["infos_requises"]) || isset($_GET["infos_invalides"])) : ?>
            <p class="msg erreur">Toutes les informations sont requises</p>
        <?php endif; ?>
        
        <?php if (isset($_GET["succes_deconnexion"])) : ?>
            <p class="msg succes">Déconnecté!</p>
        <?php endif; ?>

        <section class="login">
            <form action="connecter" method="POST">
                <input type="email" name="courriel" placeholder="Courriel" autofocus>
                <input type="password" name="mdp" placeholder="Mot de passe">
                <input class="btn submit" type="submit" value="Envoyer">
            </form>
            <a href="compte-creer">Pas de compte?</a>
        </section>

    </div>

</body>
</html>
