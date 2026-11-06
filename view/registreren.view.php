<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
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

    <main class="formulier">
        <h2>Registreren</h2>

        <?php if ($fout !== "") { ?>
            <p class="fout"><?php echo $fout; ?></p>
        <?php } ?>

        <form method="post" action="registreren.php">
            <label for="gebruikersnaam">Gebruikersnaam</label>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam" value="<?php echo $gebruikersnaam; ?>">

            <label for="email">E-mailadres</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">

            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" id="wachtwoord" name="wachtwoord">

            <label for="wachtwoord2">Wachtwoord herhalen</label>
            <input type="password" id="wachtwoord2" name="wachtwoord2">

            <button type="submit">Registreren</button>
        </form>

        <p>Heb je al een account? <a href="inloggen.php">Log in</a></p>
    </main>
</body>
</html>
