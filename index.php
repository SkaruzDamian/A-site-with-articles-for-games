<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games4Gamers</title>
    <script src="jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
       
        </style>

</head>
<body>
        <?php
 require("menu.php");
?>

    <div class="content">
    <div class="content1">
    
    <?php
$sql = "SELECT id, nazwa FROM kategorie";
 $result = $conn->query($sql);
 echo "<a href='index.php' class='color'> Wszyskie</a>";
 while($row = $result->fetch_object()) {
 echo " <a class='underHeader' href='index.php?idKat={$row->id}'>{$row->nazwa}</a> ";
 }
 ?>
<div class="content2">
 <form >
 <p>
 <input type="text" name="fraza" aria-label="Szukaj" placeholder="Szukaj gry">
 <input type="submit" value="Szukaj gry" >
 </p>
 </form>
</div>
    </div>
   </div>
    
<?php 
$sql = "SELECT id, nazwa, obrazek FROM gra";
if (isset($_GET["idKat"])) {
    $idKat = $_GET["idKat"];
    $sql .= " WHERE idKategorii = $idKat";
} elseif (isset($_GET["fraza"])) {
    $fraza = $_GET["fraza"];
    $sql .= " WHERE nazwa LIKE '%$fraza%'";
}

$result = $conn->query($sql);
echo "<div class='mainContainer'>";
$count = 0; // Licznik elementów w obecnym wierszu

while ($row = $result->fetch_object()) {
    if ($count % 3 == 0) {
        // Rozpoczęcie nowego wiersza po trzech elementach (pierwszy element w nowym wierszu)
        if ($count > 0) {
            echo "</div><div class='line'>";
        }
    }

    echo "<a class='mainItem' href='details.php?id={$row->id}'>
            <img class='itemimg' src='{$row->obrazek}'></img>{$row->nazwa}
          </a>";

    $count++;
}

// Zamknięcie ostatniego wiersza, jeśli nie zakończył się po trzech elementach

echo "</div>";
?>


    
</body>
<footer>
<?php 
require("footer.html");
?>
</footer>
</html>
