<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018-2019, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    commercial
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_nc_gateway']['tstamp']              = array('Änderungsdatum', 'Zeitpunkt der letzten Änderung');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_on']            = array('PDF-Formular ausfüllen', 'Ausfüllen einer PDF-Vorlage');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_vorlage']       = array('PDF-Vorlage-Datei', 'Bitte wählen Sie die PDF-Datei als Vorlage aus. Sie haben so die Möglichkeit, die Vorlage von Formularinhalten abhängig zu machen.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_savepath']      = array('Verzeichnis zur Speicherung', 'Bitte wählen Sie das Verzeichnis aus, wo die PDF-Dateien gespeichert werden sollen. Das Verzeichnis kann auch geschützt sein.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_overwrite']     = array('Bestehende Datei überschreiben', 'Normalerweise wird eine Versionsnummer angehängt, wenn die Datei bereits vorhanden ist.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_useHomeDir']    = array('Im Mitgliedsverzeichnis speichern, wenn möglich', 'Wenn ein Mitglied im Frontend angemeldet ist, wird das PDF ins Mitgliedsverzeichnis gespeichert.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protect']       = array('PDF schützen', 'Das PDF wird mit Passwortschutz versehen');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_openpassword']  = array('PDF-Passwort zum Öffnen', 'Lassen Sie das Feld leer, wenn Öffnen ohne Passwort möglich sein soll.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflags']  = array('Berechtigungen', 'Markieren Sie alles, was ohne Passwort möglich sein soll.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_password']      = array('PDF-Passwort für Berechtigungen', 'Wenn dieses Feld leer bleibt, wird ein Zufallspasswort erzeugt');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_allpages']      = array('Alle gültigen Vorlagenseiten übernehmen', 'Übernimmt auch Vorlagenseiten ohne Positionseinträge in das PDF.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_offset']        = array('Grund-Offset', 'X- und Y-Verschiebung in Millimeter aller Positionen auf den Seiten.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_textcolor']     = array('Schreibfarbe im PDF', 'Bitte wählen Sie die Stiftfarbe für das Ausfüllen der Einträge aus');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_author']        = array('Autor', 'Angegebener Autor in den PDF-Eigenschaften');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_title']         = array('Titel', 'Titel des PDF-Dokuments');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_fileext']       = array('Dateinamen erweitern', 'Ergänzen Sie den Dateinamen mit InsertTags oder SimpleTokens, z.B. {{date::ymd_His}}, um ihn eindeutig zu machen. Wenn die Ergänzung mit _ oder - beginnt, wird der Titel der Benachrichtigung voran gestellt.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_tokens']        = array('Liste der SimpleToken', 'Hängt an das PDF eine Liste mit möglichen SimpleToken an. <strong>Nur wenn man im Backend angemeldet ist!</strong>');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_multiform']     = array('Mehrformular-Vorlage', 'Enthält die Vorlagedatei mehrere Formulare, können hier zutreffende Seiten definiert werden, z.B. 1-4,7,10. Lassen Sie die Felder leer, um alle Seiten zu verwenden.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['multiform_bedingung'] = array('Bedingung', 'Ist die Bedingung erfüllt, werden nur die angegebenen Seiten in die PDF-Ausgabe übernommen.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['multiform_seiten']    = array('Seiten aus der PDF-Vorlage', 'Geben Sie mit Komma getrennt oder als Bereichsangaben eine Liste der zugehörigen Seiten an, z.B. 1-4,7,10');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['print']       = 'Drucken';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['print-high']  = 'Drucken in hoher Auflösung';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['modify']      = 'Ändern des Dokuments';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['assemble']    = 'Seiten einfügen, drehen, löschen, Lesezeichen';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['copy']        = 'Kopieren von Inhalten';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['annot-forms'] = 'Kommentieren';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['extract']     = 'Seitenentnahme';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['fill-forms']  = 'Formularfelder ausfüllen';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_nc_gateway']['positions']  = array('Positionen', 'Definition der Textpositionen im PDF');
 
/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_legend']  = 'PDF-Formular ausfüllen';
