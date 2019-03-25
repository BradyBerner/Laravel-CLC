<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Utility;

interface ILoggerService{

    public function debug($message, $data);
    
    public function info($message, $data);
    
    public function warning($message, $data);
    
    public function error($message, $data);
}