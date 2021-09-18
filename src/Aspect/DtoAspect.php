<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/16
 * Time: 4:05 下午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Aspect;


use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hzx\ExcelDto\Annotation\ExportExcel;
use Hzx\ExcelDto\AnnotationManager;
use Hzx\ExcelDto\GenExcelManager;

/**
 * @Aspect
 * Class DtoAspect
 * @package Hzx\ExcelDto\Aspect
 */
class DtoAspect extends AbstractAspect
{
    public $annotations = [
        ExportExcel::class,
    ];

    /**
     * @var GenExcelManager
     */
    protected $manager;

    /**
     * @var AnnotationManager
     */
    protected $annotationManager;


    public function __construct(GenExcelManager $genExcelManager, AnnotationManager $annotationManager)
    {
        $this->manager = $genExcelManager;
        $this->annotationManager = $annotationManager;
    }

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $className = $proceedingJoinPoint->className;
        $method = $proceedingJoinPoint->methodName;
        $arguments = $proceedingJoinPoint->arguments['keys'];
        $result = $this->annotationManager->getDtoValue($className, $method, $arguments);

        /* 获取返回数据 */
        $result['data'] = $proceedingJoinPoint->process();

        $filename = ($this->manager->getDriver($result['basic']))->handle($result);
        $result['basic']['full_path'] = $filename;
        unset($result['field']);
        return $result;
    }
}