<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018-2021, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    LGPL
 */

namespace Softleister\Pdfncattachment;

require_once( TL_ROOT . '/vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/classes/pdfnc_helper.php' );

//-----------------------------------------------------------------
//  pdfNcAttachmentHooks:    Output of the PDF
//-----------------------------------------------------------------
class pdfNcAttachmentHooks extends \Contao\Backend
{
    protected   $arrProtectflags = array('modify','extract','print','print-high','copy','annot-forms','fill-forms');

    //-----------------------------------------------------------------
    //  execute:    Process mail data
    //-----------------------------------------------------------------
    public function execute($objMessage, &$arrTokens, $language, $objGatewayModel)
    {
        if( $objMessage->gateway_type !== 'email' ) return true;        // for gateway type "email" only
        if( $objGatewayModel->pdfnc_on != 1 ) return true;              // "Fill in PDF form" inactive

        $filename = \Haste\Util\StringUtil::recursiveReplaceTokensAndTags( $objGatewayModel->pdfnc_fileext, $arrTokens );   // Filename-Erweiterung aus den Eigenschaften
        if( empty( $filename ) || in_array( substr($filename, 0, 1), ['-', '_']) ) {
            $filename = $objMessage->title . $filename;            
        }
        $filename = \Contao\StringUtil::standardize(\Contao\StringUtil::restoreBasicEntities( $filename ));
        
        //--- member directory? ---
        $savepath = \Contao\FilesModel::findByUuid($objGatewayModel->pdfnc_savepath)->path;
        if( $objGatewayModel->pdfnc_useHomeDir && FE_USER_LOGGED_IN ) {
			$this->import('FrontendUser', 'User');

			if( $this->User->assignDir && $this->User->homeDir ) {
                $dir = \Contao\FilesModel::findByUuid($this->User->homeDir)->path;
                if( is_dir( TL_ROOT . '/' . $dir ) ) {
				    $savepath = $dir;                                   // Accept member directory
                }
			}
        }

        if( file_exists(TL_ROOT . '/' . $savepath . '/' . $filename . '.pdf') ) {
            if( !$objGatewayModel->pdfnc_overwrite ) {
                $i = 2;
                while( file_exists(TL_ROOT . '/' . $savepath . '/' . $filename . '-' . $i . '.pdf') ) $i++;
                $filename = $filename . '-' . $i;

                file_put_contents(TL_ROOT . '/' . $savepath . '/' . $filename . '.pdf', '');    // create empty file
            }
        }
        else {
            file_put_contents(TL_ROOT . '/' . $savepath . '/' . $filename . '.pdf', '');        // create empty file
        }

        //--- Get filename of template PDF ---
        $vorlage = '';          // no template PDF
        
        // 1. template PDF from gateway settings
        $objVorlage = \Contao\FilesModel::findByUuid( $objGatewayModel->pdfnc_vorlage );
        if( $objVorlage !== null ) {
            $vorlage = $objVorlage->path;
        }

        // 2. template PDF from SimpleTokens ##filename_template_pdf## or ##form_filename_template_pdf##
        if( isset( $arrTokens['filename_template_pdf'] ) ) {
            $vorlage = $arrTokens['filename_template_pdf'];
        }
        else if( isset( $arrTokens['form_filename_template_pdf'] ) ) {
            $vorlage = $arrTokens['form_filename_template_pdf'];
        }
        if( \Contao\Validator::isUuid( $vorlage ) ) {                      // IF( vorlage == UUID )
            $objVorlage = \Contao\FilesModel::findByUuid( $vorlage );
            if( $objVorlage !== null ) {
                $vorlage = $objVorlage->path;
            }
        }

        $arrPDF = array( 'gateid'        => $objGatewayModel->id,
                         'gatetitle'     => $objGatewayModel->title,
                         'filename'      => $filename,
                         'vorlage'       => trim( $vorlage, '/' ),
                         'savepath'      => $savepath,
                         'protect'       => $objGatewayModel->pdfnc_protect,
                         'openpassword'  => \Contao\Controller::replaceInsertTags( pdfnc_helper::decrypt($objGatewayModel->pdfnc_openpassword ), false ),
                         'protectflags'  => \Contao\StringUtil::deserialize($objGatewayModel->pdfnc_protectflags),
                         'password'      => \Contao\Controller::replaceInsertTags( pdfnc_helper::decrypt($objGatewayModel->pdfnc_password ), false ),
                         'multiform'     => \Contao\StringUtil::deserialize($objGatewayModel->pdfnc_multiform),
                         'allpages'      => $objGatewayModel->pdfnc_allpages,
                         'offset'        => array( 0, 0 ),
                         'textcolor'     => $objGatewayModel->pdfnc_textcolor,
                         'title'         => \Contao\Controller::replaceInsertTags( $objGatewayModel->pdfnc_title, false ),
                         'author'        => \Contao\Controller::replaceInsertTags( $objGatewayModel->pdfnc_author, false ),
                         'tokenlist'     => $objGatewayModel->pdfnc_tokens,
                         'arrTokens'     => $arrTokens,
                         'R'             => \Contao\FilesModel::findByUuid($objGatewayModel->pdfnc_font)->path,
                         'B'             => \Contao\FilesModel::findByUuid($objGatewayModel->pdfnc_fontb)->path,
                         'I'             => \Contao\FilesModel::findByUuid($objGatewayModel->pdfnc_fonti)->path,
                         'IB'            => \Contao\FilesModel::findByUuid($objGatewayModel->pdfnc_fontbi)->path,
                       );
        if( !is_array($arrPDF['protectflags']) ) $arrPDF['protectflags'] = array( $arrPDF['protectflags'] );

        // Enter offsets if specified
        $ofs = \Contao\StringUtil::deserialize($objGatewayModel->pdfnc_offset);
        if( isset($ofs[0]) && is_numeric($ofs[0]) ) $arrPDF['offset'][0] = $ofs[0];
        if( isset($ofs[1]) && is_numeric($ofs[1]) ) $arrPDF['offset'][1] = $ofs[1];

        // HOOK: before pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdfnc_BeforePdf']) && \is_array($GLOBALS['TL_HOOKS']['pdfnc_BeforePdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdfnc_BeforePdf'] as $callback ) {
                $arrPDF = \Contao\System::importStatic($callback[0])->{$callback[1]}( $arrPDF, $this );
                $arrTokens = $arrPDF['arrTokens'];
            }
        }


        //-- Include Settings
        $tcpdfinit = \Contao\Config::get("pdftemplateTcpdf");

        // 1: Own settings addressed via app/config/config.yml
        if( !empty($tcpdfinit) && file_exists(TL_ROOT . '/' . $tcpdfinit) ) {
            require_once(TL_ROOT . '/' . $tcpdfinit);
        }
        // 2: Own tcpdf.php from files directory
        else if( file_exists(TL_ROOT . '/files/tcpdf.php') ) {
            require_once(TL_ROOT . '/files/tcpdf.php');
        }
        // 3: From config directory (up to Contao 4.6)
        else if( file_exists(TL_ROOT . '/vendor/contao/core-bundle/src/Resources/contao/config/tcpdf.php') ) {
            require_once(TL_ROOT . '/vendor/contao/core-bundle/src/Resources/contao/config/tcpdf.php');
        }
        // 4: From config directory of tcpdf-bundle (from Contao 4.7)
        else if( file_exists(TL_ROOT . '/vendor/contao/tcpdf-bundle/src/Resources/contao/config/tcpdf.php') ) {
            require_once(TL_ROOT . '/vendor/contao/tcpdf-bundle/src/Resources/contao/config/tcpdf.php');
        }
        // 5: not found? - Then take it from this extension
        else {
            require_once(TL_ROOT . '/vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/config/tcpdf.php');
        }


        //--- Create and save PDF file ---
        $arrTokens['pdfnc_attachment'] = $arrTokens['pdfnc_document'] = '';
        $pdfdatei = $savepath . '/' . $filename . '.pdf';

        //--- Create token for created file ---
        $arrTokens['pdfnc_attachment'] = $pdfdatei;
        $arrTokens['pdfnc_document'] = basename( $pdfdatei );

        if( pdfnc_helper::getPdfData( $arrPDF, $arrTokens, $pdfdatei ) ) {

            //--- Enter PDF file in the file manager ---
            $objFile = \Contao\Dbafs::addResource( $pdfdatei );
            \Contao\Dbafs::updateFolderHashes( $strUploadFolder );

            //--- Entry in log ---
            \Contao\System::Log('PDF attachment "' . $filename . '.pdf" has been created', __METHOD__, TL_ACCESS);
        }
        else $pdfdatei = '';        // no file was created


        // HOOK: after pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdfnc_AfterPdf']) && \is_array($GLOBALS['TL_HOOKS']['pdfnc_AfterPdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdfnc_AfterPdf'] as $callback ) {
                \Contao\System::importStatic($callback[0])->{$callback[1]}( $pdfdatei, $arrPDF, $this );
            }
        }
        return !isset( $arrTokens['do_not_send_notification'] ) && !isset( $arrTokens['form_do_not_send_notification'] );    // Notification may be sent
    }


    //-----------------------------------------------------------------
    //  InsertTags abarbeiten
    //
    //  {{pdfnc::pdfdocument}}
    //  {{pdfnc::pdfdocument::name}}
    //-----------------------------------------------------------------
    public function myReplaceInsertTags( $strTag )
    {
        $tag = explode( '::', $strTag );
        if( $tag[0] !== 'pdfnc' ) return false;                                 // nicht zuständig für diese InsertTags

        if( strtolower($tag[1] == 'pdfdocument' ) ) {
            if( !isset($_SESSION['pdfnc']['pdfdocument']) ) return false;       // bisher kein Dokument erstellt

            if( !isset($tag[2]) ) $tag[2] = '';                                 // kein 3. Parameter angegeben, mit default ergänzen
            switch( $tag[2] ) {
                case 'name':    return basename($_SESSION['pdfnc']['pdfdocument']);
                default:        return $_SESSION['pdfnc']['pdfdocument'];
            }
        }

        return false;                                                           // kein bekannter InsertTag => nicht zuständig!
    }


    //-----------------------------------------------------------------
    //  HOOK: The initializeSystem hook is triggered right after the 
    //        system initialization process is finished and before the 
    //        request processing is started.
    //-----------------------------------------------------------------
    public function myInitializeSystem( )
    {
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
    }


    //-----------------------------------------------------------------
}
