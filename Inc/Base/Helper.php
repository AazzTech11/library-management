<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

if ( ! class_exists( 'Helper' ) ) {
    class Helper
    {
        /* This function echo the file path. Which file we want to include,
        we use this only need to require once the template from 'Viwe' folder */
        public static function view($template, $data = [])
        {
            $path = PLUGIN_DIRNAME . "/Inc/view/$template.php";
            if (file_exists($path)) {
                require_once($path);
            }
        }

        /* This function catch and return the file path. Which file we want to include,
        we use this for require the shortcode template from only 'View' folder */
        public static function get_view( $template, $data = [] )
        {
            $content = '';
            $path = PLUGIN_DIRNAME . "/Inc/view/$template.php";
            if (file_exists( $path ) ) {
                ob_start();
                require_once( $path );
                $content = ob_get_contents();
                ob_get_clean();
                return $content;
            }
        }

        /* This function don't use for 'Include or Require' the template. This function
        catch and return the template path. Which template path we want to catch,
        the template file and file's folder name input in the '$template' variable */
        public static function get_template_path( $template )
        {
            return $path = PLUGIN_DIRNAME . "/Inc/view/$template.php";
        }


    }
}