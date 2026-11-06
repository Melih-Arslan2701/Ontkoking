<?php
session_start();
include_once "config.php";

$ingelogd = isset($_SESSION["gebruiker_id"]);
$isadmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

$id = 0;
if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
}

$query = $conn->prepare("
    SELECT r.*, c.naam AS categorie, g.gebruikersnaam
    FROM recepten r
    JOIN categorieen c ON c.id = r.categorie_id
    JOIN gebruikers g ON g.id = r.gebruiker_id
    WHERE r.id = :id
");
$query->execute([":id" => $id]);
$recept = $query->fetch(PDO::FETCH_ASSOC);

if (!$recept) {
    header("Location: index.php");
    exit;
}

$query = $conn->prepare("SELECT naam, hoeveelheid FROM ingredienten WHERE recept_id = :id ORDER BY id");
$query->execute([":id" => $id]);
$ingredienten = $query->fetchAll(PDO::FETCH_ASSOC);

$mag_bewerken = $ingelogd && ($recept["gebruiker_id"] == $_SESSION["gebruiker_id"] || $isadmin);

include_once "view/detail.view.php";
