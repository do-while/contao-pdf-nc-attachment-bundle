<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018-2023, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    commercial
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['tstamp']             = array('Änderungsdatum', 'Zeitpunkt der letzten Änderung');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['type']               = array('Positionstyp', 'Art der Position auswählen');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype']            = array('Barcode-Typ', 'Wählen Sie einen Barcodetyp aus');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitems']          = array('Eingaben und Texte', 'Eingaben und/oder Texte, die hier ins PDF eingefügt werden sollen');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitem_feld']      = array('SimpleToken oder "Text" ', 'Geben Sie den SimpleToken an, oder in Gänsefüssen einen Text, der eingetragen werden soll.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bedingung']          = array('Bedingung ', 'Das Element wird nur ausgegeben, wenn die Bedingung erfüllt ist. Bei Angabe eines Tokens muss der Token existieren und nicht leer sein. Es können auch einfache Vergleiche mit == oder != verwendet werden, z.B. form_question==yes');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitem_bedingung'] = array('Bedingung ', 'Der Text wird nur ausgegeben, wenn die Bedingung erfüllt ist. Bei Angabe eines Tokens muss der Token existieren und nicht leer sein. Es können auch einfache Vergleiche mit == oder != verwendet werden, z.B. form_question==yes');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['page']               = array('Seite im PDF', 'Seite, auf der die Position eingefügt werden soll');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['posxy']              = array('Position in X und Y', 'Position im mm von der oberen, linken Ecke');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['borderright']        = array('Rechter Rand', 'Optionelle Randeinstellung, als Umbruchgrenze bei langen Texten');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['align']              = array('Ausrichtung', 'Ausrichtung bezogen auf die Position.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontstyle']          = array('Textattribute', 'Attribute Fett oder Kursiv für die eingefügten Texte');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform']      = array('Text-Transformation', 'Hier können Sie einen Text-Transformationsmodus auswählen.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textcolor']          = array('Textfarbe überschreiben', 'Lassen Sie das Feld leer, wenn Sie die Standard-Textfarbe für diese Position nicht überschreiben möchten.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontsize']           = array('Textgröße', 'Font Textgröße in pt');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['published']          = array('Veröffentlicht', 'Die Position wird nur im PDF eingetragen, wenn sie veröffentlicht ist.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textarea']           = array('Abmessungen', 'Größe des Rahmens Breite x Höhe in mm. Wird ein Wert mit 0 angegeben, wird er proportional errechnet.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['picture']            = array('Bild', 'Wählen Sie das Bild aus');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pictype']            = array('Bilddaten', 'Bild aus Datei oder aus einem Data-Stream verwenden.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pictag']             = array('SimpleTag mit Bilddaten', 'Definieren Sie den SimpleToken, der die Bilddaten enthält.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['qrsize']             = array('Größe des Barcodes', 'Wählen Sie die Größe aus.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['noblanks']           = array('Keine automatischen Leerzeichen', 'Unterdrückt das automatische Einfügen von Leerzeichen zwischen den Feldern.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontstyles']['bold']   = 'Fett';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontstyles']['italic'] = 'Kursiv';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['text']                 = 'Textposition';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pic']                  = 'Bildposition';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['qrcode']               = 'Barcode';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['file']                 = 'Datei';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['upload']               = 'Upload-Datei';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['data']                 = 'Data-Stream';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['seite']                = 'Seite';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform_']['uppercase']  = 'Großbuchstaben';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform_']['lowercase']  = 'Kleinbuchstaben';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform_']['capitalize'] = 'Anfangsbuchstaben groß';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform_']['none']       = 'deaktivieren';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['2d']         = '2D-Barcodes';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['QRCODE,L']   = 'QR-Code - einfache Fehlerkorrektur';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['QRCODE,M']   = 'QR-Code - mittlere Fehlerkorrektur';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['QRCODE,Q']   = 'QR-Code - bessere Fehlerkorrektur';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['QRCODE,H']   = 'QR-Code - beste Fehlerkorrektur';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['PDF417']     = 'PDF417 (ISO/IEC 15438:2006)';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['DATAMATRIX'] = 'Datamatrix (ISO/IEC 16022:2006)';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['1d']         = '1D-Barcodes';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C39']        = 'Code 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C39+']       = 'Code 39 + Checksumme';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C39E']       = 'Code 39 Extended';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C39E+']      = 'Code 39 Extended + Checksumme';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C93']        = 'Code 93 - USS-93';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['S25']        = 'Standard 2 of 5';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['S25+']       = 'Standard 2 of 5 + Checksumme';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['I25']        = 'Interleaved 2 of 5';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['I25+']       = 'Interleaved 2 of 5 + Checksumme';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C128']       = 'Code 128 AUTO';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C128A']      = 'Code 128 A';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C128B']      = 'Code 128 B';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['C128C']      = 'Code 128 C';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['EAN8']       = 'EAN 8';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['EAN13']      = 'EAN 13';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['UPCA']       = 'UPC-A';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['UPCE']       = 'UPC-E';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['EAN5']       = '5-Ziffern UPC-Based Extension';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['EAN2']       = '2-Ziffern UPC-Based Extension';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['MSI']        = 'MSI';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['MSI+']       = 'MSI + Checksumme (module 11)';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['CODABAR']    = 'Codabar';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['CODE11']     = 'Code 11';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['PHARMA']     = 'Pharmacode';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['PHARMA2T']   = 'Pharmacode TWO-TRACKS';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['IMB']        = 'IMB - Intelligent Mail Barcode - Onecode - USPS-B-3200';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['POSTNET']    = 'Postnet';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['PLANET']     = 'Planet';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['RMS4CC']     = 'RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_']['KIX']        = 'KIX (Klant index - Customer index)';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['new']        = array('Neue Position', 'Neue Variablenposition erstellen');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['edit']       = array('Position bearbeiten', 'Position ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['copy']       = array('Position duplizieren', 'Position ID %s kopieren');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['cut']        = array('Position verschieben', 'Position ID %s verschieben');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['delete']     = array('Position löschen', 'Position ID %s löschen');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['toggle']     = array('Position veröffentlichen/unveröffentlichen', 'Position ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['show']       = array('Positions-Details', 'Details zu Position ID %s');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['editheader'] = array('Position bearbeiten', 'Diese Position bearbeiten');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pasteafter'] = array('Am Anfang einfügen', 'Nach Position ID %s einfügen');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pastenew']   = array('Neue Position unterhalb erstellen', 'Neue Position hinter ID %s erstellen');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['testpdf']    = array('Download Test-PDF', 'Testweise Ausgabe der ausgefüllten Vorlage als Download');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['type_legend']    = 'Positionstyp';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pdfnc_legend']   = 'PDF-Formular ausfüllen';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['attr_legend']    = 'Position und Attribute';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['publish_legend'] = 'Veröffentlichung';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['img_legend']     = 'Bildauswahl';

