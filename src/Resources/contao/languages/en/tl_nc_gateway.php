<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    commercial
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_nc_gateway']['tstamp']              = array('Modification date', 'Last modification time');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_on']            = array('Fill PDF form', 'Filling out a PDF template');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_vorlage']       = array('PDF template file', 'Please select the PDF file as a template. You have the opportunity to make parts of submission dependent.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_savepath']      = array('Directory for storing', 'Please select the directory where the PDF files should be saved. The directory can also be protected.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protect']       = array('Protect PDF', 'The PDF is provided with password protection');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_openpassword']  = array('PDF password for opening', 'Leave the field blank if open without a password should be possible.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflags']  = array('Permissions', 'Select everything that should be possible without a password.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_password']      = array('PDF password for permissions', 'If this field is left blank, a random password is generated');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_allpages']      = array('Take all valid document pages', 'Applies also template pages without position entries in the PDF.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_offset']        = array('Basic offset', 'X and Y displacement in millimeters of all positions on the sides.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_textcolor']     = array('text color in PDF', 'Please select the pen color to fill in the entries');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_author']        = array('Author', 'Stated author in the PDF properties');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_title']         = array('Title', 'Title of PDF document');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_fileext']       = array('Expand file name', 'Expand the file name with InsertTags or SimpleTokens, e.g. {{date::ymd_His}} to make it unique.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_tokens']        = array('List of SimpleTokens', 'Attaches a list with possible SimpleTokens to the PDF. <strong>Only if you are logged on to the backend!</strong>');
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_multiform']     = array('Multi-form template', 'If the template file contains different forms, applicable pages can be defined here, e.g. 1-4,7,10. Leave the fields blank to use all pages.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['multiform_bedingung'] = array('Condition', 'If the condition is fulfilled, only the specified pages are used for the PDF output.');
$GLOBALS['TL_LANG']['tl_nc_gateway']['multiform_seiten']    = array('Pages from the PDF template', 'Specify a list of the corresponding pages separated by commas or as range specifications, e. g. 1-4,7,10');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['print']       = 'Print';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['print-high']  = 'Print in high resolution';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['modify']      = 'Modify the document';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['assemble']    = 'Insert pages, rotate, delete, bookmarks';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['copy']        = 'Copying content';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['annot-forms'] = 'comment on';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['extract']     = 'Remove pages';
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag']['fill-forms']  = 'Fill in form fields';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_nc_gateway']['positions']  = array('Positions', 'Definition of text positions within the PDF');
 
/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_legend']  = 'Fill in PDF form';
