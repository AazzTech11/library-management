<?php
/**
 * @package  Library Management
 */

namespace Inc\Callback;

use Inc\Base\Helper;

if( ! class_exists( 'AdminCallback' ) ) {
    class AdminCallback
    {
        public static function require_admin_template()
        {
            //require_once( PLUGIN_DIRNAME.'/admin-template/admin.php' );

            // By this method require the admin template. This is alternate prcess of require_once
            Helper::view( 'admin-templates/admin', $data );
        }
    }
}