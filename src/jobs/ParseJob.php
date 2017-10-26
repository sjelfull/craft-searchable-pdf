<?php
/**
 * Searchable PDF plugin for Craft CMS 3.x
 *
 * Convert PDF assets into searchable text on upload
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\searchablepdf\jobs;

use craft\elements\Asset;
use craft\queue\BaseJob;
use superbig\searchablepdf\SearchablePdf;


class ParseJob extends BaseJob
{
    /**
     * @property integer assetId
     */
    public $assetId;

    public function execute ($queue)
    {
        $totalSteps = 3;
        $this->setProgress($queue, 1 / $totalSteps);

        $this->assetId;
        $asset = Asset::findOne($this->assetId);

        if ( $asset ) {
            SearchablePdf::$plugin->searchablePdfService->parse($asset);
            $this->setProgress($queue, 2 / $totalSteps);

            return true;
        }

        $this->setProgress($queue, 3 / $totalSteps);

        return true;
    }

    protected function defaultDescription ()
    {
        return 'Parsing PDF';
    }
}