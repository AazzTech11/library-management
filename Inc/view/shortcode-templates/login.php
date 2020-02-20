<div>
    <div class="atlm-form-container" >
        <form class="afc__form" method="POST" action="">

            <h2 class="afc__form-title"><?php _e('Login Here', 'atlibraryman' ); ?></h2>
            <h3 class="afc__error">
                <?php
                if( $data['error_empty_field'] ){
                    echo $data['error_empty_field'];
                }else{
                    echo $data['error_invalide_username'];
                    echo $data['error_invalide_email'];
                    echo $data['error_password_mismatch'];
                }
                ?>
            </h3>
            <div class="afc__input-full-width">
                <label for="atlyman_user_name"><?php _e( 'E-mail or User Name', 'atlibraryman' ); ?></label>
                <input type="text" name="atlyman_user_name" id="atlyman_user_name" value="" placeholder="Your email or username">
            </div>
            <div class="afc__input-full-width">
                <label for="atlyman_password"><?php _e( 'Password', 'atlibraryman' ); ?></label>
                <input type="password" name="atlyman_password" id="atlyman_password" value="" placeholder="Your password">
            </div>
            <div>
                <input type="hidden" name="atlyman_login_nonce" value="<?php echo wp_create_nonce( 'atlyman-login-nonce' ); ?>"/>
                <input class="afc__button" type="submit" value="<?php _e( 'Login', 'atlibraryman' ); ?>"/>
            </div>

        </form>
    </div>
</div>