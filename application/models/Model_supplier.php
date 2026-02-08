
<?php

class Model_supplier extends MY_Model
{
    const DB_TABLE = 'poweron_supplier';
    const DB_TABLE_PK = 'supplier_id';

 public $supplier_id; 
 public $supplier_name; 
 public $supplier_address; 
 public $supplier_contact_person; 
 public $supplier_contact_number; 
}