<?php

namespace Core\Helpers;

use Core\Model\User;

class Helper
{
     /**
     * redirect to specific url
     *
     * @return void
     */
    public static function redirect(string $url): void
    {
        header("Location: $url");
    }

   
    
}
