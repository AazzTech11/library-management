<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

use Inc\Callback\ReaderCPTCallback;

if( ! class_exists( 'ReaderCPT' ) ) {
    class ReaderCPT
    {
        public $metafield;

        public function __construct(){
            $this->metafield = new ReaderCPTCallback();
        }

        public function register()
        {
            add_action( 'init', array( $this, 'add_reader_post_type' ) );
            add_action( 'admin_menu', array( $this, 'add_reader_custom_metabox') );

            // This hook change the CPT Title placeholder
            add_filter( 'enter_title_here', array( $this, 'atlibman_change_reader_name_placeholder_text') );
        }

        public function add_reader_post_type()
        {
            $labels = array(
                'name'               => _x( 'Reader', 'post type general name', 'atlibraryman' ),
                'singular_name'      => _x( 'Reader', 'post type singular name', 'atlibraryman' ),
                'menu_name'          => _x( 'Reader', 'admin menu', 'atlibraryman' ),
                'name_admin_bar'     => _x( 'Reader', 'add new on admin bar', 'atlibraryman' ),
                'add_new'            => _x( 'Add New', 'Reader', 'atlibraryman' ),
                'add_new_item'       => __( 'Add New Reader', 'atlibraryman' ),
                'new_item'           => __( 'New Reader', 'atlibraryman' ),
                'edit_item'          => __( 'Edit Reader', 'atlibraryman' ),
                'view_item'          => __( 'View Reader', 'atlibraryman' ),
                'all_items'          => __( 'All Readers', 'atlibraryman' ),
                'search_items'       => __( 'Search Reader', 'atlibraryman' ),
                'parent_item_colon'  => __( 'Parent Reader:', 'atlibraryman' ),
                'not_found'          => __( 'No reader found.', 'atlibraryman' ),
                'not_found_in_trash' => __( 'No Reader found in Trash.', 'atlibraryman' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', 'atlibraryman' ),
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => false,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'at-reader-cpt' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => 150,
                'supports'           => array( 'title', 'author', 'thumbnail' )
            );

            register_post_type( 'at-reader-cpt', $args );
        }

        // This function change the CPT Title placeholder
        public function atlibman_change_reader_name_placeholder_text( $title ){
            $screen = get_current_screen();
            if  ( 'at-reader-cpt' == $screen->post_type ) {
                $title = 'Reader Name';
            }
            return $title;
        }

        public function add_reader_custom_metabox()
        {
            add_meta_box(
                'reader_details',                                     // Section id
                __( 'Reader Details', 'atlibraryman' ),               // Section name
                array( $this->metafield, 'reader_custom_metafield' ),
                array( 'at-reader-cpt' ),                            // Where show Section
                'normal',
                'high'
            );
        }
    }
}