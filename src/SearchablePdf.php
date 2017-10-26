<?php
/**
 * Searchable PDF plugin for Craft CMS 3.x
 *
 * Convert PDF assets into searchable text on upload
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\searchablepdf;

use craft\elements\Asset;
use craft\events\AssetEvent;
use craft\events\ElementEvent;
use craft\events\ModelEvent;
use craft\services\Elements;
use superbig\searchablepdf\services\SearchablePdfService as SearchablePdfServiceService;
use superbig\searchablepdf\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\console\Application as ConsoleApplication;
use craft\web\UrlManager;
use craft\events\RegisterUrlRulesEvent;

use superbig\searchablepdf\services\SearchablePdfService;
use yii\base\Event;

/**
 * Class SearchablePdf
 *
 * @author    Superbig
 * @package   SearchablePdf
 * @since     1.0.0
 *
 * @property  SearchablePdfServiceService $searchablePdfService
 */
class SearchablePdf extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var SearchablePdf
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init ()
    {
        parent::init();
        self::$plugin = $this;

        if ( Craft::$app instanceof ConsoleApplication ) {
            $this->controllerNamespace = 'superbig\searchablepdf\console\controllers';
        }

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['siteActionTrigger1'] = 'searchable-pdf/default';
            }
        );

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['cpActionTrigger1'] = 'searchable-pdf/default/do-something';
            }
        );

        Event::on(
            Elements::class,
            Elements::EVENT_AFTER_SAVE_ELEMENT,
            function (ElementEvent $event) {
                if ( $event->isNew && $event->element instanceof Asset ) {
                    $this->searchablePdfService->onSave($event->element);
                }
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ( $event->plugin === $this ) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'searchable-pdf',
                '{name} plugin loaded',
                [ 'name' => $this->name ]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel ()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml (): string
    {
        return Craft::$app->view->renderTemplate(
            'searchable-pdf/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
