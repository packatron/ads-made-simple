<?php
/**
 * @version 0.0.1
 */
/*
Plugin Name: Ads Made Simple
Plugin URI: https://github.com/wp-quality/ads-made-simple
Description: Get a new banana for your split.
Author: WP Quality
Version: 0.0.1
Author URI: https://github.com/wp-quality
*/

require_once __DIR__.'/vendor/autoload.php';

use WpQuality\AdsMadeSimple\App;

$app = new App();

$app->run();
