<?php
namespace WPT\WebsiteTestimonials\Testimonials\Stars;

/**
 * FullStar.
 */
class FullStar
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
        return "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='{$fill_color}' d='M113.14 463c-1.94 0-3.88-.97-5.81-1.93-2.9-1.94-4.85-6.77-3.88-10.63l42.62-158.49-127.85-103.4c-3.87-1.94-4.84-6.77-3.87-10.63a9.3 9.3 0 018.72-6.77l164.64-8.7L246.8 8.8c1.94-2.9 5.81-5.8 9.69-5.8 3.87 0 7.75 2.9 8.71 5.8l59.08 153.65 164.65 8.7a9.3 9.3 0 018.72 6.77c.97 3.86 0 7.73-2.9 10.63l-127.85 103.4 42.61 158.49c.97 3.86 0 7.73-3.87 10.63-2.9 1.93-7.75 2.9-10.66 0l-138.5-88.91-138.49 88.9c-1.94 1.94-2.9 1.94-4.84 1.94z'/></svg>";
    }

}
