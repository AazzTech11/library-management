<div class="wrap">
    <h2 class="atlm-title"><?php echo the_title(); ?></h2>

<!--################  Search Bar Area START  ##################-->
    <div class="atlm-search-container">
        <form method="$_GET" action="<?php the_permalink();?>">
            <div class="asc__filter-area">
                <select class="asc__filter-select" name="atlm_filter_by_cat">
                    <option value="0"><?php _e( 'Filter by Category', 'atlibraryman' ); ?></option>
                    <?php
                    foreach (  $data['categories'] as $category ){
                      echo sprintf( "<option value='%s'>%s</option>",  $category->term_id, ucwords( $category->name ) );
                    }
                    ?>
                </select>
            </div>
            <div class="asc__by-writer">
                <input type="text" name="atlm_book_s_by_writer" placeholder="Search by writer">
            </div>
            <div class="asc__by-word">
                <input type="text" name="atlm_book_s_by_word" placeholder="Search by word">
            </div>
            <div class="asc__btn-area">
                <button class="asc__search-btn" type="submit" name="atlm_book_s_btn" value="atlmbs"><span class="dashicons dashicons-search"></span></button>
                <!--<button class="asc__search-btn" name="submit" value="book_search"><span class="dashicons dashicons-search"></span></button>-->
            </div>
        </form>
    </div>
    <!--################  Search Bar Area END  ##################-->

    <!--################  Display All Books Area START  ##################-->
    <div class="atlm-display-container">
        <?php
        $the_query = new \WP_Query( array('post_type' => 'at-book-cpt','category_name' => 'other', 'posts_per_page' => 2 ) );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {    // Start looping over the query results.
                $the_query->the_post();
                echo get_the_title();
            }
        }else{
            echo "Posts not found";
        }


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

        echo paginate_links( $param );
        ?>
    </div>
    <!--################  Display All Books Area END  ##################-->
</div>