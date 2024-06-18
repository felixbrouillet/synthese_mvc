<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Publication</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="post">
        <h2>Créer une activité</h2>
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

</body>
</html>
