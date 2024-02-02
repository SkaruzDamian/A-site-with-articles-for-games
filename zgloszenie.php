<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły</title>
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
<script src="jquery-3.6.4.min.js"></script>

<?php
 require("menu.php");
?>
<textarea type="text" name="" id="tresczgloszenia" cols="275" rows="10"></textarea>
<button id="wyslijZgloszenie">Wyslij Zgłoszenie</button>

       <script>
    $(document).ready(function() {
 $("#wyslijZgloszenie").on("click", function() {
 const akapit = $(this);
 console.log(document.getElementById("tresczgloszenia").value);
 $.post("addRequest.php", { tresc: "'" + document.getElementById("tresczgloszenia").value + "'"}, function(data) {
 if (data == "sukces") {
   alert("Pomyślnie wysłano");
   
 }
 else{
   alert("Coś poszło nie tak z zgłoszeniem");;
 }
 });
 });
});
</script>

