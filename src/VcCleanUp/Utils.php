<?php namespace DigitalUnited\VcCleanUp;

class Utils
{
    protected $stdModules;
    protected $whiteListedModules;

    function __construct($stdModules, $config)
    {
        $this->stdModules = $stdModules;
        $this->whiteListedModules = $config['enabledStdModules'];
    }

    /**
     * Removes all standard modules witch is not a port of the array $whiteList
     * @param array $whiteList (Standard modules to keep)
     */
    public function enabledStdModules(Array $whiteList)
    {
        foreach ($this->stdModules as $moduleName) {
            if (!in_array($moduleName, $whiteList)) {
                vc_remove_element($moduleName);
            }
        }
    }

    /**
     *  Replaces "vc_"-prefiexd css classes in the with bootstraps grid classes if $param equals true
     * @param $param
     */
    public function useBootstrapGrid($param)
    {
        if ($param) {
            add_filter('vc_shortcodes_css_class', function ($class_string, $tag) {

                $tags_to_clean = [
                    'vc_row',
                    'vc_column',
                    'vc_row_inner',
                    'vc_column_inner'
                ];

                if (in_array($tag, $tags_to_clean)) {
                    //Remove unused VC classes
                    $class_string = str_replace(' wpb_row', '', $class_string);
                    $class_string = str_replace(' vc_row-fluid', '', $class_string);
                    $class_string = str_replace(' vc_column_container', '', $class_string);
                    $class_string = str_replace(' wpb_column', '', $class_string);

                    //Remove all vc_prefixes
                    $class_string = str_replace('vc_', '', $class_string);
                }

                $class_string = preg_replace('|col-sm|', 'col-sm', $class_string);

                return $class_string;
            }, 10, 2);
        }
    }

    /**
     * Disables loading of visualcomposaer css if $param equals true
     * @param $param
     */
    public function deregisterFrontendStyles($param)
    {
        if ($param) {
            add_action('wp_enqueue_scripts', function () {
                wp_deregister_style('js_composer_front');
            });
        }
    }

    /**
     * Disables frontendeditor of if $param equals true
     * @param $param
     */
    public function disableFrontendEditor($param)
    {
        if ($param) {
            vc_disable_frontend();
        }
    }

    /**
     * Removes the "Extra class name"-field on all white listed modules if $param is true
     * @param $param
     */
    public function removeExtraClassNameField($param)
    {
        if ($param) {
            add_action('init', function () {
                foreach ($this->whiteListedModules as $moduleName) {
                    vc_remove_param($moduleName, 'el_class');
                }
            });
        }
    }

    /**
     * Removes the "Design options"-tab on all white listed modules if $param is true
     * @param $param
     */
    public function removeDesignOptionsTab($param)
    {
        if ($param) {
            add_action('init', function () {
                foreach ($this->whiteListedModules as $moduleName) {
                    vc_remove_param($moduleName, 'css');
                }
            });
        }
    }

    /**
     * Removes all row layouts that isnt in the array $rowLayoutsToKeep or
     * @param array|bool $rowLayoutsToKeep
     */
    public function enableRowLayouts($rowLayoutsToKeep)
    {
        if (is_array($rowLayoutsToKeep)) {
            add_action('vc_after_init_base', function () use ($rowLayoutsToKeep) {
                global $vc_row_layouts;

                foreach ($vc_row_layouts as $key => $vcRowLayout) {
                    if (false === array_search($vcRowLayout['title'], $rowLayoutsToKeep)) {
                        unset($vc_row_layouts[$key]);
                    }
                }
            });
        }
    }

    /**
     * Set vc as a part of a theme witch disables the "Custom CSS" tab on the Visual Composer options-page if $param equals true
     * @param $param
     */
    public function setVcAsTheme($param)
    {
        if ($param) {
            add_action('vc_before_init', function () {
                vc_set_as_theme();
            });
        }
    }

    /**
     * Removes Grid Elements from the admin menu if $param equals true
     * @param $param
     */
    public function disableGridElements($param)
    {
        if ($param) {
            add_action('admin_menu', function () {
                remove_menu_page('edit.php?post_type=vc_grid_item');
            });
        }
    }

    /**
     * Removes alot of unusefull buttons from VisualComposers admin GUI if $param equals true
     * @param $param
     */
    public function hideVcAdminButtons($param)
    {
        if ($param) {
            add_action('admin_head', function () {
                echo '
                    <style type="text/css">
                        #visual_composer_content .wpb_vc_row_inner .vc_controls-row .vc_column-edit, /* Hides edit-button on inner-row */
                        #visual_composer_content .wpb_vc_row .vc_controls-row .custom_columns, /* Hides "custom columns"-button in row column settings */
                        #visual_composer_content .wpb_vc_row .vc_controls-row .vc_column-add, /* Hides "add column"-button on rows */
                        #visual_composer_content .wpb_vc_row .vc_controls-row .vc_column-toggle, /* Hides all toggle-buttons on rows */
                        #visual_composer_content .wpb_vc_column_inner .vc_control-column .vc_column-add, /* Hides ALL buttons in columns */
                        #visual_composer_content .wpb_vc_column_inner .vc_control-column .vc_column-edit, /* Hides edit-buttons in inner-columns */
                        #visual_composer_content .wpb_vc_column .vc_control-column .vc_column-delete /* Hides delete-buttons on all columns */
                        {display:none; visibility: hidden;}
                        /* Override to show bottom add-buttons */
                        #visual_composer_content .wpb_vc_column_inner .vc_control-column.bottom-controls .vc_column-add
                        {display:block; visibility: visible;}

                        #wpb_visual_composer .vc_navbar-nav #vc_post-settings-button,
                        /*#wpb_visual_composer .vc_navbar-nav #wpb-edit-inline,*/
                        #wpb_visual_composer .vc_navbar-nav #vc_add-new-element,
                        #wpb_visual_composer .vc_navbar-header .vc_navbar-brand
                        {display:none; visibility: hidden;}
                    </style>
                ';
            });
        }
    }
}
