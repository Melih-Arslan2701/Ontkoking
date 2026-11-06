<?php
session_start();
include_once "config.php";

$ingelogd = isset($_SESSION["gebruiker_id"]);
$isadmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

if ($ingelogd) {
    header("Location: index.php");
    exit;
}

$fout = "";
$gebruikersnaam = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = strip_tags(htmlspecialchars(trim($_POST["gebruikersnaam"])));
    $wachtwoord = $_POST["wachtwoord"];

    $query = $conn->prepare("SELECT id, wachtwoord, rol FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam");
    $query->execute([":gebruikersnaam" => $gebruikersnaam]);
    $gebruiker = $query->fetch(PDO::FETCH_ASSOC);

    if ($gebruiker && password_verify($wachtwoord, $gebruiker["wachtwoord"])) {
        $_SESSION["gebruiker_id"] = $gebruiker["id"];
        $_SESSION["rol"] = $gebruiker["rol"];

        header("Location: index.php");
        exit;
    } else {
        $fout = "Gebruikersnaam of wachtwoord klopt niet.";
    }
}

include_once "view/inloggen.view.php";
