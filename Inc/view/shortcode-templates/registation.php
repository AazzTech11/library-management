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

$lReaderImage     = __( 'Upload Image', 'atlibraryman' );
$lReaderSelBtn    = __( 'Select Image', 'atlibraryman' );
$lStudientId      = __( "Studient ID", 'atlibraryman' );
$lInstituteName   = __( 'Institute Name', 'atlibraryman' );
$lDepartment      = __( 'Department Name', 'atlibraryman' );
$lEmployeeId      = __( 'Employee ID', 'atlibraryman' );
$lProfession      = __( 'Reader Profession', 'atlibraryman' );
$lEmail           = __( 'E-mail', 'atlibraryman' );
$lAddress         = __( 'Address', 'atlibraryman' );
$lMobile          = __( 'Phone Number', 'atlibraryman' );
$lGender          = __( 'Gender', 'atlibraryman' );


?>
<div>
    <div class="atlm-form-container" >
        <form class="afc__form" method="POST">
            <h2 class="afc__form-title">Registration Here</h2>
            <div class="afc__input-full-width">
                <label class="afc__radio-label"><?php _e( 'Reader Type', 'atlibraryman' ); ?></label>
                <?php
                foreach( $readerTypes as $readerType ){
                    $readerType = ucwords( $readerType );
                    ?>
                    <div class="afc__radio-opt-group">
                        <label class="afc__radio-opt-label" for="reader_type_<?php echo $readerType; ?>" ><?php echo $readerType; ?></label>
                        <input class="afc__radio-opt" type="radio" name="reader_type" id="reader_type_">
                    </div>
                <?php }
                ?>
            </div>
            <div class="afc__input-full-width">
                <label><?php _e( 'Name', 'atlibraryman' ); ?></label>
                <input type="text" name="last_name" id="last_name" value="" placeholder="Your name">
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


            <div class="afc__student-area">
                <div class="afc__input-half-width">
                    <label for="institute_name"><?php _e( 'Institute', 'atlibraryman' ); ?></label>
                    <input type="text" name="institute_name" id="institute_name" value="" placeholder="Institute name">
                </div>
                <div class="afc__input-half-width">
                    <label for="department"><?php _e( 'Department', 'atlibraryman' ); ?></label>
                    <input type="text" name="department" id="department" value="" placeholder="Department">
                </div>
                <div class="afc__input-half-width">
                    <label for="student_id"><?php _e( 'Student ID', 'atlibraryman' ); ?></label>
                    <input type="number" name="student_id" id="student_id" value="" placeholder="Your Student ID">
                </div>
            </div>


            <div class="afc__other-area">
                <div class="afc__input-half-width">
                    <label for="profession"><?php _e( 'Profession', 'atlibraryman' ); ?></label>
                    <input type="text" name="profession" id="profession" value="" placeholder="Your profession">
                </div>
                <div class="afc__input-half-width">
                    <label for="employee_id"><?php _e( 'Employee ID', 'atlibraryman' ); ?></label>
                    <input type="number" name="employee_id" id="employee_id" value="" placeholder="Employee ID">
                </div>
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
                <label for="passowrd"><?php _e( 'Password', 'atlibraryman' ); ?></label>
                <input type="password" name="passowrd" id="passowrd" value="" placeholder="Your password">
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
            <button class="afc__button" type="submit"><?php _e( 'Register', 'atlibraryman' ); ?></button>
        </form>
    </div>
</div>
