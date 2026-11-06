<?php
header("Content-Type: text/css");
?>
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap");

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    min-height: 100vh;
    font-family: "Nunito", Arial, sans-serif;
    font-size: 16px;
    background: #EBB89E;
    color: #3B3B33;
}

a {
    color: #7A5636;
}

header {
    position: sticky;
    top: 0;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    padding: 20px 5% 16px 5%;
    background: #4F4045;
}

header h1 {
    margin: 0;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: 0.2em;
    text-align: center;
}

header h1 a {
    color: #ffffff;
    text-decoration: none;
}

header nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 4px 24px;
}

header nav a {
    padding: 4px 0;
    border-bottom: 2px solid transparent;
    font-size: 16px;
    font-weight: 600;
    color: #ffffff;
    text-decoration: none;
    transition: border-color 0.2s;
}

header nav a:hover {
    border-bottom-color: #EBB89E;
}

.midden {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}

.account {
    display: flex;
    gap: 18px;
}

.account a {
    padding: 4px 0;
    border-bottom: 2px solid transparent;
    font-size: 15px;
    font-weight: 600;
    color: #ffffff;
    text-decoration: none;
    transition: border-color 0.2s;
}

.account a:hover {
    border-bottom-color: #EBB89E;
}

.hero {
    width: 90%;
    margin: 50px auto 30px auto;
    text-align: center;
}

.hero h2 {
    margin: 0 0 16px 0;
    font-size: 40px;
    font-weight: 800;
    line-height: 1.1;
}

.hero h2 em {
    font-style: normal;
    color: #7A5636;
}

.hero p {
    max-width: 520px;
    margin: 0 auto;
    font-size: 18px;
    color: #4F4045;
}

.balk {
    display: flex;
    flex-direction: column;
    gap: 14px;
    width: 90%;
    max-width: 1200px;
    margin: 40px auto;
    padding: 16px;
    background: #ffffff;
    border: 1px solid #C7A08C;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(59, 59, 51, 0.06);
}

.zoekbalk {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    flex: 1;
    width: 100%;
}

.zoekbalk input,
.zoekbalk select {
    padding: 12px 16px;
    border: 1px solid #C7A08C;
    background: #ffffff;
    color: #3B3B33;
    border-radius: 10px;
    font-family: inherit;
    font-size: 16px;
}

.zoekbalk input {
    flex: 1 1 100%;
    min-width: 0;
}

.zoekbalk input::placeholder {
    color: #9A7866;
}

.zoekbalk input:focus,
.zoekbalk select:focus {
    outline: none;
    border-color: #7A5636;
}

.zoekbalk select {
    flex: 1;
    min-width: 0;
}

.zoekbalk button,
.toevoegen,
.knop,
.formulier button,
.acties button,
.admin button {
    display: inline-block;
    padding: 12px 24px;
    border: none;
    background: #7A5636;
    color: #ffffff;
    border-radius: 10px;
    font-family: inherit;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: background 0.2s;
}

.zoekbalk button:hover,
.toevoegen:hover,
.knop:hover,
.formulier button:hover,
.acties button:hover,
.admin button:hover {
    background: #4F4045;
}

.gevaar {
    background: #3B3B33 !important;
}

.gevaar:hover {
    background: #4F4045 !important;
}

.recepten {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
    width: 90%;
    max-width: 1200px;
    margin: 30px auto 70px auto;
}

.kaart {
    display: block;
    background: #ffffff;
    border: 1px solid #C7A08C;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(59, 59, 51, 0.06);
    text-decoration: none;
    color: #3B3B33;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}

.kaart:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(59, 59, 51, 0.12);
}

.kaart img,
.kaart .geenfoto {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
}

.kaart .geenfoto,
.detail .geenfoto {
    background: #C7A08C;
}

.kaart .tekst {
    padding: 16px 20px 20px 20px;
}

.kaart h2 {
    margin: 0 0 6px 0;
    font-size: 20px;
    font-weight: 800;
}

.kaart p {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    color: #7A5636;
}

.formulier {
    width: 90%;
    max-width: 480px;
    margin: 40px auto 70px auto;
    padding: 28px 24px;
    background: #ffffff;
    border: 1px solid #C7A08C;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(59, 59, 51, 0.06);
}

.formulier.breed {
    max-width: 720px;
}

.formulier h2 {
    margin: 0 0 8px 0;
    font-size: 28px;
    font-weight: 800;
}

.formulier label {
    display: block;
    margin: 18px 0 6px 0;
    font-size: 14px;
    font-weight: 700;
}

.formulier input[type="text"],
.formulier input[type="password"],
.formulier input[type="number"],
.formulier select,
.formulier textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #C7A08C;
    background: #ffffff;
    color: #3B3B33;
    border-radius: 10px;
    font-family: inherit;
    font-size: 16px;
}

.formulier input:focus,
.formulier select:focus,
.formulier textarea:focus {
    outline: none;
    border-color: #7A5636;
}

.formulier input[type="file"] {
    width: 100%;
    font-family: inherit;
}

.formulier button {
    margin-top: 26px;
}

.ingredientrij {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 10px;
}

.voorbeeld {
    display: block;
    width: 100%;
    max-height: 200px;
    object-fit: cover;
    margin-bottom: 10px;
    border-radius: 10px;
}

.fout {
    margin: 14px 0;
    padding: 12px 14px;
    background: #3B3B33;
    border: 1px solid #3B3B33;
    border-radius: 10px;
    color: #EBB89E;
    font-weight: 600;
}

.detail {
    width: 90%;
    max-width: 1100px;
    margin: 30px auto 70px auto;
}

.detail .terug {
    display: inline-block;
    margin-bottom: 20px;
    font-weight: 700;
    color: #7A5636;
    text-decoration: none;
}

.bovenkant,
.onderkant {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
    margin-bottom: 24px;
}

.detail img,
.detail .geenfoto {
    width: 100%;
    height: 320px;
    object-fit: cover;
    display: block;
    border-radius: 16px;
}

.detail h2 {
    margin: 0 0 8px 0;
    font-size: 36px;
    font-weight: 800;
    line-height: 1.1;
}

.detail .info {
    margin: 0 0 14px 0;
    font-weight: 700;
    color: #7A5636;
}

.detail .beschrijving {
    line-height: 1.6;
    color: #4F4045;
}

.paneel {
    padding: 22px;
    background: #ffffff;
    border: 1px solid #C7A08C;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(59, 59, 51, 0.06);
}

.paneel h3 {
    margin: 0 0 12px 0;
    font-size: 20px;
    font-weight: 800;
}

.paneel p {
    margin: 0;
    line-height: 1.7;
}

.paneel ul {
    margin: 0;
    padding-left: 20px;
    line-height: 1.9;
}

.acties {
    display: flex;
    gap: 12px;
    margin-top: 24px;
}

.acties form {
    margin: 0;
}

.admin {
    width: 90%;
    max-width: 1200px;
    margin: 40px auto 70px auto;
}

.admin h2 {
    margin: 0 0 14px 0;
    font-size: 26px;
    font-weight: 800;
}

.tabelwrap {
    overflow-x: auto;
    margin-bottom: 40px;
    padding: 8px 20px;
    background: #ffffff;
    border: 1px solid #C7A08C;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(59, 59, 51, 0.06);
}

.admin a {
    color: #7A5636;
    font-weight: 700;
}

.admin table {
    width: 100%;
    border-collapse: collapse;
    min-width: 500px;
}

.admin th {
    text-align: left;
    padding: 12px 10px;
    border-bottom: 1px solid #C7A08C;
    font-size: 13px;
    font-weight: 700;
    color: #4F4045;
}

.admin td {
    text-align: left;
    padding: 12px 10px;
    border-bottom: 1px solid #EBB89E;
}

.admin form {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.admin .knop,
.admin button {
    padding: 6px 14px;
    font-size: 14px;
    color: #ffffff;
}

@media (min-width: 600px) {
    header h1 {
        font-size: 26px;
    }

    .hero h2 {
        font-size: 60px;
    }

    .zoekbalk {
        flex-wrap: nowrap;
    }

    .zoekbalk input {
        flex: 1;
    }

    .zoekbalk select {
        flex: none;
        width: 190px;
    }

    .recepten {
        grid-template-columns: 1fr 1fr;
    }

    .ingredientrij {
        flex-direction: row;
    }

    .ingredientrij input:first-child {
        width: 35%;
    }
}

@media (min-width: 900px) {
    header {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
    }

    .midden {
        grid-column: 2;
    }

    .account {
        grid-column: 3;
        justify-self: end;
    }

    .hero {
        margin: 70px auto 40px auto;
    }

    .hero h2 {
        font-size: 72px;
    }

    .balk {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .zoekbalk {
        max-width: 780px;
    }

    .recepten {
        grid-template-columns: 1fr 1fr 1fr;
    }

    .bovenkant {
        grid-template-columns: 1fr 1fr;
        align-items: center;
    }

    .detail img,
    .detail .geenfoto {
        height: 400px;
    }

    .onderkant {
        grid-template-columns: 1fr 2fr;
        align-items: start;
    }
}
