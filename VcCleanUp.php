<?php
/**
 * Plugin Name: Visual Composer CleanUp
 * Plugin URI: https://github.com/digitalunited/VisualComposerCleanUp
 * Author: Digital United
 * Author URI: http://digitalunited.io
 */

$plugginFile = __FILE__;

register_activation_hook($plugginFile, function () {
    $themeDir = get_template_directory();
    $customThemeFile = 'VcCleanUpConfig.php';

    if (file_exists($themeDir . '/' . $customThemeFile)) {
        return;
    }

    $stringData = file_get_contents('configBoilerplate.php', FILE_USE_INCLUDE_PATH);

    $fh = fopen($themeDir . '/' . $customThemeFile, 'w') or die('cant open file');
    fwrite($fh, $stringData);
    fclose($fh);
});

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

$vcCleanUp = new \DigitalUnited\VcCleanUp\VcCleanUp();
$vcCleanUp->go();