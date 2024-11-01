<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialsList;

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
        $fields = [];
        if ( !isset( $this->module->margin_padding ) ) {
            $this->module->set_factory_objects();
        }
        $fields += $this->general_main_content();
        $fields += $this->general_testimonial_data();
        $fields += $this->general_seo_schema();
        // ALL FIELDS
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
        $fields['enable_pagination'] = [
            'label'       => esc_html__( 'Enable Pagination?', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Select `Yes` to enable pagination', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'enable_pagination' ),
        ];
        $fields['pagination_method'] = [
            'label'       => esc_html__( 'Pagination Content Load Method', 'website-testimonials' ),
            'type'        => 'select',
            'options'     => [
                'ajax'     => 'Ajax',
                'true'     => 'Page Reload',
                'loadmore' => 'Load More',
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Select the method to load the content of testimonial on pagination link clicks. Select `Ajax` to load content without refreshing the page, `Page Reload` to load the page OR `Load More` to append additional testimonials via ajax', 'website-testimonials' ),
            'show_if'     => [
                'enable_pagination' => 'on',
            ],
            'default'     => $this->get_default( 'pagination_method' ),
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
        $fields['show_response'] = [
            'label'       => esc_html__( 'Show Response', 'website-testimonials' ),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__( 'NO', 'website-testimonials' ),
                'on'  => esc_html__( 'YES', 'website-testimonials' ),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'testimonial_data',
            'description' => esc_html__( 'Show your response text to the testimonial', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_response' ),
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

    /**
     * Get selector
     */
    public function get_selector( $key ) {
        $selectors = $this->get_selectors();
        if ( isset( $selectors[$key] ) ) {
            return $selectors[$key]['selector'];
        }
        return false;
    }

    /**
     * List of selectors
     */
    public function get_selectors() {
        return [
            'reviews_wrap'                         => [
                'selector' => "%%order_class%% .glsr-default .glsr-reviews-wrap",
                'label'    => esc_html__( 'Testimonials Container', 'website-testimonials' ),
            ],
            'reviews'                              => [
                'selector' => "%%order_class%% .glsr-default .glsr-reviews",
                'label'    => esc_html__( 'Testimonials', 'website-testimonials' ),
            ],
            'review_item'                          => [
                'selector' => "%%order_class%% .glsr-default .glsr-reviews .glsr-review",
                'label'    => esc_html__( 'Testimonial Item', 'website-testimonials' ),
            ],
            'review_item_hover'                    => [
                'selector' => "%%order_class%% .glsr-default .glsr-reviews .glsr-review:hover",
                'label'    => esc_html__( 'Testimonial Item', 'website-testimonials' ),
            ],
            'review_title_container'               => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-title",
                'label'    => esc_html__( 'Testimonial Title Container', 'website-testimonials' ),
            ],
            'review_title'                         => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-title .glsr-tag-value",
                'label'    => esc_html__( 'Testimonial Title', 'website-testimonials' ),
            ],
            'review_avatar_wrapper'                => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-avatar",
                'label'    => esc_html__( 'Testimonial Avatar Wrapper', 'website-testimonials' ),
            ],
            'review_avatar_wrapper_before'         => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-avatar::before",
                'label'    => esc_html__( 'Testimonial Avatar Wrapper :: Before', 'website-testimonials' ),
            ],
            'review_avatar'                        => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-avatar img",
                'label'    => esc_html__( 'Testimonial Avatar Image', 'website-testimonials' ),
            ],
            'review_assigned_links_text'           => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-assigned_links",
                'label'    => esc_html__( 'Testimonial Assigned Links Text', 'website-testimonials' ),
            ],
            'review_assigned_links'                => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-assigned_links a",
                'label'    => esc_html__( 'Testimonial Assigned Link', 'website-testimonials' ),
            ],
            'review_content_wrapper'               => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-content",
                'label'    => esc_html__( 'Testimonial Content Wrapper', 'website-testimonials' ),
            ],
            'review_content_wrapper_hover'         => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-content:hover",
                'label'    => esc_html__( 'Testimonial Content Wrapper', 'website-testimonials' ),
            ],
            'review_content_wrapper_before'        => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-content::before",
                'label'    => esc_html__( 'Testimonial Content Wrapper :: Before', 'website-testimonials' ),
            ],
            'review_content_wrapper_after'         => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-content::after",
                'label'    => esc_html__( 'Testimonial Content Wrapper :: After', 'website-testimonials' ),
            ],
            'review_content_main'                  => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-content .glsr-tag-value",
                'label'    => esc_html__( 'Testimonial Content Main', 'website-testimonials' ),
            ],
            'review_content'                       => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-content .glsr-tag-value, %%order_class%% .glsr-default .glsr-review-content .glsr-tag-value p",
                'label'    => esc_html__( 'Testimonial Content & Para Tag', 'website-testimonials' ),
            ],
            'review_author_wrapper'                => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-author",
                'label'    => esc_html__( 'Author Name Wrapper', 'website-testimonials' ),
            ],
            'review_date_wrapper'                  => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-date",
                'label'    => esc_html__( 'Testimonial Date', 'website-testimonials' ),
            ],
            'review_date'                          => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-date .glsr-tag-value",
                'label'    => esc_html__( 'Testimonial Date', 'website-testimonials' ),
            ],
            'review_author'                        => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-author .glsr-tag-value",
                'label'    => esc_html__( 'Author Name', 'website-testimonials' ),
            ],
            'review_response_container'            => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-response",
                'label'    => esc_html__( 'Review Response Container', 'website-testimonials' ),
            ],
            'review_response_text'                 => [
                'selector' => "%%order_class%% .glsr-default .glsr-review-response .glsr-tag-value .glsr-review-response-inner",
                'label'    => esc_html__( 'Review Response Text', 'website-testimonials' ),
            ],
            'review_response_background_before'    => [
                'selector' => "%%order_class%% .glsr-default .glsr-reviews-wrap .glsr-reviews .glsr-review .glsr-review-response:before",
                'label'    => esc_html__( 'Review Response Background (Before)', 'website-testimonials' ),
            ],
            'review_response_background_after'     => [
                'selector' => "%%order_class%% .glsr-default .glsr-reviews-wrap .glsr-reviews .glsr-review .glsr-review-response:after",
                'label'    => esc_html__( 'Review Response Background (After)', 'website-testimonials' ),
            ],
            'pagination_container'                 => [
                'selector' => "%%order_class%% .glsr-pagination",
                'label'    => esc_html__( 'Pagination Container', 'website-testimonials' ),
            ],
            'pagination_nav_link'                  => [
                'selector' => "%%order_class%% .glsr-pagination .nav-links a",
                'label'    => esc_html__( 'Pagination Nav Link - Page Numbers, Next & Previous', 'website-testimonials' ),
            ],
            'button_container'                     => [
                'selector' => "%%order_class%% .glsr-default .glsr-reviews-wrap .glsr-pagination .wp-block-button",
                'label'    => esc_html__( 'Button Container', 'website-testimonials' ),
            ],
            'load_more_button'                     => [
                'selector' => "%%order_class%% .glsr-pagination .glsr-button-loadmore",
                'label'    => esc_html__( 'Button - Load More', 'website-testimonials' ),
            ],
            'pagination_current_nav'               => [
                'selector' => "%%order_class%% .nav-links span.page-numbers.current",
                'label'    => esc_html__( 'Pagination - Active Page Number', 'website-testimonials' ),
            ],
            'pagination_dots'                      => [
                'selector' => "%%order_class%% .nav-links span.page-numbers.dots",
                'label'    => esc_html__( 'Pagination - Dots', 'website-testimonials' ),
            ],
            'page_numbers'                         => [
                'selector' => "%%order_class%% .nav-links a.page-numbers",
                'label'    => esc_html__( 'Page Numbers', 'website-testimonials' ),
            ],
            'pagination_next'                      => [
                'selector' => "%%order_class%% .nav-links a.page-numbers.next",
                'label'    => esc_html__( 'Pagination Next Link', 'website-testimonials' ),
            ],
            'pagination_prev'                      => [
                'selector' => "%%order_class%% .nav-links a.page-numbers.prev",
                'label'    => esc_html__( 'Pagination Previous Link', 'website-testimonials' ),
            ],
            'full_star'                            => [
                'selector' => "%%order_class%% .glsr-stars.s10>span:first-child, %%order_class%% .glsr-stars.s20>span:nth-child(-1n+2), %%order_class%% .glsr-stars.s30>span:nth-child(-1n+3), %%order_class%% .glsr-stars.s40>span:nth-child(-1n+4), %%order_class%% .glsr-stars.s50>span:nth-child(-1n+5), %%order_class%% .glsr-stars.s60>span:nth-child(-1n+6), %%order_class%% .glsr-stars.s70>span:nth-child(-1n+7), %%order_class%% .glsr-stars.s80>span:nth-child(-1n+8), %%order_class%% .glsr-stars.s90>span:nth-child(-1n+9), %%order_class%% .glsr-stars.s100>span, %%order_class%% .glsr-star-full",
                'label'    => esc_html__( 'Full Star', 'website-testimonials' ),
            ],
            'stars_wrapper'                        => [
                'selector' => "%%order_class%% .glsr-review-rating",
                'label'    => esc_html__( 'Stars Wrapper', 'website-testimonials' ),
            ],
            'empty_star'                           => [
                'selector' => "%%order_class%% .glsr-star-empty",
                'label'    => esc_html__( 'Empty Star', 'website-testimonials' ),
            ],
            'stars'                                => [
                'selector' => "%%order_class%% .glsr-stars",
                'label'    => esc_html__( 'Stars', 'website-testimonials' ),
            ],
            'star'                                 => [
                'selector' => "%%order_class%% .glsr-default .glsr-star",
                'label'    => esc_html__( 'Star', 'website-testimonials' ),
            ],
            'grid_review_container'                => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review",
                'label'    => esc_html__( '[Grid] Title Container', 'website-testimonials' ),
            ],
            'grid_review_title_container'          => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review-title",
                'label'    => esc_html__( '[Grid] Title Container', 'website-testimonials' ),
            ],
            'grid_review_assigned_links_container' => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review-assigned_links",
                'label'    => esc_html__( '[Grid] Assigned Links Container', 'website-testimonials' ),
            ],
            'grid_review_stars_container'          => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review-rating",
                'label'    => esc_html__( '[Grid] Stars Container', 'website-testimonials' ),
            ],
            'grid_review_date_container'           => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review-date",
                'label'    => esc_html__( '[Grid]  Container', 'website-testimonials' ),
            ],
            'grid_review_content_container'        => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review-content",
                'label'    => esc_html__( '[Grid] Content Container', 'website-testimonials' ),
            ],
            'grid_review_response_container'       => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review-response",
                'label'    => esc_html__( '[Grid] Response Container', 'website-testimonials' ),
            ],
            'grid_review_avatar_container'         => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review-avatar",
                'label'    => esc_html__( '[Grid] Avatar Container', 'website-testimonials' ),
            ],
            'grid_review_author_container'         => [
                'selector' => "%%order_class%%.wpt_grid .glsr-default .glsr-review-author",
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
            'fetch_from_assigned_posts'          => 'on',
            'grid_column_gap'                    => '10px',
            'grid_row_gap'                       => '10px',
            'beginning_quote_icon_custom_margin' => '0|0|5px|0|false|false',
            'beginning_quote_icon_alignment'     => 'center',
            'beginning_quote_icon_color'         => '#8b8b8b',
            'beginning_quote_icon_bg'            => '',
            'beginning_quote_icon'               => '&#xf10d;||fa||900',
            'ending_quote_icon_size'             => '22px',
            'show_ending_quote_icon'             => 'off',
            'ending_quote_icon'                  => '&#xf10e;||fa||900',
            'ending_quote_icon_custom_margin'    => '5px|0|0|0|false|false',
            'ending_quote_icon_alignment'        => 'center',
            'ending_quote_icon_color'            => '#8b8b8b',
            'ending_quote_icon_bg'               => '',
            'beginning_quote_icon_size'          => '22px',
            'show_beginning_quote_icon'          => 'off',
            'avatar_side_size'                   => '90px',
            'review_item_bg_color'               => '#f5f5f5',
            'grid_template_columns'              => '1fr',
            'review_item_custom_padding'         => '20px|20px|20px|20px|true|true',
            'title_row_start'                    => 1,
            'title_row_end'                      => 1,
            'title_column_start'                 => 1,
            'title_column_end'                   => 1,
            'stars_row_start'                    => 2,
            'stars_row_end'                      => 2,
            'stars_column_start'                 => 1,
            'stars_column_end'                   => 1,
            'assigned_links_row_start'           => 3,
            'assigned_links_row_end'             => 3,
            'assigned_links_column_start'        => 1,
            'assigned_links_column_end'          => 1,
            'date_row_start'                     => 4,
            'date_row_end'                       => 4,
            'date_column_start'                  => 1,
            'date_column_end'                    => 1,
            'content_row_start'                  => 5,
            'content_row_end'                    => 5,
            'content_column_start'               => 1,
            'content_column_end'                 => 1,
            'response_row_start'                 => 6,
            'response_row_end'                   => 6,
            'response_column_start'              => 1,
            'response_column_end'                => 1,
            'avatar_row_start'                   => 7,
            'avatar_row_end'                     => 7,
            'avatar_column_start'                => 1,
            'avatar_column_end'                  => 1,
            'author_row_start'                   => 8,
            'author_row_end'                     => 8,
            'author_column_start'                => 1,
            'author_column_end'                  => 1,
            'testimonial_layout'                 => 'wpt_flexbox_column',
            'align_avatar'                       => 'center',
            'stars_justify_content'              => 'center',
            'title_order'                        => 1,
            'star_order'                         => 2,
            'date_order'                         => 3,
            'assigned_links_order'               => 4,
            'content_order'                      => 5,
            'avatar_order'                       => 6,
            'author_name_order'                  => 7,
            'review_justify_content'             => 'left',
            'button_full_width'                  => 'off',
            'load_more_button_alignment'         => 'center',
            'grid_gap'                           => '2em',
            'columns'                            => 1,
            'star_size'                          => '1.25em',
            'star_color'                         => '#FFB900',
            'review_response_background'         => '#666666',
            'schema'                             => 'off',
            'fallback'                           => 'No testimonials found.',
            'show_title'                         => 'on',
            'show_response'                      => 'off',
            'show_rating'                        => 'on',
            'show_date'                          => 'off',
            'show_content'                       => 'on',
            'show_avatar'                        => 'on',
            'show_author'                        => 'on',
            'show_assigned_links'                => 'off',
            'rating'                             => '1',
            'pagination_method'                  => 'ajax',
            'enable_pagination'                  => 'off',
            'assigned_users'                     => '',
            'offset'                             => '0',
            'display'                            => '5',
            'categories'                         => '',
            'custom_ids'                         => '',
            'filter_by_categories'               => 'off',
            'fetch_testimonials_from'            => 'post_id',
            'content_custom_padding'             => '1em|0|1em|0|false|false',
        ];
        return $defaults;
    }

}
