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
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['tstamp']             = array('Modification date', 'Last modification time');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['type']               = array('Type of position', 'Select the type of position');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitems']          = array('Inputs and texts', 'Input values and/or text to be inserted her into PDF');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitem_feld']      = array('Field name or "text" ', 'Enter the field name, or a text in quotations to be inserted here');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bedingung']          = array('Condition ', 'The element is only output if the condition is fulfilled. If a token is specified, the token must exist and not be empty. You can also use simple comparisons with == or !=, e.g. form_question==yes');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitem_bedingung'] = array('Condition ', 'The text is only output if the condition is fulfilled. If a token is specified, the token must exist and not be empty. You can also use simple comparisons with == or !=, e.g. form_question==yes');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['page']               = array('Page in PDF', 'Page on which the item is to be inserted');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['posxy']              = array('Position in X and Y', 'Position im mm from the upper left corner');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['borderright']        = array('Border right', 'Optional margin setting for wordwrap of long texts');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['align']              = array('Orientation', 'Orientation based on the position');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontstyle']          = array('Text attributes', 'Attributes bold or italic for the inserted text');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform']      = array('Text transformation', 'Here you can choose a text transformation mode.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textcolor']          = array('Overwrite text color', 'Leave the field blank if you do not want to overwrite the default text color for this item.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontsize']           = array('Text size', 'Font size of text in pt');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['published']          = array('Published', 'The position is inserted in PDF only when it is published');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textarea']           = array('Dimensions', 'Size of the box width x height in mm.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['picture']            = array('Picture', 'Select your picture');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pictype']            = array('Image data', 'Use an image from file or from a data stream.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pictag']             = array('SimpleTag with image data', 'Define the SimpleToken that contains the image data.');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['qrsize']             = array('Size of QR code', 'Select the size.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontstyles']['bold']   = 'Bold';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontstyles']['italic'] = 'Italic';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['text']                 = 'Text position';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pic']                  = 'Picture position';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['qrcode']               = 'QR code';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['file']                 = 'File';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['upload']               = 'Upload file';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['data']                 = 'Data stream';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['seite']                = 'Page';

$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform']['uppercase']  = 'uppercase';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform']['lowercase']  = 'lowercase';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform']['capitalize'] = 'capitalize';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform']['none']       = 'none';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['new']        = array('New position', 'Create new variables position');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['edit']       = array('Edit position', 'Edit position ID %s');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['copy']       = array('Duplicate position', 'Copy position ID %s');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['cut']        = array('Move position', 'Move position ID %s');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['delete']     = array('Delete position', 'Delete position ID %s');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['toggle']     = array('Position publish/unpublish', 'Position ID %s publish/unpublish');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['show']       = array('Position details', 'Details of position ID %s');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['editheader'] = array('Edit position', 'Edit this position');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pasteafter'] = array('Paste after', 'Paste after position ID %s');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pastenew']   = array('Create a new position below', 'Create a new position below ID %s');
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['testpdf']    = array('Download Test PDF', 'Download of a filled template PDF');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['type_legend']    = 'Type of position';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pdfnc_legend']   = 'Fill PDF form';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['attr_legend']    = 'Positions and attributes';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['publish_legend'] = 'Publication';
$GLOBALS['TL_LANG']['tl_pdfnc_positions']['img_legend']     = 'Image selection';

