<?php
require("menu.php");
?>
<?php
$id = $_POST["id"];
$nazwa = $_SESSION["login"];
$tresc = $_POST["tresc"];

$sql = "INSERT INTO komentarz (idGry, tresc, nick) VALUES ('$id', '$tresc', '$nazwa')";
$result = $conn->query($sql);
header("location: details.php?id=$id");
?>