<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialsList;

use WPT\WebsiteTestimonials\Divi\Modules\BaseModule;
class Module extends BaseModule {
    public $slug = 'et_pb_website_testimonials_list';

    public $icon_path;

    protected $module_credits = [
        'module_uri' => 'https://wptools.app/wordpress-plugin/divi-testimonial-plus-advanced-testimonial-grid-slider-form-and-seo-schema/?utm_source=grid-module&utm_medium=class&utm_campaign=divi-testimonials&utm_content=credits#pricing',
        'author'     => 'WP Tools (Get Risk-Free 7-Day FREE Trial)',
        'author_uri' => 'https://wptools.app/wordpress-plugin/divi-testimonial-plus-advanced-testimonial-grid-slider-form-and-seo-schema/?utm_source=grid-module&utm_medium=class&utm_campaign=divi-testimonials&utm_content=credits#pricing',
    ];

    /**
     * Initialize name and icons
     */
    public function init() {
        $this->name = esc_html__( 'Testimonial Grid', 'website-testimonials' );
        $this->icon_path = $this->container['plugin_dir'] . '/images/testimonials-list/icon.svg';
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
        $fetch_testimonials_from = $this->get_prop_value( 'fetch_testimonials_from', 'select' );
        $custom_ids = $this->get_prop_value( 'custom_ids', 'text' );
        $filter_by_categories = $this->get_prop_value( 'filter_by_categories', 'yes_no_button' );
        $categories = $this->get_prop_value( 'categories', 'categories' );
        $assigned_users = $this->get_prop_value( 'assigned_users', 'text' );
        $display = $this->get_prop_value( 'display', 'range' );
        $offset = $this->get_prop_value( 'offset', 'range' );
        $enable_pagination = $this->get_prop_value( 'enable_pagination', 'yes_no_button' );
        $pagination_method = $this->get_prop_value( 'pagination_method', 'select' );
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
        $grid_template_columns = $this->get_prop_value( 'grid_template_columns', 'text' );
        $show_beginning_quote_icon = $this->get_prop_value( 'show_beginning_quote_icon', 'yes_no_button' );
        $show_ending_quote_icon = $this->get_prop_value( 'show_ending_quote_icon', 'yes_no_button' );
        $fetch_from_assigned_posts = $this->get_prop_value( 'fetch_from_assigned_posts', 'yes_no_button' );
        // END PROP VALUES
        $this->props['beginning_quote_icon'] = $this->get_prop_value( 'beginning_quote_icon', 'text' );
        $this->props['ending_quote_icon'] = $this->get_prop_value( 'ending_quote_icon', 'text' );
        $this->add_classname( [$testimonial_layout] );
        if ( !wpt_dtp_fs()->is_premium() ) {
            $this->add_classname( ['is-free'] );
        }
        $shortcode_attrs = [];
        if ( $fetch_testimonials_from == 'post_id' ) {
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
        if ( $enable_pagination ) {
            $shortcode_attrs['pagination'] = $pagination_method;
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
        // END STYLES
        ob_start();
        require $this->container['plugin_dir'] . '/resources/views/divi/modules/testimonials-list.php';
        return ob_get_clean();
    }

}
