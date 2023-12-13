# do-while/contao-pdf-nc-attachment-bundle
**Diese Contao-Erweiterung erweitert das Standard-E-Mail-Gateway des Notification-Centers in Contao 4 um die Möglichkeit, mit den SimpleTokens, die an das Notification-Center übertragen werden, eine PDF-Vorlage auszufüllen, zu speichern und der Mail als Anhang mitzugeben.**

Die Erweiterung contao-pdf-nc-attachment-bundle installiert sich als eingeschränkte Demo. Die Demoversion erzeugt bei vollem Funktionsumfang einen Demo-Hinweis im PDF und ist auf 2 Ausgabeseiten begrenzt. Wenn Sie einen Lizenzkey kaufen, wird die volle Funktionalität freigeschaltet. Die Lizenz erlaubt ihnen den Einsatz der Erweiterung in der beim Kauf angegebenen Domain. Der Einsatz in weiteren Domains bedarf einer zusätzlichen Lizenz.

Eine ausführliche Anleitung finden Sie als PDF-Datei im Verzeichnis der Erweiterung:<br>`vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/docs`
___


**This Contao extension extends the standard e-mail gateway of the notification center in Contao 4 by the possibility to fill in a PDF template with the SimpleTokens which are transferred to the Notification Center, save it and attach it to the mail.**

The extension contao-pdf-n-attachment-bundle is installed as a limited demo. The demo version generates a demo hint in the PDF with full functionality and is limited to 2 output pages. When you buy a license key, the restrictions are removed. The license allows you to use the extension in the domain specified at the time of purchase. The use in other domains requires an additional license.

Detailed instructions can be found as a PDF file in the extension directory:<br>`vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/docs`


## Installation
Installieren Sie die Erweiterung einfach mit dem **Contao Manager** oder auf der Kommandozeile mit dem **Composer**:<br>*Simply install the extension with the **Contao Manager** or on the command line with the **Composer**:*
```
composer require do-while/contao-pdf-nc-attachment-bundle
```

## Documentation
[Deutsches Handbuch](http://www.softleister.de/files/manuals/contao-pdf-nc-attachment-bundle/Anleitung_contao-pdf-nc-attachment-bundle.pdf)<br>
[English manual](http://www.softleister.de/files/manuals/contao-pdf-nc-attachment-bundle/Manual_contao-pdf-nc-attachment-bundle.pdf)


## Version
* 2.10.0<br>Freigabedatum: 2023-12-13<br>1) Positionen können absolut oder relativ (+/-) angegeben werden
* 2.9.0<br>Freigabedatum: 2023-08-13<br>1) neue Option für Bilddaten: Übergabe einer UUID
* 2.8.12<br>Freigabedatum: 2023-04-10<br>1) Bereitstellung von einzelnen Datei-Tokens für FineUploader<br>2) Probleme bei Bilddateien mit Blanks im Dateinamen beseitigt
* 2.8.9<br>Freigabedatum: 2022-05-31<br>1) Textfarbe nicht mehr vorbesetzt = Standardfarbe aus den Gateway-Eigenschaften
* 2.8.0<br>Freigabedatum: 2021-08-25<br>1) Kompatibilität mit PHP 8<br>2) Unterstützung für eigene TTF- oder OTF-Fonts
* 2.7.0<br>Freigabedatum: 2020-11-08<br>1) Dynamische Vorgabe-PDF per SimpleToken
* 2.6.3<br>Freigabedatum: 2020-08-05<br>1) Bugfix: Fehler bei Bild aus nicht auflösbarem SimpleToken<br>2) Die Bennung der Ausgabe-PDF kann jetzt auch ohne den Titel der Benachrichtigung erfolgen (siehe Hint)
* 2.6.2<br>Freigabedatum: 2020-06-26<br>1) Bugfix: Bilder wurden nicht eingebunden, ab Contao 4.8.2
* 2.6.1<br>Freigabedatum: 2020-06-25<br>1) InsertTags in PDF-Titel und -Autor möglich
* 2.6.0<br>Freigabedatum: 2020-05-15<br>1) Neue Option für die Unterdrückung automatischer Leerzeichen
* 2.5.1<br>Freigabedatum: 2020-05-05<br>1) Liste der SimpleTokens bei Contao-Versionen >= 4.6
* 2.5.0<br>Freigabedatum: 2020-03-20<br>1) InsertTags {{pdfnc::pdfdocument}} und {{pdfnc::pdfdocument::name}}
* 2.4.6<br>Freigabedatum: 2020-02-22<br>1) Bug fixes Lizenzerkennung
* 2.4.0<br>Freigabedatum: 2019-10-21<br>1) 1D/2D-Barcodes ergänzt
* 2.3.1<br>Freigabedatum: 2019-10-03<br>1) Bug fixes Overwrite
* 2.3.0<br>Freigabedatum: 2019-10-02<br>1) Speichern im Mitgliedsverzeichnis möglich<br>2) Text-Transformationen für die Texte<br>3) Bug fixes
* 2.2.2<br>Freigabedatum: 2019-08-25<br>1) Im Hook pdfnc_BeforePdf arrTokens ergänzt
* 2.2.1<br>Freigabedatum: 2019-08-21<br>1) Warning in PHP 7.3 beseitigt
* 2.2.0<br>Freigabedatum: 2019-05-24<br>1) Lauffähig in Contao >=4.7, Problematik: TCPDF ist jetzt ein Bundle
* 2.1.0<br>Freigabedatum: 2019-05-20<br>1) Über die Bedingungen in den Gateway-Eigenschaften kann das Generieren des PDF verhindert werden.
* 2.0.0<br>Freigabedatum: 2019-02-18<br>1) Einbindung von Bilddaten aus Dateiverwaltung, Upload oder einem DataStream<br>2) Einbindung von QR-Codes<br>3) Überschreiben der Standard-Schreibfarbe für einzelne Elemente
* 1.0.4<br>Freigabedatum: 2018-10-19<br>1) PDF-Anhang jetzt in allen Benachrichtigungen verfügbar<br>2) In der Dateinamenergänzung werden auch SimpleTokens umgewandelt
* 1.0.0<br>Freigabedatum: 2018-09-23<br>Version für Contao ab Version 4.4 LTS

**Problem melden | *Report Problem*:**<br>per E-Mail | *via Email*: licence@softleister.de

___
Softleister - 2023-08-13
