<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018-2020, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    LGPL
 */

namespace Softleister\Pdfncattachment;

require_once( TL_ROOT . '/vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/classes/pdfnc_helper.php' );

//-----------------------------------------------------------------
//  pdfNcAttachmentHooks:    Output of the PDF
//-----------------------------------------------------------------
class pdfNcAttachmentHooks extends \Backend
{
    protected   $arrProtectflags = array('modify','extract','print','print-high','copy','annot-forms','fill-forms');

    //-----------------------------------------------------------------
    //  execute:    Process mail data
    //-----------------------------------------------------------------
    public function execute($objMessage, &$arrTokens, $language, $objGatewayModel)
    {
        if( $objMessage->gateway_type !== 'email' ) return true;        // for gateway type "email" only
        if( $objGatewayModel->pdfnc_on != 1 ) return true;              // "Fill in PDF form" inactive

        $filename = standardize(\StringUtil::restoreBasicEntities($objMessage->title)) . \Haste\Util\StringUtil::recursiveReplaceTokensAndTags( $objGatewayModel->pdfnc_fileext, $arrTokens );
        
        //--- member directory? ---
        $savepath = \FilesModel::findByUuid($objGatewayModel->pdfnc_savepath)->path;
        if( $objGatewayModel->pdfnc_useHomeDir && FE_USER_LOGGED_IN ) {
			$this->import('FrontendUser', 'User');

			if( $this->User->assignDir && $this->User->homeDir ) {
                $dir = \FilesModel::findByUuid($this->User->homeDir)->path;
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
                         'arrTokens'     => $arrTokens
                        );
        if( !is_array($arrPDF['protectflags']) ) $arrPDF['protectflags'] = array( $arrPDF['protectflags'] );

        // Enter offsets if specified
        $ofs = deserialize($objGatewayModel->pdfnc_offset);
        if( isset($ofs[0]) && is_numeric($ofs[0]) ) $arrPDF['offset'][0] = $ofs[0];
        if( isset($ofs[1]) && is_numeric($ofs[1]) ) $arrPDF['offset'][1] = $ofs[1];

        // HOOK: before pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdfnc_BeforePdf']) && \is_array($GLOBALS['TL_HOOKS']['pdfnc_BeforePdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdfnc_BeforePdf'] as $callback ) {
                $arrPDF = \System::importStatic($callback[0])->{$callback[1]}( $arrPDF, $this );
                $arrTokens = $arrPDF['arrTokens'];
            }
        }


        //-- Include Settings
        $tcpdfinit = \Config::get("pdftemplateTcpdf");

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

        if( pdfnc_helper::getPdfData( $arrPDF, $arrTokens, $pdfdatei ) ) {

            //--- Enter PDF file in the file manager ---
            $objFile = \Dbafs::addResource( $pdfdatei );
            \Dbafs::updateFolderHashes( $strUploadFolder );

            //--- Create token for created file ---
            $arrTokens['pdfnc_attachment'] = $pdfdatei;
            $arrTokens['pdfnc_document'] = basename( $pdfdatei );

            //--- Entry in log ---
            \System::Log('PDF attachment "' . $filename . '.pdf" has been created', __METHOD__, TL_ACCESS);
        }
        else $pdfdatei = '';        // no file was created


        // HOOK: after pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdfnc_AfterPdf']) && \is_array($GLOBALS['TL_HOOKS']['pdfnc_AfterPdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdfnc_AfterPdf'] as $callback ) {
                \System::importStatic($callback[0])->{$callback[1]}( $pdfdatei, $arrPDF, $this );
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
}
