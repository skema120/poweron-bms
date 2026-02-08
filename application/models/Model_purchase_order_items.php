
<?php

class Model_purchase_order_items extends MY_Model
{
    const DB_TABLE = 'poweron_purchase_order_items';
    const DB_TABLE_PK = 'id';

 public $id;
 public $po_id;
 public $unit;
 public $qty;
 public $description;
 public $unit_cost;
}