<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    LGPL
 */

namespace Softleister\Pdfncattachment;

require_once( TL_ROOT . '/vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/classes/pdfnc_helper.php' );

//-----------------------------------------------------------------
//  pdfnc_TestPdf:    Testausgabe des PDF
//-----------------------------------------------------------------
class pdfnc_TestPdf extends \Backend
{
    //-----------------------------------------------------------------------------------
    //  Konstruktor
    //-----------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->import('Files');
        $this->import('Database');
    }


    //-----------------------------------------------------------------------------------
    //  Test-PDF erstellen
    //-----------------------------------------------------------------------------------
    public function testpdf( )
    {
        if( \Input::get('key') !== 'testpdf' ) return '';                       // Falscher Aufruf

        // Formulareinstellungen laden
        $objGate = $this->Database->prepare("SELECT * FROM tl_nc_gateway WHERE id=?")
                                  ->limit(1)
                                  ->execute(\Input::get('id'));

        if( ($objGate->numRows < 1) || ($objGate->pdfnc_on != '1') ) return;    // PDF-Attachment abgeschaltet!

        $arrPDF = array( 'gateid'        => $objGate->id,
                         'gatetitle'     => $objGate->title,
                         'filename'      => standardize( \StringUtil::restoreBasicEntities($objGate->title) ),
                         'vorlage'       => \FilesModel::findByUuid($objGate->pdfnc_vorlage)->path,
                         'savepath'      => \FilesModel::findByUuid($objGate->pdfnc_savepath)->path,
                         'protect'       => $objGate->pdfnc_protect,
                         'openpassword'  => \Controller::replaceInsertTags( pdfnc_helper::decrypt($objGate->pdfnc_openpassword ) ),
                         'protectflags'  => deserialize($objGate->pdfnc_protectflags),
                         'password'      => \Controller::replaceInsertTags( pdfnc_helper::decrypt($objGate->pdfnc_password ) ),
                         'multiform'     => deserialize($objGate->pdfnc_multiform),
                         'allpages'      => $objGate->pdfnc_allpages,
                         'offset'        => array( 0, 0 ),
                         'textcolor'     => $objGate->pdfnc_textcolor,
                         'title'         => $objGate->pdfnc_title,
                         'author'        => $objGate->pdfnc_author,
                         'tokenlist'     => $objGate->pdfnc_tokens,
                       );

        unset( $arrFields );
        if( !is_array($arrPDF['protectflags']) ) $arrPDF['protectflags'] = array( $arrPDF['protectflags'] );

        // Offsets eintragen, wenn angegeben
        $ofs = deserialize($objGate->pdfnc_offset);
        if( isset($ofs[0]) && is_numeric($ofs[0]) ) $arrPDF['offset'][0] = $ofs[0];
        if( isset($ofs[1]) && is_numeric($ofs[1]) ) $arrPDF['offset'][1] = $ofs[1];

        // HOOK: before pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdfnc_BeforePdf']) && \is_array($GLOBALS['TL_HOOKS']['pdfnc_BeforePdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdfnc_BeforePdf'] as $callback ) {
                $arrPDF = \System::importStatic($callback[0])->{$callback[1]}( $arrPDF, $this );
            }
        }

        //--- PDF-Datei erstellen ---
        pdfnc_helper::getPdfData( $arrPDF, array(), '' );
    }


    //-----------------------------------------------------------------
}
