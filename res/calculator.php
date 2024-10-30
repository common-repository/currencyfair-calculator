<?php

require(CF_WIDGET_DIR . '/CurrencyFairCalculatorWidget.php');

add_action('admin_menu', 'register_currencyfair_calculator_submenu');
add_action('widgets_init', 'register_currencyfair_calculator_widget');

function register_currencyfair_calculator_submenu()
{
    add_submenu_page(
        'currencyfair-main',
        cf_get_msg('button_submenu_calculator_widget'),
        cf_get_msg('button_submenu_calculator_widget'),
        'manage_options',
        'currencyfair-calculator',
        'currencyfair_calculator_widget_page'
    );
}

function currencyfair_calculator_widget_page()
{
    $secret_key = esc_attr(get_option('currencyfair_account_secret_key'));
    $cfApi = new CurrencyFair\ApiClient();
    $access_token = $cfApi->getAccessToken($secret_key);
    $size_options = cf_get_widget_size_list();

    wp_enqueue_script(
        'cf_calculator_update_iframe',
        plugins_url('public/js/cf_calculator_update_iframe.js', dirname(__FILE__)),
        false,
        CF_WP_VERSION,
        true
    );
    wp_localize_script('cf_calculator_update_iframe', 'param', array(
        'accessToken' => $access_token,
        'iframeUrl' => 'https://www.currencyfair.com/banners/pap/calculator/'
    ));

    wp_enqueue_style(
        'header_style',
        plugins_url('public/css/header.css', dirname(__FILE__)),
        false,
        CF_WP_VERSION
    );

    wp_enqueue_style(
        'calculator_widget_test_style',
        plugins_url('public/css/calculator_widget_test.css', dirname(__FILE__)),
        false,
        CF_WP_VERSION
    );

    ob_start();
    require_once(CF_VIEW_DIR . 'header.php');
    require_once(CF_VIEW_DIR . 'calculator_widget_settings.php');
    echo ob_get_clean();
}

// register settings
function register_currencyfair_calculator_widget()
{
    register_widget('CurrencyFairCalculatorWidget');
}
