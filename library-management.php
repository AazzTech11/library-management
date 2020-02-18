<?php
/**
* @package  Library Management
*/
/**
* Plugin Name:       Library Management
* Plugin URI:        https://aazztech.com/products/plugins/library-management/
* Description:
* Version:           1.0
* Requires at least: 5.2
* Requires PHP:      7
* Author:            AazzTech
* Author URI:        https://aazztech.com
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:       atlibraryman
* Domain Path:       /languages
*/

// If this file is called firectly, abrot!!!
if ( ! defined( 'ABSPATH' ) ) {
exit;                       // Exit if accessed directly
}

// Define CONSTANTS
define( 'PLUGIN_DIRNAME', dirname( __FILE__ ) );
define( 'PLUGIN_BASE_DIR', dirname( dirname(__FILE__) ) );
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_NAME', plugin_basename( __FILE__ ) );

define( 'PLUGIN_ADMIN_CSS', plugin_dir_url( __FILE__ ).'assets/admin/css/' );
define( 'PLUGIN_ADMIN_JS', plugin_dir_url( __FILE__ ).'assets/admin/js/' );
define( 'PLUGIN_PUBLIC_CSS', plugin_dir_url( __FILE__ ).'assets/public/css/' );
define( 'PLUGIN_PUBLIC_JS', plugin_dir_url( __FILE__ ).'assets/public/js/' );

/*echo PLUGIN_DIRNAME ."<br>";
echo PLUGIN_BASE_DIR."<br>";
echo PLUGIN_PATH."<br>";
echo PLUGIN_URL."<br>";
echo PLUGIN_NAME."<br>";*/

define( 'LIMAN_DB_VERSION', '1.0' );

spl_autoload_register( function( $className ){
    $filePath = PLUGIN_DIRNAME."/$className.php";
    if( file_exists( $filePath ) ) {
        require_once( $filePath );
    }
} );

use Inc\Init;
use Inc\Base\Activate;

if( class_exists( 'Inc\Init' ) ) {
    Init::register_service();
}

function init_file()
{
    return new Init;
}



function atlyman_activate()
{
    $activation = new Activate();
    $activation->register();
}
// This hook run when plugin are active
register_activation_hook( __FILE__, 'atlyman_activate' );



// This hook run when plugin are deactive
//register_deactivation_hook( __FILE__, 'atlyman_activate' );