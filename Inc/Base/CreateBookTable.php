<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

if( ! class_exists( "WP_List_Table" ) ) {
    require_once( ABSPATH."wp-admin/includes/class-wp-list-table.php" );
}

if ( ! class_exists( 'CreateBookTable' ) ) {
    class CreateBookTable extends \WP_List_Table
    {
        // This function collect the posts data, paginate and sort
        public function get_post_data(){
            global $wpdb;

            /*echo "<pre>";
            print_r($wpdb);
            echo "</pre>";*/

            $sqlQuery = "SELECT * FROM ".$wpdb->posts." WHERE post_type = 'at-book-cpt' AND post_status = 'publish'";

            $orderBy = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
            $order   = @( $_GET['order'] ) ? $_GET['order'] : '';

            $orderByQuery = ( 'book_name'=== $orderBy ) ? " ORDER BY post_title $order" : " ORDER BY $orderBy $order";
            if( strlen( $order) > 0 ){
                $sqlQuery .= "$orderByQuery";
            }

            if( 'writer_name'== $orderBy && strlen( $order) > 0 ){
                //$sqlQuery1 = "SELECT * FROM ".$wpdb->postmeta." WHERE post_type = 'at-book-cpt' AND post_status = 'publish'";
               /* $sqlQuery1 = "SELECT * FROM ".$wpdb->postmeta." WHERE post_key = 'writer_name'";

                $sqlQuery = $sqlQuery1;*/
            }

            $postData = $wpdb->get_results( $sqlQuery );

            $postDataArray = array();
            if( count( $postData ) > 0 ){
                foreach( $postData as $index=>$post ){
                    $gpm = get_post_meta( $post->ID, 'book_image_url', true );
                    if( empty( $gpm ) ){
                        $image = 'Empty !';
                    }else{
                        $image = "<img src='{$gpm}' />";
                    }
                    $postDataArray[] = array(
                        'id'                => $post->ID,
                        'image'             => $image,
                        'book_name'         => $post->post_title,
                        'writer_name'       => get_post_meta( $post->ID, 'writer_name', true ),
                        'edition'           => get_post_meta( $post->ID, 'edition', true ),
                        'published_year'    => get_post_meta( $post->ID, 'published_year', true ),
                        'book_isbn'         => get_post_meta( $post->ID, 'book_isbn', true ),
                        'about_book'        => get_post_meta( $post->ID, 'about_book', true ),
                    );
                }
            }
            return $postDataArray;
        }

        // First write this fuction
        // By this function make the Data Table column name
        public function get_columns(){
            // This array index is same index of 'Data Base' or sorce data index whire the data is stored
            $columnName = array(
                'cb'                => "<input type='checkbox'>",
                'image'             => __( 'Image', 'atlibraryman' ),
                'book_name'         => __( 'Book Name', 'atlibraryman' ),
                'writer_name'       => __( 'Writer Name', 'atlibraryman' ),
                'edition'           => __( 'Book Edition', 'atlibraryman' ),
                'published_year'    => __( 'Publish Year', 'atlibraryman' ),
                'book_isbn'         => __( 'Book ISBN', 'atlibraryman' ),
                'about_book'        => __( 'About Book', 'atlibraryman' ),
            );
            return $columnName;
        }

        // Second write this fuction
        // By this function Show the Table
        public function prepare_items()
        {
            $getColumns         = $this->get_columns();
            $sortableColumns    = $this->get_sortable_columns();

            $this->_column_headers  = array( $getColumns, array(), $sortableColumns );
            $this->items            = $this->get_post_data();
        }

        // Third write this fuction
        // This function Show the Table's data
        public function column_default( $item, $column_name )
        {
            return $item[ $column_name ];
        }

        // Fourth write this fuction, we write this function after show the Table
        // This function show the 'Checkbox' column in Table
        public function column_cb( $item )
        {
            return "<input type='checkbox' value='{$item['id']}' />";
        }

        // This function sorted the column data
        public function get_sortable_columns()
        {
            return array(
                'book_name'         => [ 'book_name', true ],
                'writer_name'       => [ 'writer_name', true ],
                'published_year'    => [ 'published_year', true ],
            );
        }


    }
}