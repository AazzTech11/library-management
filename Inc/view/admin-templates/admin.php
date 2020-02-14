<div class="wrap">
	<h1>Library Management</h1>
	<?php settings_errors(); ?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1"><?php _e( 'Booking','atlibraryman' ); ?></a></li>
        <li><a href="#tab-2"><?php _e( 'Books','atlibraryman' ); ?></a></li>
        <li><a href="#tab-3"><?php _e( 'Readers','atlibraryman' ); ?></a></li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <h1><?php _e( 'Booking','atlibraryman' ); ?></h1>
        </div>

        <div id="tab-2" class="tab-pane">
            <?php
            init_file()->allBooks->display_all_books();
            ?>
        </div>

        <div id="tab-3" class="tab-pane">
            <?php
            init_file()->allReader->display_all_reader();
            ?>
        </div>
    </div>
</div>