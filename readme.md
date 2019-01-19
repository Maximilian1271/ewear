$_Session Fehler wurde gefixt, $_Sessions von anderen projekten sollten nun gelöscht werden


um einen reibunglosen ablauf zu gewährleisten, ändern sie bitte in app->config->paths.php die konstante "APP_URL" so dass das root directory gleich dem projektnamen ist. Sollte der Projektname "ewear" sein, so sind keine änderungen notwendig. Sollte der Projektname "beispiel1" sein, so nennen sie bitte die konstante "http://localhost/beispiel1/"

die datenbank muss den namen "ewear" tragen, ansonsten funktionieren datenbankfunktionen nicht (ewear.sql dump sollte alles richtig importieren)

passwörter für alle nutzer ist "hallo123"

usernames sind case sensitive

passwörter sind case sensitive

admin account: admin (passwort: hallo123)
user account: fschaumann (passwort: hallo123)


Folgende aufgaben wurden leider nicht erfüllt:
Alle aufgaben wurden erfüllt

Zusätzliche Aufgaben wurden erfüllt:
-Dem User wird im Warenkorb bzw. vorm Bestellabschluß ermöglicht eine alternative
Lieferadresse anzugeben.
-clientseitige Formularvalidierung
