<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialForm;

class SettingsModalToggles {
    /**
     * Get toggles
     */
    public function all() {
        return [
            'general'  => [
                'toggles' => $this->general(),
            ],
            'advanced' => [
                'toggles' => $this->advanced(),
            ],
        ];
    }

    /**
     *  General toggles
     */
    public function general() {
        $general = [];
        $general['main_content'] = esc_html__( 'Testimonial Form', 'website-testimonials' );
        return $general;
    }

    /**
     * Advanced toggles
     */
    public function advanced() {
        // Advanced tab toggles
        $advanced = [];
        return $advanced;
    }

}
