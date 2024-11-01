<?php 
namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialsCarousel;



/**
 * Assets.
 */
class Assets
{
    protected $container;

    /**
     * Constructor.
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
    * Enqueue assets
    */
    public function enqueue()
    {
        wp_enqueue_script('wpt-swiper-script', $this->container['plugin_url'] . "/js/swiper.min.js", ['jquery'], $this->container['plugin_version'], true);
        wp_enqueue_script('wpt-swiper-custom', $this->container['plugin_url'] . "/js/custom.js", ['wpt-swiper-script'], $this->container['plugin_version'], true);
         wp_enqueue_style('wpt-swiper-style', $this->container['plugin_url'] . "/css/swiper-bundle.min.css", [], $this->container['plugin_version'], false);
    }

}


