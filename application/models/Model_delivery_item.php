
<?php

class Model_delivery_item extends MY_Model
{
    const DB_TABLE = 'poweron_delivery_item';
    const DB_TABLE_PK = 'id';

 public $id; 
 public $delivery_id; 
 public $inventory_id; 
 public $item_serial_number; 
 public $delivery_item_qty;
 public $delivery_warranty;
}