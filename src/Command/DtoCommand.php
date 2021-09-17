<?php
/**
 * Created By PhpStorm
 * Author Wongzx <wonghzx@163.com>
 * Date: 2021/9/17
 * Time: 10:43 上午
 */
declare(strict_types=1);

namespace Hzx\ExcelDto\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Symfony\Component\Console\Input\InputOption;


/**
 * @Command
 */
class DtoCommand extends HyperfCommand
{
    /**
     * 执行的命令行
     *
     * @var string
     */
    protected $name = 'dto:publish';

    public function handle()
    {
        // 从 $input 获取 config 参数
        $argument = $this->input->getOption('config');
        if ($argument) {
            $this->copySource(__DIR__ . '/../../publish/dto.php', BASE_PATH . '/config/autoload/dto.php');
            $this->line('The dto configuration file has been generated', 'info');
        }
    }

    protected function getOptions()
    {
        return [
            ['config', NULL, InputOption::VALUE_NONE, 'Publish the configuration for dto']
        ];
    }

    /**
     * 复制文件到指定的目录中
     * @param $copySource
     * @param $toSource
     */
    protected function copySource($copySource, $toSource)
    {
        copy($copySource, $toSource);
    }
}