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
            $data = array();

            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $postsPerPage = -1;

            $args = array(
                'post_type'         => 'at-book-cpt',
                'posts_per_page'    => $postsPerPage,
                'paged'             => $paged,
            );
            $posts = new \WP_Query( $args );

            $data = [
                'posts' => $posts,
            ];


            /*// By this way take or retrieve a perticular post type's a preticular taxonomy's category
            $terms = get_terms( array( 'taxonomy' => 'book-category' ) );

            if( !empty( $terms ) ) {
                foreach ($terms as $term) {
                    echo $term->term_id . "<br>";
                    echo $term->name . "<br>";
                }
            }else{
                echo 'No term found';
            }

            // By this way take or retrieve a perticular post type's a preticular taxonomy's category
            $categories = get_categories( array( 'taxonomy' => 'book-category' ) );

            if( !empty( $categories ) ) {
                foreach ($categories as $category) {
                    echo $category->term_id . "<br>";
                    echo $category->name . "<br>";
                }
            }else{
                echo 'No category found';
            }

            // By this way take or retrieve a perticular post type's a preticular taxonomy's category
            $term_query = new \WP_Term_Query( array( 'taxonomy' => 'book-category' ) );

            if( ! empty( $term_query->terms ) ){
                foreach( $term_query->terms as $term ){
                    echo $term->term_id."<br>";
                    echo $term->name."<br>";
                }
            }else{
                echo 'No term found';
            }
 */
            // By this method take or retrieve a perticular post type's a preticular taxonomy's category then I display in filter category
            $categories = get_categories( array(
                'orderby'   => 'name',
                'order'     => 'ASC',
                'taxonomy'  => 'book-category'
            ) );
            $data['categories'] = $categories;

            // Search the data
            $filterByCat    = isset( $_REQUEST['atlm_filter_by_cat'] ) ? $_REQUEST['atlm_filter_by_cat'] : '';
            $searchByWriter = isset( $_REQUEST['atlm_book_s_by_writer'] ) ? $_REQUEST['atlm_book_s_by_writer'] : '';
            $searchByWord   = isset( $_REQUEST['atlm_book_s_by_word'] ) ? $_REQUEST['atlm_book_s_by_word'] : '';

            //if( isset( $_REQUEST['atlm_book_s_btn'] ) ){

           /* $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $postsPerPage = -1;*/



                /*while ( $pos->have_posts() ) {    // Start looping over the query results.
                    $pos->the_post();

                    the_title()."<br>";
                }*/
            //}


            /*ob_start();
            require_once( PLUGIN_DIRNAME.'/shortcode-templates/all-books.php' );
            $content = ob_get_contents();
            ob_get_clean();
            return $content;*/

            // This is alternate way to include the file from above way
            return Helper::get_view( 'shortcode-templates/all-books', $data );
        }
    }
}