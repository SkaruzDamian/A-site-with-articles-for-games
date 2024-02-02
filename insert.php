<?php 
$nazwa = $_POST["nazwa"];
$opis = $_POST["opis"];
$ocena = $_POST["ocena"];
$premiera = $_POST["premiera"];
$idKategorii = $_POST["idKategorii"];
$obrazek = basename($_FILES["obrazek"]["name"]);
move_uploaded_file($_FILES["obrazek"]["tmp_name"], "src/" . $obrazek);

$dostepnosc = $_POST["dostepnosc"];
$wersjajezykowa = $_POST["wersjajezykowa"];
$producent = $_POST["producent"];
$wydawca = $_POST["wydawca"];
$cena = $_POST["cena"];
$pomocnyLicznik=$_POST["pomocnyLicznik"];

$conn = new mysqli("localhost", "root", "", "projekt");

$sql = "INSERT INTO gra (idKategorii, nazwa, opis, obrazek, ocena, premiera, dostepnosc, wersjajezykowa, producent, wydawca, cena, pomocnyLicznik) VALUES
 ($idKategorii, '$nazwa','$opis', 'src/$obrazek', $ocena, '$premiera', '$dostepnosc', '$wersjajezykowa', '$producent', '$wydawca', $cena, $pomocnyLicznik)";

if ($conn->query($sql) === TRUE) {
    $idGry = $conn->insert_id;
}
if(isset($_POST['obraz_ident']) && isset($_FILES['obraz'])) {
    $obraz_ident = $_POST['obraz_ident'];
    $obraz = $_FILES['obraz'];

    for ($i = 0; $i < count($obraz['name']); $i++) {
        $nazwa_pliku = $conn->real_escape_string($obraz['name'][$i]);
        $identyfikator = $conn->real_escape_string($obraz_ident[$i]);
        move_uploaded_file($_FILES["obraz"]["tmp_name"][$i], "src/" . $nazwa_pliku);

        $sql = "INSERT INTO obrazek (idGry, licznik, obraz) VALUES ($idGry, '$identyfikator', 'src/$nazwa_pliku')";
        
        if ($conn->query($sql) !== TRUE) {
            echo "Błąd wstawiania obrazka: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Wstawianie danych do tabeli 'opis'
if(isset($_POST['liczenie_ident']) && isset($_POST['tresc'])) {
    $liczenie_ident = $_POST['liczenie_ident'];
    $tresc = $_POST['tresc'];

    for ($i = 0; $i < count($tresc); $i++) {
        $tresce = $conn->real_escape_string($tresc[$i]);
        $identyfika = $conn->real_escape_string($liczenie_ident[$i]);

        $sql = "INSERT INTO opis (idGry, licznik, tresc) VALUES ($idGry, '$identyfika', '$tresce')";
        
        if ($conn->query($sql) !== TRUE) {
            echo "Błąd wstawiania opisu: " . $sql . "<br>" . $conn->error;
        }
    }
}

    echo "Dane zostały dodane do bazy danych.";


$conn->close();


header("location: index.php");


?>