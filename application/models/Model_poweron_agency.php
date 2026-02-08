
<?php

class Model_poweron_agency extends MY_Model
{
    const DB_TABLE = 'poweron_agency';
    const DB_TABLE_PK = 'agency_id';

 public $agency_id; 
 public $agency_po_number;
 public $agency_name;
 public $agency_date_received;
 public $agency_person_received;
 public $agency_due_date;
 public $agency_delivery_term;
 public $agency_amount;
 public $agency_status;
 public $agency_remarks;
 
}