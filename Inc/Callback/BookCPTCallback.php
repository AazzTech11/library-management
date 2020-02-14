<?php
/**
 * @package  Library Management
 */

namespace Inc\Callback;

use Inc\Base\Functions;

if( ! class_exists( 'BookCPTCallback' ) ) {
    class BookCPTCallback
    {
        public function register()
        {
            add_action( 'save_post', array( $this, 'save_book_details' ) );
        }

        public function save_book_details( $post_id )
        {
            if( ! Functions::is_secured( 'at_lm_book_cmb_field', 'at_lm_book_cmb_action', $post_id ) ){
                return $post_id;
            }

            $bookImageId    = isset( $_POST['book_image_id'] ) ? $_POST['book_image_id'] : '';
            $bookImageUrl   = isset( $_POST['book_image_url'] ) ? $_POST['book_image_url'] : '';

            $writerName     = isset( $_POST['writer_name'] ) ? $_POST['writer_name'] : '';
            $edition        = isset( $_POST['edition'] ) ? $_POST['edition'] : '';
            $publishedYear  = isset( $_POST['published_year'] ) ? $_POST['published_year'] : '';
            $bookIsbn       = isset( $_POST['book_isbn'] ) ? $_POST['book_isbn'] : '';
            $aboutBook      = isset( $_POST['about_book'] ) ? $_POST['about_book'] : '';

            update_post_meta( $post_id, 'book_image_id', $bookImageId );
            update_post_meta( $post_id, 'book_image_url', $bookImageUrl );

            update_post_meta( $post_id, 'writer_name', $writerName );
            update_post_meta( $post_id, 'edition', $edition );
            update_post_meta( $post_id, 'published_year', $publishedYear );
            update_post_meta( $post_id, 'book_isbn', $bookIsbn );
            update_post_meta( $post_id, 'about_book', $aboutBook );
        }

        public function book_custom_metafield( $post )
        {
            $lBookImage     = __( 'Upload Image', 'atlibraryman' );
            $lBookSelBtn    = __( 'Select Image', 'atlibraryman' );
            $lWriterName    = __( 'Writer Name', 'atlibraryman' );
            $lBookEdition   = __( 'Book Edition', 'atlibraryman' );
            $lPublishYear   = __( 'Publish Year', 'atlibraryman' );
            $lBookIsbn      = __( 'Book ISBN', 'atlibraryman' );
            $lAboutBook     = __( 'Something About Book', 'atlibraryman' );

            $savedImageId       = esc_attr( get_post_meta( $post->ID, 'book_image_id', true ) );
            $savedImageUrl      = esc_attr( get_post_meta( $post->ID, 'book_image_url', true ));
            $savedWriterName    = get_post_meta( $post->ID, 'writer_name', true );
            $savedEdition       = get_post_meta( $post->ID, 'edition', true );
            $savedPublishedYear = get_post_meta( $post->ID, 'published_year', true );
            $savedBookIsbn      = get_post_meta( $post->ID, 'book_isbn', true );
            $savedAboutBook     = get_post_meta( $post->ID, 'about_book', true );

            wp_nonce_field( 'at_lm_book_cmb_action', 'at_lm_book_cmb_field' );

            $bookDetailsHtml = <<<EOD
<table class="form-table" >
    <tbody>
        <tr>
            <th>
                <label>{$lBookImage}</label>
            </th>
            <td>      
                <button class="button" id="book_image_uploader">{$lBookSelBtn}</button>
                <input type="hidden" name="book_image_id" id="book_image_id" value="{$savedImageId}">
                <input type="hidden" name="book_image_url" id="book_image_url" value="{$savedImageUrl}">
                <div id="book_image_container"></div>
            </td>
        </tr>        
        <tr>
            <th>
                <label for="writer_name">{$lWriterName}</label>
            </th>
            <td>
                <input type="text" name="writer_name" id="writer_name" value="{$savedWriterName}">
            </td>
        </tr>
        <tr>
            <th>
                <label for="edition">{$lBookEdition}</label>
            </th>
            <td>
                <input type="text" name="edition" id="edition" value="{$savedEdition}">
            </td>
        </tr>
        <tr>
            <th>
                <label for="published_year">{$lPublishYear}</label>
            </th>
            <td>
                <input type="text" name="published_year" id="published_year" value="{$savedPublishedYear}">
            </td>
        </tr>
        <tr>
            <th>
                <label for="book_isbn">{$lBookIsbn}</label>
            </th>
            <td>
                <input type="text" name="book_isbn" id="book_isbn" value="{$savedBookIsbn}">
           </td>
        </tr>
        <tr>
            <th>
                <label for="about_book">{$lAboutBook}</label>
            </th>
            <td>
                <textarea type="text" name="about_book" id="about_book" rows="4" cols="100">{$savedAboutBook}</textarea>
            </td>
        </tr>
    </tbody>
</table>                
EOD;
            echo $bookDetailsHtml;
        }
    }
}