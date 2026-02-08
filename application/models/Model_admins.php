
<?php

class Model_admins extends MY_Model
{
    const DB_TABLE = 'poweron_users';
    const DB_TABLE_PK = 'users_id';

 public $users_id; 
 public $username;
 public $password;
 public $first_name; 
}