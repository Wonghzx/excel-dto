<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/17
 * Time: 11:18 上午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Helper;


class Helper
{

    public static function yieldExcelData(array &$data, array &$field): \Generator
    {
        foreach ($data as $dat) {
            $yield = [];
            foreach ($field as $item) {
                $yield[$item['name']] = $dat[$item['name']] ?? '';
            }
            yield $yield;
        }
    }

    public static function uid($length = 15)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes((int)ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes((int)ceil($length / 2));
        } else {
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
        }
        return substr(bin2hex($bytes), 0, $length);
    }

    public static function filename()
    {
        $string = self::uid(32);
        $name = md5(sprintf('%s-%s-%s-%s-%s',
            substr($string, 0, 8),
            substr($string, 9, 4),
            substr($string, 14, 4),
            substr($string, 19, 4),
            substr($string, 20),
        ));
        return $name;
    }
}