<?php
/**
 * @package  Library Management
 */

namespace Inc;

use Inc\Base\AllBooks;
use Inc\Base\AllReader;

if( ! class_exists( 'Init' ) ){
   final class Init
    {
        public $allBooks;
        public $allReader;

        function __construct() {
            $this->allBooks = new AllBooks;
            $this->allReader = new AllReader;
        }

        public function register()
        {
            add_action( 'plugins_loaded', array( $this, 'loaded_atliman_plugins_textdomain' ) );
        }

        public function loaded_atliman_plugins_textdomain()
        {
            load_plugin_textdomain( 'atlibraryman', false, PLUGIN_BASE_DIR . "/languages" );
        }

        public static function get_services()
        {
            return array(
                self::class,
                Pages\Admin::class,
                Base\Enqueue::class,
                Base\BookCPT::class,
                Base\ReaderCPT::class,
                Base\TemplateController::class,
                Callback\BookCPTCallback::class,
                Callback\ReaderCPTCallback::class,
                Shortcodes\ShortcodeLogin::class,
                Shortcodes\ShortcodeAllBooks::class,
                Shortcodes\ShortcodeRegistation::class,
            );
        }

        public static function register_service()
        {
            foreach( self::get_services() as $className ) {
                $service = self::instantiate( $className );
                if ( method_exists( $service, 'register' ) ) {
                    $service->register();
                }
            }
        }

       private static function instantiate( $className )
       {
           $instantiate = new $className;
           return $instantiate;
       }
    }
}