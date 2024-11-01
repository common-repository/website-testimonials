<?php
namespace WPT\WebsiteTestimonials\Testimonials\Stars;

/**
 * Script.
 */
class Script
{
    protected $container;

    /**
     * Constructor.
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function enqueue_all()
    {
        // phpcs:ignore
        if (isset($_GET['et_fb']) && ($_GET['et_fb'] == '1')) {
            wp_register_style('wpt-star-rating-placeholder', false);
            wp_enqueue_style('wpt-star-rating-placeholder');
            wp_enqueue_style('wpt-star-rating-css', $this->container['plugin_url'] . '/css/star-rating/star-rating.min.css', ['wpt-star-rating-placeholder'], false, 'all');

            wp_register_script('wpt-star-rating-placeholder-js', false);
            wp_enqueue_script('wpt-star-rating-placeholder-js');
            wp_enqueue_script('wpt-star-rating-js', $this->container['plugin_url'] . '/js/star-rating/star-rating.min.js', ['wpt-star-rating-placeholder-js'], false, 'all');
        }
    }

}
