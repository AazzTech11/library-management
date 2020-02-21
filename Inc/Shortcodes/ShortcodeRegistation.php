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
        }

        public function include_registation_shortcode_template()
        {
            $data   = array();
            $error  = [];
            $msg    = array();

            $firstName          = isset( $_POST['atlyman_f_name'] ) ? $_POST['atlyman_f_name'] : '';
            $lastName           = isset( $_POST['atlyman_l_name'] ) ? $_POST['atlyman_l_name'] : '';
            //$userImage          = isset( $_POST['reader_image_url'] ) ? $_POST['reader_image_url'] : '';
            $profession         = isset( $_POST['atlyman_profession'] ) ? $_POST['atlyman_profession'] : '';
            $readerId           = isset( $_POST['atlyman_reader_id'] ) ? $_POST['atlyman_reader_id'] : '';
            $email              = isset( $_POST['atlyman_email'] ) ? $_POST['atlyman_email'] : '';
            $userName           = isset( $_POST['atlyman_atlyman_user_name'] ) ? $_POST['atlyman_atlyman_user_name'] : '';
            $password           = isset( $_POST['atlyman_password'] ) ? $_POST['atlyman_password'] : '';
            $confirmPassword    = isset( $_POST['atlyman_confirm_password'] ) ? $_POST['atlyman_confirm_password'] : '';
            $mobile             = isset( $_POST['atlyman_mobile'] ) ? $_POST['atlyman_mobile'] : '';
            $birthDay           = isset( $_POST['atlyman_birth_day'] ) ? $_POST['atlyman_birth_day'] : '';
            $gender             = isset( $_POST['atlyman_gender'] ) ? $_POST['atlyman_gender'] : '';
            $address            = isset( $_POST['atlyman_address'] ) ? $_POST['atlyman_address'] : '';

            $data = [
                'firstName'         => $firstName,
                'lastName'          => $lastName,
                //'userImage'         => $userImage,
                'profession'        => $profession,
                'readerId'          => $readerId,
                'email'             => $email,
                'userName'          => $userName,
                'password'          => $password,
                'confirmPassword'   => $confirmPassword,
                'mobile'            => $mobile,
                'birthDay'          => $birthDay,
                'address'           => $address,
            ];

            if ( wp_verify_nonce( $_POST['atlyman_register_nonce'], 'atlyman-register-nonce' ) ) {
                if ( empty( $firstName && $lastName && $profession && $readerId && $email && $userName && $password && $confirmPassword && $birthDay && $address ) ) {
                    $error['1'] = 1;
                    $data['error_empty_field'] = __( 'Empty input field !', 'atlibraryman' );
                }

                if ( username_exists( $userName ) ) {   // Username already registered
                    $error['2'] = 2;
                    $data['error_atlyman_user_name'] = __( 'Username already taken !', 'atlibraryman' );
                }

                if ( !validate_username( $userName ) ) {     // Invalid username
                    $error['3'] = 3;
                    $data['error_invalide_username'] = __( 'Invalide username !', 'atlibraryman' );
                }

                if ( ! is_email( $email ) ) {        // Invalid email
                    $error['4'] = 4;
                    $data['error_invalide_email'] = __( 'Invalid email !', 'atlibraryman' );
                }

                if ( email_exists( $email ) ) {      // Email address already registered
                    $error['5'] = 5;
                    $data['error_unavailable_email'] = __( 'Email already registered !', 'atlibraryman' );
                }

                if ( $password != $confirmPassword ) {     // Passwords do not match
                    $error['6'] = 6;
                    $data['error_password_mismatch'] = __( 'Passwords do not match !', 'atlibraryman' );
                }

                if ( empty( $error ) ) {
                    $userRegister = wp_insert_user( array(
                        'first_name'        => $firstName,
                        'last_name'         => $lastName,
                        'user_login'        => $userName,
                        'user_email'        => $email,
                        'user_pass'         => $password,
                        'user_registered'   => date('Y-m-d H:i:s'),
                    ) );
                    $data['success_register'] = "Successfully Register !";
                }
            }

            /*ob_start();
            require_once( PLUGIN_DIRNAME.'/shortcode-templates/registation.php' );
            $content = ob_get_contents();
            ob_get_clean();
            return $content;*/

            // This is alternate way to include the file from above way
            return Helper::get_view( 'shortcode-templates/registation', $data );
        }
    }
}