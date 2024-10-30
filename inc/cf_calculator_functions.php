<?php

function cf_get_widget_size_list()
{
    return array(
        array('value' => '160x600', 'display' => '160 x 600', 'x' => 160, 'y' => 600),
        array('value' => '300x250', 'display' => '300 x 250', 'x' => 300, 'y' => 250),
        array('value' => '728x90', 'display' => '728 x 90', 'x' => 728, 'y' => 90)
    );
}

function cf_get_msg($key)
{
    $cf_message_list = array(
        'button_submenu_settings' => __('Settings', 'currencyfair'),
        'button_submenu_calculator_widget' => __('Calculator Widget', 'currencyfair'),
        'button_save_secret_key' => __('Save Secret Key', 'currencyfair'),
        'placeholder_secret_key' => __('Insert Secret Key...', 'currencyfair'),
        'form_affiliate_url_description' => __('Enter your affiliate URL here. Please note, we will automatically remove the CurrencyFair website component of the URL.'),
        'form_secret_key_description' => __('Your secret key is emailed to you by the CurrencyFair Affiliate Program team. You can find their contact details here:'),
        'notice_access_token_saved' => __('Secret Key Saved Successfully', 'currencyfair'),
        'notice_access_token_valid' => __('Your CurrencyFair secret key is valid. You are ready to go.', 'currencyfair'),
        'notice_access_token_invalid' => __('Your CurrencyFair secret key is invalid.', 'currencyfair'),
        'notice_generic_error_message' => __('Something went wrong. Please try again later.', 'currencyfair'),
        'calculator_input_select_widget_size' => __('Select widget size', 'currencyfair'),
        'calculator_input_select_affiliate_url' => __('Affiliate URL', 'currencyfair'),
        'calculator_widget_title' => __('CurrencyFair Affiliate Calculator', 'currencyfair'),
        'calculator_widget_description' => __('Display the CurrencyFair Calculator', 'currencyfair'),
        'calculator_widget_page_description' => __('This page is for testing the CurrencyFair calculator only. To add the CurrencyFair calculator to your site, please go to', 'currencyfair') . ' <code>' . __('Appearance') . ' -> ' . __('Widgets') . '</code>'
    );

    return $cf_message_list[$key];
}

function cf_echo_msg($key)
{
    echo cf_get_msg($key);
}
