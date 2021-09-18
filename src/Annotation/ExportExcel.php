<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/16
 * Time: 12:07 下午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hzx\ExcelDto\DtoListenerCollector;

/**
 * @Annotation
 * @Target({"METHOD"})
 * Class ExcelData
 * @package Hzx\ExcelDto\Annotation
 */
#[Attribute(Attribute::TARGET_METHOD)]
class ExportExcel extends AbstractAnnotation
{
    /**
     * @var string
     */
    public string $property;

    /**
     * @var string
     */
    public string $path = BASE_PATH . '/storage/exports';

    /**
     * @var string
     */
    public string $group = 'local';

    /**
     * @var string
     */
    public string $filename = '';


    public function collectMethod(string $className, ?string $target): void
    {
        if (isset($this->property)) {
            DtoListenerCollector::setListener($this->property, [
                'className' => $className,
                'method'    => $target,
            ]);
        }
        AnnotationCollector::collectMethod($className, $target, static::class, $this);
    }
}