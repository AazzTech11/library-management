<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

if( ! class_exists( 'AllReader' ) ) {

    class AllReader
    {
        public static function display_all_reader()
        {
            $readerTable = new CreateReaderTable();
            $readerTable->prepare_items();
            ?>
            <div class="wrap" >
                <h1><?php _e( 'All Reader','atlibraryman' ); ?></h1>
                <form method="GET" >
                    <?php
                    $readerTable->search_box( 'Search', 'search-from-reader-table' );
                    $readerTable->display();
                    ?>
                </form>
            </div>
            <?php
        }
    }
}