<?php

namespace Processboard\Admin;

class Settings
{
    public function __construct() {
        add_action('acf/init', array($this, 'registerSettings'));
    }

    /**
     * Register settings
     * @return void
     */
    public function registerSettings()
    {
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page(array(
                'page_title'  => __("Processboard", 'modularity-processboard'),
                'menu_title'  => __("Processboard Settings", 'modularity-processboard'),
                'menu_slug'   => 'modularity-processboard-settings',
                'parent_slug' => 'options-general.php',
                'capability'  => 'manage_options'
            ));
        }
    }
}
