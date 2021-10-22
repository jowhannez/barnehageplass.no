<?php
/**
 * Cachebuster plugin for Craft CMS 3.x
 *
 * Handles cache busting server side
 *
 * @link      https://tibemolde.no
 * @copyright Copyright (c) 2019 TIBE Molde
 */

namespace tibe\cachebuster;

use tibe\cachebuster\variables\CachebusterVariable;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class Cachebuster
 *
 * @author    TIBE Molde
 * @package   Cachebuster
 * @since     1.0.0
 *
 */
class Cachebuster extends Plugin
{
    public static $plugin;
    public $schemaVersion = '1.0.0';

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('cachebuster', CachebusterVariable::class);
            }
        );

        Craft::info(Craft::t('cachebuster', '{name} plugin loaded', ['name' => $this->name]), __METHOD__);
    }
}
