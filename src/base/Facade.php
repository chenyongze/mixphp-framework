<?php

namespace mix\base;

/**
 * 门面基类
 * @author 刘健 <coder.liu@qq.com>
 */
class Facade
{

    // 执行静态方法
    public static function __callStatic($name, $arguments)
    {
        $instance = static::getInstance();
        return call_user_func_array([$instance, $name], $arguments);
    }

}
