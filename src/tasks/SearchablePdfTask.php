<?php
/**
 * Searchable PDF plugin for Craft CMS 3.x
 *
 * Convert PDF assets into searchable text on upload
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\searchablepdf\tasks;

use superbig\searchablepdf\SearchablePdf;

use Craft;
use craft\base\Task;

/**
 * @author    Superbig
 * @package   SearchablePdf
 * @since     1.0.0
 */
class SearchablePdfTask extends Task
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $someAttribute = 'Some Default';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['someAttribute', 'string'],
            ['someAttribute', 'default', 'value' => 'Some Default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getTotalSteps(): int
    {
        return 1;
    }

    /**
     * @inheritdoc
     */
    public function runStep(int $step)
    {
        return true;
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function defaultDescription(): string
    {
        return Craft::t('searchable-pdf', 'SearchablePdfTask');
    }
}
