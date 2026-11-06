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
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = strip_tags(htmlspecialchars(trim($_POST["gebruikersnaam"])));
    $email = strip_tags(htmlspecialchars(trim($_POST["email"])));
    $wachtwoord = $_POST["wachtwoord"];
    $wachtwoord2 = $_POST["wachtwoord2"];

    if ($gebruikersnaam === "" || $email === "" || $wachtwoord === "") {
        $fout = "Vul alle velden in.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fout = "Dit is geen geldig e-mailadres.";
    } elseif (strlen($wachtwoord) < 6) {
        $fout = "Je wachtwoord moet minimaal 6 tekens hebben.";
    } elseif ($wachtwoord !== $wachtwoord2) {
        $fout = "De wachtwoorden komen niet overeen.";
    } else {
        $query = $conn->prepare("SELECT id FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam OR email = :email");
        $query->execute([":gebruikersnaam" => $gebruikersnaam, ":email" => $email]);

        if ($query->fetch()) {
            $fout = "Deze gebruikersnaam of dit e-mailadres bestaat al.";
        } else {
            $query = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord) VALUES (:gebruikersnaam, :email, :wachtwoord)");
            $query->execute([
                ":gebruikersnaam" => $gebruikersnaam,
                ":email" => $email,
                ":wachtwoord" => password_hash($wachtwoord, PASSWORD_DEFAULT)
            ]);

            header("Location: inloggen.php");
            exit;
        }
    }
}

include_once "view/registreren.view.php";
