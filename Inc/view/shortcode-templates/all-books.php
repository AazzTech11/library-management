<div class="wrap">
    <h2 class="atlm-title"><?php echo the_title(); ?></h2>
    <div class="atlm-search-container">
        <div class="asc__filter-area">
            <label class="asc__filter-label">Filter by Category</label>
        </div>
        <div class="asc__book-search-area">
            <input class="asc__search-input" type="search" placeholder="Search by word">
            <button class="asc__search-button"><span class="dashicons dashicons-search"></span></button>
        </div>
    </div>
    <div class="atlm-display-container">
        <?php
        if ( $data['posts']->have_posts() ) {           // Check that we have query results.
            while ( $data['posts']->have_posts() ) {    // Start looping over the query results.
                $data['posts']->the_post();

                global $post;

                $lEdition = __( 'Edition : ', 'atlibraryman' );
                $lPublishedYear = __( 'Published Year : ', 'atlibraryman' );
                $isbn = __( 'ISBN : ', 'atlibraryman' );

                $bookName       = get_the_title();
                $img            = get_post_meta( $post->ID, 'book_image_url', true );
                $writerName     = get_post_meta( get_the_ID(), 'writer_name', true );
                $edition        = get_post_meta( get_the_ID(), 'edition', true );
                $publishedYear  = get_post_meta( get_the_ID(), 'published_year', true );
                $bookIsbn       = get_post_meta( get_the_ID(), 'book_isbn', true );
                ?>
                <div class="adc__book">
                    <div class="adc__book-image">
                        <img src="<?php echo $img ?>" alt="Book Image">
                    </div>
                    <div class="adc__book-details">
                        <h4><?php echo $bookName; ?></h4>
                        <h4><?php echo $writerName; ?></h4>
                        <h5><?php echo $lEdition . $edition; ?></h5>
                        <h5><?php echo $lPublishedYear . $publishedYear; ?></h5>
                        <h5><?php echo $isbn . $bookIsbn; ?></h5>
                    </div>
                </div>
                <?php
                }
            }
            wp_reset_query();       // Restore original post data.
        ?>
    </div>
    <div class="atlm-pagination-container" >
        <?php
        $param = array(
            'total' => $data['posts']->max_num_pages,
            //'current' => $data['posts']->paged,
            'prev_text' => "<span class=\"dashicons dashicons-arrow-left-alt2\"></span>",
            'next_text' => "<span class=\"dashicons dashicons-arrow-right-alt2\"></span>",
        );

        echo paginate_links( $param ); ?>

    </div>
</div>