<?php
namespace CurrencyFair;

class ApiClient
{
    private $url = 'https://api.currencyfair.com/oauth';

    public function getAccessToken($secret_key)
    {
        $response = wp_remote_post(
            $this->url,
            array(
                'body' => array(
                    'grant_type' => 'auth_token',
                    'client_id'  => 'mobile_ios',
                    'auth_token' => $secret_key
                )
            )
        );

        if (is_wp_error($response)
            || (isset($response['response']['code']) && $response['response']['code'] !== 200)) {
            return false;
        }

        return json_decode($response['body'])->access_token;
    }
}
