<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<html>
  <meta charset="utf-8" >
  <head>
    <title>Neuer Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    
<body>

  <nav class="navtop">
		<div>
			<h1>BTP-Server</h1>
      <a href="./home.php">Startseite</a>
			<a href="./eingabe.php">Neuer Patient</a>
			<a href="./tabelle.php">Übersicht Patienten</a>
			<a href="./statistik.php">Statistik</a>
			<a href="./lageinfos.php">Lageinfos</a>
			<a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
  </nav>

    <div class="container">
      <h1>Neuer Patient</h1>
      <h3>vollständig ausfüllen!</h3>

        <form action = "connect.php" method="POST">
          <div class="row">
            <div class="col-25">
              <label for="vorname">Vorname</label>
            </div>
            <div class="col-75">
              <input type="text" id="vorname" name="vorname" placeholder="Vorname Patient">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="nachname">Nachname</label>
            </div>
            <div class="col-75">
              <input type="text" id="nachname" name="nachname" placeholder="Nachname Patient">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="geburtsdatum">Geburtsdatum</label>
            </div>
            <div class="col-75">
                <input type = "date" name = "geburtsdatum" placeholder="TT.MM.JJJJ" />
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="adresse">Adresse</label>
            </div>
            <div class="col-75">
              <textarea id="adresse" name="adresse" placeholder="Adresse" style="height:90px"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="telefon">Telefonnummer</label>
            </div>
            <div class="col-75">
                <input type="text" id="telefon" name="telefon" placeholder="Telefonnummer Patient">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="erkrankungen">Vorerkrankungen</label>
            </div>
            <div class="col-75">
                <input type="text" id="erkrankungen" name="erkrankungen" placeholder="Liste aller Vorerkrankungen" style="height:130px">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="medis">Medikamente</label>
            </div>
            <div class="col-75">
                <input type="text" id="medis" name="medis" placeholder="Liste aller Medikamente" style="height:130px">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="medisgenug">Ausreichend Medikamente?</label>
            </div>
            <div class="col-75">
                <input type="checkbox" id="medisgenug" name="medisgenug" value="ja">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="material">Benötigtes Material</label>
            </div>
            <div class="col-75">
                <input type="text" id="material" name="material" placeholder="Besonderes Material wie Sauerstoff benötigt?" style="height:130px">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="TMittel">Transportmittel Ankunft</label>
            </div>
            <div class="col-75">
              <select id="TMittel" name="TMittel">
                <option value="RTW">RTW</option>
                <option value="KTW">KTW</option>
                <option value="keinRD">LMW / Taxi / Privatunternehmen / DSW21</option>
                <option value="selbst">Eigenständig</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="mobility">Mobilität</label>
            </div>
            <div class="col-75">
              <select id="mobility" name="mobility">
                <option value="Laufend">Laufend</option>
                <option value="Rollstuhl">Rollstuhl</option>
                <option value="Rollator">Rollator</option>
                <option value="Liegend">Liegend</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="bemerkungen">Bemerkungen</label>
            </div>
            <div class="col-75">
                <input type="text" id="bemerkungen" name="bemerkungen" placeholder="weitere Bemerkungen ggf. Funkkennung des Transportmittel bzw Rufnummer Rücktransport" style="height:130px">
            </div>
            <div class="row">
              <div class="col-25">
                <label for="ort">Zugewiesener Aufenthaltsraum</label>
              </div>
              <div class="col-75">
                <select id="ort" name="ort">
                  <option value="Aula">Aula</option>
                  <option value="Sporthalle">Sporthalle</option>
                  <option value="Turnhalle1">Turnhalle 1</option>
                  <option value="Turnhalle2">Turnhalle 2</option>
                  <option value="Turnhalle3">Turnhalle 3</option>
                  <option value="SanBereich">Sanitätsbereich</option>
                </select>
              </div>
            </div>

          
          <div class="row">
            <p></p>
            <input type="submit" value="Patienten eintragen">
          </div>
        </form>
        <div>
          <p>Inhaltliche Fragen: an GF Betreuung wenden</p>
          <p>Technische Probleme oder Fragen an den ELW wenden</p>
          
          
        </div>
      </div>
</body>