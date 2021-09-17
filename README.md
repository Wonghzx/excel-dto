# hyperf excel-dto

通过注解快速导出excel表格，默认使用 [xlswriter](https://xlswriter-docs.viest.me/) 进行表格处理

- PHP >= 7.4
- [xlswriter](https://xlswriter-docs.viest.me/) 扩展

## 1、安装

```
composer require hzx/excel-dto
```

## 2、使用

- 定义 Dto 数据对象
- @ExcelData 定义对象名称
- @ExcelProperty 定义属性

```php
use Hzx\ExcelDto\Annotation\ExcelData;
use Hzx\ExcelDto\Annotation\ExcelProperty;

/**
 * @ExcelData(name="test")
 */
class Test
{

    /**
     * @ExcelProperty(value="用户名", index="0")
     */
    public $name;

    /**
     * @ExcelProperty(value="邮箱", index="1")
     */
    public $email;


    /**
     * @ExcelProperty(value="经度", index="3")
     */
    public $longitude;

    /**
     * @ExcelProperty(value="纬度", index="4")
     */
    public $latitude;
}
```

## 3、调用

| @ExportExcel | 备注  |
| --------------------- | ------------------------ |
| property     | 对应 @ExcelData(name="test")     |
| path         | 保存路径                    |
| filename     | 为空自动生成，（可填写为传参参数）    |

```php
    use Hzx\ExcelDto\Annotation\ExportExcel;

    /**
     * @ExportExcel(property="test", path="/storage/exports")
     */
    public function test1($filename)
    {
        $faker = \Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'name'      => $faker->name,
                'email'     => $faker->email,
                'longitude' => $faker->longitude,
                'latitude'  => $faker->latitude,
            ];
        }
        return $data;
    }
    
    /**
     * @ExportExcel(property="test", path="/storage/exports")
     */
    public function test2()
    {
        $faker = \Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'name'      => $faker->name,
                'email'     => $faker->email,
                'longitude' => $faker->longitude,
                'latitude'  => $faker->latitude,
            ];
        }
        return $data;
    }
    $this->test1('test.xlsx');
    $this->test2();
```
## 导出结果

