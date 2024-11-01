<?php

namespace WPT\WebsiteTestimonials\Divi\Modules\TestimonialsList;

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
        $general['main_content'] = esc_html__( 'Testimonials Filter', 'website-testimonials' );
        $general['testimonial_data'] = esc_html__( 'Content Toggles', 'website-testimonials' );
        $general['seo'] = esc_html__( 'SEO Schema', 'website-testimonials' );
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
