<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/17
 * Time: 10:13 上午
 */
declare(strict_types=1);

return [
    'local' => [
        'driver' => Hzx\ExcelDto\Driver\LocalDriver::class,
        'root'   => BASE_PATH . '/storage/exports',
    ],
];