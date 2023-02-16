<?php

namespace Core\Model;

use Core\Base\Model;

class User extends Model
{
    // assign constants that contain the permission of all roles

    const ADMIN = array(
        "item:read", "item:create", "item:update", "item:delete",
        "user:read", "user:create", "user:update", "user:delete",
        "transaction:read", "transaction:create", "transaction:update", "transaction:delete"
    );

    const SELLER = array(
        "transaction:create", "transaction:update","transaction:delete",
    );

    const PROCUREMENT = array(
        "item:read", "item:create", "item:update","item:delete"
        
    );

    const ACCOUNTANT = array(
        "transaction:read", "transaction:update","transaction:delete"
    );

        /**
         * check the username if he exists or not
         *
         * @return void
         */
    public function check_username(string $username)
    {
        $result = $this->connection->query("SELECT * FROM $this->table WHERE username='$username'");
        if ($result) { // if there is an error in the connection or if there is syntax error in the SQL.
            if ($result->num_rows > 0) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
       
}
