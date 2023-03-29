<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_63fdb95198420',
    'title' => __('Anpassa processnode', 'modularity-processboard'),
    'fields' => array(
        0 => array(
            'key' => 'field_63fdb951e1a4e',
            'label' => __('Kopplade kort', 'modularity-processboard'),
            'name' => 'connected_nodes',
            'aria-label' => '',
            'type' => 'relationship',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array(
                0 => 'process',
            ),
            'taxonomy' => '',
            'filters' => array(
                0 => 'search',
                1 => 'taxonomy',
            ),
            'return_format' => 'id',
            'acfe_bidirectional' => array(
                'acfe_bidirectional_enabled' => '0',
            ),
            'min' => '',
            'max' => '',
            'elements' => '',
        ),
        1 => array(
            'key' => 'field_64218da448b31',
            'label' => __('Nivå', 'modularity-processboard'),
            'name' => 'level',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => __('Tvinga nivån i grafen, lämna tomt för standard', 'modularity-processboard'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'min' => '',
            'max' => '',
            'placeholder' => '',
            'step' => '',
            'prepend' => '',
            'append' => '',
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'process',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'left',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'acfe_display_title' => '',
    'acfe_autosync' => '',
    'acfe_form' => 0,
    'acfe_meta' => '',
    'acfe_note' => '',
));
}