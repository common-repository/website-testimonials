<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialForm;

class AdvancedFieldsConfig {
    protected $module_fields;

    /**
     * Constructor.
     */
    public function __construct( $module_fields ) {
        $this->module_fields = $module_fields;
    }

    /**
     *  Get all advanced field config
     */
    public function all() {
        $config = [];
        $config['border'] = false;
        $config['borders'] = false;
        $config['text'] = false;
        $config['box_shadow'] = false;
        $config['filters'] = false;
        $config['animation'] = false;
        $config['text_shadow'] = false;
        $config['max_width'] = false;
        $config['margin_padding'] = false;
        $config['custom_margin_padding'] = false;
        $config['custom_spacing'] = false;
        $config['background'] = false;
        $config['custom_background'] = false;
        $config['fonts'] = false;
        $config['link_options'] = false;
        $config['transform'] = false;
        $config['button'] = false;
        return $config;
    }

    /**
     * Get the default value of the prop
     */
    public function get_default( $prop_name ) {
        return $this->module_fields->get_default( $prop_name );
    }

    /**
     * Get the CSS selector for the field.
     */
    public function get_selector( $key ) {
        return $this->module_fields->get_selector( $key );
    }

}
