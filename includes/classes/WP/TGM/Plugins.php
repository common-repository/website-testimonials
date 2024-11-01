<?php
namespace WPT\WebsiteTestimonials\WP\TGM;

/**
 * Plugins.
 */
class Plugins
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
     * Register required plugins
     */
    public function register()
    {

        $plugins = [];

        $plugins[] = [
            'name'        => 'Site Reviews',
            'slug'        => 'site-reviews',
            'is_callable' => 'glsr_create_review',
            'required'    => true,
        ];

        $config = [
            'id'           => 'website-testimonials', // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '', // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'plugins.php', // Parent menu slug.
            'capability'   => 'manage_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true, // Show admin notices or not.
            'dismissable'  => true, // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true, // Automatically activate plugins after installation or not.
            'message'      => '', // Message to output right before the plugins table.

            'strings'      => [
                'page_title'                      => __('Install Required Plugins', 'website-testimonials'),
                'menu_title'                      => __('Install Plugins', 'website-testimonials'),

                'installing'                      => __('Installing Plugin: %s', 'website-testimonials'),

                'updating'                        => __('Updating Plugin: %s', 'website-testimonials'),
                'oops'                            => __('Something went wrong with the plugin API.', 'website-testimonials'),
                'notice_can_install_required'     => _n_noop(
                    '"Divi Testimonial Plus" plugins requires the following plugin: %1$s.',
                    '"Divi Testimonial Plus" plugins requires the following plugins: %1$s.',
                    'website-testimonials'
                ),
                'notice_can_install_recommended'  => _n_noop(
                    '"Divi Testimonial Plus" plugins recommends the following plugin: %1$s.',
                    '"Divi Testimonial Plus" plugins recommends the following plugins: %1$s.',
                    'website-testimonials'
                ),
                'notice_ask_to_update'            => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'website-testimonials'
                ),
                'notice_ask_to_update_maybe'      => _n_noop(
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'website-testimonials'
                ),
                'notice_can_activate_required'    => _n_noop(
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'website-testimonials'
                ),
                'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'website-testimonials'
                ),
                'install_link'                    => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'website-testimonials'
                ),
                'update_link'                     => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'website-testimonials'
                ),
                'activate_link'                   => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'website-testimonials'
                ),
                'return'                          => __('Return to Required Plugins Installer', 'website-testimonials'),
                'plugin_activated'                => __('Plugin activated successfully.', 'website-testimonials'),
                'activated_successfully'          => __('The following plugin was activated successfully:', 'website-testimonials'),
                'plugin_already_active'           => __('No action taken. Plugin %1$s was already active.', 'website-testimonials'),
                'plugin_needs_higher_version'     => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'website-testimonials'),
                'complete'                        => __('All plugins installed and activated successfully. %1$s', 'website-testimonials'),
                'dismiss'                         => __('Dismiss this notice', 'website-testimonials'),
                'notice_cannot_install_activate'  => __('There are one or more required or recommended plugins to install, update or activate.', 'website-testimonials'),
                'contact_admin'                   => __('Please contact the administrator of this site for help.', 'website-testimonials'),

                'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
            ],

        ];

        tgmpa($plugins, $config);

    }

}
