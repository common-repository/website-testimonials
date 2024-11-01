<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialForm;

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
        $fields['associated_pages'] = [
            'label'       => esc_html__( 'Associated Page(s)', 'website-testimonials' ),
            'type'        => 'select',
            'options'     => [
                'post_id'    => 'Current Page',
                'custom_ids' => 'Custom Pages',
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Link page(s) to the testimonial form.', 'website-testimonials' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'associated_pages' ),
        ];
        $fields['custom_ids'] = [
            'label'       => esc_html__( 'Custom Page IDs (comma-separated)', 'website-testimonials' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Add comma-separated page ids', 'website-testimonials' ),
            'show_if'     => [
                'associated_pages' => 'custom_ids',
            ],
            'default'     => $this->get_default( 'custom_ids' ),
        ];
        $fields['admin_label'] = [
            'label'       => __( 'Admin Label', 'website-testimonials' ),
            'type'        => 'text',
            'description' => 'This will change the label of the module in the builder for easy identification.',
        ];
        return $fields;
    }

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
            'input_label'            => [
                'selector' => "%%order_class%% .glsr-default form.glsr-form label.glsr-label",
                'label'    => 'Input Label',
            ],
            'consent_description'    => [
                'selector' => "%%order_class%% .glsr-default form.glsr-form .glsr-field-toggle label",
                'label'    => 'Consent Description Text',
            ],
            'input_text'             => [
                'selector' => "%%order_class%% .glsr-default form.glsr-form input.glsr-input, %%order_class%% .glsr-default form.glsr-form select.glsr-select, %%order_class%% .glsr-default form.glsr-form textarea.glsr-textarea",
                'label'    => 'Input Text',
            ],
            'input_placeholder_text' => [
                'selector' => "%%order_class%% .glsr-default form.glsr-form input.glsr-input::placeholder, %%order_class%% .glsr-default form.glsr-form textarea.glsr-textarea::placeholder",
                'label'    => 'Input Placeholder Text',
            ],
            'button_container'       => [
                'selector' => "%%order_class%% .glsr-default .wp-block-button",
                'label'    => 'Button Container',
            ],
            'button'                 => [
                'selector' => "%%order_class%% .glsr-default .et_pb_button",
                'label'    => 'Button',
            ],
            'button_before'          => [
                'selector' => "%%order_class%% .glsr-default .et_pb_button:before",
                'label'    => 'Button :: Before',
            ],
            'button_after'           => [
                'selector' => "%%order_class%% .glsr-default .et_pb_button:after",
                'label'    => 'Button :: After',
            ],
            'invalid_text_input'     => [
                'selector' => "%%order_class%% .glsr-default form.glsr-form input.glsr-input.glsr-is-invalid, %%order_class%% .glsr-default form.glsr-form textarea.glsr-textarea.glsr-is-invalid",
                'label'    => 'Invalided Input Field',
            ],
            'input_error_message'    => [
                'selector' => "%%order_class%% .glsr-default form.glsr-form .glsr-field-error",
                'label'    => 'Input Error Message',
            ],
            'form_error_message'     => [
                'selector' => "%%order_class%% .glsr-default form.glsr-form .glsr-form-failed",
                'label'    => 'Form Error Message',
            ],
            'success_message'        => [
                'selector' => "%%order_class%% .glsr-default form.glsr-form .glsr-form-success",
                'label'    => 'Success Message',
            ],
            'full_star'              => [
                'selector' => "%%order_class%% .gl-star-rating-stars.s10>span:first-child, %%order_class%% .gl-star-rating-stars.s20>span:nth-child(-1n+2), %%order_class%% .gl-star-rating-stars.s30>span:nth-child(-1n+3), %%order_class%% .gl-star-rating-stars.s40>span:nth-child(-1n+4), %%order_class%% .gl-star-rating-stars.s50>span:nth-child(-1n+5), %%order_class%% .gl-star-rating-stars.s60>span:nth-child(-1n+6), %%order_class%% .gl-star-rating-stars.s70>span:nth-child(-1n+7), %%order_class%% .gl-star-rating-stars.s80>span:nth-child(-1n+8), %%order_class%% .gl-star-rating-stars.s90>span:nth-child(-1n+9), %%order_class%% .gl-star-rating-stars.s100>span, %%order_class%% .glsr-star-full",
                'label'    => 'Full Star',
            ],
            'empty_star'             => [
                'selector' => "%%order_class%% .gl-star-rating-stars>span, %%order_class%% .glsr-star-empty ",
                'label'    => 'Empty Star',
            ],
            'stars'                  => [
                'selector' => "%%order_class%% .gl-star-rating-stars",
                'label'    => 'Stars',
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
            'custom_button'                  => 'off',
            'input_error_message_text_color' => '#e02424',
            'associated_pages'               => 'post_id',
            'custom_ids'                     => '',
            'star_color'                     => '#FFB900',
            'input_text_custom_padding'      => '8px|12px|8px|12px',
            'input_text_custom_margin'       => '0|0|0|0',
            'input_label_custom_margin'      => '0|0|0.25em|0|false|false',
            'input_label_custom_padding'     => '0|0|0|0|false|false',
            'button_icon'                    => '%%40%%',
            'button_icon_placement'          => 'right',
            'show_terms'                     => 'on',
            'show_email'                     => 'on',
            'show_name'                      => 'on',
            'show_content'                   => 'on',
            'show_title'                     => 'on',
            'show_ratings_stars'             => 'on',
        ];
        return $defaults;
    }

}
