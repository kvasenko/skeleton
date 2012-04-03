<?php

/**
 * Copyright (c) 2012 by Bluz PHP Team
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * @namespace
 */
namespace Bluz;

/**
 * Profiler
 *
 * @category Bluz
 * @package  Profiler
 *
 * @author   Anton Shevchuk
 * @created  08.07.11 13:09
 */
class Profiler
{
    /**
     * @todo Use $_SERVER['REQUEST_TIME_FLOAT'] for PHP 5.4
     * @var null
     */
    static protected $_start = null;
    static protected $_timer = null;
    static protected $_logs = array();

    /**
     * log
     *
     * @param $message
     * @return void
     */
    public static function log($message)
    {
        if (!self::$_start) {
            if (defined('TIMER')) {
                self::$_start = TIMER;
                self::$_timer = TIMER;
            } else {
                self::$_start = microtime(true);
                self::$_timer = microtime(true);
            }
        }

        $curTimer = microtime(true);
        $curMemory = ceil((memory_get_usage()/1024));

        $args = func_get_args();
        array_shift($args);

        array_unshift(
            $args,
            ($curTimer - self::$_start),
            ($curTimer - self::$_timer),
            $curMemory
        );

        self::$_logs[] = vsprintf(
            "%f :: %f :: %s kb // {$message}",
            $args
        );

        self::$_timer = $curTimer;
    }

    /**
     * return logs
     *
     * @return array
     */
    public static function data()
    {
        return self::$_logs;
    }
}
