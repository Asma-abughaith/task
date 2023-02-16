<?php

namespace Core\Base;

class Model
{
    public $connection;
    protected $table;

    /**
    * automatically call this function when you create an object from a class and have connection and related table function
    *
    * @return void
    */
    public function __construct()
    {
        $this->connection(); // connection is ready
        $this->relate_table();
    }

     /**
    * will automatically call this function at the end of the script and close the connection with database
    *
    * @return void
    */

    public function __destruct()
    {
        $this->connection->close();
    }

     /**
    * Fetches all data from current table from the DB.
    *
    * @return array
    */

    public function get_all(): array
    {
        // declear variable type array to put all data in specific table inside it
        $data = array();

        // make connection and select all data in specific table
        $result = $this->connection->query("SELECT * FROM $this->table");

        // if num rows of result more than 0 that mean there is data collected from database
        if ($result->num_rows > 0) {

            // we will make loop over all rows to fetch data 
            while ($row = $result->fetch_object()) {

                //put the data in the previous  array 
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
    * Fetches specific data by id from current table from the DB.
    *
    * @return array
    */
    
    public function get_by_id($id)
    {
        // prepare the sql statement
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id=?"); 
        // bind the parameter
        $stmt->bind_param('i', $id); 
        // execute the statement on the DB
        $stmt->execute();
        // get the result of the execution 
        $result = $stmt->get_result(); 
        //close 
        $stmt->close();
        //fetche the result 
        return $result->fetch_object();
    }

    /**
    * delete the data from table that we need to delete it
    *
    * @return void
    */

    public function delete($id)
    {
        // prepare the sql statement
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id=?");
        // bind the params per data type 
        $stmt->bind_param('i', $id);
        // execute the statement on the DB 
        $stmt->execute();
        // get the result of the execution 
        $result = $stmt->get_result(); 
        $stmt->close();
        return $result;
    }

     /**
    * Create new data 
    *@param $data
    * @return array
    */

    public function create($data)
    {
        // Get dynamic keys title, contenta
        // $keys: string
        // Get dynamic values coresponds to the key 
        // $values: string


        //we need to declear variable in type string to put in side all keys
        $keys = '';

        //we need to declear variable in type string to put in side all values
        $values = '';

        //we need to declear variable in  string type to put the type of value for sql injection to bind parameter
        $data_types = '';

        //i need array to put inside it value of bind parameter 
        $value_arr = array();

        //$data its parameter from function create and i need to make loop to seperate the key and value
        foreach ($data as $key => $value) {

            // this statment to emphesis the key and value not last because "," will be make error in syntax
            if ($key != \array_key_last($data)) {

                //in key i want it with each other by concatnat
                $keys .= $key . ', ';

                //in value i want it with each other by concatnat with value ? to sql injection
                $values .= "?, ";
            } else {

                // if key is last one will not put ","
                $keys .= $key;

                // if value is last one will not put "," and value will ? to sql injection
                $values .= "?";
            }

            switch ($key) {
                // this switch statment i need to declear the type of all value of key
                case 'id':
                case 'quantity':
                case 'items_id':
                    $data_types .= "i";
                    break;

                case'cost':
                case 'selling_price':
                case 'selling_price':
                    $data_types .= "d";
                    break;


                default:
                    $data_types .= "s";
                    break;
            }

            $value_arr[] = $value;
        }

       
        // prepare the sql statement
        $sql = "INSERT INTO $this->table ($keys) VALUES ($values)";
        
        $stmt = $this->connection->prepare($sql);

        // bind the params per data type 
        $stmt->bind_param($data_types, ...$value_arr);
        
        // execute the statement on the DB 
        $stmt->execute();
        $stmt->close();
    }

    /**
    * updata data 
    *@param $data
    * @return array
    */

    public function update($data)
    {
        $id_bind="";
        // declear variable to put all key value to gother
        $set_values = '';
        //declear variable to put inside type of data 
        $data_types = '';
        //declear variable to put inside id that we want to update it 
        $id = 0;
        //declear variable to put inside values to bind the value for sql injection
        $values_array=array();
        // make loop the parameter in function update
        foreach ($data as $key => $value) {
            // this if statement for last key or not 
            if ($key == 'id') {
                $id ="?";
                $id_bind=$value;
                continue;
            }
            if ($key != \array_key_last($data)) {
                
                $set_values .= "$key= ?, ";
            } else {
                
                $set_values .= "$key= ?";
            }
            switch ($key) {
                case 'quantity':
                case 'items_id':
                    $data_types .= "i";
                    break;

                case'cost':
                case 'selling_price':
                case 'selling_price':
                    $data_types .= "d";
                    break;


                default:
                    $data_types .= "s";
                    break;
            }
            //we put all value in array
            $values_array[]="$value";
            
        }
        //i put the last value was id because should arrange it in this way
        $values_array[]=$id_bind;
        //concat the type of id in the string of type of value
        $data_types .="i";
        
        $sql = "UPDATE $this->table 
            SET $set_values
            WHERE id=$id
        ";
        //prepar sql statement
        $stmt = $this->connection->prepare($sql);
        // bind the params per data type 
        $stmt->bind_param($data_types, ...$values_array);
        // execute the statement on the DB 
        $stmt->execute();
        $stmt->close();
       
       
    }

    /**
    * make connection with database 
    *@param $data
    * @return array
    */

    protected function connection()
    {
        //this configration to connecte with database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pos_borini";
      

        // Create connection
        $this->connection = new \mysqli($servername, $username, $password, $database);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    /**
    * make table dynamic in every where we call this class
    *@param $data
    * @return string
    */

    protected function relate_table()
    {
        //in this frame work the Modle singular and controller and table of DB plurlar 
        //get the name of class that make instance 
        $table_name = \get_class($this);
        //when we get the class it's will get it with namespace so we should to explode in \ 
        $table_name_arr = \explode('\\', $table_name);
        // we need the last key that the name of table but its singlular
        $class_name = $table_name_arr[\array_key_last($table_name_arr)]; // $table_name_arr[2]
        // change it to plurar 
        $final_clas_name = \strtolower($class_name) . "s";
        // the table name is ready
        $this->table = $final_clas_name;
    }
    /**
    * sum the data from column
    *@param $col & $table
    * @return array
    */
    public function sum($col,$table)
    {
        $data = array();
        $result = $this->connection->query("SELECT SUM($col) FROM $table");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                foreach ($row as $key => $value) {
                    $data[]=$value;
                }
            }

        
        return $data;
        }
    }

    /**
    * find 5 top data from specific column and specific table
    *@param $col $table $n
    * @return array
    */

    public function top($col,$table,$n)
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM $table ORDER BY $col  DESC LIMIT $n");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[]=$row;
            }

        
        return $data;
        }
    }
    /**
    * find last id in table
    *@param  $table 
    * @return array
    */
    public function last($table)
    {
        $data = array();
        $sql="SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $result=$this->connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[]=$row->id;  
            }
        return $data;
        
        }
}
/**
    * find summation with specific column and table and date  in table
    *@param  $col,$table,$date
    * @return array
    */
public function sum_total($col,$table,$n)
    {
        $data = array();
        $result = $this->connection->query("SELECT SUM($col) FROM $table WHERE created_at>=CURDATE()-$n");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                foreach ($row as $key => $value) {
                    $data[]=$value;
                }
            }

        
        return $data;
        }
    }
}

