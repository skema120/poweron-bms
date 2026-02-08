
<?php

class Model_poweron_users extends MY_Model
{
    const DB_TABLE = 'poweron_users';
    const DB_TABLE_PK = 'users_id';

 public $users_id;
 public $image; 
 public $username; 
 public $password; 
 public $first_name; 
 public $last_name; 
 public $users_date_created; 
 public $users_account_type; 
}