<?php

namespace Core\Controller;
use Core\Helpers\Tests;
use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Users extends Controller
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
         * Gets all users
         *
         * @return array
         */
        public function index()
        {
                //the user can rech this page just if have user:read permission
                $this->permissions(['user:read']);

                // include file index in folder users that have all users
                $this->view = 'users.index';

                //make instance of model User to have info that i need from database 
                $user = new User; 

                // here we use the Test to check if i have all users from database or not
                self::check_if_empty($user->get_all());

                // now i put all users form db in variable data to show it in the privous html script
                $this->data['users'] = $user->get_all();

                // counting number of data that come from database
                $this->data['users_count'] = count($user->get_all());
        }
        /**
     * Gets specific user
     *
     * @return array
     */

        public function single()
        {
                //the user can see this page just if have user:read permission
                $this->permissions(['user:read']);

                // we use test to check if i have id in get or not
                self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");

                // indicate the html page that i want it 
                $this->view = 'users.single';

                // make instanse of User model
                $user = new User();

                // put the information of user that i need in variable by using method get_by_id();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Display the HTML form for user creation
         *
         * @return void
         */
        public function create()
        {
                //the user can see this page just if have user:create permission
                $this->permissions(['user:create']);

                //that will includ the html that i want to see
                $this->view = 'users.create';
        }

        /**
         * Creates new user
         *
         * @return void
         */
        public function store()
        {
                //the user can see this page just if have user:create permission
                $this->permissions(['user:create']);

                // make validation on usename and display_name and email to make sure not empty
                self::check_if_empty($_POST['username']);
                self::check_if_empty($_POST['display_name']);
                self::check_if_empty($_POST['email']);

                // i use method to protect $_post from xss attack
                $this->htmlspecial($_POST);

                //make instance of User model
                $user = new User();

                //i put variable that have last id to make the image uniqe as possible
                $data['photo_count']=$user->last("users");
                $conuter=(int)$data['photo_count'][0]+"1";

                //declear variable that have username value to make image uniqe as possible
                $name=$_POST['username'];

                //declear variable that have string type
                $file_name = '';

                //check if the globle variable $_FIlES is empty or not
                if (!empty($_FILES)) {
                        // to find the extention of image we need to divide  $_FILES['image']['type'] in the last /
                $file_ext = substr(
                $_FILES['image']['type'], 
                strpos($_FILES['image']['type'], '/') + 1 // 5
                );

                //now reassign the $file_name to new name to save it in folder image 
                $file_name = "image-.$name.$conuter.{$file_ext}";
                
                move_uploaded_file($_FILES['image']['tmp_name'], "./resources/image/$file_name");
                }
                
                //if $_FILES['image']['name'] empty i want to put defult image
                if(empty($_FILES['image']['name'])){
                        $file_name="defult.jpg";
                }
               
                //now i want to reassign $_POST['image'] to new name of image
                $_POST['image']=$file_name;
                
                //make password hash
                $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
                switch ($_POST['role']) {
                        case 'admin':
                                $permissions = User::ADMIN;
                                break;
                        case 'seller':
                                $permissions = User::SELLER;
                                break;
                        case 'porcurement':
                                $permissions = User::PROCUREMENT;
                                break;
                        case 'accountant':
                                $permissions = User::ACCOUNTANT;
                                break;
                }
                
                //make array from constant user string to put it in db
                $_POST['permissions'] = \serialize($permissions);

        
                //here i want to create $_POSt in database
                $user->create($_POST);
                
                //after the create new user will redirect user to /users that contain all users
                Helper::redirect('/users');
        }

        /**
         * Display the HTML form for user update
         *
         * @return void
         */
        public function edit()
        {
                //the user can see this page just if have 'user:read', 'user:update' permission
                $this->permissions(['user:read', 'user:update']);

                // we use test to check if i have id in get or not
                self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
                
                //that will includ the html that i want to see
                $this->view = 'users.edit';

                //make instance of model User to have info that i need from database
                $user = new User();
                // put the information of user that i need in variable by using method get_by_id();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Updates the user
         *
         * @return void
         */
        public function update()
        {
                //the user can reach this page just if have 'user:read', 'user:update' permission
                $this->permissions(['user:read', 'user:update']);

                // make validation on username and display_name andemail to make sure not empty
                self::check_if_empty($_POST['username']);
                self::check_if_empty($_POST['display_name']);
                self::check_if_empty($_POST['email']);

                //protect the $_POST from xss attacks
                $this->htmlspecial($_POST);

                //make instance of model User to have info that i need from database 
                $user = new User();
                
                //assign variable for permission
                $permissions = null;

                //make switch statment to depend on role and every role have different permissions
                switch ($_POST['role']) {
                        case 'admin':
                                $permissions = User::ADMIN;
                                break;
                        case 'seller':
                                $permissions = User::SELLER;
                                break;
                        case 'porcurement':
                                $permissions = User::PROCUREMENT;
                                break;
                        case 'accountant':
                                $permissions = User::ACCOUNTANT;
                                break;
                }
                
                //make array from constant user string to put it in db
                $_POST['permissions'] = \serialize($permissions);

                // $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);

                //update the user in database
                $user->update($_POST);

                //after update the user will redirect the user to single user page
                Helper::redirect('/user?id=' . $_POST['id']);
        }

        /**
         * Delete the user
         *
         * @return void
         */
        public function delete()
        {
                //the user can see this page just if have 'user:read', 'user:delete' permission
                $this->permissions(['user:read', 'user:delete']);

                // we use test to check if i have id in get or not
                self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
               
                //make instance of model User to have info that i need from database
                $user = new User();
$user_id= $_GET['id'];
                $stmt2=$user->connection->prepare("DELETE FROM users_transactions  WHERE user_id=?");
                $stmt2->bind_param('i', $user_id);
                $stmt2->execute();
                $result = $stmt2->get_result(); 
                $stmt2->close();


                //delete the user from db
                $user->delete($_GET['id']);

                //redirect the user to all users page
                Helper::redirect('/users');
        }
        /**
         * Updates the user's image
         *
         * @return void
         */
        public function image()
    {

       //the user can see this page just if have 'user:read', 'user:update' permission
        $this->permissions(['user:read', 'user:update']);

        //check if $_FILES empty or not
        self::check_if_empty($_FILES);

        //make instance of User model
        $user = new User();
        // $data['photo_count']=$user->last("users");
        // $conuter=(int)$data['photo_count'][0]+"1";

        //this step to make image uniqe
        $selected= $user->get_by_id($_POST['id']);
        $name=$selected->username;
        
        //declear variable that have string type
        $file_name = '';

        //check if the globle variable $_FIlES is empty or not
        if (!empty($_FILES)) {
        $file_ext = substr(
                // to find the extention of image we need to divide  $_FILES['image']['type'] in the last /
            $_FILES['image']['type'], 
            strpos($_FILES['image']['type'], '/') + 1 
        );
        
        //now reassign the $file_name to new name to save it in folder image 
        $file_name = "image-.$name.{$file_ext}";
        move_uploaded_file($_FILES['image']['tmp_name'], "./resources/image/$file_name");
        }

        //if $_FILES['image']['name'] empty i want to put defult image
        if(empty($_FILES['image']['name'])){
                $file_name="defult.jpg";
        }
        //now i want to reassign $_POST['image'] to new name of image
        $_POST['image']=$file_name;
        
        // i use method to protect $_post from xss attack
        $this->htmlspecial($_POST);

        //update the image in db
        $user->update($_POST);

        //redirect the use to user single page that i update it
        Helper::redirect('/user?id=' . $_POST['id']);

    }
     /**
     * Display the HTML form for user update
     *
     * @return void
     */
    public function editProfile()
    {
            // we use test to check if i have id in get or not
            self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");

            //that will includ the html that i want to see
            $this->view = 'edit';

            //make instance of model user to have info that i need from database 
            $user = new User();

        // put the information of user that i need in variable by using method get_by_id();
            $this->data['user'] = $user->get_by_id($_GET['id']);
    }

    public function updateProfile()
        {
                 // make validation on username and display_name,email
                self::check_if_empty($_POST['username']);
                self::check_if_empty($_POST['display_name']);
                self::check_if_empty($_POST['email']);

                //protect the $_POST from xss attacks
                $this->htmlspecial($_POST);

                //make instance of model User to have info that i need from database
                $user=new User;

                //update the user in database
                $user->update($_POST);

                //redirect after update depend on the user
                Helper::redirect('./');
        }

        /**
         * update image of the user
         *
         * @return void
         */
       
    public function imageProfile()
    {
        //check if $_FILES empty or not
        self::check_if_empty($_FILES);

        //make instance of User model
        $user = new User();

        //i put variable that have last id to make the image uniqe as possible
        $data['photo_count']=$user->last("users");
        $conuter=(int)$data['photo_count'][0]+"1";

        // make another variable to emphesis to make image name unique
        $selected= $user->get_by_id($_POST['id']);
        $name=$selected->username;

        //declear variable that have string type
        $file_name = '';

        //check if the globle variable $_FIlES is empty or not
        if (!empty($_FILES)) {
                 // to find the extention of image we need to divide  $_FILES['image']['type'] in the last /
        $file_ext = substr(
            $_FILES['image']['type'], // 'image/jpeg'
            strpos($_FILES['image']['type'], '/') + 1 // 5
        );
        
        //now reassign the $file_name to new name to save it in folder image 
        $file_name = "image-.$name.$conuter.{$file_ext}";
        
        move_uploaded_file($_FILES['image']['tmp_name'], "./resources/image/$file_name");
        }

        //if $_FILES['image']['name'] empty i want to put defult image
        if(empty($_FILES['image']['name'])){
                $file_name="defult.jpg";
        }

        //now i want to reassign $_POST['image'] to new name of image
        $_POST['image']=$file_name;
        
        // i use method to protect $_post from xss attack
        $this->htmlspecial($_POST);

        //update the image in db
        $user->update($_POST);

        //redirect after update depend on the user
        Helper::redirect('./');
        }

        public function profile()
        {
                // we use test to check if i have id in get or not
                self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
                
                //that will includ the html that i want to see
                $this->view = 'profile';

                //make instance of model User to have info that i need from database
                $user = new User();

                // put the information of user that i need in variable by using method get_by_id();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

       
}
