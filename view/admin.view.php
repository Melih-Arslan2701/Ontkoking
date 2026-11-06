<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

    <main class="admin">
        <h2>Gebruikers</h2>
        <div class="tabelwrap">
            <table>
                <tr>
                    <th>Gebruikersnaam</th>
                    <th>E-mail</th>
                    <th>Rol</th>
                    <th>Acties</th>
                </tr>
                <?php foreach ($gebruikers as $gebruiker) { ?>
                    <tr>
                        <td><?php echo $gebruiker["gebruikersnaam"]; ?></td>
                        <td><?php echo $gebruiker["email"]; ?></td>
                        <td><?php echo $gebruiker["rol"]; ?></td>
                        <td>
                            <?php if ($gebruiker["id"] != $_SESSION["gebruiker_id"]) { ?>
                                <form method="post" action="admin.php">
                                    <input type="hidden" name="id" value="<?php echo $gebruiker["id"]; ?>">
                                    <button type="submit" name="actie" value="wissel_rol">Rol wisselen</button>
                                    <button type="submit" name="actie" value="verwijder_gebruiker" class="gevaar" onclick="return confirm('Gebruiker en alle recepten van deze gebruiker verwijderen?');">Verwijderen</button>
                                </form>
                            <?php } else { ?>
                                Jij
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <h2>Recepten</h2>
        <div class="tabelwrap">
            <table>
                <tr>
                    <th>Titel</th>
                    <th>Soort</th>
                    <th>Door</th>
                    <th>Acties</th>
                </tr>
                <?php foreach ($recepten as $recept) { ?>
                    <tr>
                        <td><a href="detail.php?id=<?php echo $recept["id"]; ?>"><?php echo $recept["titel"]; ?></a></td>
                        <td><?php echo $recept["categorie"]; ?></td>
                        <td><?php echo $recept["gebruikersnaam"]; ?></td>
                        <td>
                            <form method="post" action="admin.php">
                                <input type="hidden" name="id" value="<?php echo $recept["id"]; ?>">
                                <a class="knop" href="bewerken.php?id=<?php echo $recept["id"]; ?>">Bewerken</a>
                                <button type="submit" name="actie" value="verwijder_recept" class="gevaar" onclick="return confirm('Dit recept verwijderen?');">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>
</body>
</html>
