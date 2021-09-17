<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/16
 * Time: 3:30 下午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto;

use Hyperf\Di\MetadataCollector;

class DtoListenerCollector extends MetadataCollector
{
    /**
     * @var array
     */
    protected static $container = [];

    public static function setListener(string $listener, array $value)
    {
        static::$container[$listener] = $value;
    }

    public static function getListner(string $listener, $default = null)
    {
        return static::$container[$listener] ?? $default;
    }

    public static function clear(?string $className = null): void
    {
        if ($className) {
            foreach (static::$container as $listener => $value) {
                if (isset($value['className']) && $value['className'] === $className) {
                    unset(static::$container[$listener]);
                }
            }
        } else {
            static::$container = [];
        }
    }
}