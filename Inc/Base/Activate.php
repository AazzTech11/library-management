<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;
use Inc\Base\Helper;

if( ! class_exists( 'Activate' ) ) {
    class Activate      // This class instanshiet in root file
    {
        public function register()
        {
            $this->auto_create_pages();
        }

        // This function create 'Auto Create Page' when the plugin are activae
        public function auto_create_pages()
        {
            /*// This for display 'All Books' page
            if ( !post_exists( 'All Books' ) ) {
                $page = array(
                    'post_title'    => __( 'All Books', 'atlibraryman' ), //title of page
                    'post_content'  => "[atliman_all_books]",        //content of page
                    'post_status'   => 'publish',       // status of page - publish or draft
                    'post_type'     => 'page',          // type of post
                    'page_template' => 'Inc/view/page-templates/base-template.php', // link of template
                );
                wp_insert_post( $page );
            }

            // This for display 'Registation' page
            if ( !post_exists( 'Registation' ) ) {
                $page = array(
                    'post_title'    => __( 'Registation', 'atlibraryman' ), //title of page
                    'post_content'  => '[atliman_registation]',     //content of page
                    'post_status'   => 'publish',     // status of page - publish or draft
                    'post_type'     => 'page',        // type of post
                    'page_template' => 'Inc/view/page-templates/base-template.php', // link of template
                );
                wp_insert_post( $page );
            }

            // This for display 'Login' page
            if ( !post_exists( 'Login' ) ) {
                $page = array(
                    'post_title'    => __( 'Login', 'atlibraryman' ), //title of page
                    'post_content'  => '[atliman_login]',      //content of page
                    'post_status'   => 'publish',     // status of page - publish or draft
                    'post_type'     => 'page',        // type of post
                    'page_template' => 'Inc/View/page-templates/base-template.php', // link of template
                );
                wp_insert_post( $page );
            }*/


            // This is alternet way to create 'Auto Create Page' when plugin can active
            $pages = [
                [   // This for display 'All Books' page
                    'post_title'    => 'All books',
                    '__post_title'  => __( 'All books', 'atlibraryman' ),
                    'post_content'  => '[atliman-all-books]'
                ],
                [   // This for display 'Registation' page
                    'post_title'    => 'Registation',
                    '__post_title'  => __( 'Registation', 'atlibraryman' ),
                    'post_content'  => '[atliman-registation]'
                ],
                [   // This for display 'Login' page
                    'post_title'    => 'Login',
                    '__post_title'  => __( 'Login', 'atlibraryman' ),
                    'post_content'  => '[atliman-login]'
                ]
            ];

            foreach( $pages as $page ) {
                if ( ! post_exists( $page['post_title'] ) ) {
                    $page = array(

                        'post_content'  => $page['post_content'],   //content of page
                        'post_title'    => $page['__post_title'],   //title of page
                        'post_name'     => $page['__post_title'],
                        'post_type'     => 'page',      // type of post
                        'post_status'   => 'publish',   // status of page - publish or draft
                        'page_template' => 'Inc/view/page-templates/base-template.php', // link of template
                        //'page_template' => Helper::get_template_path( 'page-templates/base-template' ),
                    );

                    wp_insert_post($page);
                }
            }
        }


    }
}