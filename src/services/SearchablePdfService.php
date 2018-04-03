<?php
/**
 * Searchable PDF plugin for Craft CMS 3.x
 *
 * Convert PDF assets into searchable text on upload
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\searchablepdf\services;

use craft\base\Element;
use craft\base\ElementInterface;
use craft\elements\Asset;
use SGH\PdfBox\PdfBox;
use superbig\searchablepdf\jobs\ParseJob;
use superbig\searchablepdf\SearchablePdf;

use Craft;
use craft\base\Component;

/**
 * @author    Superbig
 * @package   SearchablePdf
 * @since     1.0.0
 */
class SearchablePdfService extends Component
{
    // Public Methods
    // =========================================================================

    public function parse(Asset $asset)
    {
        $converter = new PdfBox;
        $converter->setPathToPdfBox('/Users/fred/bin/pdfbox-app-2.0.7.jar');

        $path = $asset->getCopyOfFile();
        $text = $converter->textFromPdfFile($path);

        Craft::info(
            'Output of PDF: ' . $path . ' :' . $text,
            __METHOD__
        );
    }

    /**
     * @param ElementInterface $asset
     *
     * @return string
     *
     */
    public function onSave(ElementInterface $asset)
    {
        /** @var Asset $asset */
        if ($this->_isPDF($asset)) {
            Craft::$app->queue->push(new ParseJob([
                'description' => 'Parsing content for ' . $asset->filename,
                'assetId'     => $asset->id,
            ]));
        }
    }

    private function _isPDF(Asset $asset)
    {
        return strtolower($asset->getExtension()) === 'pdf' || $asset->getMimeType() == 'application/pdf';
    }
}
