<link rel="stylesheet" href="style.css">
<?php
 require("menu.php");
// require("session.php");
if($_SESSION["rola"] == "admin"){
    require("db.php");
    $sql = "SELECT zgloszenia.tresc AS ZGTresc , zgloszenia.data AS ZGData , uzytkownicy.login AS UZLogin FROM zgloszenia INNER JOIN uzytkownicy ON zgloszenia.idUzytkownika = uzytkownicy.id";
    $result = $conn->query($sql);
    $srednia = $result->fetch_object();
    
  $result = $conn->query($sql);
   
    while($row = $result->fetch_object()) {
        echo "<span>{$row->ZGTresc}  {$row->UZLogin}  {$row->ZGData}</span> <br>";
        // echo "<span>{$row->}</span>";
        }
    
    echo "</div>";

}
?>
