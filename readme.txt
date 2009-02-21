=== izioSEO ===
Contributors: Mathias 'United20' Schmidt
Donate link: http://www.goizio.com/downloads/
Tags: seo, plugin, suchmaschinenoptimierung, google, meta, robots, description, keywords, analytics, search engine optimization, posts, title, meta description, meta keywords, duplicate content
Requires at least: 2.6
Tested up to: 2.7.1
Stable tag: 1.1.3

Das Wordpress SEO Plugin izioSEO ist ein wirkungsvolles und vollautomatisches Plugin fuer Ihren Blog, welches ohne 
viel Aufwand Ihren Wordpress Blog nach den Kriterien der OnPage Suchmaschinenoptimierung (SEO) optimiert.

== Description ==
Sie wollen Ihren Wordpress Blog in den Suchergebnissen (SERPS) von Google und anderen Suchmaschinen besser 
platzieren? Dann ist das Wordpress SEO Plugin izioSEO genau das richtige fuer Sie. Eine sehr gute OnPage 
Suchmaschinenoptimierung ist eine wertvolle Grundlage fuer eine hoehere und erfolgreichere Platzierung in den 
Suchergebnissen. Durch dieses SEO Plugin haben Sie einen perfekten Ausgangspunkt fuer die oftmals schwierige 
und langwierige OffPage Suchmaschinenoptimierung.

Was bietet Ihnen izioSEO? izioSEO bietet eine solide Optimierung aller seitenspezifischer Merkmale. Das 
Wordpress Plugin optimiert unter anderem den Seitentitel, die META-Daten, wie META-Keywords, META-Beschreibung 
und die META-Robots eines Artikels oder einer Seite. Doch izioSEO kann noch weit aus mehr, als nur die Zuweisung 
von META-Daten und Seitentitel. izioSEO besticht durch die dynamische und automatisierte Generierung der META-Tags 
und der Seitentitel unter Verwendung einer Stopword-Liste. Diese Stopword-Liste ist frei nach Ihren Wuenschen 
erweiterbar und anpassbar, so koennen Sie Ihre Keywords und Seitenbeschreibungen beliebig definieren. Ausserdem 
verhindert izioSEO gezielt Duplicate Content auf ihrer Website, was sich wiederum sehr positiv auf die 
Suchmaschinenplatzierungen auswirkt. Doch dies ist nur ein Bruchteil der Funktionen, welche izioSEO besitzt. Mit 
mehr als 50 verschiedenen Funktionen ist izioSEO schon jetzt eines der umfangreichsten SEO Plugins fuer Wordpress 
und das Gute daran ist, es ist komplett kostenlos.

Der Funktionsumfang von izioSEO:

 * Optimierung der Seitentitel
 * Generierung und Optimierung von META-Daten (Keywords, Description, Robots)
 * Dynamische und erweiterbare Stopword-Liste zur Generierung von META-Daten
 * Zielgerichtete Verhinderung von Duplicate Content
 * Einbeziehung von Suchanfragen in die META-Daten
 * Umfangreiche Statistikfunktion
 * Im- und Export von Einstellung
 * Unterstuetzung der Daten anderer Wordpress Plugins
 * uvm.

Sie sind neugierig geworden und  moechten auf izioSEO umsteigen? Kein Problem. Durch die Unterstuetzung der 
Wordpress Plugins All In One SEO Pack, SimpleTags, Simple Tagging oder Ultimate Tag Warrior ist der Umstieg auf 
izioSEO nicht schwer.

== Installation ==
Dieser Bereich erlaeutert die Installation von izioSEO

1. Laden Sie izioSEO von der Website http://www.goizio.com/ herunter
2. Entpacken Sie das ZIP-Archiv mit Winzip, Winrar oder einer anderen gaengigen Packsoftware
3. Kopieren Sie den Ordner 'izioSEO' in das Verzeichniss '/wp-content/plugins/' ihres Wordpress-Blogs
4. Aktivieren Sie izioSEO unter dem Menuepunkt 'Plugins' in ihrem Wordpress-Blog
5. Nehmen Sie gewuenschte Einstellungen unter dem Menupunkt 'izioSEO' vor

== Changelog ==
Version 1.01 vom 15.09.2008

 * Bugfix: UTF-8 Fehler beseitigt
 * Bugfix: Behebung einiger kleiner Fehler in der Adminoberflaeche
 * Add: wird keine META-Description extrahiert, so wird bei der Generierung der Description auf die ersten Saetze 
   des Textes zurueckgegriffen
 * Add: zu wenige Keywords werden bei der Generierung mit den standard Keywords erweitert und auf die 
   gewuenschte Anzahl erweitert

Version 1.02 vom 16.10.2008

 * Bugfix: Bug bei der Generierung der Keywords von Blogseiten behoben
 * Change: Verbesserung der Generierung von META-Daten
 * Add: aktivieren und deaktivieren von rel="nofollow" fuer die Tagcloud, die Kategorieliste, die Auflistung der 
   Kategorien fuer einen Kommentar und die Blogroll
 * Add: Sammeln der Keywords fuer individuelle Stopword-Listen ueber das Admininterface
 * Add: robots.txt editierbar ueber das Administrationspanel

Version 1.02 Rev1 vom 22.10.2008

 * Change: kleine interne Aenderung in der Formatierung von Seitentiteln und Beschreibung
 * Change: Aenderungen im Administrationspanel zur einfacheren Handhabung

Version 1.02 Rev2 vom 24.10.2008

 * Bugfix: Inkompatibilitaet mit PHP4

Version 1.03 vom 09.11.2008

 * Bugfix: Behebung eines Fehlers in der Generierung von Keywords
 * Add: META-Daten werden von "All In One SEO Pack" mit uebernommen

Version 1.04 vom 29.11.2008

 * Bugfix: Aenderung der RegEx zur Entfernung verschiedener Zeichen in der Funktion stripHTML()
 * Bugfix: Fehlerbehebung bei der Unterstuetzung von All In One SEO Pack
 * Change: izioSEO mit Wordpress 2.7.0 kompatibel gemacht
 * Change: Anpassung der Generierung der META-Beschreibung an die minimale Laenge der META-Beschreibung Funktionen
 * Add: Einfuehrung der minimalen Laenge fuer die META-Beschreibung

Version 1.05 vom 30.11.2008

 * Add: 301-Redirect fuer geanderte Permalinks
 * Add: noarchive - Tag wurde zu den Robots hinzugefuegt

Version 1.1 vom 22.01.2009

 * Bugfix: Leere Felder wurden nicht uebernommen, wenn diese vorher einen Wert besassen
 * Bugfix: Archiv-Seiten werden jetzt mit beruecksichtigt bei den META-Robots
 * Bugfix: Einbeziehung der Keywords aus Kategorien und Tags
 * Bugfix: Templateueberarbeitung fuer Wordpress 2.6 und 2.7
 * Change: META-Daten werden jetzt als erstes zur Funktion wp_head() hinzugefuegt (hoehere
   Positionierung im Template)
 * Change: META-Robots werden bei dem Wert "index,follow" ausgeblendet
 * Change: AdSection kann nun seperat fuer einen Artikel/eine Seite de-/aktiviert werden
 * Change: Menustruktur beinhaltet als Hauptmenupunkt izioSEO
 * Change: Optionsseite wurde in die Bereiche: Uebersicht, Einstellungen, robots.txt, Statistik und 
   Zuruecksetzen aufgeteilt
 * Add: Seitenzahl frei positionierbar im Seitentitel
 * Add: Link aus der Uebersicht der Plugins zu den Einstellungen fuer das Plugin
 * Add: Direkter Hilfelink zur Dokumentation fuer jeden Einstellungspunkt
 * Add: Wordpress 2.7 Hilfekontext hinzugefuegt
 * Add: Bilder werden jetzt Suchmaschinenfreundlich eingebetet
 * Add: Dashboard (Funktionsuebersicht, News, Backlinkcheck, Schnellhilfe, Hinweise/Fehler, 
   PageRank/AlexRank check)
 * Add: Import/Export/Zuruecksetzen von Einstellungen
 * Add: Hinweise bei Konflikten (Auswertung des Log-Files, Hinweis bei doppelten META-Datendaten)
 * Add: Refererdaten von Suchmaschinen werden fuer die META-Keywords und die META-Beschreibung beruecksichtigt
 * Add: Detailierte Statistik fuer die Suchanfragen, Referers und Keywords
 * Add: csv-Export fuer die Statistiken
 * Add: Automatischer Versionshinweis mit Updatelink auf der Uebersichtsseite
 * Remove: &lt;meta name="language" ... /&gt; wurde entfernt

Version 1.1.1 vom 01.02.2009

 * Bugfix: Analytics wurde nicht genutzt, wenn Webmastertools nicht verwendet wurden
 * Bugfix: Optimierung der Generierung von Keywords und Description
 * Bugfix: PHP Short Open Tags wurden entfernt
 * Change: Optimierung des Referer-Trackings
 * Remove: noydir-Tag wurde entfernt
 * Add: Umlaute werden fuer URL's richtig umgewandelt

Version 1.1.2 vom 08.02.2009

 * Add: Anonymisierung von externen Links fuer ContentLinks, Kommentarlinks und Blogroll

Version 1.1.3 vom 14.02.2009

 * Bugfix: Aenderung im Regex der Funktion stripHtml()
 * Change: Kleine interne Aenderung
 * Add: Loeschlink der Statistik
