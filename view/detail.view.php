<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $recept["titel"]; ?></title>
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

    <main class="detail">
        <a class="terug" href="index.php">&larr; Terug naar alle recepten</a>

        <div class="bovenkant">
            <div>
                <?php if ($recept["afbeelding"]) { ?>
                    <img src="uploads/<?php echo $recept["afbeelding"]; ?>" alt="<?php echo $recept["titel"]; ?>">
                <?php } else { ?>
                    <div class="geenfoto"></div>
                <?php } ?>
            </div>

            <div>
                <h2><?php echo $recept["titel"]; ?></h2>
                <p class="info"><?php echo $recept["categorie"]; ?> - <?php echo (int) $recept["bereidingstijd"]; ?> min - door <?php echo $recept["gebruikersnaam"]; ?></p>

                <?php if ($recept["beschrijving"]) { ?>
                    <p class="beschrijving"><?php echo nl2br($recept["beschrijving"]); ?></p>
                <?php } ?>

                <?php if ($mag_bewerken) { ?>
                    <div class="acties">
                        <a class="knop" href="bewerken.php?id=<?php echo $recept["id"]; ?>">Bewerken</a>
                        <form method="post" action="verwijderen.php" onsubmit="return confirm('Weet je zeker dat je dit recept wilt verwijderen?');">
                            <input type="hidden" name="id" value="<?php echo $recept["id"]; ?>">
                            <button type="submit" class="gevaar">Verwijderen</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="onderkant">
            <div class="paneel">
                <h3>Ingredienten</h3>
                <ul>
                    <?php foreach ($ingredienten as $ingredient) { ?>
                        <li><?php echo $ingredient["hoeveelheid"]; ?> <?php echo $ingredient["naam"]; ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="paneel">
                <h3>Bereidingswijze</h3>
                <p><?php echo nl2br($recept["bereidingswijze"]); ?></p>
            </div>
        </div>
    </main>
</body>
</html>
