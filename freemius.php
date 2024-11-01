<?php

require_once __DIR__ . '/freemius/start.php';
if ( !function_exists( 'wpt_dtp_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wpt_dtp_fs() {
        global $wpt_dtp_fs;
        if ( !isset( $wpt_dtp_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $wpt_dtp_fs = fs_dynamic_init( [
                'id'             => '11896',
                'slug'           => 'website-testimonials',
                'type'           => 'plugin',
                'public_key'     => 'pk_c962a5b94364aff18a19c86c2ec0d',
                'is_premium'     => false,
                'premium_suffix' => 'Premium',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'trial'          => [
                    'days'               => 7,
                    'is_require_payment' => false,
                ],
                'menu'           => [
                    'slug'    => 'wpt-divi-testimonials',
                    'support' => false,
                ],
                'is_live'        => true,
            ] );
        }
        return $wpt_dtp_fs;
    }

    // Init Freemius.
    wpt_dtp_fs();
    // Signal that SDK was initiated.
    do_action( 'wpt_dtp_fs_loaded' );
}