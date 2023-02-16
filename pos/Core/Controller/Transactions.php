<?php

namespace Core\Controller;
use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Item;
use Core\Model\User;
use Core\Model\Transaction;


class Transactions extends Controller
{  
        
        protected $request_body;
        protected $http_code = 200;

        protected $response_schema = array(
                "success" => true, 
                "message_code" => "", 
                "body" => []
        );
        /*
        *this method will directly make response from method to json object to send it to html page
        * return
        */
        public function render()
        {
                //we should change the content type as json type
                header("Content-Type: application/json"); 
                //control the http_response conde depend on response
                http_response_code($this->http_code); 
                //we should encode the response to be acceptable to see it in html page
                echo json_encode($this->response_schema);
                
                
        }
        /** 
        *this method will automatically make request body json_decode to make it php object to use it 
        * return
        */
        function __construct()
        {

                $this->request_body = json_decode(file_get_contents("php://input", true)); 
                
                   
        }
        
        /** 
        *fetch all transactions that meet the conditions
        * @return array
        */
        public function index()
        {   
                
                // make instance of transaction model to call with db
               $users = new User;

               //we will fetch the data that belongs to user from table users_transactions(here we prapare the sql statment)
               $all_users = $users->get_all();
              
               // bind the parameter
               

                //assign variable to put inside the object that i need which is the transaction_id and user_id 
               

               //reassign the response_schema['body'] to the data i need
               $this->response_schema['body'] = $all_users;
               

               //reassgin the response_schema['message_code'] with massage i need
               $this->response_schema['message_code'] = "transactions_collected_successfuly";
             
        }

       

        /**
         * delete the transaction
         * 
         */
        public function delete()
        {

                $user= new User;
               
                $user->delete($this->request_body->id);
                
        }
      
         /**
          * update the transaction quantity and the stock of item
          */
        

        public function update()
        {
               
                $user = new User();
                $user->update($_POST);
                $this->response_schema['body'] = $user->get_by_id($_POST['id']);
                   
        }
        public function single()
        {
               
                $user = new User();
                $this->response_schema['body'] = $user->get_by_id($_POST['id']);
                
        }

}
