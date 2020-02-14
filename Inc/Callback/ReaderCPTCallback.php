<?php
/**
 * @package  Library Management
 */

namespace Inc\Callback;

use Inc\Base\Functions;

if( ! class_exists( 'ReaderCPTCallback' ) ) {
    class ReaderCPTCallback
    {
        public function register()
        {
            add_action( 'save_post', array( $this, 'save_reader_details') );
        }

        public function save_reader_details( $post_id )
        {
            if ( ! Functions::is_secured( 'at_lm_reader_cmb_field', 'at_lm_reader_cmb_action', $post_id ) ) {
                return $post_id;
            }

            $readerImageId  = isset( $_POST['reader_image_id'] ) ? $_POST['reader_image_id'] : '';
            $readerImageUrl = isset( $_POST['reader_image_url'] ) ? $_POST['reader_image_url'] : '';

            $setReaderType  = isset( $_POST['reader_type'] ) ? $_POST['reader_type'] : '';
            $studentId      = isset( $_POST['student_id'] ) ? $_POST['student_id'] : '';
            $instituteName  = isset( $_POST['institute_name'] ) ? $_POST['institute_name'] : '';
            $department     = isset( $_POST['department'] ) ? $_POST['department'] : '';
            $employeeId     = isset( $_POST['employee_id'] ) ? $_POST['employee_id'] : '';
            $profession     = isset( $_POST['profession'] ) ? $_POST['profession'] : '';
            $email          = isset( $_POST['email'] ) ? $_POST['email'] : '';
            $address        = isset( $_POST['address'] ) ? $_POST['address'] : '';
            $mobile         = isset( $_POST['mobile'] ) ? $_POST['mobile'] : '';
            $gender         = isset( $_POST['gender'] ) ? $_POST['gender'] : '';


            update_post_meta( $post_id, 'reader_image_id', $readerImageId );
            update_post_meta( $post_id, 'reader_image_url', $readerImageUrl );

            update_post_meta( $post_id, 'reader_type', $setReaderType );
            update_post_meta( $post_id, 'student_id', $studentId );
            update_post_meta( $post_id, 'institute_name', $instituteName );
            update_post_meta( $post_id, 'department', $department );
            update_post_meta( $post_id, 'employee_id', $employeeId );
            update_post_meta( $post_id, 'profession', $profession );
            update_post_meta( $post_id, 'email', $email );
            update_post_meta( $post_id, 'address', $address );
            update_post_meta( $post_id, 'mobile', $mobile );
            update_post_meta( $post_id, 'gender', $gender );
        }



        public function reader_custom_metafield( $post )
        {
            $lReaderImage     = __( 'Upload Image', 'atlibraryman' );
            $lReaderSelBtn    = __( 'Select Image', 'atlibraryman' );
            $lReaderType      = __( 'Reader Type', 'atlibraryman' );
            $lStudientId      = __( "Studient ID", 'atlibraryman' );
            $lInstituteName   = __( 'Institute Name', 'atlibraryman' );
            $lDepartment      = __( 'Department Name', 'atlibraryman' );
            $lEmployeeId      = __( 'Employee ID', 'atlibraryman' );
            $lProfession      = __( 'Reader Profession', 'atlibraryman' );
            $lEmail           = __( 'E-mail', 'atlibraryman' );
            $lAddress         = __( 'Address', 'atlibraryman' );
            $lMobile          = __( 'Phone Number', 'atlibraryman' );
            $lGender          = __( 'Gender', 'atlibraryman' );

            $readerTypes = array(
                __( 'student', 'atlibraryman' ),
                __( 'employee', 'atlibraryman' ),
                __('other', 'atlibraryman' )
            );
            $genders = array(
                __( 'male', 'atlibraryman' ),
                __( 'female', 'atlibraryman' ),
                __( 'custom', 'atlibraryman' )
            );

            $savedImageId       = esc_attr( get_post_meta( $post->ID, 'reader_image_id', true ) );
            $savedImageUrl      = esc_attr( get_post_meta( $post->ID, 'reader_image_url', true ) );

            $savedReaderType    = get_post_meta( $post->ID, 'reader_type', true );
            $savedStudentId     = get_post_meta( $post->ID, 'student_id', true );
            $savedInstitute     = get_post_meta( $post->ID, 'institute_name', true );
            $savedDepartment    = get_post_meta( $post->ID, 'department', true );
            $savedEmployeeId    = get_post_meta( $post->ID, 'employee_id', true );
            $savedProfession    = get_post_meta( $post->ID, 'profession', true );
            $savedEmail         = get_post_meta( $post->ID, 'email', true );
            $savedAddress       = get_post_meta( $post->ID, 'address', true );
            $savedPhoneNum      = get_post_meta( $post->ID, 'mobile', true );
            $savedGender        = get_post_meta( $post->ID, 'gender', true );


            wp_nonce_field( 'at_lm_reader_cmb_action', 'at_lm_reader_cmb_field' );

            $readerDetailsHtml = <<<EOD
<table class="form-table" >
    <tbody>
        <tr>
            <th>
                <label>{$lReaderImage}</label>
            </th>
            <td>    
                <button class="button" id="reader_image_uploader">{$lReaderSelBtn}</button>
                <input type="hidden" name="reader_image_id" id="reader_image_id" value="{$savedImageId}">
                <input type="hidden" name="reader_image_url" id="reader_image_url" value="{$savedImageUrl}">
                <div id="reader_image_container"></div>
            </td>
        </tr>        
        <tr>
            <th>                    
                <label>{$lReaderType}</label>
            </th>
            <td>                       
EOD;
            foreach( $readerTypes as $readerType ){
                $readerType = ucwords( $readerType );
                $checkedReaderType = ( $readerType == $savedReaderType ) ? "checked = 'checked'" : '';
                $readerDetailsHtml .= <<<EOD
                <label for="reader_type_{$readerType}" >{$readerType}</label>
                <input type="radio" name="reader_type" id="reader_type_{$readerType}" value="{$readerType}" {$checkedReaderType}>
EOD;
            }
            $readerDetailsHtml .= <<<EOD
            </td>
        </tr>
        
        <tr>        
            <div class="student-area">
                <tr>
                    <th>
                        <label for="student_id">{$lStudientId}</label>
                    </th>
                    <td>
                        <input type="number" name="student_id" id="student_id" value="{$savedStudentId}">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="institute_name">{$lInstituteName}</label>
                    </th>
                    <td>
                        <input type="text" name="institute_name" id="institute_name" value="{$savedInstitute}">
                    </td>
                </tr>
            </div>
              
        
            <div class="employee-area">        
                <tr>
                    <th>
                        <label for="department">{$lDepartment}</label>
                    </th>
                    <td>
                        <input type="text" name="department" id="department" value="{$savedDepartment}">
                   </td>
                </tr>
                <tr>
                    <th>
                        <label for="employee_id">{$lEmployeeId}</label>
                    </th>
                    <td>
                        <input type="number" name="employee_id" id="employee_id" value="{$savedEmployeeId}">
                    </td>
                </tr>
            </div>
                
            <div class="other-area">        
                <tr>
                    <th>
                        <label for="profession">{$lProfession}</label>
                    </th>
                    <td>
                        <input type="text" name="profession" id="profession" value="{$savedProfession}">
                    </td>                  
                </tr>        
            </div>     
        </tr>
             
        <tr>
            <th>
                <label for="email">{$lEmail}</label>
            </th>
            <td>    
                <input type="email" name="email" id="email" value="{$savedEmail}">
            </td>
        </tr>     
        <tr>
            <th>
                <label for="address">{$lAddress}</label>
            </th>
            <td>    
                <textarea type="text" name="address" id="address" value="{$savedAddress}" rows="4" cols="100"></textarea>
            </td>
        </tr>
        <tr>
            <th>
                <label for="mobile">{$lMobile}</label>
            </th>
            <td>
                <input type="number" name="mobile" id="mobile" value="{$savedPhoneNum}">
            </td>
        </tr>
        <tr>
            <th>
                <label>{$lGender}</label>
            </th>
            <td>
EOD;
            foreach( $genders as $gender ){
                $gender = ucwords( $gender );
                $checkedGender = ( $gender == $savedGender ) ? "checked = 'checked'" : '';
                $readerDetailsHtml .= <<<EOD
                <label for="gender_{$gender}">{$gender}</label>
                <input type="radio" name="gender" id="gender_{$gender}" value="{$gender}" {$checkedGender}>  
EOD;
            }
            $readerDetailsHtml .= <<<EOD
            </td>
        </tr>
    </tbody>
</table> 
EOD;
            echo $readerDetailsHtml;
        }
    }
}