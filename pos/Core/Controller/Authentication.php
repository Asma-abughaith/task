<?php

namespace Core\Controller;
use Core\Helpers\Tests;
use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Authentication extends Controller
{
        use Tests;
        private $user = null;
         /**
        * make instance of view class that have two argument $data and $view
        *
        * @return array
        */

        public function render()
        {
                if (!empty($this->view))
                        $this->view();
        }
          /**
        * check if user login or not 
        *
        * @return void
        */

        function __construct()
        {
                $this->admin_view(false);
                // if (isset($_SESSION['user']))
                // //i want to make direction depend on permission
                // Helper::redirect('/sales');
        }

        /**
         * Displays login form
         *
         * @return void
         */
        public function login()
        {
                $this->view = 'login';
        }
        public function signup()
        {
                $this->view = 'registration';
        }

        /**
         * Login Validation
         *
         * @return void
         */
        public function validate() {
          
          
                // Check if the username and password fields are filled
                if (empty($_POST['username']) || empty($_POST['password'])) {
                  // Return an error response if the fields are not filled
                  $response = false;
                  echo json_encode($response);
                  return;
                }
              
                $user = new User();
                $logged_in_user = $user->check_username($_POST['username']);
                
              
                // Check if the user exists in the database
                if (!$logged_in_user) {
                  // Return an error response if the user does not exist
                  $response = array("status"=>"false");
                  echo json_encode($response);
                  return;
                } 
              
                // Check if the password is correct
                if (!password_verify($_POST['password'], $logged_in_user->password)) {
                  // Return an error response if the password is incorrect
                  $response = array("status"=>"false");
                  echo json_encode($response);
                  return;
                }
                if ($logged_in_user->status !="1") {
                  // Return an error response if the password is incorrect
                  $response = array("status"=>"inactive");
                  echo json_encode($response);
                  return;
                }

                if ($logged_in_user->role =="admin") {
                  // Return a success response
                    $response = array("status"=>"admin");
                    echo json_encode($response);
                }else{
                  $response = array("status"=>"user");;
                  echo json_encode($response);

                }
              
                // Set the session data for the logged in user
                $_SESSION['user'] = array(
                  'username' => $logged_in_user->username,
                  'user_id' => $logged_in_user->id,
                  
                );

                // Set the user_id cookie if the "Remember me" checkbox is selected
                if (isset($_POST['remember_me'])) {
                  setcookie('user_id', $logged_in_user->id, time() + (86400 * 30)); 
                }
              
                
              
                
               
              }
    public function sign() {
     
      $password = $_POST['password'];
      if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $password)) {
        if($_POST['password'] ==$_POST['repeat']){
          unset($_POST['repeat']);
        $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
        $user = new User();
        $user->create($_POST);
        $response=true;
        echo json_encode($response);
        }else{
        
          $response="matches";
          echo json_encode($response);
          return;
        }
      }else{
        $response=false;
        echo json_encode($response);
      }
        
      
     
    }
    public function password() {
      $password = $_POST['password'];
      if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $password)) {
      if($_POST['password'] ==$_POST['repeat'])
        echo 'success';
      } else {
      echo 'error';
      }
    }

              
         /**
         * logout 
         *
         * @return void
         */

        public function logout()
        {
                \session_destroy();
                \session_unset();
                \setcookie('user_id', '', time() - 3600); 
                Helper::redirect('/');
        }
        /**
         * invalid username or password redirect  
         *
         * @return void
         */

         //if the username not in database we need to direct him to login page
        private function invalid_redirect()
        {
                $_SESSION['error'] = "Invalid Username or Password";
                Helper::redirect('/');
                exit();
        }
}