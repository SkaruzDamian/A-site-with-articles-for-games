<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ulubione recenzje</title>
    <style>
        .mainContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .itemimg {
            margin: 5px;
            width: 20%; /* Stała szerokość dla elementu */
            height: auto;
            object-fit: cover; /* Zachowanie proporcji, wypełniając obszar */
        }
    </style>
</head>
<body>
    
<?php
require("menu.php");
$idUzytkownika = $_SESSION["id"];
$sql = "SELECT d.id,d.obrazek, d.nazwa FROM gra d, ulubione u WHERE u.idGry = d.id
AND idUzytkownika = $idUzytkownika";
$result = $conn->query($sql);
echo "<div class='mainContainer'>";

while($row = $result->fetch_object()){
    echo "<img class='itemimg' src='$row->obrazek'>";
}

echo "</div>";
?>
</body>

</html>


