<?php
/**
* @package  Library Management
*/

namespace Inc\Pages;

use Inc\Callback\AdminCallback;

if( ! class_exists( 'Admin' ) ) {
    class Admin
    {
        private $adminCallback;
        public function register()
        {
            $this->adminCallback = new AdminCallback();
            add_action( 'admin_menu', array( $this, 'add_atliman_admin_menu' ) );
        }

        public function add_atliman_admin_menu()
        {
            // This method create 'Library Manage' admin menu
            add_menu_page(
                __( 'Library Management', 'atlibraryman' ),                 // Page title
                __( 'Library Manage', 'atlibraryman' ),                     // Menu title
                'manage_options',                                           // Capability
                'library-management',                                       // Menu slug
                array( $this->adminCallback, 'require_admin_template' ),    // Callback
                'dashicons-book-alt',                                       // Menu icon
                50                                                         // Menu position
            );


            // This method include all books in 'All Books' submenu
            add_submenu_page(
                'library-management',                               // Parent slug
                __( 'All Books', 'atlibraryman' ),                  // Page title
                __( 'All Books', 'atlibraryman' ),                  // Menu title
                'manage_options',                                   // Capability
                'edit.php?post_type=at-book-cpt',                   // This is page path
            );

            // This method include 'Book CPT' in 'Add New Book' submenu
            add_submenu_page(
                'library-management',                               // Parent slug
                __( 'Add New Book', 'atlibraryman' ),               // Page title
                __( 'Add New Book', 'atlibraryman' ),               // Menu title
                'manage_options',                                   // Capability
                'post-new.php?post_type=at-book-cpt',               // This is page path
            );

            // This method include 'Book CPT' in 'Book Categories' submenu
            add_submenu_page(
                'library-management',                               // Parent slug
                __( 'Book Categories', 'atlibraryman' ),            // Page title
                __( 'Book Categories', 'atlibraryman' ),            // Menu title
                'manage_options',                                   // Capability
                'edit-tags.php?taxonomy=book-category',             // This is page path
            );

            // This method include all readers in 'All Readers' submenu
            add_submenu_page(
                'library-management',
                __( 'All Readers', 'atlibraryman' ),
                __( 'All Readers', 'atlibraryman' ),
                'manage_options',
                'edit.php?post_type=at-reader-cpt',
            );

            // This method include 'Reader CPT' in 'Add New Reader' submenu
            add_submenu_page(
                'library-management',
                __( 'Add New Reader', 'atlibraryman' ),
                __( 'Add New Reader', 'atlibraryman' ),
                'manage_options',
                'post-new.php?post_type=at-reader-cpt',
            );

            // This method create 'Settings' submenu
            add_submenu_page(
                'library-management',                                           // Parent slug
                __( 'Library Manage Settings', 'atlibraryman' ),                // Page title
                __( 'Settings', 'atlibraryman' ),                               // Menu title
                'manage_options',                                               // Capability
                'library_manage_settings',                                      // Menu slug
                function(){ echo "<h1>Library Management Settings Page</h1>"; }, // Callback
            );
        }

    }
}