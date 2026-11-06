<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stop de ontkoking</title>
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

    <section class="hero">
        <h2>Stop de <em>ontkoking</em></h2>
        <p>Recepten voor als je geen zin hebt in gedoe. Zoek op wat je nog in huis hebt.</p>
    </section>

    <div class="balk">
        <form class="zoekbalk" method="get" action="index.php">
            <input type="text" name="zoek" placeholder="Zoek op ingredient of titel" value="<?php echo $zoek; ?>">
            <select name="categorie">
                <option value="0">Alle gerechten</option>
                <?php foreach ($categorieen as $categorie) { ?>
                    <option value="<?php echo $categorie["id"]; ?>" <?php if ($categorie_id == $categorie["id"]) { echo "selected"; } ?>><?php echo $categorie["naam"]; ?></option>
                <?php } ?>
            </select>
            <button type="submit">Zoeken</button>
        </form>

        <?php if ($ingelogd) { ?>
            <a class="toevoegen" href="toevoegen.php">Recepten toevoegen</a>
        <?php } ?>
    </div>

    <div class="recepten">
        <?php foreach ($recepten as $recept) { ?>
            <a class="kaart" href="detail.php?id=<?php echo $recept["id"]; ?>">
                <?php if ($recept["afbeelding"]) { ?>
                    <img src="uploads/<?php echo $recept["afbeelding"]; ?>" alt="<?php echo $recept["titel"]; ?>">
                <?php } else { ?>
                    <div class="geenfoto"></div>
                <?php } ?>
                <div class="tekst">
                    <h2><?php echo $recept["titel"]; ?></h2>
                    <p><?php echo $recept["categorie"]; ?> - <?php echo (int) $recept["bereidingstijd"]; ?> min</p>
                </div>
            </a>
        <?php } ?>

        <?php if (count($recepten) === 0) { ?>
            <p>Geen recepten gevonden.</p>
        <?php } ?>
    </div>
</body>
</html>
