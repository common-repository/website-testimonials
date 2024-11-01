<?php
namespace WPT\WebsiteTestimonials\Divi;

/**
 * Actions.
 */
class Actions
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
     * Register divi extension
     *
     * @return [type] [description]
     */
    public function divi_extensions_init()
    {
        new Modules\Extension($this->container);
    }


    /**
     * Register divi modules
     *
     * @return [type] [description]
     */
    public function et_builder_ready()
    {
        // REGISTER DIVI MODULES
		new Modules\TestimonialForm\Module($this->container);
		new Modules\TestimonialsCarousel\Module($this->container);
        new Modules\TestimonialsList\Module($this->container);
    }

}

