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
$GLOBALS['TL_HOOKS']['sendNotificationMessage'][] = array('Softleister\Pdfncattachment\pdfNcAttachmentHooks', 'execute');


/**
 * Attachment-Token für alle Notifications hinzufügen
 */
foreach( $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'] as $vendor=>$app ) {
    foreach( $app as $noti=>$tok ) {
        $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'][$vendor][$noti]['email_text'][] = 'pdfnc_document';
        $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'][$vendor][$noti]['email_html'][] = 'pdfnc_document';
        $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'][$vendor][$noti]['attachment_tokens'][] = 'pdfnc_attachment';
    }
}
