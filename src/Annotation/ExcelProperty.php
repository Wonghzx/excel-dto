<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/16
 * Time: 11:49 上午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 * Class ExcelProperty
 * @package Hzx\ExcelDto\Annotation
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class ExcelProperty extends AbstractAnnotation
{
    public $value;

    public $index;
}