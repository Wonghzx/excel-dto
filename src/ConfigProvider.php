<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Hzx\ExcelDto;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands'     => [
            ],
            'annotations'  => [
                'scan' => [
                    'ignore_annotations' => [
                        'mixin',
                    ],
                    'paths'              => [
                        __DIR__,
                    ],
                    'collectors'         => [
                        DtoListenerCollector::class
                    ]
                ],
            ],
            'publish'      => [
                [
                    'id'          => 'config',
                    'source'      => __DIR__ . '/../publish/dto.php',
                    'description' => 'description of this config file.', // 描述
                    'destination' => BASE_PATH . '/config/autoload/dto.php',
                ]

            ]
        ];
    }
}
