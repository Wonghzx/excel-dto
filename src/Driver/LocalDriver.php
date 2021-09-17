<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/17
 * Time: 11:17 上午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Driver;


use Hzx\ExcelDto\Exception\DtoException;
use Hzx\ExcelDto\Helper\Helper;
use Psr\Container\ContainerInterface;

class LocalDriver extends Driver
{



    public function __construct(ContainerInterface $container, array $config)
    {
        parent::__construct($container, $config);


    }

    public function handle(array $data = [])
    {
        $head = array_column($data['field'], 'value');

        $filename = $data['basic']['filename'] ?: Helper::filename() . '.xlsx';
        $fileObject = $this->excelObject->fileName($filename)->header($head);

        $generate = Helper::yieldExcelData($data['data'], $data['field']);

        $row = 1;
        while ($generate->valid()) {
            $column = 0;
            foreach ($generate->current() as $value) {
                $fileObject = $fileObject->insertText($row, $column, $value);
                $column++;
            }
            $generate->next();
            $row++;
        }
        $filepath = $fileObject->output();
        return $filepath;
    }

}