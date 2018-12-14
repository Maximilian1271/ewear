!! bitte stellen sie sicher das beim zugriff auf das projekt, sämtliche $_SESSION's gelöscht wurden. Sollte dies nicht der fall sein und sie bekommen den fehler: "Fatal error: Uncaught Error: Call to a member function fetch_row() on boolean in C:\xampp\htdocs\ewear\app\Models\User.php:112", rufen sie bitte die logout methode indem sie die seite "localhost/ewear/logout" besuchen. Dies ist ein fehler der nur in einer entwickungsumgebung auftritt und beeinflusst das projekt nicht !!


um einen reibunglosen ablauf zu gewährleisten, ändern sie bitte in app->config->paths.php die konstante "APP_URL" so dass das root directory gleich dem projektnamen ist. Sollte der Projektname "ewear" sein, so sind keine änderungen notwendig. Sollte der Projektname "beispiel1" sein, so nennen sie bitte die konstante "http://localhost/beispiel1/"

die datenbank muss den namen "ewear" tragen, ansonsten funktionieren datenbankfunktionen nicht (ewear.sql dump sollte alles richtig importieren)

passwörter für alle nutzer ist "hallo123"

usernames sind case sensitive

passwörter sind case sensitive

usernames sind in der datenbank unter der tabelle "users" zu finden. Der admin account hat die login daten username: admin, passwort: hallo123

nur user mit dem access level 2 haben zugriff zu administrativen funktionen

csrf methoden wurden geschrieben, jedoch für die entwicklung deaktiviert



Folgende aufgaben wurden leider nicht erfüllt:
-Das projekt ist nicht reponsive. Getestet wurde auf einem 1920x1080 monitor
-order cart ist nicht vorhanden
-/admin/OrderControl ist nicht vorhanden

dennoch hoffe ich auf eine gute beurteilung!