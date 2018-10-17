<?php
/**
 * Created by PhpStorm.
 * User: ppawliczuk
 * Date: 17.10.2018
 * Time: 15:07
 */

namespace App\Util;



use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

class EnvVarProc implements EnvVarProcessorInterface
{
    /**
     * @var ConsulFetcher
     */
    private $fetcher;

    public function __construct(ConsulFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    public static function getProvidedTypes()
    {
        return ['consul'=>'string'];
    }

    public function getEnv($prefix, $name, \Closure $getEnv)
    {

        if($prefix=='consul'){
            $key = str_replace('__', '/', $name);
            return $this->fetcher->fetch($key);
        }

        throw new RuntimeException('Problem with consul');
    }


}