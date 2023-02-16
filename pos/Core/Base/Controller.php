<?php

namespace Core\Base;
use Core\Model\User;
use Core\Helpers\Helper;


abstract class Controller
{
   /**
    * make render abstract to force any controller to have view or encode data to see it in browser
    *
    * @return void
    */
    abstract public function render();

    //there are two variables in view class so we prepare it 
    protected $view = null;
    protected $data = array();

    /**
    * make instance of class view
    *
    * @return void
    */
    protected function view()
    {
        new View($this->view, $this->data);
    }

    /**
    * check if there is any user in login or not if they not user will redirect them to login
    *
    * @return void
    */
    protected function auth()
    {
        if (!isset($_SESSION['user'])) {
            Helper::redirect('/');
            exit;
        }
    }

    // /**
    //  * Check if the user has the assigned permissions.
    //  *
    //  * @param array $permissions_set
    //  * @return void
    //  */
    // protected function permissions(array $permissions_set)
    // {
    //     $this->auth();
    //     $user = new User;
    //     $assigned_permissions = $user->get_permissions();
    //     // check if the user has all the permissions_set
    //     foreach ($permissions_set as $permission) {
    //         if (!in_array($permission, $assigned_permissions)) {

    //            //if the user has role seller and want to acess any url that include his permission will redirect him to the selling dashbard
    //             if($_SESSION['user']['role']=='seller'){
    //                     Helper::redirect('/sales');

    //             //if the user has role accountant and want to acess any url that include his permission will redirect him to the transaction dashbard
    //             }elseif($_SESSION['user']['role']=='accountant'){
    //                     Helper::redirect('/sales/all_transactions');
                        
    //             //if the user has role porcurement and want to acess any url that include his permission will redirect him to the stock manegment dashbard
    //             }elseif($_SESSION['user']['role']=='porcurement'){
    //                     Helper::redirect('/items');
    // }
    //         }
    //     }    
    // }

    /**
     * Change the header view. check View.php line 18
     *
     * @param boolean $switch
     * @return void
     */
    protected function admin_view(bool $switch): void
    {

        if (isset($_SESSION['user']['is_admin_view'])) {
            $_SESSION['user']['is_admin_view'] = $switch;
        }
    }
    /**
     * make the input from user secured from xss attack
     *
     * @param  $variable
     * @return secured data from xss attack
     */
    protected function htmlspecial(array &$variable) {
        //we need to make loop over the value of input to make it securied
        foreach ($variable as &$value) {
            //this if statement to check if the value array or not if array we will use the function again over the value
            if (is_array($value)) {
                htmlspecial($value);
            } else {
                // htmlspecialchars this function will transfer any script to special character 
                $value = \htmlspecialchars($value);
            }
        }
    }

} 

