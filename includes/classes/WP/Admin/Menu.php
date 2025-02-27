<?php
namespace WPT\WebsiteTestimonials\WP\Admin;

/**
 * Menu.
 */
class Menu
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
     * Add submenu to the left sidebar menu in admin
     */
    public function add_submenu()
    {
        add_submenu_page(
            'options-general.php',
            'Divi Testimonials',
            'Divi Testimonials',
            'manage_options',
            'wpt-divi-testimonials',
            [$this, 'settings_submenu']
        );

    }

    public function settings_submenu()
    {
        ob_start();
        require $this->container['plugin_dir'] . '/resources/views/admin_menu/settings_submenu.php';
        // phpcs:ignore
        echo ob_get_clean();
    }

    /**
     * Add schema check link
     */
    public function admin_bar_menu()
    {
        if (is_admin()) {
            return;
        }
        global $wp_admin_bar;
        global $wp;

        $svg = '<svg style="position:relative; top: 1px; margin-right:3px;display:inline;" width="12" height="12" version="1.1" viewBox="0 0 28 28" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:ns="&amp;ns_sfw;" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<style type="text/css">
    .st0{fill:#4285F4;}
    .st1{fill:#34A853;}
    .st2{fill:#FBBC04;}
    .st3{fill:#EA4335;}
</style>
<metadata>
    <ns:sfw>
        <ns:slices/>
        <ns:sliceSourceBounds x="0.1" y="110.1" width="533.5" height="544.3" bottomLeftOrigin="true"/>
    </ns:sfw>
<rdf:RDF><cc:Work rdf:about=""><dc:format>image/svg+xml</dc:format><dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/><dc:title/></cc:Work></rdf:RDF></metadata>
<g transform="matrix(.050579 0 0 .050579 .50941 .23548)">
    <path class="st0" d="m533.5 278.4c0-18.5-1.5-37.1-4.7-55.3h-256.7v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4"/>
    <path class="st1" d="m272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3h-90.5v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853"/>
    <path class="st2" d="m119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2v-70.1h-90.4c-38.6 76.9-38.6 167.5 0 244.4z" fill="#fbbc04"/>
    <path class="st3" d="m272.1 107.7c38.8-0.6 76.3 14 104.4 40.8l77.7-77.7c-49.2-46.2-114.5-71.6-182.1-70.8-102.9 0-197 58-243.2 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335"/>
</g>
</svg>';
        $current_url = home_url($wp->request);

        $wp_admin_bar->add_menu([
            'id'     => 'wpt-testimonial-schema-checker', // an unique id (required)
            'parent' => false, // false for a top level menu
            'title'  => $svg . ' Check Testimonial / Review SEO Schema', // title/menu text to display
            'href'   => 'https://search.google.com/test/rich-results?url=' . rawurlencode($current_url), // target url of this menu item
            // optional meta array
            'meta'   => [
                'onclick' => '',
                'html'    => '',
                'class'   => '',
                'target'  => '_blank',
                'title'   => 'Check validity of testimonial/review schema structured data.',
            ],
        ]);
    }

}
