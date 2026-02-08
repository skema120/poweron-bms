
<?php

class Model_purchase_order extends MY_Model
{
    const DB_TABLE = 'poweron_purchase_order';
    const DB_TABLE_PK = 'po_id';

 public $po_id; 
 public $po_number;
 public $supplier_id;
 public $po_date;
 public $po_classification;
 public $po_payment_terms;
 public $po_end_user;
 public $po_status;
 public $po_created_by;
}