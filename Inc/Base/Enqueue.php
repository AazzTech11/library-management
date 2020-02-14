<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

//use assets\admin\css;

if ( ! class_exists( 'Enqueue' ) ) {
    class Enqueue
    {
        public function register()
        {
            add_action('admin_enqueue_scripts', array( $this, 'add_admin_enqueue_scripts') );
            add_action('wp_enqueue_scripts', array( $this, 'add_public_enqueue_scripts') );
        }

        public function add_admin_enqueue_scripts()
        {
            wp_enqueue_style( 'admin_style', PLUGIN_ADMIN_CSS. 'admin-style.css', time() );
            wp_enqueue_script( 'admin_script', PLUGIN_ADMIN_JS. 'admin-script.js' );
            wp_enqueue_script('cpt_img_uploader_script', PLUGIN_ADMIN_JS. 'cpt-img-uploader.js', array( 'jquery' ), time(), true );
        }

        public function add_public_enqueue_scripts()
        {
            wp_enqueue_style( 'public_style', PLUGIN_PUBLIC_CSS. 'public-style.css', time() );
            wp_enqueue_script( 'public_script', PLUGIN_PUBLIC_JS. 'public-script.js', array( 'jquery' ), time(), true  );
        }
    }
}