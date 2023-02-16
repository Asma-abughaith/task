<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Item;
use Core\Model\Transaction;
use Core\Helpers\Tests;

class Sales extends Controller
{
        use Tests;
         /**
        * make instance of class view
        *
        * @return void
        */
        public function render()
        {
                if (!empty($this->view))
                        $this->view();
        }
         /**
        * check if user login or not and if admin will show him specific view
        *
        * @return void
        */
        
        function __construct()
        {
                $this->auth();
                $this->admin_view(true);
        }
         /**
         * Gets all items
         *
         * @return array
         */

        public function index()
        {
                
                $this->view = 'sales.index';
        
        }
       
       
}