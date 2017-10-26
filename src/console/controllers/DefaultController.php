<?php
/**
 * Searchable PDF plugin for Craft CMS 3.x
 *
 * Convert PDF assets into searchable text on upload
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\searchablepdf\console\controllers;

use superbig\searchablepdf\SearchablePdf;

use Craft;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Default Command
 *
 * @author    Superbig
 * @package   SearchablePdf
 * @since     1.0.0
 */
class DefaultController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Handle searchablepdf/default console commands
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'something';

        echo "Welcome to the console DefaultController actionIndex() method\n";

        return $result;
    }

    /**
     * Handle searchablepdf/default/do-something console commands
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'something';

        echo "Welcome to the console DefaultController actionDoSomething() method\n";

        return $result;
    }
}
