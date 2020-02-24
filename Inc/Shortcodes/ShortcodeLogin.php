<?php
/**
 * @package  Library Management
 */

namespace Inc\Shortcodes;

use Inc\Base\Helper;

if( ! class_exists( 'ShortcodeLogin' ) ) {
    class ShortcodeLogin
    {
        public function register()
        {
            add_shortcode( 'atliman-login', array( $this, 'include_login_shortcode_template' ) );
        }

        public function include_login_shortcode_template()
        {
            $error = array();
            $data  = array();

            $userName   = isset($_POST['atlyman_user_name']) ? $_POST['atlyman_user_name'] : '';
            $password   = isset($_POST['atlyman_password']) ? $_POST['atlyman_password'] : '';

            if( wp_verify_nonce( $_POST['atlyman_login_nonce'], 'atlyman-login-nonce' ) ) {
                if( empty( $password && $userName ) ){
                    $error['1'] = 1;
                    $data['error_empty_field'] = __( 'Empty input field !', 'atlibraryman' );
                }

                if( ! empty( $userName ) && ! is_email( $userName ) ){
                    $user = get_userdatabylogin( $userName );
                    $user = get_user_by( 'ID', $user->ID );
                    $registeredUserName = $user->user_login;

                    if( $registeredUserName == $userName ) {
                        if( ! wp_check_password( $password, $user->user_pass, $user->ID ) ){
                            $error['2'] = 2;
                            $data['error_password_mismatch'] = __('Invalide Passwords !', 'atlibraryman');
                        }
                    }else{
                        $error['3'] = 3;
                        $data['error_invalide_username'] = __('Invalide username !', 'atlibraryman');
                    }
                }

                if( ! empty( $userName ) && is_email( $userName ) ){
                    $user = get_user_by_email( $userName );
                    $user = get_user_by( 'ID', $user->ID );
                    $registeredEmail = $user->user_email;

                    if( $registeredUserName == $email ) {
                        if( ! wp_check_password( $password, $user->user_pass, $user->id ) ){
                            $error['2'] = 2;
                            $data['error_password_mismatch'] = __( 'Invalide Passwords !', 'atlibraryman' );
                        }
                    }else{
                        $error['4'] = 4;
                        $data['error_invalide_email'] = __( 'Invalide E-mail !', 'atlibraryman' );
                    }
                }

                if( empty( $error ) ){
                    /*wp_setcookie( $_POST['atlyman_user_name'], $_POST['atlyman_password'], true );
                    wp_set_current_user($user->ID, $_POST['atlyman_user_name'] );
                    do_action( 'wp_login', $_POST['atlyman_user_name'] );*/
                    ?>
                    <script>window.location="all-books"</script>
                    <?php


                    }
                }

            /*ob_start();
            require_once( PLUGIN_DIRNAME.'/shortcode-templates/login.php' );
            $content = ob_get_contents();
            ob_get_clean();
            return $content;*/

            // This is alternate way to include the file from above way
            return Helper::get_view( 'shortcode-templates/login', $data );
        }
    }
}