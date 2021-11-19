<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018-2021, Softleister
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
$GLOBALS['TL_HOOKS']['initializeSystem'][]  = array('Softleister\Pdfncattachment\pdfNcAttachmentHooks', 'myInitializeSystem');
$GLOBALS['TL_HOOKS']['sendNotificationMessage'][] = array('Softleister\Pdfncattachment\pdfNcAttachmentHooks', 'execute');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]  = array('Softleister\Pdfncattachment\pdfNcAttachmentHooks', 'myReplaceInsertTags');
