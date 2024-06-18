<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h1>Publications ici</h1>

    <a href="deconnecter">Déconnexion</a>

    <?php if (isset($_GET['succes_suppression'])) : ?>
        <span class="msg succes">Activité supprimée avec succès!</span>
    <?php elseif (isset($_GET['erreur_suppression'])) : ?>
        <span class="error-message">Erreur lors de la suppression de l'activité. Veuillez réessayer.</span>
    <?php endif; ?>

    <?php if (isset($_GET['succes_ajout'])) : ?>
        <span class="msg succes">Activité ajoutée avec succès!</span>
    <?php elseif (isset($_GET['erreur_ajout'])) : ?>
        <span class="error-message">Erreur lors de l'ajout de l'activité. Veuillez réessayer.</span>
    <?php endif; ?>
    
    <?php if (isset($_GET['infos_requises'])) : ?>
        <span class="error-message">infos requises pour publier une activité.</span>
    <?php endif; ?>
    

    <div class="post">
        <h2>Créer une activité</h2>
        <a href="publications-enregistrer">Aller créer une publication</a>
        <form action="publications-enregistrer" method="POST" enctype="multipart/form-data">
            <label>
                <p>Titre</p>
                <input type="text" name="titre" value="">
            </label>

            <div>
                <label>
                    <p>Média</p>
                    <input type="file" name="image">
                </label>

                <div>
                    <label>
                        <p>Catégorie</p>
                        <select name="categorie_id">
                            <?php foreach ($categories as $categorie) : ?>
                                <option value="<?= $categorie->id ?>">
                                    <?= ucfirst($categorie->nom) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <div>
                    <input type="submit" value="Créer la publication">
                </div>
            </div>
        </form>
    </div>
  
    <div class="post">
        <h2>Publications</h2>
        
        <?php foreach($publications as $publication) : ?>
            <div class="publications">
                <h3><?= $publication->titre ?></h3>
                <h4>
                    Catégorie:
                    <?= $publication->nom_categorie ?>
                </h4>

                <?php if($publication->image != null) : ?>
                    <div>
                        <img class="image" src="<?= $publication->image ?>" alt="Image" width="500">
                    </div>
                <?php endif; ?>

                <p>
                    <span>
                        Par <?= $publication->prenom ?> <?= $publication->nom ?>
                    </span>
                    <span>
                        Publié le <?= $publication->date_creation ?>
                    </span>

                    <form action="publications-supprimer" method="POST">
                        <input type="hidden" name="id" value="<?= $publication->id ?>">
                        <button type="submit">Supprimer cette activité</button>
                    </form>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
    
    <a href="deconnecter">Déconnexion</a>

</body>
</html>
