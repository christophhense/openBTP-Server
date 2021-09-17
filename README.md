
  <h3 align="center">openBTP-Server</h3>

  <p align="center">
    Eine übersichtliche Lösung, um die Registratur und Auswertung von Patient*innen im Betreuungsplatzeinsatz zu übernehmen

</p>



<details open="open">
  <summary>Inhalt</summary>
  <ol>
    <li>
      <a href="#Über-das-Projekt">Über das Projekt</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#Vorraussetzungen">Vorraussetzungen</a></li>
        <li><a href="#Ans-Laufen-Bringen">Ans laufen bringen</a></li>
        <li><a href="#Erste-Anmeldung">Erste Anmeldung</a></li>
        <li><a href="#Konten-Anlegen">Konten anlegen</a></li>
      </ul>
    </li>
    <li><a href="#Aktueller-Stand">Aktueller Stand<a></li>
    <li><a href="#Was-ist-geplant">Was ist geplant?</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>




## Über das Projekt

Der openBTP-Server soll das schnelle und effektive Patient*innenmanagement am Einsatzort ermöglichen. Die Grundidee entstand aus einem geplanten größeren Betreuungseinsatz im Rahmen einer
Bombenevakuierung. Auf genau diesen Einsatz ist das Projekt zugeschnitten. Aber auch eine Anwendung in anderen Bereichen in möglich. Immer dann, wenn Patient*innen oder Besucher*innen registriert und verwaltet werden müssen.
Die Datensätze werden auch in eine stabsfreundliche Statistik ausgewertet und dargestellt. Ein Zugriff von außen ist möglich, muss aber technisch realisiert werden (s. Unten).


## Getting Startet


### Vorraussetzungen

Vorausseetzung ist ein laufender LAMP-Stack (o. Ä.).
Benötigt wird ein Webserver, PHP und eine SQL-Datenbank.
Ein Beispiel:
Apache als Webserver + PHP
MariaDB als Datenbank
evtl. phpMyAdmin um die Einrichtung zu verwalten.

### Ans Laufen Bringen

1. Datenbankdaten in folgenden Dateien anpassen: `dbConfig.php` und `statistik.php`
2. `benutzer.sql` und `patienten.sql` in Datenbank importieren um Tabllen und einen Testbenutzer zu erstellen.
3. SQL
  Dateien löschen.
4. Dateien in den Webordner bewegen.

### Erste Anmeldung

Benutzer: `test`
Passwort: `test`

### Konten anlegen

1. `/register.php` aufrufen und neuen Benutzer*in anlegen
2. über die CLI der Datenbank oder phpMyAdmin den test Benutzer löschen.



## Aktueller Stand
  
Änderungsübersicht:
- Lageübersichtsseite hinzugekommen. Hier findet ihr alle Infos zum Einsatz, sowie die Downloads.
- Der SanBereich hat eine eigene Unterseite bekommen wo nur Patient*innen aus dem SanBereich angezeigt werden.
- Anpassung Berechnung der Statistik: Ausgebuchte Patient*innen werden in entsprechenden Bereichen nicht mehr mitgezählt.



<!-- ROADMAP -->
## Was ist geplant?

- Verinfachte installation über eine `/install.php`
- Patient*innen können mehrfach ein und ausgebucht werden und bekommen eine Historie.
- Seite zum schnelleren Ausbuchen von Patient*innen zum Einsatzende.
- Echtzeit Notizen zur Kommunikation in der Lage mit Benachrichtigungen.
- Eigenständige Passwortänderung über die Profil-Seite (dann hat diese endlich einen erkennbaren Sinn 😏 )
- UHS-Modul (ähnlich wie SanBereich mit angepasstem Datensatz (Kostenträger, Fachrichtung, Meldebild etc.)
- Schnittstelle zum openTacticalDispatcher zum Anlegen von Transporten und Einsätzen.



<!-- CONTRIBUTING -->


<!-- LICENSE -->
## License

Distributed under the GNU General Public License v3.0. See `LICENSE` for more information.



<!-- CONTACT -->
## Contact

Cédric Steinbrecher - [@SirVanStone](https://twitter.com/SirVanStone) - hallo@nonameserver.org

Project Link: [https://github.com/elypson-Stone/openBTP-Server](https://github.com/elypson-Stone/openBTP-Server)


