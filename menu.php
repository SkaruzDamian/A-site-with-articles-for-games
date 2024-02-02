<?php 
require("db.php");
require("session.php");
?>
<header>
    <p><img src="g.png" width="100" height="100">

 <a href="index.php">Strona główna</a>
 <a href="favourites.php">Ulubione</a>
 <a href="myReviews.php">Moje komentarze</a>
 <a href="zgloszenie.php">Dodaj zgłoszenie</a>
 <?php if($_SESSION["rola"] === "admin"){
     echo " <a href='lista.php'>Lista Zgłoszeń</a>  ";
}
 ?>

Witaj <?= $_SESSION["login"] ?>!
 <a href="logout.php">Wyloguj</a>
 <?php if($_SESSION["rola"] === "admin"){ ?>
    <div class="addItem">
        <form action="insertForm.php">
        <button type="submit"> Dodaj nowy przedmiot</button>
        </form>
    </div>
	<?php } ?>
</p>
    </header>
    