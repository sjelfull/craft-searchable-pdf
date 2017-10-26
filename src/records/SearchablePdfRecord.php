<?php
/**
 * Searchable PDF plugin for Craft CMS 3.x
 *
 * Convert PDF assets into searchable text on upload
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\searchablepdf\records;

use superbig\searchablepdf\SearchablePdf;

use Craft;
use craft\db\ActiveRecord;

/**
 * @author    Superbig
 * @package   SearchablePdf
 * @since     1.0.0
 */
class SearchablePdfRecord extends ActiveRecord
{
    // Public Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%searchablepdf_searchablepdfrecord}}';
    }
}
