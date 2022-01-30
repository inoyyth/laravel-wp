<?php
namespace App\Library\Services;

use Automattic\WooCommerce\Client;
 
// public $link

class Woocommerce
{
    // public function __construct($link) {
    //   $this->link = $link
    // }

    public function fetch()
    {
      $woocommerce = new Client(
        config('app.wp_base'),
        config('app.woocommerce_ck'),
        config('app.woocommerce_sk'),
        [
            'wp_api' => true,
            'version' => 'wc/v3',
            'query_string_auth' => true, // Force Basic Authentication as query string true and using under HTTPS
            'verify_ssl' => false
        ]
      );

      return $woocommerce;
    }

    public function get($link) {
      return $this->fetch()->get($link);
    }

    public function post($link, $data) {
      return $this->fetch()->post($link, $data);
    }

    public function put($link, $data) {
      return $this->fetch()->put($link, $data);
    }

    public function delete($link, $isForceDelete=false) {
      return $this->fetch()->put($link, array('force' => $isForceDelete));
    }
}
