<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj recenzję</title>
    <link rel="stylesheet" href="style.css">
    <style>
         .centered-container {
  display: flex;
  justify-content: center;
  align-items: center;
 
}
    .larger-input {
        width: 1000px;
        height: 300px;
    }
        </style>
</head>
<body>
<?php
 require("menu.php");
?>

    <?php 
    echo"
    <div class='centered-container'>
        <form action='insert.php' method='post'  enctype='multipart/form-data'>
        <p><input type='text' class='larger-input' name='nazwa' placeholder='nazwa' id='' value=''></p>
        <p><input type='file' name='obrazek'></p>
        <p><input type='text' class='larger-input' name='opis' placeholder='opis' id='' value=''></p>
        <p><input type='number' class='larger-input' name='ocena' placeholder='ocena' id='' value=''></p>
		<p><input type='text' class='larger-input' name='premiera' placeholder='premiera' id='' value=''></p>
		<p><input type='text'  class='larger-input' name='dostepnosc' placeholder='dostepnosc' id='' value=''></p>
		<p><input type='text' class='larger-input' name='wersjajezykowa' placeholder='wersjajezykowa' id='' value=''></p>
		<p><input type='text' class='larger-input' name='producent' placeholder='producent' id='' value=''></p>
		<p><input type='text' class='larger-input' name='wydawca' placeholder='wydawca' id='' value=''></p>
		<p><input type='number' name='cena' placeholder='cena' id='' value=''></p>
        <p><select name='idKategorii' ></p>
        ";
        $conn = new mysqli("localhost", "root", "", "projekt");
        $sql = "SELECT id,nazwa FROM kategorie";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_object()) {
                echo"<option value='$row->id'>{$row->nazwa} </option>";

            }}else
            {
                echo"NIE ZNALEZIONO KATEGORI";
            }
    echo"     </select></p>
     <button type='button' id='dodajObrazek'>Dodaj obrazek</button>
    <button type='button' id='dodajOpis'>Dodaj opis</button>

    <div id='dynamicznePola'></div>

    <p><button type='submit'>Dodaj recenzję</button>
        </form>
        </div>
        ";
    ?>
<script>
    const dodajObrazekButton = document.getElementById('dodajObrazek');
    const dodajOpisButton = document.getElementById('dodajOpis');
    const dynamicznePola = document.getElementById('dynamicznePola');
    let poleIndex = 0;
    let licznik =1;
    let pomocnyL =2;
    dodajObrazekButton.addEventListener('click', function() {
        const nowePole = document.createElement('div');
        nowePole.id = `pole${poleIndex}`;
        
        nowePole.innerHTML = `
            <p><input type='file' class='larger-input' name='obraz[]' id='obraz${licznik}'></p>
            <p><input type="hidden"  name="obraz_ident[]" value="${licznik}"></p>
            <input type="hidden" name="pomocnyLicznik" value="${pomocnyL}">
            `;
        dynamicznePola.appendChild(nowePole);
        poleIndex++;
        licznik++;
        pomocnyL++;
    });

    dodajOpisButton.addEventListener('click', function() {
        const nowePole = document.createElement('div');
        nowePole.id = `pole${poleIndex}`;
        
        nowePole.innerHTML = `<p><input type='text' class='larger-input' name='tresc[]' placeholder='tresc' id='opis${licznik}' value=''></p>
        <p><input type='hidden' name='liczenie_ident[]' value='${licznik}'></p>
        <input type="hidden" name="pomocnyLicznik" value="${pomocnyL}">
        `;
        
        dynamicznePola.appendChild(nowePole);
        poleIndex++;
        licznik++;
        pomocnyL++
    });
    const nowePole = document.createElement('div');
        nowePole.id = `pole${poleIndex}`;
        nowePole.innerHTML = ` <input type="hidden" name="pomocnyLicznik" value="${pomocnyL}">
            `;
            dynamicznePola.appendChild(nowePole);
        poleIndex++;
        licznik++;
</script>

    
</body>
</html>