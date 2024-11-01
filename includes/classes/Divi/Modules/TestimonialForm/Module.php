<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialForm;

use WPT\WebsiteTestimonials\Divi\Modules\BaseModule;
/**
 * Testimonial Form divi module class
 */
class Module extends BaseModule {
    /**
     * Divi module slug
     */
    public $slug = 'wpt_et_pb_testimonial_form';

    public $icon_path;

    /**
     * Divi module credits
     */
    protected $module_credits = [
        'module_uri' => 'https://wptools.app/wordpress-plugin/divi-testimonial-plus-advanced-testimonial-grid-slider-form-and-seo-schema/?utm_source=form-module&utm_medium=class&utm_campaign=divi-testimonials&utm_content=credits#pricing',
        'author'     => 'WP Tools (Get Risk-Free 7-Day FREE Trial)',
        'author_uri' => 'https://wptools.app/wordpress-plugin/divi-testimonial-plus-advanced-testimonial-grid-slider-form-and-seo-schema/?utm_source=form-module&utm_medium=class&utm_campaign=divi-testimonials&utm_content=credits#pricing',
    ];

    /**
     * Initialize name and icons
     */
    public function init() {
        $this->name = esc_html__( 'Testimonial Form', 'website-testimonials' );
        $this->icon_path = $this->container['plugin_dir'] . '/images/testimonial-form/icon.svg';
        $this->module_fields = new Fields($this);
        $this->module_advanced_fields_config = new AdvancedFieldsConfig($this->module_fields);
        $this->module_settings_modal_toggles = new SettingsModalToggles();
    }

    /**
     * Render the divi module
     */
    public function render( $attrs, $content = null, $render_slug = null ) {
        parent::render( $attrs, $content, $render_slug );
        $attrs = $this->initialize_attributes( $attrs );
        // PROP VALUES
        $associated_pages = $this->get_prop_value( 'associated_pages', 'select' );
        $custom_ids = $this->get_prop_value( 'custom_ids', 'text' );
        $show_ratings_stars = $this->get_prop_value( 'show_ratings_stars', 'yes_no_button' );
        $show_title = $this->get_prop_value( 'show_title', 'yes_no_button' );
        $show_content = $this->get_prop_value( 'show_content', 'yes_no_button' );
        $custom_button = $this->get_prop_value( 'custom_button', 'yes_no_button' );
        $show_name = $this->get_prop_value( 'show_name', 'yes_no_button' );
        $show_email = $this->get_prop_value( 'show_email', 'yes_no_button' );
        $show_terms = $this->get_prop_value( 'show_terms', 'yes_no_button' );
        $button_icon = $this->get_prop_value( 'button_icon', 'text' );
        $button_icon_placement = $this->get_prop_value( 'button_icon_placement', 'text' );
        $input_error_message_text_color = $this->get_prop_value( 'input_error_message_text_color', 'text' );
        // END STYLES
        // SHORTCODE
        $shortcode_attrs = [];
        if ( $associated_pages == 'post_id' ) {
            $shortcode_attrs['assigned_posts'] = 'post_id';
        } else {
            $shortcode_attrs['assigned_posts'] = $custom_ids;
        }
        $hide = [];
        if ( !$show_ratings_stars ) {
            $hide[] = 'rating';
        }
        if ( !$show_title ) {
            $hide[] = 'title';
        }
        if ( !$show_content ) {
            $hide[] = 'content';
        }
        if ( !$show_name ) {
            $hide[] = 'name';
        }
        if ( !$show_email ) {
            $hide[] = 'email';
        }
        if ( !$show_terms ) {
            $hide[] = 'terms';
        }
        $shortcode_attrs['hide'] = implode( ',', $hide );
        $attributes_serialized = '';
        foreach ( $shortcode_attrs as $attr_name => $attr_value ) {
            $attributes_serialized .= sprintf( ' %s="%s"', $attr_name, $attr_value );
        }
        $shortcode = sprintf( '[site_reviews_form %s/]', $attributes_serialized );
        $form = do_shortcode( $shortcode );
        $form = preg_replace( '/\\>\\s+\\</m', '><', $form );
        $form = str_replace( 'glsr-button ', 'glsr-button et_pb_button ', $form );
        $form = str_replace( '<div class="wp-block-button">', '<div class="wp-block-button et_pb_button_module_wrapper">', $form );
        $form = str_replace( 'type="submit"', 'type="submit" data-icon="' . esc_attr( et_pb_process_font_icon( $button_icon ) ) . '"', $form );
        // $form = str_replace('<div><button ', '<div class="et_pb_button_container"><button ', $form);
        ob_start();
        require $this->container['plugin_dir'] . '/resources/views/divi/modules/testimonial-form.php';
        return ob_get_clean();
    }

}
