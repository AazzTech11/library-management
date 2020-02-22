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
        <form class="afc__form" method="POST" action="<?php echo get_the_permalink(); ?>">

            <h2 class="afc__form-title"><?php _e('Registration Here', 'atlibraryman' ); ?></h2>
            <h3 class="afc__error">
                <?php
                if( $data['success_register'] ){
                    echo $data['success_register'];
                }else {
                    if ($data['error_empty_field']) {
                        echo $data['error_empty_field'];
                    } else {
                        echo $data['error_atlyman_user_name'];
                        echo $data['error_invalide_username'];
                        echo $data['error_invalide_email'];
                        echo $data['error_unavailable_email'];
                        echo $data['error_password_mismatch'];
                    }
                }
                ?>
            </h3>
            <div class="afc__input-half-width">
                <label for="atlyman_f_name"><?php _e( 'First Name', 'atlibraryman' ); ?></label>
                <input type="text" name="atlyman_f_name" id="atlyman_f_name" value="<?php echo $data['firstName']; ?>" placeholder="First name">
            </div>
            <div class="afc__input-half-width">
                <label for="atlyman_l_name"><?php _e( 'Last Name', 'atlibraryman' ); ?></label>
                <input type="text" name="atlyman_l_name" id="atlyman_l_name" value="<?php echo $data['lastName']; ?>" placeholder="Last name">
            </div>
            <div class="afc__input-full-width">
                <label><?php _e( 'Image', 'atlibraryman' ); ?></label>
                <dev class="afc__image-btn-area">
                    <button class="afc__button" id="reader_image_uploader"><?php _e( 'Select Image', 'atlibraryman' ); ?></button>
                    <input type="hidden" name="atlyman_reader_image_id" id="atlyman_reader_image_id" value="">
                    <input type="hidden" name="atlyman_reader_image_url" id="atlyman_reader_image_url" value="">
                </dev>
                <div class="afc__image-container" id="reader_image_container"></div>
            </div>

            <div class="afc__input-half-width">
                <label for="atlyman_profession"><?php _e( 'Profession', 'atlibraryman' ); ?></label>
                <input type="text" name="atlyman_profession" id="atlyman_profession" value="<?php echo $data['profession']; ?>" placeholder="Your profession">
            </div>
            <div class="afc__input-half-width">
                <label for="atlyman_reader_id"><?php _e( 'Employee or Student ID', 'atlibraryman' ); ?></label>
                <input type="text" name="atlyman_reader_id" id="atlyman_reader_id" value="<?php echo $data['readerId']; ?>" placeholder="Your ID">
            </div>
            <div class="afc__input-half-width">
                <label for="atlyman_email"><?php _e( 'Email', 'atlibraryman' ); ?></label>
                <input type="email" name="atlyman_email" id="atlyman_email" value="<?php echo $data['email']; ?>" placeholder="Your email address">
            </div>
            <div class="afc__input-half-width">
                <label for="atlyman_atlyman_user_name"><?php _e( 'User Name', 'atlibraryman' ); ?></label>
                <input type="text" name="atlyman_atlyman_user_name" id="atlyman_atlyman_user_name" value="<?php echo $data['userName']; ?>" placeholder="Your email address">
            </div>
            <div class="afc__input-half-width">
                <label for="atlyman_password"><?php _e( 'Password', 'atlibraryman' ); ?></label>
                <input type="password" name="atlyman_password" id="atlyman_password" value="<?php echo $data['password']; ?>" placeholder="Your password">
            </div>
            <div class="afc__input-half-width">
                <label for="atlyman_confirm_password"><?php _e( 'Confirm Password', 'atlibraryman' ); ?></label>
                <input type="password" name="atlyman_confirm_password" id="atlyman_confirm_password" value="<?php echo $data['confirmPassword']; ?>" placeholder="Your Confirm password">
            </div>
            <div class="afc__input-half-width">
                <label for="atlyman_mobile"><?php _e( 'Mobile', 'atlibraryman' ); ?></label>
                <input type="number" name="atlyman_mobile" id="atlyman_mobile" value="<?php echo $data['mobile']; ?>" placeholder="+8801XXXXXXXXX">
            </div>
            <div class="afc__input-half-width">
                <label for="atlyman_birth_day"><?php _e( 'Date of Birth', 'atlibraryman' ); ?></label>
                <input type="date" name="atlyman_birth_day" id="atlyman_birth_day" value="<?php echo $data['birthDay']; ?>">
            </div>
            <div class="afc__input-full-width">
                <label class="afc__radio-label"><?php _e( 'Gender', 'atlibraryman' ); ?></label>
                <?php
                foreach( $genders as $gender ){
                    $gender = ucwords( $gender );
                    ?>
                    <div class="afc__radio-opt-group">
                        <label class="afc__radio-opt-label" for="atlyman_gender_<?php echo $gender; ?>"><?php echo $gender; ?></label>
                        <input class="afc__radio-opt" type="radio" name="atlyman_gender" id="atlyman_gender_<?php echo $gender; ?>" value="">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="afc__input-full-width">
                <label for="atlyman_address"><?php _e( 'Address', 'atlibraryman' ); ?></label>
                <textarea type="text" name="atlyman_address" id="atlyman_address" value="<?php echo $data['address']; ?>" rows="4" cols="100" placeholder="Your address"></textarea>
            </div>
            <div >
                <input type="hidden" name="atlyman_register_nonce" value="<?php echo wp_create_nonce( 'atlyman-register-nonce' ); ?>"/>
                <input class="afc__button" type="submit" value="<?php _e( 'Register', 'atlibraryman' ); ?>"/>
            </div>
        </form>
    </div>
</div>
