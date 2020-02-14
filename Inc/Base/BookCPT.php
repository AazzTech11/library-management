<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;


use Inc\Callback\BookCPTCallback;

if( ! class_exists( 'BookCPT' ) ) {
    class BookCPT
    {
        public $metaField;

        public function register()
        {
            $this->metaField = new BookCPTCallback;

            add_action( 'init', array( $this, 'add_book_post_type' ) );
            add_action( 'init', array( $this, 'add_custom_taxonomy') );
            add_action( 'admin_menu', array( $this, 'add_custom_metabox') );


            // This hook change the CPT Title placeholder
            add_filter( 'enter_title_here', array( $this, 'atlibman_change_book_name_placeholder_text') );
        }

        public function add_book_post_type()
        {
            $labels = array(
                'name'               => _x( 'Books', 'post type general name', 'atlibraryman' ),
                'singular_name'      => _x( 'Book', 'post type singular name', 'atlibraryman' ),
                'menu_name'          => _x( 'Books', 'admin menu', 'atlibraryman' ),
                'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'atlibraryman' ),
                'add_new'            => _x( 'Add New Book', 'book', 'atlibraryman' ),
                'add_new_item'       => __( 'Add New Book', 'atlibraryman' ),
                'new_item'           => __( 'New Book', 'atlibraryman' ),
                'edit_item'          => __( 'Edit Book', 'atlibraryman' ),
                'view_item'          => __( 'View Book', 'atlibraryman' ),
                'all_items'          => __( 'All Books', 'atlibraryman' ),
                'search_items'       => __( 'Search Books', 'atlibraryman' ),
                'parent_item_colon'  => __( 'Parent Books:', 'atlibraryman' ),
                'not_found'          => __( 'No books found.', 'atlibraryman' ),
                'not_found_in_trash' => __( 'No books found in Trash.', 'atlibraryman' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', 'atlibraryman' ),
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => false,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'at-book-cpt' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                //'menu_position'      => 150,
                'supports'           => array( 'title', 'author', 'thumbnail')
            );

            register_post_type( 'at-book-cpt', $args );
        }

        // This function change the CPT Title placeholder
        public function atlibman_change_book_name_placeholder_text( $title ){
            $screen = get_current_screen();
            if  ( 'at-book-cpt' == $screen->post_type ) {
                $title = 'Book Name';
            }
            return $title;
        }

        public function add_custom_metabox()
        {
            add_meta_box(
                'book_details',                                     // Section id
                __( 'Book Details', 'atlibraryman' ),               // Section name
                array( $this->metaField, 'book_custom_metafield' ),
                array( 'at-book-cpt' ),                            // Where show Section
                'normal',
                'high'
            );
        }

        public function add_custom_taxonomy()
        {
            $labels = array(
                'name'              => _x( 'Book Category',  'atlibraryman' ),
                'singular_name'     => _x( 'Book Category', 'atlibraryman' ),
                'search_items'      => __( 'Search Book Category', 'atlibraryman' ),
                'all_items'         => __( 'All Categories', 'atlibraryman' ),
                'parent_item'       => __( 'Parent Category', 'atlibraryman' ),
                'parent_item_colon' => __( 'Parent Category:', 'atlibraryman' ),
                'edit_item'         => __( 'Edit Book Category', 'atlibraryman' ),
                'update_item'       => __( 'Update Book Category', 'atlibraryman' ),
                'add_new_item'      => __( 'Add New Category', 'atlibraryman' ),
                'new_item_name'     => __( 'New Category Name', 'atlibraryman' ),
                'menu_name'         => __( 'Book Category', 'atlibraryman' ),
            );

            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'book-category' ),
            );

            register_taxonomy( 'book-category', 'at-book-cpt', $args );
        }
    }
}