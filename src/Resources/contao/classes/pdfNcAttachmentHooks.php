<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018-2019, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    LGPL
 */

namespace Softleister\Pdfncattachment;

require_once( TL_ROOT . '/vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/classes/pdfnc_helper.php' );

//-----------------------------------------------------------------
//  pdfNcAttachmentHooks:    Ausgabe des PDF
//-----------------------------------------------------------------
class pdfNcAttachmentHooks extends \Backend
{
    protected   $arrProtectflags = array('modify','extract','print','print-high','copy','annot-forms','fill-forms');

    //-----------------------------------------------------------------
    //  execute:    Maildaten verarbeiten
    //-----------------------------------------------------------------
    public function execute($objMessage, &$arrTokens, $language, $objGatewayModel)
    {
        if( $objMessage->gateway_type !== 'email' ) return true;        // nur für den Gateway-Typ "email"
        if( $objGatewayModel->pdfnc_on != 1 ) return true;              // "PDF-Formular ausfüllen" inaktiv

        $filename = standardize(\StringUtil::restoreBasicEntities($objMessage->title)) . \Haste\Util\StringUtil::recursiveReplaceTokensAndTags( $objGatewayModel->pdfnc_fileext, $arrTokens );
        
        $savepath = \FilesModel::findByUuid($objGatewayModel->pdfnc_savepath)->path;
        if( file_exists(TL_ROOT . '/' . $savepath . '/' . $filename . '.pdf') ) {
            $i = 2;
            while( file_exists(TL_ROOT . '/' . $savepath . '/' . $filename . '-' . $i . '.pdf') ) $i++;
            $filename = $filename . '-' . $i;
        }
        $ttt = TL_ROOT . '/' . $savepath . '/' . $filename . '.pdf';
        file_put_contents(TL_ROOT . '/' . $savepath . '/' . $filename . '.pdf', '');  // leere Datei erzeugen

        $arrPDF = array( 'gateid'        => $objGatewayModel->id,
                         'gatetitle'     => $objGatewayModel->title,
                         'filename'      => $filename,
                         'vorlage'       => \FilesModel::findByUuid($objGatewayModel->pdfnc_vorlage)->path,
                         'savepath'      => $savepath,
                         'protect'       => $objGatewayModel->pdfnc_protect,
                         'openpassword'  => \Controller::replaceInsertTags( pdfnc_helper::decrypt($objGatewayModel->pdfnc_openpassword ) ),
                         'protectflags'  => deserialize($objGatewayModel->pdfnc_protectflags),
                         'password'      => \Controller::replaceInsertTags( pdfnc_helper::decrypt($objGatewayModel->pdfnc_password ) ),
                         'multiform'     => deserialize($objGatewayModel->pdfnc_multiform),
                         'allpages'      => $objGatewayModel->pdfnc_allpages,
                         'offset'        => array( 0, 0 ),
                         'textcolor'     => $objGatewayModel->pdfnc_textcolor,
                         'title'         => $objGatewayModel->pdfnc_title,
                         'author'        => $objGatewayModel->pdfnc_author,
                         'tokenlist'     => $objGatewayModel->pdfnc_tokens,
                        );
        unset( $arrFields );
        if( !is_array($arrPDF['protectflags']) ) $arrPDF['protectflags'] = array( $arrPDF['protectflags'] );

        // Offsets eintragen, wenn angegeben
        $ofs = deserialize($objGatewayModel->pdfnc_offset);
        if( isset($ofs[0]) && is_numeric($ofs[0]) ) $arrPDF['offset'][0] = $ofs[0];
        if( isset($ofs[1]) && is_numeric($ofs[1]) ) $arrPDF['offset'][1] = $ofs[1];

        // HOOK: before pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdfnc_BeforePdf']) && \is_array($GLOBALS['TL_HOOKS']['pdfnc_BeforePdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdfnc_BeforePdf'] as $callback ) {
                $arrPDF = \System::importStatic($callback[0])->{$callback[1]}( $arrPDF, $this );
            }
        }


        //--- PDF-Datei erstellen und speichern ---
        $arrTokens['pdfnc_attachment'] = $arrTokens['pdfnc_document'] = '';
        $pdfdatei = $savepath . '/' . $filename . '.pdf';

        if( pdfnc_helper::getPdfData( $arrPDF, $arrTokens, $pdfdatei ) ) {

            //--- PDF-Datei in der Dateiverwaltung eintragen ---
            $objFile = \Dbafs::addResource( $pdfdatei );                    // Datei in der Dateiverwaltung eintragen
            \Dbafs::updateFolderHashes( $strUploadFolder );

            //--- Token für erstellte Datei mitgeben ---
            $arrTokens['pdfnc_attachment'] = $pdfdatei;
            $arrTokens['pdfnc_document'] = basename( $pdfdatei );

            //--- Eintrag im Log ---
            \System::Log('PDF attachment "' . $filename . '.pdf" has been created', __METHOD__, TL_ACCESS);
        }
        else $pdfdatei = '';        // es wurde keine Datei erzeugt


        // HOOK: after pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdfnc_AfterPdf']) && \is_array($GLOBALS['TL_HOOKS']['pdfnc_AfterPdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdfnc_AfterPdf'] as $callback ) {
                \System::importStatic($callback[0])->{$callback[1]}( $pdfdatei, $arrPDF, $this );
            }
        }
        return true;                // Benachrichtigung darf gesendet werden
    }


    //-----------------------------------------------------------------
}
