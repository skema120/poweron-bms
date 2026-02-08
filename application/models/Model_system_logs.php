
<?php

class Model_system_logs extends MY_Model
{
    const DB_TABLE = 'system_logs';
    const DB_TABLE_PK = 'logs_id';

 public $logs_id; 
 public $users_id; 
 public $logs_message; 
 public $logs_local_ip; 
 public $logs_date_time;
 public $logs_transaction;  
}