<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/16
 * Time: 4:12 下午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto;


use Hyperf\Di\Annotation\AnnotationCollector;
use Hzx\ExcelDto\Annotation\ExcelData;
use Hzx\ExcelDto\Annotation\ExcelProperty;
use Hzx\ExcelDto\Annotation\ExportExcel;
use Hzx\ExcelDto\Exception\DtoException;
use Hzx\ExcelDto\Helper\Helper;

class AnnotationManager
{
    public function getDtoValue(string $className, string $method, array $arguments)
    {
        $data = $this->getAnnotationOfData(ExportExcel::class, $className, $method);

        $data['basic']['filename'] = $arguments['filename'] ?? $data['basic']['filename'] ?: Helper::filename() . '.xlsx';

        return $data;
    }

    protected function getAnnotationOfData(string $annotation, string $className, string $method): array
    {
        $collector = AnnotationCollector::get($className);
        $result = $collector['_m'][$method][$annotation] ?? null;
        if (!$result instanceof $annotation) {
            throw new DtoException(sprintf('Annotation %s in %s:%s not exist.', $annotation, $className, $method));
        }

        $annMate = null;
        $annName = ExcelProperty::class;
        $annotation = AnnotationCollector::getClassesByAnnotation(ExcelData::class);
        foreach ($annotation as $key => $value) {
            if ($result->property === $value->name) {
                $annMate = AnnotationCollector::get($key);
                break;
            }
        }
        if (!isset($annMate['_c'])) {
            throw new DtoException('Property "' . $result->property . '" Not found');
        }
        $property = &$annMate['_p'];
        $fields = [];
        foreach ($property as $name => $item) {
            $fields[$item[$annName]->index] = [
                'name'  => $name,
                'value' => $item[$annName]->value
            ];
        }
        ksort($fields);
        $data = [
            'basic' => $result->toArray(),
            'field' => $fields
        ];
        return $data;
    }
}