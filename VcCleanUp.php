<?php
/**
 * Plugin Name: Visual Composer CleanUp
 * Plugin URI: https://github.com/digitalunited/VisualComposerCleanUp
 * Author: Digital United
 * Author URI: http://digitalunited.io
 */


function createCleanupConfigIfNotExists()
{
    $boilerplaceConfigPath = __DIR__.'/configBoilerplate.php';
    $themeConfigPath = get_template_directory().'/VcCleanUpConfig.php';

    if (!file_exists($themeConfigPath)) {
        copy($boilerplaceConfigPath, $themeConfigPath);
    }
}

register_activation_hook(__FILE__, 'createCleanupConfigIfNotExists');


if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

add_action('admin_init', function () {
    if (function_exists('vc_remove_element')) {
        $vcCleanUp = new \DigitalUnited\VcCleanUp\VcCleanUp();
        $vcCleanUp->go();
    }
});
