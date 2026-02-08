<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_list extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['product'] = $this->getUsers();  
		$data['supplier'] = $this->getSupplier();
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/inventory/inventory_list.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 

	function getUsers() {
		$data = $this->fetchRawData("SELECT
										inventory_id,
										(SELECT supplier_name FROM poweron_supplier ps WHERE ps.supplier_id = pi.supplier_id) AS supplier_name,
										inventory_item_brand,
										inventory_item_sub_class,
										inventory_item_description,
										inventory_item_unit,
										IFNULL( inventory_item_qty_onhand, 0 ) inventory_item_qty_onhand,
										IF(inventory_item_qty_onhand > 0 ,'In Stock','Out of Stock' ) status,
										inventory_item_created_by,
										inventory_item_date_created 
										FROM
										poweron_inventory pi
										ORDER BY
										inventory_id DESC");
		return $data;
	}

	function getSupplier() {
		$data = $this->fetchRawData("SELECT * FROM poweron_supplier ORDER BY supplier_name ASC");
		return $data;
	}
 

	function saveDetail() {
		 $userdata = $this->session->userdata('admin_user_data');
		 date_default_timezone_set("Asia/Manila");


		$inventory_id = $this->input->post('inventory_id');
		$supplier_id = $this->input->post('supplier_id');
		$inventory_item_date_created = $this->input->post('inventory_item_date_created');
		$inventory_item_created_by = $this->input->post('inventory_item_created_by');

		$inventory_item_brand = $this->input->post('inventory_item_brand');
		$inventory_item_sub_class = $this->input->post('inventory_item_sub_class');  
		$inventory_item_description = $this->input->post('inventory_item_description');
		$inventory_item_unit = $this->input->post('inventory_item_unit');       
		$inventory_item_qty_onhand = $this->input->post('inventory_item_qty_onhand'); 
		$inventory_item_qty_received = $this->input->post('inventory_item_qty_received'); 	 

 		
	    $this->load->model('Model_inventory');
	    $product = new Model_inventory();
	    if ($inventory_id != '') {
	    	$product->inventory_id = $inventory_id;
	    } 

	     if ($inventory_item_date_created == '') {
	    	$product->inventory_item_date_created = date('Y-m-d');
	    } else {
	    	$product->inventory_item_date_created = $inventory_item_date_created;
	    }

	     
	      


	    if ($inventory_item_created_by == '') {
	    	if(isset($userdata['users_id']) !=''){
		    	$first_name = $userdata['first_name'];
		      	$last_name = $userdata['last_name'];
		      	$fullname = $first_name .' '. $last_name;

		    	$product->inventory_item_created_by =  $fullname;
	    	 }
	    } else {
	    	$product->inventory_item_created_by = $inventory_item_created_by;
	    }

	    if($inventory_id == ''){
	    	 $product->inventory_item_qty_onhand = $inventory_item_qty_received;
	    	} else{
	    		$product->inventory_item_qty_onhand = $inventory_item_qty_onhand;
	    	}

	    $product->supplier_id = $supplier_id;
	    $product->inventory_item_brand = $inventory_item_brand;
	    $product->inventory_item_sub_class = $inventory_item_sub_class;  
	    $product->inventory_item_description = $inventory_item_description;
	    $product->inventory_item_unit = $inventory_item_unit;
	    $product->inventory_item_qty_received = $inventory_item_qty_received;

	    // $product->save();


	    // ============================================================================

	   //  $serial_number = $this->input->post('serial_number');

	   //   $this->load->model('Model_inventory_item_serial_number');
	   //   foreach ($serial_number as $key => $serial_number) {
		  //   	$inventory_item_serial_number = new Model_inventory_item_serial_number();
		  //   	$inventory_item_serial_number->inventory_id = $product->inventory_id;

				// $inventory_item_serial_number->serial_number = $serial_number;
				// $inventory_item_serial_number->save();
		  //   }


		  // ==========================================================================
	    $data = $this->db->query("SELECT SUBSTRING_INDEX(inventory_id,'-',-1)+1 inventory_id FROM poweron_inventory ORDER BY inventory_id DESC LIMIT 1");
	    $row = $data->row();
		$lastID =`echo $row->inventory_id`;

				$this->load->model('Model_system_logs');
			    $system_logs = new Model_system_logs();

			    if (isset($_SERVER['HTTP_CLIENT_IP'])){
		        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		        $system_logs->logs_local_ip = $ipaddress;
			    }
			    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
			        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			        $system_logs->logs_local_ip = $ipaddress;
			    }
			    else if(isset($_SERVER['HTTP_X_FORWARDED'])){
			        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			        $system_logs->logs_local_ip = $ipaddress;
			    }
			    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])){
			        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
			        $system_logs->logs_local_ip = $ipaddress;
			    }
			    else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
			        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			        $system_logs->logs_local_ip = $ipaddress;
			    }
			    else if(isset($_SERVER['HTTP_FORWARDED'])){
			        $ipaddress = $_SERVER['HTTP_FORWARDED'];
			        $system_logs->logs_local_ip = $ipaddress;
			    }
			    else if(isset($_SERVER['REMOTE_ADDR'])){
			        $ipaddress = $_SERVER['REMOTE_ADDR'];
			        $system_logs->logs_local_ip = $ipaddress;
			    }
			    else{
			        $ipaddress = 'UNKNOWN';
			        $system_logs->logs_local_ip = $ipaddress;
			    	}

			    if ($inventory_id != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message = 'Inventory ID: " ' . $inventory_id . ' " has been successfully updated to Database';
	   			} else {
	   				$system_logs->logs_transaction = 'INSERT';
	   				$system_logs->logs_message = 'New Inventory ID: " ' . $lastID . '" has been successfully imported to Database';
	   			}


			    $system_logs->logs_date_time = date('Y-m-d H:i:s');	
			    // $system_logs->save();		    

			    if(isset($userdata['users_id']) !=''){
			    	 $system_logs->users_id = $userdata['users_id'];	 

			    	 $product->save();
			    	 $system_logs->save();
			    	 redirect(base_url('admin/inventory/inventory_list'));
			    	
			    } else{
			    	 
			    	$message = "Session Expired";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='../../login';
					</script>";
			    }

	}


	function getProductDetails() {
		$inventory_id = $this->input->post('inventory_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_inventory WHERE inventory_id = $inventory_id");
		echo json_encode($data);
	}

	function getProductSerialNumberDetails() {
		$inventory_id = $this->input->post('inventory_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_inventory_item_serial_number WHERE inventory_id = $inventory_id");
		echo json_encode($data);
		
	}


	function deleteSerial() {
		$id = $this->input->post('id');
		$delete_data = $this->db->query("DELETE FROM poweron_inventory_item_serial_number WHERE id=$id");
		echo 'deleted';
	}

	function updateSerialNumber() {
		$id = $this->input->post('id');
		$field = $this->input->post('field');
		$value = $this->input->post('value'); 
		$delete_data = $this->db->query("UPDATE poweron_inventory_item_serial_number SET $field='$value' WHERE id=$id");
		echo 'updated';
	}
  
	
}
