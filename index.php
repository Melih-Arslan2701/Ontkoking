<?php
session_start();
include_once "config.php";

$ingelogd = isset($_SESSION["gebruiker_id"]);
$isadmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

$zoek = "";
if (isset($_GET["zoek"])) {
    $zoek = strip_tags(htmlspecialchars(trim($_GET["zoek"])));
}

$categorie_id = 0;
if (isset($_GET["categorie"])) {
    $categorie_id = (int) $_GET["categorie"];
}

$categorieen = $conn->query("SELECT id, naam FROM categorieen ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

$query = $conn->prepare("
    SELECT DISTINCT r.id, r.titel, r.afbeelding, r.bereidingstijd, r.aangemaakt, c.naam AS categorie
    FROM recepten r
    JOIN categorieen c ON c.id = r.categorie_id
    LEFT JOIN ingredienten i ON i.recept_id = r.id
    WHERE (r.titel LIKE :zoek1 OR i.naam LIKE :zoek2)
    AND (:cat1 = 0 OR r.categorie_id = :cat2)
    ORDER BY r.aangemaakt DESC
");
$query->execute([
    ":zoek1" => "%" . $zoek . "%",
    ":zoek2" => "%" . $zoek . "%",
    ":cat1" => $categorie_id,
    ":cat2" => $categorie_id
]);
$recepten = $query->fetchAll(PDO::FETCH_ASSOC);

include_once "view/index.view.php";
