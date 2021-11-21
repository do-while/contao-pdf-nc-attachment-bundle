<?php

/**
 * Extension for Contao 4
 *
 * @copyright  Softleister 2018-2021
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdf-nc-attachment-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdf-nc-attachment-bundle
 */

namespace Softleister\PdfncattachmentBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;


/**
 * Plugin for the Contao Manager.
 *
 * @author Softleister
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles( ParserInterface $parser )
    {
        return [
            BundleConfig::create( 'Softleister\PdfncattachmentBundle\SoftleisterPdfncattachmentBundle' )
                ->setLoadAfter( ['Contao\CoreBundle\ContaoCoreBundle', 'notification_center', MarkocupicCalendarEventBookingBundle::class] )
        ];
    }
}
