<?php
session_start();
include_once "config.php";

$ingelogd = isset($_SESSION["gebruiker_id"]);
$isadmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

if (!$isadmin) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $actie = $_POST["actie"];
    $id = (int) $_POST["id"];

    if ($actie === "verwijder_gebruiker" && $id != $_SESSION["gebruiker_id"]) {
        $query = $conn->prepare("SELECT afbeelding FROM recepten WHERE gebruiker_id = :id AND afbeelding IS NOT NULL");
        $query->execute([":id" => $id]);
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $recept) {
            if (file_exists("uploads/" . $recept["afbeelding"])) {
                unlink("uploads/" . $recept["afbeelding"]);
            }
        }

        $query = $conn->prepare("DELETE FROM gebruikers WHERE id = :id");
        $query->execute([":id" => $id]);
    }

    if ($actie === "wissel_rol" && $id != $_SESSION["gebruiker_id"]) {
        $query = $conn->prepare("UPDATE gebruikers SET rol = IF(rol = 'admin', 'gebruiker', 'admin') WHERE id = :id");
        $query->execute([":id" => $id]);
    }

    if ($actie === "verwijder_recept") {
        $query = $conn->prepare("SELECT afbeelding FROM recepten WHERE id = :id");
        $query->execute([":id" => $id]);
        $recept = $query->fetch(PDO::FETCH_ASSOC);

        if ($recept && $recept["afbeelding"] && file_exists("uploads/" . $recept["afbeelding"])) {
            unlink("uploads/" . $recept["afbeelding"]);
        }

        $query = $conn->prepare("DELETE FROM recepten WHERE id = :id");
        $query->execute([":id" => $id]);
    }

    header("Location: admin.php");
    exit;
}

$gebruikers = $conn->query("SELECT id, gebruikersnaam, email, rol, aangemaakt FROM gebruikers ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

$recepten = $conn->query("
    SELECT r.id, r.titel, g.gebruikersnaam, c.naam AS categorie
    FROM recepten r
    JOIN gebruikers g ON g.id = r.gebruiker_id
    JOIN categorieen c ON c.id = r.categorie_id
    ORDER BY r.aangemaakt DESC
")->fetchAll(PDO::FETCH_ASSOC);

include_once "view/admin.view.php";
