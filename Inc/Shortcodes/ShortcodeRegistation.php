<?php
/**
 * @package  Library Management
 */

namespace Inc\Shortcodes;

use Inc\Base\Helper;

if( ! class_exists( 'ShortcodeRegistation' ) ) {
    class ShortcodeRegistation
    {
        public function register()
        {
            add_shortcode( 'atliman-registation', array( $this, 'include_registation_shortcode_template' ) );
            //add_action( 'init', array( $this, 'user_validate_and_resister' ) );
        }

        public function include_registation_shortcode_template()
        {
            /*ob_start();
            require_once( PLUGIN_DIRNAME.'/shortcode-templates/registation.php' );
            $content = ob_get_contents();
            ob_get_clean();
            return $content;*/

            // This is alternate way to include the file from above way
            return Helper::get_view( 'shortcode-templates/registation', $data );


            $firstName          = isset( $_POST['f_name'] ) ? $_POST['f_name'] : '';
            $lastName           = isset( $_POST['l_name'] ) ? $_POST['l_name'] : '';
            //$userImage          = isset( $_POST['reader_image_url'] ) ? $_POST['reader_image_url'] : '';
            $profession         = isset( $_POST['profession'] ) ? $_POST['profession'] : '';
            $readerId           = isset( $_POST['reader_id'] ) ? $_POST['reader_id'] : '';
            $email              = isset( $_POST['email'] ) ? $_POST['email'] : '';
            $userName           = isset( $_POST['user_name'] ) ? $_POST['user_name'] : '';
            $password           = isset( $_POST['password'] ) ? $_POST['password'] : '';
            $confirmPassword    = isset( $_POST['confirm_passowrd'] ) ? $_POST['confirm_passowrd'] : '';
            $mobile             = isset( $_POST['mobile'] ) ? $_POST['mobile'] : '';
            $birthDay           = isset( $_POST['birth_day'] ) ? $_POST['birth_day'] : '';
            $gender             = isset( $_POST['gender'] ) ? $_POST['gender'] : '';
            $address            = isset( $_POST['address'] ) ? $_POST['address'] : '';

            $error = [];

            if( isset( $_POST['atlyman_register_nonce'] ) && wp_verify_nonce( $_POST['atlyman_register_nonce'], 'atlyman-register-nonce' ) ){

                /*if( empty( $firstName || $profession || $readerId || $email || $userName || $password || $confirmPassword|| $gender || $address ) ){
                    $error['empty_field'] = __( 'Empty input field', 'atlibraryman' );
                }*/

                /*if( username_exists( $userName ) ){   // Username already registered
                    $error['unavailable_username'] = __( 'Username already taken.', 'atlibraryman' );
                }*/

               /* if( ! validate_username( $userName ) ){     // Invalid username
                    $error['invalide_username'] = __( 'Invalide username', 'atlibraryman' );
                }

                if( ! is_email( $email ) ) {        // Invalid email
                    $error['invalide_email'] = __( 'Invalid email', 'atlibraryman' );
                }

                if( email_exists( $email ) ) {      // Email address already registered
                    $error['unavailable_email'] = __( 'Email already registered', 'atlibraryman' );
                }

                if( $password != $confirmPassword ) {     // Passwords do not match
                    $error['password_mismatch'] = __( 'Passwords do not match', 'atlibraryman' );
                }*/

                if( count( $error ) == 0 ){
                    $userRegister = wp_insert_user( array(
                        'first_name'        => $firstName,
                        'last_name'         => $lastName,
                        'user_login'        => $userName,
                        'user_email'        => $email,
                        'user_pass'         => $password,
                        'user_registered'   => date( 'Y-m-d H:i:s' ),

                    ) );
                }

                //if( isset( $error) )

            }






        }

    }
}