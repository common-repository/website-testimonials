<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialsCarousel;

/**
 * Module fields class
 */
class Fields {
    public $module;

    /**
     * Constructor
     */
    public function __construct( $module ) {
        $this->module = $module;
    }

    /**
     * Get all the fields
     */
    public function all() {
        if ( !isset( $this->module->margin_padding ) ) {
            $this->module->set_factory_objects();
        }
        $fields = [];
        $fields += $this->general_main_content();
        $fields += $this->general_testimonial_data();
        $fields += $this->general_seo_schema();
        $fields += $this->general_carousel_settings();
        // ALL FIELDS
        return $fields;
    }

    /**
     * Carousel Settings
     */
    public function general_carousel_settings() {
        $fields = [];
        $fields['effect'] = [
            'label'       => esc_html__( 'Effect', 'website-testimonials' ),
            'type'        => 'select',
            'options'     => [
                'slide'     => 'Slide',
                'coverflow' => 'Cover Flow',
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'carousel',
            'description' => esc_html__( 'Set the carousel effect to `Slide` or `Coverflow`', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'effect' ),
        ];
        $fields['slides_per_view'] = [
            'label'          => esc_html__( 'Slides Per View', 'website-testimonials' ),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 1,
                'max'  => 100,
                'step' => 1,
            ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'carousel',
            'description'    => esc_html__( 'Set the number of slides per view', 'website-testimonials' ),
            'show_if'        => [],
            'unitless'       => true,
            'mobile_options' => true,
            'allowed_units'  => [],
            'default_unit'   => '',
            'default'        => $this->get_default( 'slides_per_view' ),
        ];
        $fields['space_between'] = [
            'label'          => esc_html__( 'Space Between Slides', 'website-testimonials' ),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 1,
                'max'  => 200,
                'step' => 1,
            ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'carousel',
            'description'    => esc_html__( 'Set the space between slides (in pixels)', 'website-testimonials' ),
            'show_if'        => [],
            'unitless'       => true,
            'allowed_units'  => [],
            'default_unit'   => '',
            'default'        => $this->get_default( 'space_between' ),
        ];
        $fields['initial_slide'] = [
            'label'          => esc_html__( 'Initial Slide', 'website-testimonials' ),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 0,
                'max'  => 500,
                'step' => 1,
            ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'carousel',
            'description'    => esc_html__( 'Set the index number of the initial slide. First slide starts from 0', 'website-testimonials' ),
            'show_if'        => [],
            'allowed_units'  => [],
            'unitless'       => true,
            'mobile_options' => false,
            'default_unit'   => '',
            'default'        => $this->get_default( 'initial_slide' ),
        ];
        $fields['centered_slides'] = [
            'label'       => esc_html__( 'Centered Slides', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'carousel',
            'description' => esc_html__( 'When enabled, active slide will be centered.', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'centered_slides' ),
        ];
        $fields['enable_coverflow_slide_shadow'] = [
            'label'       => esc_html__( 'Enable Cover Flow Slide Shadow', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'carousel',
            'description' => esc_html__( 'Set `YES` to enable coverflow slide shadow', 'website-testimonials' ),
            'show_if'     => [
                'effect' => 'coverflow',
            ],
            'default'     => $this->get_default( 'enable_coverflow_slide_shadow' ),
        ];
        $fields['coverflow_shadow_color'] = [
            'label'        => esc_html__( 'Shadow Color', 'website-testimonials' ),
            'type'         => 'color-alpha',
            'custom_color' => true,
            'show_if'      => [
                'effect'                        => 'coverflow',
                'enable_coverflow_slide_shadow' => 'on',
            ],
            'default'      => $this->get_default( 'coverflow_shadow_color' ),
            'tab_slug'     => 'general',
            'toggle_slug'  => 'carousel',
            'description'  => esc_html__( 'Here you can select color for the Shadow.', 'website-testimonials' ),
        ];
        $fields['coverflow_rotate'] = [
            'label'           => esc_html__( 'Coverflow Rotate', 'website-testimonials' ),
            'type'            => 'range',
            'option_category' => 'font_option',
            'range_settings'  => [
                'min'  => '1',
                'max'  => '360',
                'step' => '1',
            ],
            'unitless'        => true,
            'show_if'         => [
                'effect' => 'coverflow',
            ],
            'default'         => $this->get_default( 'coverflow_rotate' ),
            'mobile_options'  => false,
            'tab_slug'        => 'general',
            'toggle_slug'     => 'carousel',
            'description'     => esc_html__( 'Coverflow Rotate Slide.', 'website-testimonials' ),
        ];
        $fields['coverflow_depth'] = [
            'label'           => esc_html__( 'Coverflow Depth', 'website-testimonials' ),
            'type'            => 'range',
            'option_category' => 'font_option',
            'range_settings'  => [
                'min'  => '1',
                'max'  => '1000',
                'step' => '1',
            ],
            'unitless'        => true,
            'show_if'         => [
                'effect' => 'coverflow',
            ],
            'default'         => $this->get_default( 'coverflow_depth' ),
            'mobile_options'  => false,
            'tab_slug'        => 'general',
            'toggle_slug'     => 'carousel',
            'description'     => esc_html__( 'Coverflow Depth Slide.', 'website-testimonials' ),
        ];
        $fields['slider_loop'] = [
            'label'           => esc_html__( 'Enable Loop', 'website-testimonials' ),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => [
                'on'  => esc_html__( 'Yes', 'website-testimonials' ),
                'off' => esc_html__( 'No', 'website-testimonials' ),
            ],
            'default'         => $this->get_default( 'slider_loop' ),
            'tab_slug'        => 'general',
            'toggle_slug'     => 'carousel',
            'description'     => esc_html__( 'Toggle to "Yes" to enable continuous loop mode', 'website-testimonials' ),
        ];
        $fields['autoplay'] = [
            'label'           => esc_html__( 'Autoplay', 'website-testimonials' ),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => [
                'on'  => esc_html__( 'Yes', 'website-testimonials' ),
                'off' => esc_html__( 'No', 'website-testimonials' ),
            ],
            'default'         => $this->get_default( 'autoplay' ),
            'tab_slug'        => 'general',
            'toggle_slug'     => 'carousel',
            'description'     => esc_html__( 'Toggle "Yes" to set autoplay for the carousel', 'website-testimonials' ),
        ];
        $fields['autoplay_speed'] = [
            'label'           => esc_html__( 'Autoplay Delay', 'website-testimonials' ),
            'type'            => 'range',
            'range_settings'  => [
                'min'  => '0',
                'max'  => '50000',
                'step' => '100',
            ],
            'option_category' => 'configuration',
            'default'         => $this->get_default( 'autoplay_speed' ),
            'show_if'         => [
                'autoplay' => 'on',
            ],
            'tab_slug'        => 'general',
            'toggle_slug'     => 'carousel',
            'unitless'        => true,
            'description'     => esc_html__( 'Delay between transitions (in ms)', 'website-testimonials' ),
        ];
        $fields['pause_on_hover'] = [
            'label'           => esc_html__( 'Pause On Hover', 'website-testimonials' ),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => [
                'on'  => esc_html__( 'Yes', 'website-testimonials' ),
                'off' => esc_html__( 'No', 'website-testimonials' ),
            ],
            'default'         => $this->get_default( 'pause_on_hover' ),
            'show_if'         => [
                'autoplay' => 'on',
            ],
            'tab_slug'        => 'general',
            'toggle_slug'     => 'carousel',
            'description'     => esc_html__( 'Toggle "Yes" to pause the carousel slide on mouse hover.', 'website-testimonials' ),
        ];
        $fields['slide_transition_duration'] = [
            'label'           => esc_html__( 'Transition Duration', 'website-testimonials' ),
            'type'            => 'range',
            'range_settings'  => [
                'min'  => '0',
                'max'  => '5000',
                'step' => '100',
            ],
            'option_category' => 'configuration',
            'default'         => $this->get_default( 'slide_transition_duration' ),
            'tab_slug'        => 'general',
            'toggle_slug'     => 'carousel',
            'unitless'        => true,
            'description'     => esc_html__( 'Duration of transition between slides (in ms)', 'website-testimonials' ),
        ];
        $fields['show_arrow'] = [
            'label'            => esc_html__( 'Show Arrows', 'website-testimonials' ),
            'type'             => 'yes_no_button',
            'option_category'  => 'configuration',
            'options'          => [
                'on'  => esc_html__( 'Yes', 'website-testimonials' ),
                'off' => esc_html__( 'No', 'website-testimonials' ),
            ],
            'default'          => $this->get_default( 'show_arrow' ),
            'default_on_front' => $this->get_default( 'show_arrow' ),
            'tab_slug'         => 'general',
            'toggle_slug'      => 'carousel',
            'description'      => esc_html__( 'Toggle "Yes" to show the previous and next arrow navigation elements.', 'website-testimonials' ),
        ];
        $fields['show_arrow_on_hover'] = [
            'label'            => esc_html__( 'Show Arrows On Hover', 'website-testimonials' ),
            'type'             => 'yes_no_button',
            'option_category'  => 'configuration',
            'options'          => [
                'on'  => esc_html__( 'Yes', 'website-testimonials' ),
                'off' => esc_html__( 'No', 'website-testimonials' ),
            ],
            'show_if'          => [
                'show_arrow' => 'on',
            ],
            'default'          => $this->get_default( 'show_arrow_on_hover' ),
            'default_on_front' => $this->get_default( 'show_arrow_on_hover' ),
            'tab_slug'         => 'general',
            'toggle_slug'      => 'carousel',
            'description'      => esc_html__( 'Toggle "Yes" to show arrow navigation on hover', 'website-testimonials' ),
        ];
        $fields['show_control_dot'] = [
            'label'            => esc_html__( 'Show Dots Pagination', 'website-testimonials' ),
            'type'             => 'yes_no_button',
            'option_category'  => 'configuration',
            'options'          => [
                'on'  => esc_html__( 'Yes', 'website-testimonials' ),
                'off' => esc_html__( 'No', 'website-testimonials' ),
            ],
            'default'          => $this->get_default( 'show_control_dot' ),
            'default_on_front' => $this->get_default( 'show_control_dot' ),
            'tab_slug'         => 'general',
            'toggle_slug'      => 'carousel',
            'description'      => esc_html__( 'Toggle "Yes" to show dot navigation.', 'website-testimonials' ),
        ];
        return $fields;
    }

    /**
     * General main content fields
     */
    public function general_main_content() {
        $fields = [];
        $fields['fetch_from_assigned_posts'] = [
            'label'       => esc_html__( 'Fetch From Assigned Posts', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'Off', 'website-testimonials' ),
                'on'  => esc_html__( 'On', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Fetch testimonials assigned to posts', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'fetch_from_assigned_posts' ),
        ];
        $fields['fetch_testimonials_from'] = [
            'label'       => esc_html__( 'Fetch Testimonials From', 'website-testimonials' ),
            'type'        => 'select',
            'options'     => [
                'post_id'    => 'Current Page',
                'custom_ids' => 'Custom Pages',
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Set the page(s) to fetch the testimonials from.', 'website-testimonials' ),
            'show_if'     => [
                'fetch_from_assigned_posts' => 'on',
            ],
            'default'     => $this->get_default( 'fetch_testimonials_from' ),
        ];
        $fields['custom_ids'] = [
            'label'       => esc_html__( 'Custom Page IDs (comma-separated)', 'website-testimonials' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Add comma-separated page ids', 'website-testimonials' ),
            'show_if'     => [
                'fetch_from_assigned_posts' => 'on',
                'fetch_testimonials_from'   => 'custom_ids',
            ],
            'default'     => $this->get_default( 'custom_ids' ),
        ];
        $fields['filter_by_categories'] = [
            'label'       => esc_html__( 'Filter By Categories', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Select `Yes` to filter testimonials by categories', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'filter_by_categories' ),
        ];
        $fields['categories'] = [
            'label'            => esc_html__( 'Categories', 'website-testimonials' ),
            'type'             => 'categories',
            'post_type'        => 'site-review',
            'taxonomy_name'    => 'site-review-category',
            'renderer_options' => [
                'use_terms' => false,
            ],
            'tab_slug'         => 'general',
            'toggle_slug'      => 'main_content',
            'description'      => esc_html__( 'Select one or more categories', 'website-testimonials' ),
            'show_if'          => [
                'filter_by_categories' => 'on',
            ],
            'default'          => $this->get_default( 'categories' ),
        ];
        $fields['assigned_users'] = [
            'label'       => esc_html__( 'Assigned Users', 'website-testimonials' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Limit reviews to those assigned to specific users. Comma-separated user IDs', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'assigned_users' ),
        ];
        $fields['rating'] = [
            'label'          => esc_html__( 'Minimum Star Rating', 'website-testimonials' ),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 1,
                'max'  => 5,
                'step' => 1,
            ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'main_content',
            'description'    => esc_html__( 'Set the minimum star-rating of the testimonials to display', 'website-testimonials' ),
            'show_if'        => [],
            'allowed_units'  => [''],
            'default_unit'   => '',
            'validate_unit'  => true,
            'default'        => $this->get_default( 'rating' ),
        ];
        $fields['display'] = [
            'label'          => esc_html__( 'Number Of Reviews To Display', 'website-testimonials' ),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 1,
                'max'  => 400,
                'step' => 1,
            ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'main_content',
            'description'    => esc_html__( 'Select the number of reviews to display on the page.', 'website-testimonials' ),
            'show_if'        => [],
            'allowed_units'  => [''],
            'default_unit'   => '',
            'validate_unit'  => true,
            'default'        => $this->get_default( 'display' ),
        ];
        $fields['offset'] = [
            'label'          => esc_html__( 'Skip Testimonials - Offset', 'website-testimonials' ),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 0,
                'max'  => 500,
                'step' => 1,
            ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'main_content',
            'description'    => esc_html__( 'Select the number of reviews to skip. Its NOT recommended to use this option with pagination', 'website-testimonials' ),
            'show_if'        => [],
            'allowed_units'  => [''],
            'default_unit'   => '',
            'validate_unit'  => true,
            'default'        => $this->get_default( 'offset' ),
        ];
        return $fields;
    }

    /**
     * General testimonial data fields
     */
    public function general_testimonial_data() {
        $fields = [];
        $fields['show_assigned_links'] = [
            'label'       => esc_html__( 'Show Assigned Links', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Show links of the page to which the testimonials belong.', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_assigned_links' ),
        ];
        $fields['show_author'] = [
            'label'       => esc_html__( 'Show Author', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Select `YES` to show the author assigned to the review', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_author' ),
        ];
        $fields['show_avatar'] = [
            'label'       => esc_html__( 'Show Avatar', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Show the image of the reviewer', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_avatar' ),
        ];
        $fields['show_content'] = [
            'label'       => esc_html__( 'Show Content', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Show the testimonial content (Long review)', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_content' ),
        ];
        $fields['show_date'] = [
            'label'       => esc_html__( 'Show Date', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Show testimonial date', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_date' ),
        ];
        $fields['show_rating'] = [
            'label'       => esc_html__( 'Show Rating', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Show the rating stars for the testimonials.', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_rating' ),
        ];
        $fields['show_title'] = [
            'label'       => esc_html__( 'Show Title', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Show the title of the testimonial', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_title' ),
        ];
        $fields['fallback'] = [
            'label'       => esc_html__( 'Fallback Text', 'website-testimonials' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Fallback text when no testimonials exists.', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'fallback' ),
        ];
        return $fields;
    }

    /**
     * General SEO Schema Fields
     */
    public function general_seo_schema() {
        $fields = [];
        $fields['schema'] = [
            'label'       => esc_html__( 'Include SEO Schema?', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'seo',
            'description' => esc_html__( 'Select `Yes` to include SEO schema', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'schema' ),
        ];
        return $fields;
    }

    // START TOGGLE FUNCTIONS
    // END TOGGLE FUNCTIONS
    /**
     * Get selector
     */
    public function get_selector( $key ) {
        $selectors = $this->get_selectors();
        return $selectors[$key]['selector'];
    }

    /**
     * List of selectors
     */
    public function get_selectors() {
        return [
            'main'                                 => [
                'selector' => '%%order_class%%',
                'label'    => esc_html__( 'Module Container', 'website-testimonials' ),
            ],
            'reviews_wrap'                         => [
                'selector' => '%%order_class%% .glsr-default .glsr-reviews-wrap',
                'label'    => esc_html__( 'Testimonials Container', 'website-testimonials' ),
            ],
            'reviews'                              => [
                'selector' => '%%order_class%% .glsr-default .glsr-reviews',
                'label'    => esc_html__( 'Testimonials', 'website-testimonials' ),
            ],
            'review_item'                          => [
                'selector' => '%%order_class%% .glsr-default .glsr-reviews .glsr-review',
                'label'    => esc_html__( 'Testimonial Item', 'website-testimonials' ),
            ],
            'review_item_hover'                    => [
                'selector' => '%%order_class%% .glsr-default .glsr-reviews .glsr-review:hover',
                'label'    => esc_html__( 'Testimonial Item', 'website-testimonials' ),
            ],
            'review_title_container'               => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-title',
                'label'    => esc_html__( 'Testimonial Title Container', 'website-testimonials' ),
            ],
            'review_title'                         => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-title .glsr-tag-value',
                'label'    => esc_html__( 'Testimonial Title', 'website-testimonials' ),
            ],
            'review_avatar'                        => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-avatar img',
                'label'    => esc_html__( 'Testimonial Avatar Image', 'website-testimonials' ),
            ],
            'review_avatar_wrapper'                => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-avatar',
                'label'    => esc_html__( 'Testimonial Avatar Wrapper', 'website-testimonials' ),
            ],
            'review_avatar_wrapper_before'         => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-avatar::before',
                'label'    => esc_html__( 'Testimonial Avatar Wrapper :: Before', 'website-testimonials' ),
            ],
            'review_assigned_links_text'           => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-assigned_links',
                'label'    => esc_html__( 'Testimonial Assigned Links Text', 'website-testimonials' ),
            ],
            'review_assigned_links'                => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-assigned_links a',
                'label'    => esc_html__( 'Testimonial Assigned Link', 'website-testimonials' ),
            ],
            'review_content_main'                  => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-content .glsr-tag-value',
                'label'    => esc_html__( 'Testimonial Content Main', 'website-testimonials' ),
            ],
            'review_content'                       => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-content .glsr-tag-value, %%order_class%% .glsr-default .glsr-review-content .glsr-tag-value p',
                'label'    => esc_html__( 'Testimonial Content', 'website-testimonials' ),
            ],
            'review_content_wrapper'               => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-content',
                'label'    => esc_html__( 'Testimonial Content Wrapper', 'website-testimonials' ),
            ],
            'review_content_wrapper_hover'         => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-content:hover',
                'label'    => esc_html__( 'Testimonial Content Wrapper', 'website-testimonials' ),
            ],
            'review_content_wrapper_before'        => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-content::before',
                'label'    => esc_html__( 'Testimonial Content Wrapper :: Before', 'website-testimonials' ),
            ],
            'review_content_wrapper_after'         => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-content::after',
                'label'    => esc_html__( 'Testimonial Content Wrapper :: After', 'website-testimonials' ),
            ],
            'review_date_wrapper'                  => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-date',
                'label'    => esc_html__( 'Testimonial Date', 'website-testimonials' ),
            ],
            'review_date'                          => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-date .glsr-tag-value',
                'label'    => esc_html__( 'Testimonial Date', 'website-testimonials' ),
            ],
            'review_author_wrapper'                => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-author',
                'label'    => esc_html__( 'Author Name Wrapper', 'website-testimonials' ),
            ],
            'review_author'                        => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-author .glsr-tag-value',
                'label'    => esc_html__( 'Author Name', 'website-testimonials' ),
            ],
            'review_response_container'            => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-response',
                'label'    => esc_html__( 'Review Response Container', 'website-testimonials' ),
            ],
            'review_response_text'                 => [
                'selector' => '%%order_class%% .glsr-default .glsr-review-response .glsr-tag-value .glsr-review-response-inner',
                'label'    => esc_html__( 'Review Response Text', 'website-testimonials' ),
            ],
            'review_response_background_before'    => [
                'selector' => '%%order_class%% .glsr-default .glsr-reviews-wrap .glsr-reviews .glsr-review .glsr-review-response:before',
                'label'    => esc_html__( 'Review Response Background (Before)', 'website-testimonials' ),
            ],
            'review_response_background_after'     => [
                'selector' => '%%order_class%% .glsr-default .glsr-reviews-wrap .glsr-reviews .glsr-review .glsr-review-response:after',
                'label'    => esc_html__( 'Review Response Background (After)', 'website-testimonials' ),
            ],
            'full_star'                            => [
                'selector' => '%%order_class%% .gl-star-rating-stars.s10>span:first-child, %%order_class%% .gl-star-rating-stars.s20>span:nth-child(-1n+2), %%order_class%% .gl-star-rating-stars.s30>span:nth-child(-1n+3), %%order_class%% .gl-star-rating-stars.s40>span:nth-child(-1n+4), %%order_class%% .gl-star-rating-stars.s50>span:nth-child(-1n+5), %%order_class%% .gl-star-rating-stars.s60>span:nth-child(-1n+6), %%order_class%% .gl-star-rating-stars.s70>span:nth-child(-1n+7), %%order_class%% .gl-star-rating-stars.s80>span:nth-child(-1n+8), %%order_class%% .gl-star-rating-stars.s90>span:nth-child(-1n+9), %%order_class%% .gl-star-rating-stars.s100>span, %%order_class%% .glsr-star-full',
                'label'    => esc_html__( 'Full Star', 'website-testimonials' ),
            ],
            'empty_star'                           => [
                'selector' => '%%order_class%% .glsr-star-empty',
                'label'    => esc_html__( 'Empty Star', 'website-testimonials' ),
            ],
            'stars_wrapper'                        => [
                'selector' => '%%order_class%% .glsr-review-rating',
                'label'    => esc_html__( 'Stars Wrapper', 'website-testimonials' ),
            ],
            'stars'                                => [
                'selector' => '%%order_class%% .glsr-stars',
                'label'    => esc_html__( 'Stars', 'website-testimonials' ),
            ],
            'star'                                 => [
                'selector' => '%%order_class%% .glsr-default .glsr-star',
                'label'    => esc_html__( 'Star', 'website-testimonials' ),
            ],
            'swiper_container'                     => [
                'selector' => '%%order_class%%  .swiper-container',
                'label'    => 'Swiper Container',
            ],
            'slide'                                => [
                'selector' => '%%order_class%% .swiper-slide',
                'label'    => 'Slide',
            ],
            'slide_hover'                          => [
                'selector' => '%%order_class%% .swiper-slide:hover',
                'label'    => 'Slide - Hover',
            ],
            'card_wrapper'                         => [
                'selector' => '%%order_class%% .wpt-image-card-wrapper',
                'label'    => 'Card Wrapper',
            ],
            'coverflow_slide_shadow_left'          => [
                'selector' => "%%order_class%% .swiper-container-3d[data-effect='coverflow'] .swiper-slide-shadow-left",
                'label'    => 'Coverflow Effect - Slide Shadow Left',
            ],
            'coverflow_slide_shadow_right'         => [
                'selector' => "%%order_class%% .swiper-container-3d[data-effect='coverflow'] .swiper-slide-shadow-right",
                'label'    => 'Coverflow Effect - Slide Shadow Right',
            ],
            'arrow_container'                      => [
                'selector' => '%%order_class%% .swiper-buttton-container',
                'label'    => esc_html__( 'Arrow Container', 'website-testimonials' ),
            ],
            'arrow_prev'                           => [
                'selector' => '%%order_class%% .wpt-testimonials-carousel-inner .swiper-buttton-container .swiper-button-prev',
                'label'    => 'Prev Arrow',
            ],
            'arrow_next'                           => [
                'selector' => '%%order_class%% .wpt-testimonials-carousel-inner .swiper-buttton-container .swiper-button-next',
                'label'    => 'Next Arrow',
            ],
            'arrow_nav'                            => [
                'selector' => '%%order_class%% .wpt-testimonials-carousel-inner .swiper-buttton-container .swiper-nav',
                'label'    => 'Arrow Nav - Prev & Next',
            ],
            'arrow_nav_hover'                      => [
                'selector' => '%%order_class%% .swiper-nav:hover',
                'label'    => '[Hover] Arrow Nav - Prev & Next',
            ],
            'pagination_container'                 => [
                'selector' => '%%order_class%% .swiper-pagination',
                'label'    => 'Pagination Wrapper',
            ],
            'pagination_bullet'                    => [
                'selector' => '%%order_class%% .swiper-pagination-bullet',
                'label'    => 'Pagination Bullet',
            ],
            'pagination_bullet_active'             => [
                'selector' => '%%order_class%% .swiper-pagination-bullet.swiper-pagination-bullet-active',
                'label'    => 'Pagination Bullet - Active',
            ],
            'pagination_bullet_inactive'           => [
                'selector' => '%%order_class%% .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)',
                'label'    => 'Pagination Bullet - Inactive',
            ],
            'grid_review_container'                => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review',
                'label'    => esc_html__( '[Grid] Title Container', 'website-testimonials' ),
            ],
            'grid_review_title_container'          => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review-title',
                'label'    => esc_html__( '[Grid] Title Container', 'website-testimonials' ),
            ],
            'grid_review_assigned_links_container' => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review-assigned_links',
                'label'    => esc_html__( '[Grid] Assigned Links Container', 'website-testimonials' ),
            ],
            'grid_review_stars_container'          => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review-rating',
                'label'    => esc_html__( '[Grid] Stars Container', 'website-testimonials' ),
            ],
            'grid_review_date_container'           => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review-date',
                'label'    => esc_html__( '[Grid]  Container', 'website-testimonials' ),
            ],
            'grid_review_content_container'        => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review-content',
                'label'    => esc_html__( '[Grid] Content Container', 'website-testimonials' ),
            ],
            'grid_review_response_container'       => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review-response',
                'label'    => esc_html__( '[Grid] Response Container', 'website-testimonials' ),
            ],
            'grid_review_avatar_container'         => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review-avatar',
                'label'    => esc_html__( '[Grid] Avatar Container', 'website-testimonials' ),
            ],
            'grid_review_author_container'         => [
                'selector' => '%%order_class%%.wpt_grid .glsr-default .glsr-review-author',
                'label'    => esc_html__( '[Grid] Author Container', 'website-testimonials' ),
            ],
        ];
    }

    /**
     * Get default for given keys
     */
    public function get_default( $key ) {
        $defaults = $this->get_defaults();
        return ( isset( $defaults[$key] ) ? $defaults[$key] : '' );
    }

    /**
     * Get defaults
     */
    public function get_defaults() {
        $defaults = [
            'fetch_from_assigned_posts'           => 'on',
            'grid_template_columns'               => '1fr',
            'grid_column_gap'                     => '10px',
            'grid_row_gap'                        => '10px',
            'title_row_start'                     => 1,
            'title_row_end'                       => 1,
            'title_column_start'                  => 1,
            'title_column_end'                    => 1,
            'stars_row_start'                     => 2,
            'stars_row_end'                       => 2,
            'stars_column_start'                  => 1,
            'stars_column_end'                    => 1,
            'assigned_links_row_start'            => 3,
            'assigned_links_row_end'              => 3,
            'assigned_links_column_start'         => 1,
            'assigned_links_column_end'           => 1,
            'date_row_start'                      => 4,
            'date_row_end'                        => 4,
            'date_column_start'                   => 1,
            'date_column_end'                     => 1,
            'content_row_start'                   => 5,
            'content_row_end'                     => 5,
            'content_column_start'                => 1,
            'content_column_end'                  => 1,
            'response_row_start'                  => 6,
            'response_row_end'                    => 6,
            'response_column_start'               => 1,
            'response_column_end'                 => 1,
            'avatar_row_start'                    => 7,
            'avatar_row_end'                      => 7,
            'avatar_column_start'                 => 1,
            'avatar_column_end'                   => 1,
            'author_row_start'                    => 8,
            'author_row_end'                      => 8,
            'author_column_start'                 => 1,
            'author_column_end'                   => 1,
            'arrow_top_position'                  => '45%',
            'stars_justify_content'               => 'center',
            'beginning_quote_icon_custom_margin'  => '0|0|5px|0|false|false',
            'beginning_quote_icon_alignment'      => 'center',
            'beginning_quote_icon_color'          => '#8b8b8b',
            'beginning_quote_icon_bg'             => '',
            'beginning_quote_icon'                => '&#xf10d;||fa||900',
            'ending_quote_icon_size'              => '22px',
            'show_beginning_quote_icon'           => 'off',
            'show_ending_quote_icon'              => 'off',
            'ending_quote_icon'                   => '&#xf10e;||fa||900',
            'ending_quote_icon_custom_margin'     => '5px|0|0|0|false|false',
            'ending_quote_icon_alignment'         => 'center',
            'ending_quote_icon_color'             => '#8b8b8b',
            'ending_quote_icon_bg'                => '',
            'beginning_quote_icon_size'           => '22px',
            'review_item_custom_padding'          => '20px|20px|20px|20px|true|true',
            'align_avatar'                        => 'center',
            'title_order'                         => 1,
            'star_order'                          => 2,
            'date_order'                          => 3,
            'assigned_links_order'                => 4,
            'content_order'                       => 5,
            'avatar_order'                        => 6,
            'author_name_order'                   => 7,
            'review_avatar_image_size'            => '80px',
            'review_assigned_links_color'         => '#007aff',
            'control_dot_active_color'            => '#000000',
            'control_dot_inactive_color'          => '#cccccc',
            'arrow_prev_custom_margin'            => '||||false|false',
            'arrow_next_custom_margin'            => '||||false|false',
            'effect'                              => 'slide',
            'space_between'                       => '20',
            'slides_per_view'                     => 3,
            'enable_coverflow_slide_shadow'       => 'off',
            'coverflow_shadow_color'              => '#cccccc',
            'coverflow_rotate'                    => 40,
            'initial_slide'                       => '0',
            'centered_slides'                     => 'off',
            'coverflow_depth'                     => 100,
            'slider_loop'                         => 'off',
            'autoplay'                            => 'off',
            'autoplay_speed'                      => 3000,
            'pause_on_hover'                      => 'on',
            'slide_transition_duration'           => 1000,
            'show_arrow'                          => 'on',
            'show_arrow_on_hover'                 => 'off',
            'show_control_dot'                    => 'on',
            'arrow_font_size'                     => '44px',
            'arrow_color'                         => '#000000',
            'arrow_background'                    => '#ffffff',
            'arrow_position'                      => 'outside',
            'pagination_position'                 => 'center',
            'pagination_bullets_custom_margin'    => '0|8px|0|0|false|false',
            'pagination_bullets_gap'              => '4px',
            'dot_pagination_width'                => '7px',
            'dot_pagination_height'               => '7px',
            'change_active_dot_dimensions'        => 'off',
            'active_dot_pagination_width'         => '7px',
            'active_dot_pagination_height'        => '7px',
            'dot_nav_border_radius'               => '50%',
            'inactive_dot_opacity'                => '0.2',
            'swiper_container_custom_margin'      => '0|0|0|0|true|true',
            'swiper_container_custom_padding'     => '0|0|0|0|true|true',
            'pagination_container_custom_padding' => '0|0|0|0|false|false',
            'pagination_container_custom_margin'  => '20px|0|0|0|false|false',
            'equalize_height'                     => 'on',
            'content_vertical_alignment'          => 'end',
            'overlay_content_over_image'          => 'off',
            'content_visiblity'                   => 'always',
            'content_custom_padding'              => '20px|20px|20px|20px|true|true',
            'review_justify_content'              => 'center',
            'star_size'                           => '1.25em',
            'star_color'                          => '#FFB900',
            'review_response_background'          => '#666666',
            'schema'                              => 'off',
            'fallback'                            => 'No testimonials found.',
            'show_title'                          => 'on',
            'show_rating'                         => 'on',
            'show_date'                           => 'off',
            'show_content'                        => 'on',
            'show_avatar'                         => 'on',
            'show_author'                         => 'on',
            'show_assigned_links'                 => 'off',
            'rating'                              => '1',
            'assigned_users'                      => '',
            'offset'                              => '0',
            'display'                             => '5',
            'categories'                          => '',
            'custom_ids'                          => '',
            'filter_by_categories'                => 'off',
            'fetch_testimonials_from'             => 'post_id',
            'testimonial_layout'                  => 'wpt_flexbox_column',
        ];
        return $defaults;
    }

}
