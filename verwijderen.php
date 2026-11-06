<?php
session_start();
include_once "config.php";

$ingelogd = isset($_SESSION["gebruiker_id"]);
$isadmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

if (!$ingelogd || $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = (int) $_POST["id"];

$query = $conn->prepare("SELECT gebruiker_id, afbeelding FROM recepten WHERE id = :id");
$query->execute([":id" => $id]);
$recept = $query->fetch(PDO::FETCH_ASSOC);

if ($recept && ($recept["gebruiker_id"] == $_SESSION["gebruiker_id"] || $isadmin)) {
    if ($recept["afbeelding"] && file_exists("uploads/" . $recept["afbeelding"])) {
        unlink("uploads/" . $recept["afbeelding"]);
    }

    $query = $conn->prepare("DELETE FROM recepten WHERE id = :id");
    $query->execute([":id" => $id]);
}

header("Location: index.php");
exit;
