<?php
/**
 * @package  Library Management
 */

namespace Inc\Base;

if ( ! class_exists( 'TemplateController' ) ) {
    class TemplateController
    {
        public $templates;

        public function register()
        {
            // This is template's path, which we want to change from page editor.
            $this->templates = array(
                'Inc/view/page-templates/base-template.php' => 'Lib - Base Template',
                'Inc/view/page-templates/all-books-1.php' => 'All Books -1',
            );

            add_filter( 'theme_page_templates', array( $this, 'create_custom_template_opt' ) );
            add_filter( 'template_include', array( $this, 'loaded_custom_template' ) );
        }

        public function create_custom_template_opt( $templates )
        {
            $templates = array_merge( $templates, $this->templates );

            return $templates;
        }

        public function loaded_custom_template( $template )
        {
            global $post;

            if( ! $post ){
                return $template;
            }

            $templateName = get_post_meta( $post->ID, '_wp_page_template', true );

            if( ! isset( $this->templates[ $templateName ] ) ){
                return $template;
            }

            $file = PLUGIN_PATH.$templateName;

            if( file_exists( $file ) ){
                return $file;
            }

            return $template;
        }


    }
}