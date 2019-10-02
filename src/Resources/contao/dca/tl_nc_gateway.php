<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018-2019, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    LGPL
 */

require_once( TL_ROOT . '/vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/classes/pdfnc_helper.php' );

// Positions-Icon hinzufügen
$GLOBALS['TL_DCA']['tl_nc_gateway']['list']['operations']['positions'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_nc_gateway']['positions'],
    'href'      => 'table=tl_pdfnc_positions',
    'icon'      => 'bundles/softleisterpdfncattachment/pdf_positions.png'
);


// PALETTES
$GLOBALS['TL_DCA']['tl_nc_gateway']['palettes']['email'] .= ';{pdfnc_legend},pdfnc_on';

// Subpalette hinzufügen
$GLOBALS['TL_DCA']['tl_nc_gateway']['subpalettes']['pdfnc_on']      = 'pdfnc_vorlage,pdfnc_savepath,pdfnc_overwrite,pdfnc_useHomeDir,pdfnc_fileext,pdfnc_multiform,pdfnc_allpages,pdfnc_tokens,pdfnc_offset,pdfnc_textcolor,pdfnc_title,pdfnc_author,pdfnc_protect';
$GLOBALS['TL_DCA']['tl_nc_gateway']['subpalettes']['pdfnc_protect'] = 'pdfnc_password,pdfnc_openpassword,pdfnc_protectflags';


// Selector hinzufügen
$GLOBALS['TL_DCA']['tl_nc_gateway']['palettes']['__selector__'][] = 'pdfnc_on'; 
$GLOBALS['TL_DCA']['tl_nc_gateway']['palettes']['__selector__'][] = 'pdfnc_protect'; 


// Kopplung mit weiterer Child-Tabelle aufbauen
$GLOBALS['TL_DCA']['tl_nc_gateway']['config']['ctable'][] = 'tl_pdfnc_positions';


// Neue Felder hinzufügen
$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_on'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_on'],
    'exclude'       => true,
    'filter'        => true,
    'inputType'     => 'checkbox',
    'eval'          => array('submitOnChange'=>true),
    'sql'           => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_vorlage'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_vorlage'],
    'exclude'       => true,
    'inputType'     => 'fileTree',
    'eval'          => array('filesOnly'=>true, 'fieldType'=>'radio', 'mandatory'=>true, 'tl_class'=>'clr', 'extensions'=>'pdf'),
    'sql'           => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_savepath'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_savepath'],
    'exclude'       => true,
    'inputType'     => 'fileTree',
    'eval'          => array('files'=>false, 'fieldType'=>'radio', 'tl_class'=>'clr w50'),
    'sql'           => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_overwrite'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_overwrite'],
    'default'       => '1',
    'exclude'       => true,
    'inputType'     => 'checkbox',
    'eval'          => array('tl_class'=>'w50'),
    'sql'           => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_useHomeDir'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_useHomeDir'],
    'default'       => '1',
    'exclude'       => true,
    'inputType'     => 'checkbox',
    'eval'          => array('tl_class'=>'w50'),
    'sql'           => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_fileext'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_fileext'],
    'default'       => '_{{date::ymd_His}}',
    'exclude'       => true,
    'inputType'     => 'text',
    'eval'          => array('maxlength'=>255, 'tl_class'=>'clr w50'),
    'sql'           => "varchar(255) NOT NULL default '_{{date::ymd_His}}'"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_allpages'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_allpages'],
    'default'       => '1',
    'exclude'       => true,
    'inputType'     => 'checkbox',
    'eval'          => array('tl_class'=>'clr'),
    'sql'           => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_offset'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_offset'],
    'default'       => serialize(array('0', '0')),
    'exclude'       => true,
    'inputType'     => 'text',
    'eval'          => array('multiple'=>true, 'size'=>2, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50'),
    'sql'           => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_textcolor'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_textcolor'],
    'default'       => '000ac0',
    'inputType'     => 'text',
    'eval'          => array('maxlength'=>6, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard', 'style'=>'width:138px'),
    'sql'           => "varchar(8) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_title'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_title'],
    'exclude'       => true,
    'inputType'     => 'text',
    'eval'          => array('maxlength'=>255, 'tl_class'=>'clr w50'),
    'sql'           => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_author'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_author'],
    'exclude'       => true,
    'inputType'     => 'text',
    'eval'          => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'           => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_protect'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protect'],
    'exclude'       => true,
    'inputType'     => 'checkbox',
    'eval'          => array('submitOnChange'=>true, 'tl_class'=>'clr w50 m12'),
    'sql'           => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_openpassword'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_openpassword'],
    'exclude'       => true,
    'inputType'     => 'text',
    'load_callback' => array( array('Softleister\Pdfncattachment\pdfnc_helper', 'decrypt') ),
    'save_callback' => array( array('Softleister\Pdfncattachment\pdfnc_helper', 'encrypt') ),
    'eval'          => array('preserveTags'=>true, 'tl_class'=>'w50'),
    'sql'           => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_password'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_password'],
    'exclude'       => true,
    'inputType'     => 'text',
    'load_callback' => array( array('Softleister\Pdfncattachment\pdfnc_helper', 'decrypt') ),
    'save_callback' => array( array('Softleister\Pdfncattachment\pdfnc_helper', 'encrypt') ),
    'eval'          => array('preserveTags'=>true, 'tl_class'=>'w50'),
    'sql'           => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_protectflags'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflags'],
    'exclude'       => true,
    'inputType'     => 'checkbox',
    'options'       => array('print', 'print-high', 'modify', 'assemble', 'extract', 'copy', 'annot-forms', 'fill-forms'),
    'reference'     => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_protectflag'],
    'eval'          => array('multiple'=>true, 'tl_class'=>'clr w50'),
    'sql'           => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_tokens'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_tokens'],
    'exclude'       => true,
    'inputType'     => 'checkbox',
    'eval'          => array('tl_class'=>'clr'),
    'sql'           => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['pdfnc_multiform'] = array (
    'label'                   => &$GLOBALS['TL_LANG']['tl_nc_gateway']['pdfnc_multiform'],
    'exclude'                 => true,
    'inputType'               => 'multiColumnWizard',
    'eval'                    => array
    (
            'tl_class'     => 'clr',
            'columnFields' => array
            (
                    'bedingung' => array
                    (
                            'label'             => &$GLOBALS['TL_LANG']['tl_nc_gateway']['multiform_bedingung'],
                            'default'           => '',
                            'exclude'           => true,
                            'inputType'         => 'text',
                    ),
                    'seiten' => array
                    (
                            'label'             => &$GLOBALS['TL_LANG']['tl_nc_gateway']['multiform_seiten'],
                            'default'           => '',
                            'exclude'           => true,
                            'inputType'         => 'text',
                    ),
            )
    ),
    'sql'                     => "mediumtext NULL"
);

