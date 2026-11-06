<?php
session_start();
include_once "config.php";

$ingelogd = isset($_SESSION["gebruiker_id"]);
$isadmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

if (!$ingelogd) {
    header("Location: inloggen.php");
    exit;
}

$categorieen = $conn->query("SELECT id, naam FROM categorieen ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

$paginatitel = "Recept toevoegen";
$formulier_actie = "toevoegen.php";
$afbeelding_huidig = "";
$fout = "";

$formulier = [
    "titel" => "",
    "categorie_id" => 0,
    "beschrijving" => "",
    "bereidingswijze" => "",
    "bereidingstijd" => ""
];
$ingredienten_form = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formulier["titel"] = strip_tags(htmlspecialchars(trim($_POST["titel"])));
    $formulier["categorie_id"] = (int) $_POST["categorie_id"];
    $formulier["beschrijving"] = strip_tags(htmlspecialchars(trim($_POST["beschrijving"])));
    $formulier["bereidingswijze"] = strip_tags(htmlspecialchars(trim($_POST["bereidingswijze"])));
    $formulier["bereidingstijd"] = (int) $_POST["bereidingstijd"];

    for ($i = 0; $i < count($_POST["ingredient_naam"]); $i++) {
        $naam = strip_tags(htmlspecialchars(trim($_POST["ingredient_naam"][$i])));
        $hoeveelheid = strip_tags(htmlspecialchars(trim($_POST["ingredient_hoeveelheid"][$i])));

        if ($naam !== "") {
            $ingredienten_form[] = ["naam" => $naam, "hoeveelheid" => $hoeveelheid];
        }
    }

    if ($formulier["titel"] === "" || $formulier["bereidingswijze"] === "") {
        $fout = "Vul minimaal een titel en de bereidingswijze in.";
    } elseif ($formulier["categorie_id"] === 0) {
        $fout = "Kies een soort gerecht.";
    } elseif ($formulier["bereidingstijd"] < 1) {
        $fout = "Vul de bereidingstijd in minuten in.";
    } elseif (count($ingredienten_form) === 0) {
        $fout = "Voeg minimaal een ingredient toe.";
    }

    $afbeelding = "";
    if ($fout === "" && isset($_FILES["afbeelding"]) && $_FILES["afbeelding"]["error"] === 0) {
        $extensie = strtolower(pathinfo($_FILES["afbeelding"]["name"], PATHINFO_EXTENSION));

        if (!in_array($extensie, ["jpg", "jpeg", "png", "webp"])) {
            $fout = "Alleen jpg, png of webp bestanden zijn toegestaan.";
        } else {
            $afbeelding = uniqid() . "." . $extensie;
            move_uploaded_file($_FILES["afbeelding"]["tmp_name"], "uploads/" . $afbeelding);
        }
    }

    if ($fout === "") {
        $query = $conn->prepare("
            INSERT INTO recepten (gebruiker_id, categorie_id, titel, beschrijving, bereidingswijze, bereidingstijd, afbeelding)
            VALUES (:gebruiker_id, :categorie_id, :titel, :beschrijving, :bereidingswijze, :bereidingstijd, :afbeelding)
        ");
        $query->execute([
            ":gebruiker_id" => $_SESSION["gebruiker_id"],
            ":categorie_id" => $formulier["categorie_id"],
            ":titel" => $formulier["titel"],
            ":beschrijving" => $formulier["beschrijving"],
            ":bereidingswijze" => $formulier["bereidingswijze"],
            ":bereidingstijd" => $formulier["bereidingstijd"],
            ":afbeelding" => $afbeelding === "" ? null : $afbeelding
        ]);

        $recept_id = $conn->lastInsertId();

        $query = $conn->prepare("INSERT INTO ingredienten (recept_id, naam, hoeveelheid) VALUES (:recept_id, :naam, :hoeveelheid)");
        foreach ($ingredienten_form as $ingredient) {
            $query->execute([
                ":recept_id" => $recept_id,
                ":naam" => $ingredient["naam"],
                ":hoeveelheid" => $ingredient["hoeveelheid"]
            ]);
        }

        header("Location: detail.php?id=" . $recept_id);
        exit;
    }
}

while (count($ingredienten_form) < 5) {
    $ingredienten_form[] = ["naam" => "", "hoeveelheid" => ""];
}

include_once "view/recept.view.php";
