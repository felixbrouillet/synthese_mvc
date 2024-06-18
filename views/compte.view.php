<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <div class="compte">

        <h1>Créez votre compte</h1>

        <section>

            <?php if (isset($_GET["mdp_incorrect"])) : ?>
                <p>
                    <span class="info">info</span>
                    Le mot de passe n'a pu être confirmé
                </p>
            <?php endif; ?>
            <?php if (isset($_GET["echec_creation_compte"])) : ?>
                <p>
                    <span class="info">info</span>
                    Le compte n'a pu être créé...
                </p>
            <?php endif; ?>
            <form action="compte-enregistrer" method="POST" enctype="multipart/form-data">
                <input type="text" name="nom" placeholder="Prénom" autofocus>
                <input type="text" name="prenom" placeholder="Nom">
                <input type="email" name="courriel" placeholder="Courriel">
                <input type="password" name="mdp" placeholder="Mot de passe">
                <input type="password" name="confirmer_mdp" placeholder="Confirmer le mot de passe">
                <input class="btn submit" type="submit" value="Créer!">
            </form>
            <a href="index">Connexion</a>

        </section>

    </div>
    
</body>
</html>
