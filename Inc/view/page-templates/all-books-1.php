<?php
/*
Template Name: All Books -1
*/
get_header();
?>
<div class="wrap">
    <h2><?php echo the_title(); ?></h2>
    <div class="atlm-display-container">
        <?php
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $postsPerPage = -1;

        $args = array(
            'post_type' => 'at-book-cpt',
            'posts_per_page' => $postsPerPage,
            'paged' => $paged
        );
        $posts = new WP_Query( $args );         // Custom query.

        if ( $posts->have_posts() ) {           // Check that we have query results.
            while ( $posts->have_posts() ) {    // Start looping over the query results.
                $posts->the_post();
                ?>
                <div class="adc__book">
                    <div class="adc__book-image">
                        <img src="<?php echo get_post_meta( $post->ID, 'book_image_url', true ); ?>" alt="Smiley face">
                    </div>
                    <div class="adc__book-details">
                        <h4><?php echo get_the_title(); ?></h4>
                        <h4><?php echo get_post_meta( $post->ID, 'writer_name', true );?></h4>
                        <h5><?php echo get_post_meta( $post->ID, 'edition', true );?></h5>
                        <h5><?php echo get_post_meta( $post->ID, 'published_year', true );?></h5>
                        <h5><?php echo get_post_meta( $post->ID, 'book_isbn', true );?></h5>
                        <div class="adc__about-book">
                            <p><?php echo get_post_meta( $post->ID, 'about_book', true );?></p>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
        wp_reset_query();       // Restore original post data.
        ?>
    </div>
</div>
<?php
get_footer();