
<?php

class Model_inventory extends MY_Model
{
    const DB_TABLE = 'poweron_inventory';
    const DB_TABLE_PK = 'inventory_id';

 public $inventory_id; 
 public $supplier_id;
 public $inventory_item_brand; 
 public $inventory_item_sub_class; 
 public $inventory_item_description; 
 public $inventory_item_unit; 
 public $inventory_item_qty_onhand; 
 public $inventory_item_qty_received; 
 public $inventory_item_date_created;
 public $inventory_item_created_by;
 
}