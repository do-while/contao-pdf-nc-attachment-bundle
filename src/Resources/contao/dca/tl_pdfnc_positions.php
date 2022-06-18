<?php

/**
 * pdf_nc_attachment extension for Notification Center and Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018-2021, Softleister
 * @author     Hagen Klemp <info@softleister.de>
 * @licence    LGPL
 */


require_once( TL_ROOT . '/vendor/do-while/contao-pdf-nc-attachment-bundle/src/Resources/contao/classes/pdfnc_helper.php' );

/**
 * Table tl_pdfnc_positions
 */
$GLOBALS['TL_DCA']['tl_pdfnc_positions'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'ptable'                      => 'tl_nc_gateway',
        'sql' => array
        (
            'keys' => array
            (
                'id'  => 'primary',
                'pid' => 'index'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 4,
            'fields'                  => array('sorting'),
            'panelLayout'             => 'filter,search,limit',
            'headerFields'            => array('title', 'tstamp', 'type', 'pdfnc_on', 'pdfnc_vorlage', 'pdfnc_savepath'),
            'child_record_callback'   => array('tl_pdfnc_positions', 'listPositions')
        ),
        'global_operations' => array
        (
            'testpdf' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['testpdf'],
                'href'                => 'key=testpdf',
                'class'               => 'header_testpdf',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="t"'
            ),
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset()"'
            ),
            'cut' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['cut'],
                'href'                => 'act=paste&amp;mode=cut',
                'icon'                => 'cut.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset()"'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['toggle'],
                'icon'                => 'visible.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('tl_pdfnc_positions', 'toggleIcon')
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
		'__selector__'                => array('type','pictype'),
        'default'                     => '{type_legend},type;'
                                        .'{publish_legend},published',

        'text'                        => '{type_legend},type;'
                                        .'{pdfnc_legend},textitems,textcolor,noblanks;'
                                        .'{attr_legend},page,posxy,borderright,align,fontsize,fontstyle,texttransform;'
                                        .'{publish_legend},published',

        'picfile'                     => '{type_legend},type;'
                                        .'{attr_legend},page,bedingung,posxy,textarea;'
                                        .'{img_legend},pictype,picture,size;'
                                        .'{publish_legend},published',

        'picupload'                   => '{type_legend},type;'
                                        .'{attr_legend},page,bedingung,posxy,textarea;'
                                        .'{img_legend},pictype,pictag,size;'
                                        .'{publish_legend},published',

        'picdata'                     => '{type_legend},type;'
                                        .'{attr_legend},page,bedingung,posxy,textarea;'
                                        .'{img_legend},pictype,pictag,size;'
                                        .'{publish_legend},published',

        'qrcode'                      => '{type_legend},type,bartype;'
                                        .'{pdfnc_legend},textitems,textcolor,noblanks;'
                                        .'{attr_legend},page,posxy,qrsize;'
                                        .'{publish_legend},published',
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'foreignKey'              => 'tl_nc_gateway.title',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
        ),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['tstamp'],
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
//-------
        'type' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['type'],
            'exclude'                 => true,
            'default'                 => 'text',
            'inputType'               => 'select',
            'options'                 => array('text', 'pic', 'qrcode'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions'],
            'eval'                    => array('tl_class'=>'w50', 'submitOnChange'=>true),
            'sql'                     => "varchar(8) NOT NULL default 'text'"
        ),
        'bartype' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype'],
            'exclude'                 => true,
            'default'                 => 'QRCODE,Q',
            'inputType'               => 'select',
            'options'                 => array('2d'=>array('QRCODE,L', 'QRCODE,M', 'QRCODE,Q', 'QRCODE,H', 'PDF417', 'DATAMATRIX'), 
                                               '1d'=>array('C39', 'C39+', 'C39E', 'C39E+', 'C93', 'S25', 'S25+', 'I25', 'I25+', 'C128', 'C128A', 'C128B', 'C128C', 'EAN8', 'EAN13', 'UPCA', 'UPCE', 'EAN5', 'EAN2', 'MSI', 'MSI+', 'CODABAR', 'CODE11', 'PHARMA', 'PHARMA2T', 'IMB', 'POSTNET', 'PLANET', 'RMS4CC', 'KIX')),
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bartype_'],
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(12) NOT NULL default 'QRCODE,Q'"
        ),
//-------
        'textitems' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitems'],
            'exclude'                 => true,
            'inputType'               => 'multiColumnWizard',
            'eval'                    => array
            (
                    'columnFields' => array
                    (
                            'feld' => array
                            (
                                    'label'             => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitem_feld'],
                                    'default'           => '',
                                    'exclude'           => true,
                                    'inputType'         => 'text',
                                    'eval'              => array('allowHtml' => true, 'style' => 'width:265px'),
                            ),
                            'bedingung' => array
                            (
                                    'label'             => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textitem_bedingung'],
                                    'default'           => '',
                                    'exclude'           => true,
                                    'inputType'         => 'text',
                                    'eval'              => array('style' => 'width:235px'),
                            ),
                    )
            ),
            'sql'                     => "mediumtext NULL"
        ),
        'noblanks' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['noblanks'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'m12 w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
//-------
        'page' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['page'],
            'default'                 => '1',
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '1'"
        ),
        'bedingung' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['bedingung'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>64, 'tl_class'=>'w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'posxy' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['posxy'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>6, 'multiple'=>true, 'size'=>2, 'decodeEntities'=>true, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'textarea' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textarea'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'eval'                    => array('mandatory'=>true, 'maxlength'=>6, 'multiple'=>true, 'size'=>2, 'decodeEntities'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
//-------
        'borderright' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['borderright'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'maxlength'=>16, 'tl_class'=>'w50'),
            'sql'                     => "varchar(16) NOT NULL default ''"
        ),
        'align' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['align'],
            'default'                 => 'left',
            'inputType'               => 'select',
            'options'                 => array('left', 'center', 'right'),
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
        'fontsize' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontsize'],
            'default'                 => '11',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'maxlength'=>16, 'tl_class'=>'w50'),
            'sql'                     => "varchar(16) NOT NULL default '11'"
        ),
        'textcolor' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['textcolor'],
            'default'                 => '',
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>6, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard', 'style'=>'width:138px'),
            'sql'                     => "varchar(8) NOT NULL default ''"
        ),
        'fontstyle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontstyle'],
            'inputType'               => 'checkbox',
            'options'                 => array('bold', 'italic'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['fontstyles'],
            'eval'                    => array('multiple'=>true, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
		'texttransform' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform'],
			'inputType'               => 'select',
			'options'                 => array('uppercase', 'lowercase', 'capitalize', 'none'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['texttransform_'],
			'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
        'pictype' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pictype'],
            'default'                 => 'file',
            'inputType'               => 'select',
            'options'                 => array('file', 'upload', 'data'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdfnc_positions'],
            'eval'                    => array('tl_class'=>'w50', 'submitOnChange'=>true),
            'sql'                     => "varchar(8) NOT NULL default 'file'"
        ),
        'picture' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['picture'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('mandatory'=>true, 'filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr', 'extensions'=>\Contao\Config::get('validImageTypes')),
            'sql'                     => "binary(16) NULL",
        ),
        'pictag' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['pictag'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'qrsize' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['qrsize'],
            'default'                 => '2',
            'inputType'               => 'select',
            'options'                 => array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(2) NOT NULL default '2'"
        ),
//-------
        'published' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdfnc_positions']['published'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        )
    )
);


/**
 * Class tl_pdfnc_positions
 */
class tl_pdfnc_positions extends \Contao\Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    //-----------------------------------------------------------------
    //  Callback zum Anzeigen der Positionen im Backend
    //
    //  $arrRow - aktueller Datensatz
    //-----------------------------------------------------------------
    public function listPositions($arrRow)
    {
        $pub = $arrRow['published'] ? 'color:#555' : 'color:#bbb';
        $pos = \Contao\StringUtil::deserialize($arrRow['posxy']);
        $area = \Contao\StringUtil::deserialize($arrRow['textarea']);
        $items = \Contao\StringUtil::deserialize($arrRow['textitems']);

        switch( $arrRow['type']) {
            case 'pic':     if( $arrRow['pictype'] === 'file') {
                                $text = \Contao\FilesModel::findByUuid($arrRow['picture'])->path;
                                $text = '<span title="' . $text . '">' . basename($text) . '</span>';
                            }
                            else {
                                $text = $arrRow['pictag'];
                            }
                            break;

            case 'qrcode':
            case 'text':
            default:        $style = \Contao\StringUtil::deserialize($arrRow['fontstyle']);
                            $text = (is_array($style) && in_array('bold', $style) ? '<strong>' : '') . (is_array($style) && in_array('italic', $style) ? '<em>' : '');
                            foreach($items as $item) $text .= $item['feld'] . '<br>';
                            $text .= (is_array($style) && in_array('italic', $style) ? '</em>' : '') . (is_array($style) && in_array('bold', $style) ? '</strong>' : '');
                            break;
        }

        $result = '<table><tr>'
                 .'<td width="32"><img src="bundles/softleisterpdfncattachment/pos_' . $arrRow['type'] . '.png" width="16" height="16" alt=""></td>'
                 .'<td style="' . $pub . '" width="240" valign="top">' . $text . '</td>'
                 .'<td style="' . $pub . '" width="80" valign="top">' . $GLOBALS['TL_LANG']['tl_pdfnc_positions']['seite'] . ' ' . $arrRow['page'] . '</td>'
                 .'<td style="' . $pub . '" width="80" valign="top">X = ' . $pos[0] . '</td>'
                 .'<td style="' . $pub . '" width="80" valign="top">Y = ' . $pos[1] . '</td>';

        if( ($arrRow['type'] === 'pic') && !empty( $arrRow['textarea'] ) ) {
            $result .= '<td style="' . $pub . '" valign="top">(' . $area[0] . ' x ' . $area[1] . ' mm)</td>';
        }

        $result .= '</tr></table>';
        return $result;
    }

    //-----------------------------------------------------------------
    //    Veröffentlichung umschalten
    //-----------------------------------------------------------------
    public function toggleIcon( $row, $href, $label, $title, $icon, $attributes )
    {
        if( strlen(\Contao\Input::get('tid')) ) {
            $this->toggleVisibility( \Contao\Input::get('tid'), (\Contao\Input::get('state') == 1) );
            $this->redirect( $this->getReferer() );
        }

        $href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

        if( !$row['published'] ) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . \Contao\StringUtil::specialchars($title) . '"' . $attributes . '>' . \Contao\Image::getHtml($icon, $label) . '</a> ';
    }


    //-----------------------------------------------------------------
    //    Veröffentlichung umschalten
    //-----------------------------------------------------------------
    public function toggleVisibility( $intId, $blnVisible )
    {
        $objVersions = new \Contao\Versions( 'tl_pdfnc_positions', $intId );
        $objVersions->initialize( );

        // Trigger the save_callback
        if( is_array($GLOBALS['TL_DCA']['tl_pdfnc_positions']['fields']['published']['save_callback']) ) {
            foreach( $GLOBALS['TL_DCA']['tl_pdfnc_positions']['fields']['published']['save_callback'] as $callback ) {
                if( is_array( $callback ) ) {
                    $this->import( $callback[0] );
                    $blnVisible = $this->$callback[0]->$callback[1]( $blnVisible, $this );
                }
                else if( is_callable( $callback ) ) {
                    $blnVisible = $callback( $blnVisible, $this );
                }
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_pdfnc_positions SET tstamp=" . time() . ", published='" . $blnVisible . "' WHERE id=?")->execute( $intId );

        $objVersions->create();
        \Contao\System::log( 'A new version of record "tl_pdfnc_positions.id=' . $intId . '" has been created' . $this->getParentEntries('tl_pdfnc_positions', $intId ), __METHOD__, TL_GENERAL);
    }


    //-----------------------------------------------------------------
    //  Erstellt eine Liste der Formularfelder
    //  $dc->currentRecord   ist die ID des tl_pdfnc_positions
    //-----------------------------------------------------------------
    public function getFelder( $dc )
    {
        $arrFields = array();                       //=== Aufbau eines Feldes mit Vergleichswerten ===
        $cm_text = '';
        $cm_nr = 0;

        // Formular ermitteln
        $objFormField = $this->Database->prepare("SELECT * FROM tl_form_field WHERE invisible<>1 AND pid=(SELECT pid FROM tl_pdfnc_positions WHERE id=?) ORDER BY sorting")
                                       ->execute($dc->currentRecord);

        if( $objFormField->numRows < 1 ) return $arrFields;                         // keine Felder nicht gefunden: leeres Array zurück

        while( $objFormField->next() ) {
            $options = \Contao\StringUtil::deserialize($objFormField->options);     // Options auflösen

            switch( $objFormField->type ) {
                case 'submit':              break;                                  // Kommt nicht in die Liste

                case 'efgLookupRadio':
                case 'efgLookupCheckbox':
                case 'efgLookupSelect':
                                            $efgOpt = \Contao\StringUtil::deserialize($objFormField->efgLookupOptions);
                                            $dot = strpos( $efgOpt['lookup_val_field'], '.' ) + 1;
                                            $val_field = substr($efgOpt['lookup_val_field'], $dot);
                                            $name_field = substr($efgOpt['lookup_field'], $dot);

                                            $sql = 'SELECT ' . $val_field . ', ' . $name_field
                                                 . ' FROM ' . substr($efgOpt['lookup_field'], 0, strpos($efgOpt['lookup_field'], '.'));
                                            if( !empty($efgOpt['lookup_where']) ) $sql .= ' WHERE ' . html_entity_decode($efgOpt['lookup_where']);
                                            if( !empty($efgOpt['lookup_sort']) )  $sql .= ' ORDER BY ' . html_entity_decode($efgOpt['lookup_sort']);
                                            $objOpts = $this->Database->execute($sql);

                                            while( $objOpts->next() ) {
                                                $options[] = array('value'=>$objOpts->$val_field, 'label'=>$objOpts->$name_field);
                                            }
                                            // v v v   weiter, wie select, radio, checkbox   v v v
                case 'select':
                case 'radio':
                case 'checkbox':
                                            if( empty($options) ) break;
                                            foreach($options as $opt) {                             // Die Optionen einzeln
                                                $arrFields[$objFormField->name . '~'. $opt['value']] = $objFormField->name . '~'. $opt['value'];
                                            }
                                            break;

                case 'condition':
                case 'text':
                case 'textarea':
                case 'hidden':              $arrFields[$objFormField->name] = $objFormField->name;  // Feldname direkt
                                            break;

                case 'cm_alternative':      if( $objFormField->cm_alternativeType === 'cm_stop' ) break;
                                            if( $objFormField->cm_alternativeType === 'cm_start' ) {
                                                $cm_text = $objFormField->name;
                                                $cm_nr = 0;
                                            }
                                            else {
                                                $cm_nr++;
                                            }
                                            $arrFields[$cm_text . '~'. $cm_nr] = $cm_text . '~'. $cm_nr;          // Feldname mit Option
                                            break;
            }
        }

        if( version_compare(PHP_VERSION, '5.4.0') >= 0 ) {
            asort( $arrFields, SORT_FLAG_CASE );    // Alphabetisch sortieren
        }
        else {
            asort( $arrFields );                    // Alphabetisch sortieren, Groß/Kleinschreibung erst ab PHP 5.4
        }

        return $arrFields;
    }


    //-----------------------------------------------------------------
}
