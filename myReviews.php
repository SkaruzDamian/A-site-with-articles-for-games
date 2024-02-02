<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje komentarze</title>
    <link rel="stylesheet" href="style.css">
    <style>
         .centered-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
        </style>
</head>
<body>
<?php
require ("db.php");
 require("menu.php");
?>
   
    <?php
    echo "<h3>Moje komentarze: </h3>";
    echo "<div class='centered-container'>";
    $login = $_SESSION["login"];
   
    $sql = "SELECT tresc, data, d.id AS idGry, nazwa FROM komentarz r, gra d
    WHERE d.id = idGry AND nick = '$login'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_object()) {
            echo "
            <div class='review'>
            <p class='tresc'>Treść komentarza: $row->tresc </p>
            <p class='dzban'>Nazwa gry: $row->nazwa </p>
            <p class='czas'>Data: $row->data </p>
            </div>
                ";

        }}else
        {
            echo"Brak komentarzy";
        }
    echo "</div>";
    ?>
</body>

</html>