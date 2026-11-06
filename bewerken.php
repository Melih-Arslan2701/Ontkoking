<?php
session_start();
include_once "config.php";

$ingelogd = isset($_SESSION["gebruiker_id"]);
$isadmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

if (!$ingelogd) {
    header("Location: inloggen.php");
    exit;
}

$id = 0;
if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
}

$query = $conn->prepare("SELECT * FROM recepten WHERE id = :id");
$query->execute([":id" => $id]);
$recept = $query->fetch(PDO::FETCH_ASSOC);

if (!$recept || ($recept["gebruiker_id"] != $_SESSION["gebruiker_id"] && !$isadmin)) {
    header("Location: index.php");
    exit;
}

$categorieen = $conn->query("SELECT id, naam FROM categorieen ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

$paginatitel = "Recept bewerken";
$formulier_actie = "bewerken.php?id=" . $id;
$afbeelding_huidig = $recept["afbeelding"];
$fout = "";

$formulier = [
    "titel" => $recept["titel"],
    "categorie_id" => $recept["categorie_id"],
    "beschrijving" => $recept["beschrijving"],
    "bereidingswijze" => $recept["bereidingswijze"],
    "bereidingstijd" => $recept["bereidingstijd"]
];

$query = $conn->prepare("SELECT naam, hoeveelheid FROM ingredienten WHERE recept_id = :id ORDER BY id");
$query->execute([":id" => $id]);
$ingredienten_form = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formulier["titel"] = strip_tags(htmlspecialchars(trim($_POST["titel"])));
    $formulier["categorie_id"] = (int) $_POST["categorie_id"];
    $formulier["beschrijving"] = strip_tags(htmlspecialchars(trim($_POST["beschrijving"])));
    $formulier["bereidingswijze"] = strip_tags(htmlspecialchars(trim($_POST["bereidingswijze"])));
    $formulier["bereidingstijd"] = (int) $_POST["bereidingstijd"];

    $ingredienten_form = [];
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

    $afbeelding = $recept["afbeelding"];
    if ($fout === "" && isset($_FILES["afbeelding"]) && $_FILES["afbeelding"]["error"] === 0) {
        $extensie = strtolower(pathinfo($_FILES["afbeelding"]["name"], PATHINFO_EXTENSION));

        if (!in_array($extensie, ["jpg", "jpeg", "png", "webp"])) {
            $fout = "Alleen jpg, png of webp bestanden zijn toegestaan.";
        } else {
            if ($afbeelding && file_exists("uploads/" . $afbeelding)) {
                unlink("uploads/" . $afbeelding);
            }
            $afbeelding = uniqid() . "." . $extensie;
            move_uploaded_file($_FILES["afbeelding"]["tmp_name"], "uploads/" . $afbeelding);
        }
    }

    if ($fout === "") {
        $query = $conn->prepare("
            UPDATE recepten
            SET categorie_id = :categorie_id, titel = :titel, beschrijving = :beschrijving,
                bereidingswijze = :bereidingswijze, bereidingstijd = :bereidingstijd, afbeelding = :afbeelding
            WHERE id = :id
        ");
        $query->execute([
            ":categorie_id" => $formulier["categorie_id"],
            ":titel" => $formulier["titel"],
            ":beschrijving" => $formulier["beschrijving"],
            ":bereidingswijze" => $formulier["bereidingswijze"],
            ":bereidingstijd" => $formulier["bereidingstijd"],
            ":afbeelding" => $afbeelding,
            ":id" => $id
        ]);

        $query = $conn->prepare("DELETE FROM ingredienten WHERE recept_id = :id");
        $query->execute([":id" => $id]);

        $query = $conn->prepare("INSERT INTO ingredienten (recept_id, naam, hoeveelheid) VALUES (:recept_id, :naam, :hoeveelheid)");
        foreach ($ingredienten_form as $ingredient) {
            $query->execute([
                ":recept_id" => $id,
                ":naam" => $ingredient["naam"],
                ":hoeveelheid" => $ingredient["hoeveelheid"]
            ]);
        }

        header("Location: detail.php?id=" . $id);
        exit;
    }
}

for ($i = 0; $i < 2; $i++) {
    $ingredienten_form[] = ["naam" => "", "hoeveelheid" => ""];
}

include_once "view/recept.view.php";
