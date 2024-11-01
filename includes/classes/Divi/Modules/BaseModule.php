<?php

namespace WPT\WebsiteTestimonials\Divi\Modules;

use ET_Builder_Module;
use ET_Core_Data_Utils;
/**
 * BaseModule.
 */
class BaseModule extends ET_Builder_Module {
    protected $container;

    public $module_fields;

    public $module_advanced_fields_config;

    public $module_settings_modal_toggles;

    public $vb_support = 'on';

    /**
     * Constructor.
     */
    public function __construct( $container ) {
        $this->container = $container;
        parent::__construct();
    }

    /**
     * get the module toggles *
     */
    public function get_settings_modal_toggles() {
        return $this->module_settings_modal_toggles->all();
    }

    /**
     * get the advanced field for divi module settings *
     */
    public function get_advanced_fields_config() {
        return $this->module_advanced_fields_config->all();
    }

    /**
     * get the css fields for advanced divi module settings *
     */
    public function get_custom_css_fields_config() {
        $selectors = [];
        return $selectors;
    }

    /**
     * get the divi module fields *
     */
    public function get_fields() {
        $fields = $this->module_fields->all();
        return $fields;
    }

    /**
     * Get the default value for the field *
     */
    public function get_default( $key ) {
        return $this->module_fields->get_default( $key );
    }

    /**
     * Get the css selector *
     */
    public function get_selector( $key ) {
        return $this->module_fields->get_selector( $key );
    }

    /**
     * Initialize empty attributes with default values.
     */
    public function initialize_attributes( $attrs ) {
        return wp_parse_args( $attrs, $this->module_fields->get_defaults() );
    }

    /**
     * Get the final prop value. Use default if value not set
     */
    public function get_prop_value( $prop_name, $prop_type = 'text' ) {
        $value = ( isset( $this->props[$prop_name] ) && $this->props[$prop_name] ? $this->props[$prop_name] : $this->get_default( $prop_name ) );
        switch ( $prop_type ) {
            case 'yes_no_button':
                $value = $value == 'on';
                break;
            default:
                // code...
                break;
        }
        return $value;
    }

    /**
     * Add custom color fields.
     */
    public function add_custom_color_fields( &$fields ) {
        $advanced_config = $this->module_advanced_fields_config->all();
        if ( isset( $advanced_config['custom_color'] ) && is_array( $advanced_config['custom_color'] ) ) {
            foreach ( $advanced_config['custom_color'] as $prop_name => $config ) {
                $fields[$prop_name] = $config;
            }
        }
    }

    /**
     * Get responsive values
     */
    public function get_responsive_values( $prop_name ) {
        $default = $this->get_default( $prop_name );
        $desktop = et_pb_responsive_options()->get_desktop_value( $prop_name, $this->props, $default );
        $tablet = et_pb_responsive_options()->get_tablet_value( $prop_name, $this->props, $desktop );
        $phone = et_pb_responsive_options()->get_phone_value( $prop_name, $this->props, $tablet );
        return [
            'desktop' => $desktop,
            'tablet'  => $tablet,
            'phone'   => $phone,
        ];
    }

    /**
     * Render the divi module
     */
    public function render( $attrs, $content = null, $render_slug = null ) {
    }

}
