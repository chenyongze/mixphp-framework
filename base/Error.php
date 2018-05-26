<?php

namespace mix\base;

/**
 * Error类
 * @author 刘健 <coder.liu@qq.com>
 */
class Error
{

    // 注册错误处理
    public static function register()
    {
        error_reporting(E_ALL);
        set_error_handler(['mix\base\Error', 'appError']);
        set_exception_handler(['mix\base\Error', 'appException']);
        register_shutdown_function(['mix\base\Error', 'appShutdown']);
    }

    // 错误处理
    public static function appError($errno, $errstr, $errfile = '', $errline = 0)
    {
        throw new \mix\exceptions\ErrorException($errno, $errstr, $errfile, $errline);
    }

    // 停止处理
    public static function appShutdown()
    {
        if ($error = error_get_last()) {
            self::appException(new \mix\exceptions\ErrorException($error['type'], $error['message'], $error['file'], $error['line']));
        }
    }

    // 异常处理
    public static function appException(\Exception $e)
    {
        \Mix::app()->error->handleException($e, true);
    }

}