<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script src="jquery-3.6.4.min.js"></script>

<?php
 require("menu.php");

?>
<style>
    .container3 {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }

    h3 {
        font-size: 24px;
        color: #333;
    }
    .object{
        display:flex;
        flex-direction: column;
        align-items: center;
    }
    .name::before{
        content:"Imie: ";
    }
    .description::before{
        content:"Opis: ";
    }
    .capacity::before{
        content:"Pojemność: ";
    }
    .height::before{
        content:"Wysokość: ";
    }
    .centered-container {
  display: flex;
  justify-content: center;
  align-items: center;
 
}
    .obras{
        width:680px;
        height:600px;
        
    }
    .malyobrazek{
        width:10%;
        height:10%;   
    }
.obrazek {
    width:70%;
    height: 70%; 
    margin-top: 20px;
    margin-bottom: 20px;
  }
  .game-title {
    margin-top: 20px;
    margin-bottom: 20px;
    font-weight: bold;
  }

  .category {
    font-family: Arial, sans-serif; /* Przykładowa czcionka */
    font-size: 14px; /* Przykładowy rozmiar czcionki */
    /* Inne style czcionki, np. kolor, pogrubienie, itp., mogą być dodane tutaj */
  }
  .info-box {
    border: 10px solid black;
    border-radius: 10px; /* Zaokrąglone rogi */
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Cień */
  }
  .opis{
    margin-top: 20px;
    margin-bottom:20px;
    margin-right: 80px;
    margin-left: 80px;
  }
  .comment-nick {
        font-weight: bold;
    }

    .comment-tresc {
        font-style: italic;
    }

    .comment-data {
        color: #777;
    }
</style>


<div class="main">


<?php 

$id = $_GET["id"];
require("db.php");
echo "<span class='object'>";

$sql = "SELECT idKategorii, k.nazwa AS nazwaKat, d.nazwa, obrazek, d.opis, ocena, premiera, dostepnosc, wersjaJezykowa, producent, wydawca cena FROM gra d, kategorie k WHERE d.id=$id AND idKategorii=k.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_object();
    $nazwa = $row->nazwa;
    echo "<h1 class='game-title'>$nazwa</h1>";
    echo "<hr>";
    echo "<h4 class='opis'>$row->opis</h4>";
    $obrazek = $row->obrazek;
    echo "<hr>";
    echo "<img src='$obrazek' alt='Obrazek gry' class='obrazek'>";
    echo "<hr>";
} else {
    echo "Brak danych.";
}

$sql = "SELECT  gra.id AS graID,
                gra.nazwa AS graNazwa,
                gra.idKategorii,
                gra.opis AS graOpis,
                gra.ocena,
                gra.premiera,
                gra.dostepnosc,
                gra.wersjaJezykowa,
                gra.producent,
                gra.wydawca,
                gra.cena,
                gra.pomocnyLicznik,
                kategorie.nazwa AS kategoriaNazwa
                 FROM gra INNER JOIN kategorie ON gra.idKategorii = kategorie.id  WHERE gra.id='$id'";
$result = $conn->query($sql);

if ($result) {
if($result->num_rows > 0){
    echo "<h2 class='game-title'>Najważniejsze informacje o grze: </h2>";
    while($row = $result->fetch_object()) {
        $licznik = "$row->pomocnyLicznik";
        $idGry="$row->graID";
        echo "<div class='info-box'>";
        echo "<h4>Kategoria gry: <span class='category'>{$row->kategoriaNazwa}</span></h4>";
        echo "<h4>Data premiery: <span class='category'>{$row->premiera}</span></h4>";
        echo "<h4>Gra dostępna na platformach: <span class='category'>{$row->dostepnosc}</span></h4>";
        echo "<h4>Czy polska wersja językowa jest dostępna: <span class='category'>{$row->wersjaJezykowa}</span></h4>";
        echo "<h4>Producent: <span class='category'>{$row->producent}</span></h4>";
        echo "<h4>Wydawca: <span class='category'>{$row->wydawca}</span></h4>";
        echo "<h4>Cena w dniu premiery: <span class='category'>{$row->cena}</span></h4>";
        echo "</div>";
        
    }
}
} else {
    echo "Brak podanego rekordu";
}
$idGry=$id;
$zmienna=2;
$sqlObrazy = "SELECT obraz, licznik FROM obrazek WHERE idGry = $idGry ORDER BY licznik ASC";

// Zapytanie SQL dla opisów
$sqlOpisy = "SELECT tresc, licznik FROM opis WHERE idGry = $idGry ORDER BY licznik ASC";

// Wykonaj zapytania SQL
$resultObrazy = $conn->query($sqlObrazy);
$resultOpisy = $conn->query($sqlOpisy);

// Sprawdź, czy oba zapytania zwróciły wyniki
if ($resultObrazy->num_rows > 0 && $resultOpisy->num_rows > 0) {
    $rowObrazy = $resultObrazy->fetch_assoc();
    $rowOpisy = $resultOpisy->fetch_assoc();

    while ($zmienna != $licznik+1) {
        if ($rowObrazy['licznik'] == $zmienna) {
            echo "<div>";
            echo "<img class='obras' src='{$rowObrazy['obraz']}'>";
            echo "<hr>";
            echo "</div>";
            $rowObrazy = $resultObrazy->fetch_assoc(); // Przejdź do następnego rekordu obrazka
        }
        if ($rowOpisy['licznik'] == $zmienna) {
            echo "<div>";
            echo "<p class='opis'>{$rowOpisy['tresc']}</p>";
            echo "<hr>";
            echo "</div>";
            $rowOpisy = $resultOpisy->fetch_assoc(); // Przejdź do następnego rekordu opisu
        }
        $zmienna++;
    }
} else {
    echo "Brak danych.";
}
echo " </span>";
?>

<?php

$idUzytkownika = $_SESSION["id"];
$img = "src/Dodaj.png";

$sql = "SELECT id FROM ulubione WHERE idGry = $id AND idUzytkownika = $idUzytkownika";
$added = $conn->query($sql)->num_rows > 0;
$text = $added ? "src/Usun.png"  : "src/Dodaj.png";
echo "<div class='centered-container'>";
echo "<img class='malyobrazek' src='$text'  data-gra='$id'> ";
echo "</div>";
?>
<script>
$(document).ready(function() {
 $(".malyobrazek").on("click", function() {
 const akapit = $(this);
 $.post("changeFav.php", { idGry: "'" + akapit.data("gra") + "'"}, function(data) {
 if (data == "sukces") {
    akapit.attr("src",(akapit.attr("src") == "src/Usun.png") ? "src/Dodaj.png" : "src/Usun.png");
  
 }
 console.log(akapit.attr("src"))
 });
 });
});
</script>

<form action="insertReview.php" method="post">
<input type="hidden" name='id' value="<?php echo $_GET["id"] ?>" > 
<textarea name="tresc" id="" cols="270" rows="20"></textarea>
<button type="submit">Wyślij!</button>
</form>
</div>
<?php 

$sql = "SELECT nick, tresc, data FROM komentarz WHERE idGry=$id";
$result = $conn->query($sql);
echo"<h3>Komentarze: <br><br>";
if($result->num_rows > 0){
    while($row = $result->fetch_object()) {
        echo "<div class='container3'>";   
        echo "<span class='comment-nick'>Nazwa: $row->nick</span> <br>";
        echo "<span class='comment-tresc'>Tresc: $row->tresc</span> <br>";
        echo "<span class='comment-data'>Data: $row->data</span> <br>";
echo "<br>";
echo "</div>";
    }};
    if($result->num_rows == 0){
        echo"Brak komentarzy";
    }
        $conn->close();
?>  
</body>
<footer>
<?php 
require("footer.html");
?>
</footer>

</html>