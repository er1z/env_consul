<?php
/**
 * Created by PhpStorm.
 * User: ppawliczuk
 * Date: 17.10.2018
 * Time: 14:10
 */

namespace App\Util;


use SensioLabs\Consul\ConsulResponse;
use SensioLabs\Consul\ServiceFactory;

class ConsulFetcher
{


    public function fetch($key)
    {
        $sf = new ServiceFactory([
            'base_uri'=>'http://dev.local:8500'
        ]);
        $kv = $sf->get('kv');
        /**
         * @var $result ConsulResponse
         */
        $result = $kv->get($key);
        return base64_decode($result->json()[0]['Value']);
    }

}