
<?php

class Model_delivery extends MY_Model
{
    const DB_TABLE = 'poweron_delivery';
    const DB_TABLE_PK = 'delivery_id';

 public $delivery_id; 
 public $delivery_category;
 public $delivery_no; 
 public $delivery_end_user; 
 public $delivered_by; 
 public $delivery_date_delivered; 
 public $delivery_status;
}