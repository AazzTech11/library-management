<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

if( ! class_exists( 'Functions' ) ) {
    class Functions
    {
        public static function is_secured( $nonce_field, $nonce_action, $post_id )
        {
            $nonce = isset( $_POST[$nonce_field] ) ? $_POST[$nonce_field] : '';

            if( '' == $nonce ){
                return false;
            }

            if( ! wp_verify_nonce( $nonce, $nonce_action ) ){
                return false;
            }

            if( ! current_user_can( 'edit_post', $post_id ) ){
                return false;
            }

            if( wp_is_post_autosave( $post_id ) ){
                return false;
            }

            if( wp_is_post_revision( $post_id ) ){
                return false;
            }
            return true;
        }

    }
}