<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

if( ! class_exists( "WP_List_Table" ) ) {
    require_once( ABSPATH."wp-admin/includes/class-wp-list-table.php" );
}

if ( ! class_exists( 'CreateBookTable' ) ) {
    class CreateReaderTable extends \WP_List_Table
    {
        public function get_post_data()
        {
            global $wpdb;

            $sqlQuery = "SELECT * FROM ".$wpdb->posts." WHERE post_type = 'at-reader-cpt' AND post_status = 'publish'";

            $postData = $wpdb->get_results( $sqlQuery );

            $postDataArray = array();
            if( count( $postData ) > 0 ){
                foreach( $postData as $index => $post ) {
                    $gpm = get_post_meta( $post->ID, 'reader_image_url', true );
                    if( empty( $gpm ) ){
                        $image = 'Empty !';
                    }else{
                        $image = "<img src='{$gpm}' />";
                    }

                    $postDataArray[] = array(
                        'id'            => $post->ID,
                        'image'         => $image,
                        'reader_name'   => $post->post_title,
                        'gender'        => get_post_meta( $post->ID, 'gender', true ),
                        'profession'    => get_post_meta( $post->ID, 'profession', true ),
                        'email'         => get_post_meta( $post->ID, 'email', true ),
                        'phone'         => get_post_meta( $post->ID, 'mobile', true ),
                        'address'       => get_post_meta( $post->ID, 'address', true ),
                    );
                }
            }
            return $postDataArray;
        }

        // First write this fuction
        // This function create column name of the Table
        public function get_columns()                               // Defult method
        {
            return [
                'cb'            => "<input type='checkbox'>",
                'image'         => __( 'Image', 'atlibraryman' ),
                'reader_name'   => __( 'Name', 'atlibraryman' ),
                'gender'        => __( 'Gender', 'atlibraryman' ),
                'profession'    => __( 'Profession', 'atlibraryman' ),
                'email'         => __( 'E-mail', 'atlibraryman' ),
                'phone'         => __( 'Phone Number', 'atlibraryman' ),
                'address'       => __( 'Address', 'atlibraryman' ),
            ];
        }

        // Second write this fuction
        // This function Show the Table's data
        public function column_default( $item, $column_name )       // Defult method
        {
            return $item[ $column_name ];
        }

        // Third write this fuction
        // By this function Show the Table
        public function prepare_items()                             // Defult method
        {
            $getColumns = $this->get_columns();
            $sortableColumns = $this->get_sortable_columns();
            $this->_column_headers = array( $getColumns, array(), $sortableColumns );
            $this->items = $this->get_post_data();
        }

        // Fourth write this fuction, we write this function after show the Table
        // By this function show the 'Checkbox' column in data table
        public function column_cb( $item )
        {
            return "<input type='checkbox' value='{$item['id']}' />";
        }

        // This function sorted the column data
        public function get_sortable_columns()
        {
            return array(
                'reader_name'   => [ 'name', true ],
                'gender'        => [ 'gender', true ],
                'profession'    => [ 'profession', true ],
            );
        }

    }
}