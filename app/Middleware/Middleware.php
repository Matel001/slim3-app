<?php
/**
 * Created by PhpStorm.
 * User: Kuba
 * Date: 2018-06-16
 * Time: 16:22
 */

namespace App\Middleware;


abstract class Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}