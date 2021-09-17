<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/16
 * Time: 2:22 下午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target("CLASS")
 * Class ExportData
 * @package Hzx\ExcelDto\Annotation
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ExcelData extends AbstractAnnotation
{
    /**
     * @var string
     */
    public string $name;
}