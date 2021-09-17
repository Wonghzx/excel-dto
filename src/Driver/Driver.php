<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/17
 * Time: 11:49 上午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Driver;

use Vtiful\Kernel\Excel;
use Hzx\ExcelDto\Exception\DtoException;
use Psr\Container\ContainerInterface;

abstract class Driver implements DriverInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Excel
     */
    protected $excelObject;
    /**
     * @var mixed|string
     */
    protected $storePath;

    public function __construct(ContainerInterface $container, array $config)
    {
        $this->container = $container;
        $config['root'] .= '/' . date('YmdH') . '/';
        if (!get_extension_funcs('xlswriter')) {
            throw new DtoException('xlswriter necessary');
        }
        $this->storePath = $config['root'];
        if (!file_exists($this->storePath)) {
            $results = mkdir($this->storePath, 0777, true);
            if (!$results) {
                throw new DtoException('Has no permission to create directory!');
            }
        }
        $this->config = $config;
        $this->fetchDriver();
    }

    public function fetchDriver(): object
    {
        $this->excelObject = new Excel(['path' => $this->storePath]);
        return $this->excelObject;
    }

    public abstract function handle(array $data = []);
}