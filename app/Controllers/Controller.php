<?php
/**
 * Created by PhpStorm.
 * User: matel
 * Date: 14.06.18
 * Time: 15:00
 */

namespace App\Controllers;
use Interop\Container\ContainerInterface;

abstract class Controller
{
    protected $c;

    public function __construct(ContainerInterface $c)
    {
        $this->c = $c;
    }
}