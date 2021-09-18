<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/17
 * Time: 9:54 上午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto;


use Hyperf\Contract\ConfigInterface;
use Hzx\ExcelDto\Driver\DriverInterface;
use Hzx\ExcelDto\Driver\LocalDriver;

class GenExcelManager
{

    /**
     * @var array
     */
    protected array $drivers = [];


    /**
     * @var ConfigInterface
     */
    protected ConfigInterface $config;


    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function getDriver(array $basic = [])
    {
        $name = $basic['group'] ?: 'local';
        if (isset($this->drivers[$name]) && $this->drivers[$name] instanceof DriverInterface) {
            return $this->drivers[$name];
        }

        $config = $this->config->get('dto');
        if (!isset($config) || empty($config[$name])) {
            $config = [
                'driver' => LocalDriver::class,
                'root'   => $basic['path'] ?: BASE_PATH . '/storage/exports',
            ];
        }
        $driverClass = $config['driver'];
        $driver = make($driverClass, ['config' => $config]);

        return $this->drivers[$name] = $driver;
    }
}