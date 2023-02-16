<?php

namespace Core\Helpers;

use Exception;

trait Tests
{
     /**
     * check if exists 
     *@param $expr $msg
     * @return void
     */
    protected static function check_if_exists($expr, $msg)
    {
        try {
            if (!$expr) {
                throw new \Exception($msg);
                
            }
        } catch (\Exception $error) {
          
            echo $error->getMessage();
            
           
            
            die;
        }
    }
    /**
     * check if empty 
     *@param $var
     * @return void
     */
    protected static function check_if_empty($var)
    {
        try {
            if (empty($var)) {
                throw new \Exception("Empty data or you missed required information");
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
            die;
        }
    }

    

    
}
