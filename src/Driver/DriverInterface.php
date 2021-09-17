<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/17
 * Time: 10:03 上午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Driver;


use Psr\Container\ContainerInterface;

interface DriverInterface
{
    public function __construct(ContainerInterface $container, array $config);

    public function fetchDriver(): object;
}