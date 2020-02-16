<?php
/**
 * @package  Library Management
 */

namespace Inc\Shortcodes;

use Inc\Base\Helper;

if( ! class_exists( 'ShortcodeAllBooks' ) ) {
    class ShortcodeAllBooks
    {
        public function register()
        {
            add_shortcode( 'atliman-all-books', array( $this, 'include_all_books_shortcode_template' ) );
        }

        public function include_all_books_shortcode_template()
        {
            /*ob_start();
            require_once( PLUGIN_DIRNAME.'/shortcode-templates/all-books.php' );
            $content = ob_get_contents();
            ob_get_clean();
            return $content;*/

            // This is alternate way to include the file from above way

            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $postsPerPage = 1;

            $args = array(
                'post_type' => 'at-book-cpt',
                'posts_per_page' => $postsPerPage,
                'paged' => $paged,
            );
            $posts = new \WP_Query( $args );
            $data = [
                'posts' => $posts
            ];
            return Helper::get_view( 'shortcode-templates/all-books', $data );
        }
    }
}