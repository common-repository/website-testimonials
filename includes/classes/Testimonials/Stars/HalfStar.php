<?php
namespace WPT\WebsiteTestimonials\Testimonials\Stars;

/**
 * HalfStar.
 */
class HalfStar
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
     * Fill Color
     */
    public function get_icon($fill_color = '#FFB900')
    {
        return "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='{$fill_color}' d='M256.48 3c3.87 0 7.75 2.9 8.7 5.8l59.1 153.65 164.64 8.7c3.87 0 7.75 2.9 8.72 6.77.97 3.86 0 7.73-2.9 10.63l-127.85 103.4 42.6 158.5c.97 3.85 0 7.72-3.87 10.62-2.9 1.93-7.75 2.9-10.66 0l-138.5-88.9-138.5 88.9c-1.57 1.57-2.5 1.86-3.84 1.92h-.98c-1.6 0-3.2-.66-4.8-1.43l-1.02-.5c-2.9-1.94-4.85-6.77-3.88-10.63l42.62-158.5-127.85-103.4c-3.87-1.93-4.84-6.76-3.87-10.62.97-3.87 4.84-6.77 8.72-6.77l164.64-8.7L246.8 8.8c1.93-2.9 5.8-5.8 9.68-5.8zm50.98 177.04L256 46.17v301c1.28-.1 2.6.2 3.72.93l120.24 77.18-37.02-137.67c-.62-2.28.18-4.72 2.02-6.2l111.2-89.95-143.4-7.57c-2.38-.13-4.45-1.63-5.3-3.84z'/></svg>";
    }

}
