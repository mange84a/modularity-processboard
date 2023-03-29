<?php

namespace Processboard\Module;

use Processboard\Helper\CacheBust;

/**
 * Class Processboard
 * @package Processboard\Module
 */
class Processboard extends \Modularity\Module
{
    public $slug = 'processboard';
    public $supports = array();
    public $options = array();

    public function init()
    {
        $this->nameSingular = __("Processboard", 'modularity-processboard');
        $this->namePlural = __("Processboard", 'modularity-processboard');
        $this->description = __("Processboard addon.", 'modularity-processboard');
    }

    /**
     * Data array
     * @return array $data
     */
    public function data(): array
    {
        $data = array();

        //Append field config
        $data = array_merge($data, (array) \Modularity\Helper\FormatObject::camelCase(
            get_fields($this->ID)
        ));

        $data['nodes'] = $this->getNodes($data['processCategory']);
        $data['connections'] = $this->getConnections($data['processCategory']);
    
        //Translations
        $data['lang'] = (object) array(
            'info' => __(
                "Hey! This is your new Processboard module. Let's get going.",
                'modularity-processboard'
            )
        );
        return $data;
    }

    /**
     * Blade Template
     * @return string
     */
    public function template(): string
    {
        return "processboard.blade.php";
    }

    /**
     * Style - Register & adding css
     * @return void
     */
    public function style()
    {
        //Register custom css
        wp_register_style(
            'modularity-processboard',
            PROCESSBOARD_URL . '/dist/' . CacheBust::name('css/modularity-processboard.css'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_style('modularity-processboard');
    }

    /**
     * Script - Register & adding scripts
     * @return void
     */
    public function script()
    {
        //Register custom css
        wp_register_script(
            'modularity-processboard',
            PROCESSBOARD_URL . '/dist/' . CacheBust::name('js/modularity-processboard.js'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_script('modularity-processboard');
    }
   
    public function getConnections($categoryId) {
        $connections = [];
        
        $cards = get_posts([
            'post_type' => 'process',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'order' => 'ASC',
            'tax_query' => [[
                'taxonomy' => 'process_group',
                'field' => 'term_id', 
                'terms' => $categoryId, 
                'include_children' => false
            ]]
        ]);
        foreach($cards as $card) {
            $connecting_nodes = get_field('connected_nodes', $card->ID);
            if(!$connecting_nodes) { continue; }
            foreach($connecting_nodes as $connecting_node) {
                $connections[] = [
                    (string) $card->ID,
                    (string) $connecting_node,
                ];
            }
        } 
        return $connections;
    }

    public function getNodes($categoryId) {
        $nodes = [];

        $cards = get_posts([
            'post_type' => 'process',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'order' => 'ASC',
            'tax_query' => [[
                'taxonomy' => 'process_group',
                'field' => 'term_id', 
                'terms' => $categoryId, /// Where term_id of Term 1 is "1".
                'include_children' => false
            ]]
        ]);
        
        if (is_array($cards) && !empty($cards)) {
            foreach ($cards as $card) {
                $node = [
                    'id' => (string) $card->ID,
                    'description' => $card->post_content,
                    'name' => $card->post_title,
                ];
                if($lvl = get_field('level', $card->ID)) {
                    $node['level'] = $lvl;
                }

                $nodes[] = $node;             
            }
        }
        return $nodes;
    }
    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}
