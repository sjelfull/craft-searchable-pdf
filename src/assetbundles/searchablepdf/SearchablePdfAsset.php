<?php
/**
 * Searchable PDF plugin for Craft CMS 3.x
 *
 * Convert PDF assets into searchable text on upload
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\searchablepdf\assetbundles\SearchablePdf;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Superbig
 * @package   SearchablePdf
 * @since     1.0.0
 */
class SearchablePdfAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@superbig/searchablepdf/assetbundles/searchablepdf/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/SearchablePdf.js',
        ];

        $this->css = [
            'css/SearchablePdf.css',
        ];

        parent::init();
    }
}
