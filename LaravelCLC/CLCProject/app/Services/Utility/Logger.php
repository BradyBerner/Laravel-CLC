<?php

namespace App\Services\Utility;

use GuzzleHttp\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;

class MyLogger implements ILogger{
    
    private static $logger = null;
    
    static function getLogger(){
        if(self::$logger == null){
            self::$logger = new Logger('InClassActivity');
            $stream = new StreamHandler('storage/logs/InClassActivity.log', Logger::DEBUG);
            $stream->setFormatter(new LineFormatter("%datetime% : %level_name% : %message% %context%\n", "g: iA n/j/Y"));
            
            self::$logger->pushHandler($stream);
        }
        return self::$logger;
    }
    
    public function debug($message, $data=[]){
        self::getLogger()->debug($message, $data);
    }
    
    public function warning($message, $data=[]){
        self::getLogger()->warning($message, $data);
    }
    
    public function error($message, $data=[]){
        self::getLogger()->error($message, $data);
    }
    
    public function info($message, $data=[]){
        self::getLogger()->info($message, $data);
    }
}