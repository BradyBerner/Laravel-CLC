<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Utility;

//TODO:: add passing data support to methods
class MyLogger implements ILoggerService{
    
    private $logger = null;

    public function __construct($logger){
        $this->logger = $logger;
    }

    public function debug($message, $data=[]){
        $this->logger->debug($message);
    }
    
    public function warning($message, $data=[]){
        $this->logger->warning($message);
    }
    
    public function error($message, $data=[]){
        $this->logger->error($message);
    }
    
    public function info($message, $data=[]){
        $this->logger->info($message);
    }
}