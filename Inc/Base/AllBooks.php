<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

if( ! class_exists( 'AllBooks' ) ) {
    class AllBooks
    {
        public static function display_all_books()
        {
            $bookTable = new CreateBookTable();
            $bookTable->prepare_items();

            ?>
            <div class="wrap" >
                <h1><?php _e( 'All Books','atlibraryman' ); ?></h1>
                <form method="GET" name="search_from_book_table" action='" . $_SERVER['PHP_SELF'] ."?page=library-management' >
                    <?php
                    $bookTable->search_box( 'Search', 'search-from-book-table' );
                    $bookTable->display();
                    ?>
                </form>
            </div>
            <?php
        }

        public function filter_book_table_data( $item )
        {
            $filter = isset( $_REQUEST['filter_book_category'] ) ? $_REQUEST['filter_book_category'] : 'all';
            if( 'all' == $filter ){
                return true;
            }

            return false;
        }

    }
}