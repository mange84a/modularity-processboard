<?php

/**
 * Plugin Name:       Processboard
 * Plugin URI:        https://github.com/mange84a/modularity-processboard
 * Description:       Processboard addon.
 * Version:           1.0.0
 * Author:            Magnus Andersson
 * Author URI:        https://github.com/mange84a
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       mod-processboard
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('PROCESSBOARD_PATH', plugin_dir_path(__FILE__));
define('PROCESSBOARD_URL', plugins_url('', __FILE__));
define('PROCESSBOARD_TEMPLATE_PATH', PROCESSBOARD_PATH . 'templates/');
define('PROCESSBOARD_VIEW_PATH', PROCESSBOARD_PATH . 'views/');
define('PROCESSBOARD_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('PROCESSBOARD_MODULE_PATH', PROCESSBOARD_PATH . 'source/php/Module/');

load_plugin_textdomain('modularity-processboard', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once PROCESSBOARD_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once PROCESSBOARD_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new Processboard\Vendor\Psr4ClassLoader();
$loader->addPrefix('Processboard', PROCESSBOARD_PATH);
$loader->addPrefix('Processboard', PROCESSBOARD_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
$acfExportManager = new \AcfExportManager\AcfExportManager();
$acfExportManager->setTextdomain('modularity-processboard');
$acfExportManager->setExportFolder(PROCESSBOARD_PATH . 'source/php/AcfFields/');
$acfExportManager->autoExport(array(
    'processboard-module' => 'group_63fcbf7aa603f', //Update with acf id here, module view
    'process' => 'group_63fdb95198420'
));
$acfExportManager->import();

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-processboard'] = PROCESSBOARD_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new Processboard\App();
