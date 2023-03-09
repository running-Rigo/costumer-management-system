# costumer-management-system
Kompetenzcheck PHP 2
Entwickle ein kleines Kundenverwaltungssystem für ein KMU (Klein- und Mittelunternehmen), das Überblick über seine KundInnendaten erhalten möchte.
Die eingetragenen KundInnen sollen in der Datenbank abgespeichert werden, man muss die Daten bearbeiten und sich eine Übersicht der Einträge anzeigen lassen können.
Nutze für die Verbindung zur Datenbank PDO.

Die Tabellen sollen folgendermaßen aussehen:
users: user_id, name, email, password
clients: company_id, company_name, contact_person, phone, adress, created_by (welcher User hat den Eintrag erstellt), created_at(Erstelldatum), edited_at(Bearbeitungsdatum)
Relation: users 1 – n clients
Anforderungen
User-Registrierung
User-LogIn
Anlegen von NeukundInnen über ein Kontaktformular
Übersicht aller KundInnen
Möglichkeit jeden Eintrag zu bearbeiten & zu löschen
Eingeloggte User können alle Einträge im System sehen
ABER: Eingeloggte User können nur die Einträge bearbeiten bzw. löschen, die sie auch selbst erstellt haben. (Tipp: Das könnt ihr mit einer Session lösen).

Benutzeroberfläche
Für die Benutzeroberfläche (GUI) könnt ihr entweder euer eigenes CSS verwenden oder eines der CSS Frameworks aus dem Kompetenzcheck CSS Frameworks verwenden: https://wiki.streampy.at/index.php?title=Web_-_Kompetenzcheck_CSS_Framework
(Ja so könnt ihr beide Kompetenzen miteinander abschließen 😉).

Gestaltet das Kundenverwaltungssystem benutzerfreundlich! (gutes Userfeedback bei den Kontaktformularen, deutliche Hinweise, wenn etwas nicht geklappt hat, etc.)
Achtet beim Styling auf gute Lesbarkeit, Farben, die nicht ablenken etc.
Denkt auch an die Responsive Gestaltung des Tools & passt euer CSS dementsprechend an.
