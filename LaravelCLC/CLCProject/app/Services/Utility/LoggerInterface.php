<?php

namespace App\Services\Utility;

interface ILogger{
    
    private static function getLogger();
    
    public function debug($message, $data);
    
    public function info($message, $data);
    
    public function warning($message, $data);
    
    public function error($message, $data);
}