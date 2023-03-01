<?php

namespace Processboard;

use Processboard\Helper\CacheBust;

class App
{
    public function __construct()
    {

        //Init subset
        //new Admin\Settings();

        //Register module
        add_action('plugins_loaded', array($this, 'registerModule'));
        
        //Register post type
        new \Processboard\Entity\PostType(__('Processer', 'modularity-processboard'), __('Processer', 'modularity-processboard'), 'process', array(
            'description' => __('Process information', 'modularity-processboard'),
            'menu_icon' => 'dashicons-list-view',
            'public' => false,
            'publicly_queriable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'has_archive' => false,
            'hierarchical' => true,
            'exclude_from_search' => true,
            'taxonomies' => array(),
            'supports' => array('title', 'revisions', 'editor', 'page-attributes')
        ));
        
                // Add view paths
        add_filter('Municipio/blade/view_paths', array($this, 'addViewPaths'), 1, 1);
    }

    /**
     * Register the module
     * @return void
     */
    public function registerModule()
    {
        if (function_exists('modularity_register_module')) {
            modularity_register_module(
                PROCESSBOARD_MODULE_PATH,
                'Processboard'
            );
        }
    }

    /**
     * Add searchable blade template paths
     * @param array  $array Template paths
     * @return array        Modified template paths
     */
    public function addViewPaths($array)
    {
        // If child theme is active, insert plugin view path after child views path.
        if (is_child_theme()) {
            array_splice($array, 2, 0, array(PROCESSBOARD_VIEW_PATH));
        } else {
            // Add view path first in the list if child theme is not active.
            array_unshift($array, PROCESSBOARD_VIEW_PATH);
        }

        return $array;
    }
}
