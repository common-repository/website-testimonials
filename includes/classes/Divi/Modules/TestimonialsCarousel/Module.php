<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialsCarousel;

use WPT\WebsiteTestimonials\Divi\Modules\BaseModule;
/**
 * Testimonials Carousel divi module class
 */
class Module extends BaseModule {
    /**
     * Divi module slug
     */
    public $slug = 'wpt_et_pb_testimonials_carousel';

    public $icon_path;

    /**
     * Divi module credits
     */
    protected $module_credits = [
        'module_uri' => 'https://wptools.app/wordpress-plugin/divi-testimonial-plus-advanced-testimonial-grid-slider-form-and-seo-schema/?utm_source=slider-module&utm_medium=class&utm_campaign=divi-testimonials&utm_content=credits#pricing',
        'author'     => 'WP Tools (Get Risk-Free 7-Day FREE Trial)',
        'author_uri' => 'https://wptools.app/wordpress-plugin/divi-testimonial-plus-advanced-testimonial-grid-slider-form-and-seo-schema/?utm_source=slider-module&utm_medium=class&utm_campaign=divi-testimonials&utm_content=credits#pricing',
    ];

    /**
     * Initialize name and icons
     */
    public function init() {
        $this->name = esc_html__( 'Testimonial Slider', 'website-testimonials' );
        $this->icon_path = $this->container['plugin_dir'] . '/images/testimonials-carousel/icon.svg';
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
        $module_class = trim( \ET_Builder_Element::add_module_order_class( '', $render_slug ) );
        // PROP VALUES
        $effect = $this->get_prop_value( 'effect', 'select' );
        $slides_per_view = $this->get_prop_value( 'slides_per_view', 'range' );
        $space_between = $this->get_prop_value( 'space_between', 'range' );
        $initial_slide = $this->get_prop_value( 'initial_slide', 'range' );
        $centered_slides = $this->get_prop_value( 'centered_slides', 'yes_no_button' );
        $enable_coverflow_slide_shadow = $this->get_prop_value( 'enable_coverflow_slide_shadow', 'yes_no_button' );
        $coverflow_shadow_color = $this->get_prop_value( 'coverflow_shadow_color', 'string' );
        $coverflow_rotate = $this->get_prop_value( 'coverflow_rotate', 'string' );
        $coverflow_depth = $this->get_prop_value( 'coverflow_depth', 'string' );
        $slider_loop = $this->get_prop_value( 'slider_loop', 'string' );
        $autoplay = $this->get_prop_value( 'autoplay', 'string' );
        $autoplay_speed = $this->get_prop_value( 'autoplay_speed', 'string' );
        $pause_on_hover = $this->get_prop_value( 'pause_on_hover', 'string' );
        $show_arrow = $this->get_prop_value( 'show_arrow', 'string' );
        $show_arrow_on_hover = $this->get_prop_value( 'show_arrow_on_hover', 'string' );
        $show_control_dot = $this->get_prop_value( 'show_control_dot', 'string' );
        $coverflow_shadow_color = $this->get_prop_value( 'coverflow_shadow_color', 'string' );
        $control_dot_active_color = $this->get_prop_value( 'control_dot_active_color', 'string' );
        $control_dot_inactive_color = $this->get_prop_value( 'control_dot_inactive_color', 'string' );
        $slide_transition_duration = $this->get_prop_value( 'slide_transition_duration', 'string' );
        $arrow_font_size = $this->get_prop_value( 'arrow_font_size', 'string' );
        $arrow_color = $this->get_prop_value( 'arrow_color', 'string' );
        $arrow_position = $this->get_prop_value( 'arrow_position', 'string' );
        $arrow_vertical_position = $this->get_prop_value( 'arrow_vertical_position', 'string' );
        $arrow_horizontal_position = $this->get_prop_value( 'arrow_horizontal_position', 'string' );
        $pagination_position = $this->get_prop_value( 'pagination_position', 'string' );
        $space_between_desktop = et_pb_responsive_options()->get_desktop_value( 'space_between', $this->props, $this->module_fields->get_default( 'space_between' ) );
        $space_between_tablet = et_pb_responsive_options()->get_tablet_value( 'space_between', $this->props, $space_between_desktop );
        $space_between_phone = et_pb_responsive_options()->get_phone_value( 'space_between', $this->props, $space_between_tablet );
        $slides_per_view_values = $this->get_responsive_values( 'slides_per_view' );
        // FILTER TESTIMONIALS
        $fetch_testimonials_from = $this->get_prop_value( 'fetch_testimonials_from', 'select' );
        $custom_ids = $this->get_prop_value( 'custom_ids', 'text' );
        $filter_by_categories = $this->get_prop_value( 'filter_by_categories', 'yes_no_button' );
        $categories = $this->get_prop_value( 'categories', 'categories' );
        $assigned_users = $this->get_prop_value( 'assigned_users', 'text' );
        $display = $this->get_prop_value( 'display', 'range' );
        $offset = $this->get_prop_value( 'offset', 'range' );
        $rating = $this->get_prop_value( 'rating', 'range' );
        $show_assigned_links = $this->get_prop_value( 'show_assigned_links', 'yes_no_button' );
        $show_author = $this->get_prop_value( 'show_author', 'yes_no_button' );
        $show_avatar = $this->get_prop_value( 'show_avatar', 'yes_no_button' );
        $show_content = $this->get_prop_value( 'show_content', 'yes_no_button' );
        $show_date = $this->get_prop_value( 'show_date', 'yes_no_button' );
        $show_rating = $this->get_prop_value( 'show_rating', 'yes_no_button' );
        $show_response = $this->get_prop_value( 'show_response', 'yes_no_button' );
        $show_title = $this->get_prop_value( 'show_title', 'yes_no_button' );
        $fallback = $this->get_prop_value( 'fallback', 'text' );
        $schema = $this->get_prop_value( 'schema', 'yes_no_button' );
        $testimonial_layout = $this->get_prop_value( 'testimonial_layout', 'select' );
        $show_beginning_quote_icon = $this->get_prop_value( 'show_beginning_quote_icon', 'yes_no_button' );
        $show_ending_quote_icon = $this->get_prop_value( 'show_ending_quote_icon', 'yes_no_button' );
        $change_active_dot_dimensions = $this->get_prop_value( 'change_active_dot_dimensions', 'yes_no_button' );
        $fetch_from_assigned_posts = $this->get_prop_value( 'fetch_from_assigned_posts', 'yes_no_button' );
        // END PROP VALUES
        $this->add_classname( [$testimonial_layout] );
        if ( !wpt_dtp_fs()->is_premium() ) {
            $this->add_classname( ['is-free'] );
        }
        $shortcode_attrs = [];
        if ( $fetch_testimonials_from === 'post_id' ) {
            // phpcs:ignore
            if ( wp_doing_ajax() && isset( $_POST['options'], $_POST['options']['current_page'], $_POST['options']['current_page']['id'] ) ) {
                // phpcs:ignore
                $fetch_testimonials_from = (int) $_POST['options']['current_page']['id'];
            }
            $shortcode_attrs['assigned_posts'] = $fetch_testimonials_from;
        } else {
            $shortcode_attrs['assigned_posts'] = $custom_ids;
        }
        if ( !$fetch_from_assigned_posts && isset( $shortcode_attrs['assigned_posts'] ) ) {
            unset($shortcode_attrs['assigned_posts']);
        }
        if ( $filter_by_categories && $categories ) {
            $shortcode_attrs['assigned_terms'] = ( is_array( $categories ) ? implode( ',', $categories ) : $categories );
        }
        if ( $assigned_users ) {
            $shortcode_attrs['assigned_users'] = $assigned_users;
        }
        $shortcode_attrs['display'] = $display;
        $shortcode_attrs['rating'] = $rating;
        $shortcode_attrs['fallback'] = $fallback;
        if ( $offset ) {
            $shortcode_attrs['offset'] = $offset;
        }
        $hide = [];
        if ( !$show_assigned_links ) {
            $hide[] = 'assigned_links';
        }
        if ( !$show_author ) {
            $hide[] = 'author';
        }
        if ( !$show_avatar ) {
            $hide[] = 'avatar';
        }
        if ( !$show_content ) {
            $hide[] = 'content';
        }
        if ( !$show_date ) {
            $hide[] = 'date';
        }
        if ( !$show_rating ) {
            $hide[] = 'rating';
        }
        if ( !$show_response ) {
            $hide[] = 'response';
        }
        if ( !$show_title ) {
            $hide[] = 'title';
        }
        $shortcode_attrs['hide'] = implode( ',', $hide );
        if ( $schema ) {
            $shortcode_attrs['schema'] = true;
        }
        $attributes_serialized = '';
        foreach ( $shortcode_attrs as $attr_name => $attr_value ) {
            $attributes_serialized .= sprintf( ' %s="%s"', $attr_name, $attr_value );
        }
        $shortcode = sprintf( '[site_reviews %s/]', $attributes_serialized );
        $html = do_shortcode( $shortcode, false );
        $html = str_replace( 'class="glsr-reviews-wrap"', 'class="glsr-reviews-wrap swiper"', $html );
        $html = str_replace( 'class="glsr-reviews"', 'class="glsr-reviews swiper-wrapper"', $html );
        $html = str_replace( 'class="glsr-review"', 'class="glsr-review swiper-slide"', $html );
        // STYLES
        $this->container['divi_testimonial_carousel_assets']->enqueue();
        // END STYLES
        ob_start();
        require $this->container['plugin_dir'] . '/resources/views/divi/modules/testimonials-carousel.php';
        return ob_get_clean();
    }

}
