<?php
/**
 * Plugin Name:     Divi Testimonial Plus
 * Plugin URI:      https://wptools.app/wordpress-plugin/divi-testimonial-plus-advanced-testimonial-grid-slider-form-and-seo-schema/
 * Description:     Create, manage & display testimonials with divi modules for grid, slider & form. SEO schema support
 * Author:          WP Tools
 * Text Domain:     website-testimonials
 * Domain Path:     /languages
 * Version:         6.3.1
 *
 * @package         Website_Testimonials
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/freemius.php';

$loader = \WPT\WebsiteTestimonials\Loader::getInstance();

$loader['plugin_name']    = 'Divi Testimonial Plus';
$loader['plugin_version'] = '6.3.1';
$loader['plugin_dir']     = __DIR__;
$loader['plugin_slug']    = basename( __DIR__ );
$loader['plugin_url']     = plugins_url( '/' . $loader['plugin_slug'] );
$loader['plugin_file']    = __FILE__;

$loader->run();
