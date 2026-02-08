
<?php

class Model_poweron_users_permissions extends MY_Model
{
    const DB_TABLE = 'poweron_users_permissions';
    const DB_TABLE_PK = 'permission_id';

 public $permission_id; 
 public $users_account_type; 
 public $p_edit; 
 public $p_delete; 
 public $p_supplier; 
 public $p_manage;
 public $p_inventory;
 public $p_onhand;
 public $p_delivery;
 public $p_purchase_order;
 public $p_distributor;
 public $p_agency;
 public $p_system_settings;
 public $p_user_permission;
 public $p_change_password;
 public $p_user_list;
 public $p_system_log;
}