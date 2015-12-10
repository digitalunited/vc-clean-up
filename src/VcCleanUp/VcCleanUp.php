<?php namespace DigitalUnited\VcCleanUp;

/**
 * Class VcCleanUp
 * @package DigitalUnited\VcCleanUp
 */
class VcCleanUp
{
  protected $config = [];
  protected $stdModules = [];
  protected $utils;

  function __construct()
  {
    $this->checkIfVcIsLoaded();
    if (!file_exists($this->getConfigPath())) {
      return false;
    }
    $this->stdModules = \DigitalUnited\VcCleanUp\VcStdModules::get();
    $this->loadConfig();
    $this->utils = new Utils($this->stdModules, $this->config);
  }

  public function go()
  {
    foreach ($this->config as $method => $params) {
      $this->execute($method, $params);
    }
  }

  protected function getConfigPath()
  {
    return get_stylesheet_directory() . '/VcCleanUpConfig.php';
  }

  protected function loadConfig()
  {
    if (file_exists($this->getConfigPath())) {
      $this->config = include($this->getConfigPath());
    }
    else {
      return false;
    }
  }

  protected function checkIfVcIsLoaded()
  {
    if (!defined('WPB_VC_VERSION')) {
      add_action('admin_notices', function () {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
                <div class="updated">
                  <p>' . sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']) . '</p>
                </div>';
      });

      return;
    }
  }

  protected function execute($method, $params)
  {
    if (method_exists($this->utils, $method)) {
      $this->utils->$method($params);
    }
    else {
      throw new \Exception($method . ': Is not a valid VcCleanUpConfig entry');
    }
  }
}