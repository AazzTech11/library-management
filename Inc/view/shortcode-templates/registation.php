<?php
$readerTypes = array(
    __( 'student', 'atlibraryman' ),
    __('other', 'atlibraryman' )
);

$genders = array(
    __( 'male', 'atlibraryman' ),
    __( 'female', 'atlibraryman' ),
    __( 'custom', 'atlibraryman' )
);
?>
<div>
    <div class="atlm-form-container" >
        <form class="afc__form" method="POST" action="">
            <h2 class="afc__form-title"><?php _e('Registration Here', 'atlibraryman' ); ?></h2>
            <div class="afc__input-half-width">
                <label for="f_name"><?php _e( 'First Name', 'atlibraryman' ); ?></label>
                <input type="text" name="f_name" id="f_name" value="" placeholder="First name">
            </div>
            <div class="afc__input-half-width">
                <label for="l_name"><?php _e( 'Last Name', 'atlibraryman' ); ?></label>
                <input type="text" name="l_name" id="l_name" value="" placeholder="Last name">
            </div>
            <div class="afc__input-full-width">
                <label><?php _e( 'Image', 'atlibraryman' ); ?></label>
                <dev class="afc__image-btn-area">
                    <button class="afc__button" id="reader_image_uploader"><?php _e( 'Select Image', 'atlibraryman' ); ?></button>
                    <input type="hidden" name="reader_image_id" id="reader_image_id" value="">
                    <input type="hidden" name="reader_image_url" id="reader_image_url" value="">
                </dev>
                <div class="afc__image-container" id="reader_image_container"></div>
            </div>

            <div class="afc__input-half-width">
                <label for="profession"><?php _e( 'Profession', 'atlibraryman' ); ?></label>
                <input type="text" name="profession" id="profession" value="" placeholder="Your profession">
            </div>
            <div class="afc__input-half-width">
                <label for="reader_id"><?php _e( 'Employee or Student ID', 'atlibraryman' ); ?></label>
                <input type="number" name="reader_id" id="reader_id" value="" placeholder="Your ID">
            </div>
            <div class="afc__input-half-width">
                <label for="email"><?php _e( 'Email', 'atlibraryman' ); ?></label>
                <input type="email" name="email" id="email" value="" placeholder="Your email address">
            </div>
            <div class="afc__input-half-width">
                <label for="user_name"><?php _e( 'User Name', 'atlibraryman' ); ?></label>
                <input type="text" name="user_name" id="user_name" value="" placeholder="Your email address">
            </div>
            <div class="afc__input-half-width">
                <label for="password"><?php _e( 'Password', 'atlibraryman' ); ?></label>
                <input type="password" name="password" id="password" value="" placeholder="Your password">
            </div>
            <div class="afc__input-half-width">
                <label for="confirm_password"><?php _e( 'Confirm Password', 'atlibraryman' ); ?></label>
                <input type="password" name="confirm_password" id="confirm_password" value="" placeholder="Your Confirm password">
            </div>
            <div class="afc__input-half-width">
                <label><?php _e( 'Mobile', 'atlibraryman' ); ?></label>
                <input type="number" name="mobile" id="mobile" value="" placeholder="+8801XXXXXXXXX">
            </div>
            <div class="afc__input-half-width">
                <label for="birth_day"><?php _e( 'Date of Birth', 'atlibraryman' ); ?></label>
                <input type="date" name="birth_day" id="birth_day" value="">
            </div>
            <div class="afc__input-full-width">
                <label class="afc__radio-label"><?php _e( 'Gender', 'atlibraryman' ); ?></label>
                <?php
                foreach( $genders as $gender ){
                    $gender = ucwords( $gender );
                    ?>
                    <div class="afc__radio-opt-group">
                        <label class="afc__radio-opt-label" for="gender_<?php echo $gender; ?>"><?php echo $gender; ?></label>
                        <input class="afc__radio-opt" type="radio" name="gender" id="gender_<?php echo $gender; ?>" value="">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="afc__input-full-width">
                <label for="address"><?php _e( 'Address', 'atlibraryman' ); ?></label>
                <textarea type="text" name="address" id="address" value="" rows="4" cols="100" placeholder="Your address"></textarea>
            </div>
            <div >
                <input type="hidden" name="atlyman_register_nonce" value="<?php echo wp_create_nonce( 'atlyman-register-nonce' ); ?>"/>
                <input class="afc__button" type="submit" value="<?php _e( 'Register', 'atlibraryman' ); ?>"/>
            </div>
        </form>
    </div>
</div>
