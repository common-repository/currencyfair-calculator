<?php

class CurrencyFairCalculatorWidget extends WP_Widget
{
    /**
     * @uses WP_Widget::__construct
     */
    public function __construct()
    {
        $name = cf_get_msg('calculator_widget_title');
        $widget_ops = array(
            'classname' => 'currencyfair',
            'description' => cf_get_msg('calculator_widget_description')
        );

        $control_ops = array('id_base' => 'currencyfair-calculator-widget');

        parent::__construct('currencyfair-calculator-widget', $name, $widget_ops, $control_ops);
    }

    /**
     * Output
     *
     * @param  array $args
     * @param  array $instance
     * @return void
     */
    public function widget($args, $instance)
    {
        $secret_key = esc_attr(get_option('currencyfair_account_secret_key'));
        $text_widget_size = isset($instance['widget_size']) ? esc_attr($instance['widget_size']) : '160x600';
        $affiliate_url = isset($instance['affiliate_url']) ? urlencode($instance['affiliate_url']) : '';
        $widget_size = explode('x', $text_widget_size);

        $cfApi = new CurrencyFair\ApiClient();
        $access_token = $cfApi->getAccessToken($secret_key);

        if ($access_token) {
            include(CF_VIEW_DIR . 'calculator_widget_body.php');
        }
    }

    /**
     * Backend form
     *
     * @param array $instance
     * @return void
     */
    public function form($instance)
    {
        $size_options = cf_get_widget_size_list();

        // defaults
        $defaults = array(
            'widget_size' => $size_options[0]['value'],
            'affiliate_url' => ''
        );

        $instance = wp_parse_args((array)$instance, $defaults);

        include(CF_VIEW_DIR . 'calculator_widget_form.php');
    }

    /**
     * Prepares the content
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['widget_size'] = $new_instance['widget_size'];
        $instance['affiliate_url'] = $this->stripAffiliateUrl($new_instance['affiliate_url']);
        return $instance;
    }

    /**
     * Remove the url and empty params from the affiliate url
     * @param  string $url Affiliate URL
     * @return string
     */
    private function stripAffiliateUrl($url)
    {
        preg_match_all("/((\?|\&)([^=]+)\=([^\&\#]+)|\#([^\&]+))/i", $url, $params);
        return implode($params[0]);
    }
}
