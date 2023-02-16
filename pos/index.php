<?php
session_start();

use Core\Model\User;
use Core\Router;

spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'Core') === false)
        return;
    $class_name = str_replace("\\", '/', $class_name);
    $file_path = __DIR__ . "/" . $class_name . ".php";
    require_once $file_path;
});

if (isset($_COOKIE['user_id']) && !isset($_SESSION['user'])){
    $user = new User(); 
    $logged_in_user = $user->get_by_id($_COOKIE['user_id']); 
    $_SESSION['user'] = array( 
        'username' => $logged_in_user->username,
        'display_name' => $logged_in_user->display_name,
        'user_id' => $logged_in_user->id,
        'role'=>$logged_in_user->role,
        'image'=>$logged_in_user->image,
        'is_admin_view' => true
    );
}




Router::get('/', 'authentication.login'); 
Router::get('/registration', 'authentication.signup'); 
Router::post('/sign', 'authentication.sign'); 
Router::post('/password', 'authentication.password'); 


Router::get('/logout', "authentication.logout"); 
Router::post('/authenticate', "authentication.validate"); 


Router::get('/dashboard', "admin.index");


Router::get('/items', "items.index"); 
Router::get('/item', "items.single"); 
Router::get('/items/create', "items.create"); 
Router::post('/items/store', "items.store"); 
Router::get('/items/edit', "items.edit"); 
Router::post('/items/update', "items.update"); 
Router::get('/items/delete', "items.delete");
Router::post('/items/image', "items.image");



Router::get('/transactions',"transactions.index");
Router::post('/transactions/create',"transactions.create");
Router::delete('/transactions/delete',"transactions.delete");
Router::post('/transactions/update', 'transactions.update');
Router::post('/user/single', 'transactions.single');

Router::get('/sales',"sales.index");
Router::get('/sales/all_transactions',"sales.all_transactions");
Router::get('/sales/delete',"sales.delete");
Router::get('/sales/single',"sales.single");
Router::get('/sales/delete',"sales.delete");
Router::get('/sales/edit', "sales.edit"); 
Router::post('/sales/update', "sales.update");




Router::get('/users', "users.index"); 
Router::get('/user', "users.single"); 
Router::get('/users/create', "users.create"); 
Router::post('/users/store', "users.store"); 
Router::get('/users/edit', "users.edit"); 
Router::post('/users/update', "users.update"); 
Router::get('/users/delete', "users.delete");
Router::post('/users/image', "users.image"); 


Router::get('/edit', "users.editProfile");
Router::get('/profile', "users.profile"); 
Router::post('/update', "users.updateProfile"); 
Router::post('/image', "users.imageProfile"); 



Router::redirect();
