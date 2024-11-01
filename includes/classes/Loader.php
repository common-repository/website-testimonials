<?php
namespace WPT\WebsiteTestimonials;

use WPTools\Pimple\Container;

/**
 * Container
 */
class Loader extends Container
{
    /**
     *
     * @var mixed
     */
    public static $instance;

    public function __construct()
    {
        parent::__construct();

        $this['bootstrap'] = function ($container) {
            return new WP\Bootstrap($container);
        };

        $this['divi_actions'] = function ($container) {
            return new Divi\Actions($container);
        };

        $this['full_star'] = function ($container) {
            return new Testimonials\Stars\FullStar($container);
        };
        $this['half_star'] = function ($container) {
            return new Testimonials\Stars\HalfStar($container);
        };

        $this['empty_star'] = function ($container) {
            return new Testimonials\Stars\EmptyStar($container);
        };

        $this['divi_testimonial_carousel_assets'] = function ($container) {
            return new Divi\Modules\TestimonialsCarousel\Assets($container);
        };
        $this['carousel_nav'] = function ($container) {
            return new Testimonials\Carousel\Navigation($container);
        };

        $this['tgm_plugins'] = function ($container) {
            return new WP\TGM\Plugins($container);
        };

        $this['admin_menu'] = function ($container) {
            return new WP\Admin\Menu($container);
        };

    }

    /**
     * Get container instance.
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Loader();
        }

        return self::$instance;
    }

    /**
     * Plugin run
     */
    public function run()
    {
        register_activation_hook($this['plugin_file'], [$this['bootstrap'], 'register_activation_hook']);

        add_action('admin_bar_menu', [$this['admin_menu'], 'admin_bar_menu'], 999);

        //divi actions
        add_action('et_builder_ready', [$this['divi_actions'], 'et_builder_ready'], 1);
        add_action('divi_extensions_init', [$this['divi_actions'], 'divi_extensions_init']);

        // phpcs:ignore WordPress.Security.NonceVerification
        if (isset($_GET['et_fb']) && ($_GET['et_fb'] == '1')) {
            add_action('wp_enqueue_scripts', [$this['divi_testimonial_carousel_assets'], 'enqueue']);
        }

        add_action('tgmpa_register', [$this['tgm_plugins'], 'register']);

        add_action('admin_menu', [$this['admin_menu'], 'add_submenu']);

    }
}
