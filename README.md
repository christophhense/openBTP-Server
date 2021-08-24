
  <h3 align="center">openBTP-Server</h3>

  <p align="center">
    Eine übersichtliche Lösung, um die Registratur und Auswertung von Patienten im Betreuungsplatzeinsatz zu übernehmen

</p>



<details open="open">
  <summary>Table of Contents</summary>
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

Der openBTP-Server soll das schnelle und effektive Patientenmanagement am Einsatzort ermöglichen. Die Grundidee entstand aus einem geplanten größeren Betreuungseinsatz im Rahmen einer
Bombenevakuierung. Auf genau diesen Einsatz ist das Projekt zugeschnitten. Aber auch eine Anwendung in anderen Bereichen in möglich. Immer dann, wenn Patienten oder Besucher registriert und verwaltet werden müssen.
Die Datensätze werden auch in eine stabsfreundliche Statistik ausgewertet und dargestellt. Ein Zugriff von außen ist möglich, muss aber technisch realisiert werden (s. Unten).



## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Vorraussetzungen

Vorausseetzung ist ein laufender LAMP-Stack (o. Ä.).
Benötigt wird ein Webserver, PHP und eine SQL-Datenbank.
Ein Beispiel:
Apache als Webserver + PHP
MariaDB als Datenbank
evtl. phpMyAdmin um die Einrichtung zu verwalten.

### Ans Laufen Bringen

1. Datenbankdaten in folgenden Dateien anpassen: `dbConfig.php` und `statistik.php`
2. `benutzer.xml` und `patienten.xml` in Datenbank importieren um Tabllen und einen Testbenutzer zu erstellen.
3. XML Dateien löschen.
4. Dateien in den Webordner bewegen.

### Erste Anmeldung

Benutzer: `test`
Passwort: `test`

### Konten anlegen

1. `/register.php` aufrufen und neuen Benutzer anlegen
2. über die CLI der Datenbank oder phpMyAdmin den test Benutzer löschen.



## Aktueller Stand

Use this space to show useful examples of how a project can be used. Additional screenshots, code examples and demos work well in this space. You may also link to more resources.

_For more examples, please refer to the [Documentation](https://example.com)_



<!-- ROADMAP -->
## Was ist geplant?

See the [open issues](https://github.com/othneildrew/Best-README-Template/issues) for a list of proposed features (and known issues).



<!-- CONTRIBUTING -->


<!-- LICENSE -->
## License

Distributed under the GNU General Public License v3.0. See `LICENSE` for more information.



<!-- CONTACT -->
## Contact

Cedric Steinbreecher - [@SirVanStone](https://twitter.com/SirVanStone) - hallo@nonameserver.org

Project Link: [https://github.com/elypson-Stone/openBTP-Server](https://github.com/elypson-Stone/openBTP-Server)


