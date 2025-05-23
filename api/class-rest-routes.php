<?php

class RNOMPA_REST_Routes {
    public static function init() {
        
        add_action('rest_api_init', [__CLASS__, 'register_routes']);
    }

    public static function register_routes() {
        register_rest_route('wc/v3', '/rnompa-statistics', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'get_statistics']
        ]);
        register_rest_route('wc/v3', '/rnompa-unseen-notifications', [
            'methods' => 'GET',
            'callback' => ['RNOMPA_Notification', 'retrieve_telegram_assistant_data'],
            'permission_callback' => function () { return current_user_can('manage_woocommerce'); }
        ]);
        register_rest_route('wc/v3', '/rnompa-site-information', [
            'methods' => 'GET',
            'callback' => ['RNOMPA_Site_Info', 'get_website_information'],
            'permission_callback' => function () { return current_user_can('manage_woocommerce'); }
        ]);
        register_rest_route('wc/v3', '/rnompa-create-coupon', [
            'methods' => 'POST',
            'callback' => ['RNOMPA_Coupon', 'create_coupon'],
            'permission_callback' => function () { return current_user_can('manage_woocommerce'); }
        ]);
        register_rest_route('wc/v3', '/rnompa-daily-statistics', [
            'methods' => 'GET',
            'callback' => ['RNOMPA_Statistics', 'get_daily_statistics'],
            'permission_callback' => function () { return current_user_can('manage_woocommerce'); }
        ]);
    }

    public static function get_statistics($request) {
        return RNOMPA_Statistics::get_statistics($request->get_params());
    }
}