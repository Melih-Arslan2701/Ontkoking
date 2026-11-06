<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $paginatitel; ?></title>
    <link rel="stylesheet" href="css/css.php">
</head>
<body>
    <header>
        <div class="midden">
            <h1><a href="index.php">STOP DE ONTKOKING</a></h1>
            <nav>
                <a href="index.php">Recepten</a>
                <?php if ($ingelogd) { ?>
                    <a href="toevoegen.php">Recept toevoegen</a>
                <?php } ?>
                <?php if ($isadmin) { ?>
                    <a href="admin.php">Admin</a>
                <?php } ?>
            </nav>
        </div>
        <div class="account">
            <?php if ($ingelogd) { ?>
                <a href="uitloggen.php">Uitloggen</a>
            <?php } else { ?>
                <a href="inloggen.php">Inloggen</a>
                <a href="registreren.php">Registreren</a>
            <?php } ?>
        </div>
    </header>

    <main class="formulier breed">
        <h2><?php echo $paginatitel; ?></h2>

        <?php if ($fout !== "") { ?>
            <p class="fout"><?php echo $fout; ?></p>
        <?php } ?>

        <form method="post" action="<?php echo $formulier_actie; ?>" enctype="multipart/form-data">
            <label for="titel">Titel</label>
            <input type="text" id="titel" name="titel" value="<?php echo $formulier["titel"]; ?>">

            <label for="categorie_id">Soort gerecht</label>
            <select id="categorie_id" name="categorie_id">
                <option value="0">Kies een soort gerecht</option>
                <?php foreach ($categorieen as $categorie) { ?>
                    <option value="<?php echo $categorie["id"]; ?>" <?php if ($formulier["categorie_id"] == $categorie["id"]) { echo "selected"; } ?>><?php echo $categorie["naam"]; ?></option>
                <?php } ?>
            </select>

            <label for="bereidingstijd">Bereidingstijd (minuten)</label>
            <input type="number" id="bereidingstijd" name="bereidingstijd" min="1" value="<?php echo $formulier["bereidingstijd"]; ?>">

            <label for="beschrijving">Korte beschrijving</label>
            <textarea id="beschrijving" name="beschrijving" rows="3"><?php echo $formulier["beschrijving"]; ?></textarea>

            <label>Ingredienten</label>
            <?php foreach ($ingredienten_form as $ingredient) { ?>
                <div class="ingredientrij">
                    <input type="text" name="ingredient_hoeveelheid[]" placeholder="Hoeveelheid, bijv. 200 g" value="<?php echo $ingredient["hoeveelheid"]; ?>">
                    <input type="text" name="ingredient_naam[]" placeholder="Ingredient" value="<?php echo $ingredient["naam"]; ?>">
                </div>
            <?php } ?>

            <label for="bereidingswijze">Bereidingswijze</label>
            <textarea id="bereidingswijze" name="bereidingswijze" rows="8"><?php echo $formulier["bereidingswijze"]; ?></textarea>

            <label for="afbeelding">Foto</label>
            <?php if ($afbeelding_huidig) { ?>
                <img class="voorbeeld" src="uploads/<?php echo $afbeelding_huidig; ?>" alt="Huidige foto">
            <?php } ?>
            <input type="file" id="afbeelding" name="afbeelding">

            <button type="submit">Opslaan</button>
        </form>
    </main>
</body>
</html>
