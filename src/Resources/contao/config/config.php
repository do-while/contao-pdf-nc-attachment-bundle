<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    LGPL
 */

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['notification_center']['nc_gateways']['tables'][]   = 'tl_pdfnc_positions';
$GLOBALS['BE_MOD']['notification_center']['nc_gateways']['stylesheet'] = 'bundles/softleisterpdfncattachment/styles.css';
$GLOBALS['BE_MOD']['notification_center']['nc_gateways']['testpdf']    = array('Softleister\Pdfncattachment\pdfnc_TestPdf', 'testpdf');


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['sendNotificationMessage'][] = array('Softleister\Pdfncattachment\pdfNcAttachmantHooks', 'execute');


/**
 * Attachment-Token für Notifications hinzufügen
 */
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['core_form']['email_text'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['core_form']['email_html'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['core_form']['attachment_tokens'][] = 'pdfnc_attachment';

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['email_text'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['email_html'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['attachment_tokens'][] = 'pdfnc_attachment';

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_activation']['email_text'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_activation']['email_html'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_activation']['attachment_tokens'][] = 'pdfnc_attachment';

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personaldata']['email_text'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personaldata']['email_html'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personaldata']['attachment_tokens'][] = 'pdfnc_attachment';

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['email_text'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['email_html'][] = 'pdfnc_document';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['attachment_tokens'][] = 'pdfnc_attachment';
