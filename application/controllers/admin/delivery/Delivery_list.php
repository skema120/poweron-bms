<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_list extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['delivery'] = $this->getUsers(); 
		$data['inventory'] = $this->getInventory(); 
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/delivery/delivery_list.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 

	function getUsers() {
		$data = $this->fetchRawData("SELECT * FROM poweron_delivery ORDER BY delivery_date_delivered DESC,delivery_no DESC");
		return $data;
	}

	function getInventory() {
		$data = $this->fetchRawData("SELECT inventory_id, inventory_item_description, inventory_item_qty_onhand
			FROM
				poweron_inventory
			WHERE
			IFNULL( inventory_item_qty_onhand,0) > 0 
			ORDER BY
				inventory_item_description DESC");
		return $data;
	}

	
	function checkIfQtyExceed() {
		$delivery_item_qty = $this->input->post('delivery_item_qty');
		$inventory_id = $this->input->post('inventory_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_inventory WHERE inventory_id = '$inventory_id' AND inventory_item_qty_onhand < '$delivery_item_qty'");
		echo count($data); 
	}
 

	function saveDetail() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");


		$delivery_id = $this->input->post('delivery_id');
		$delivery_no = $this->input->post('delivery_no');
		$delivery_category = $this->input->post('delivery_category');
		$delivery_end_user = $this->input->post('delivery_end_user');
		$delivered_by = $this->input->post('delivered_by');
		$delivery_date_delivered = $this->input->post('delivery_date_delivered'); 
		$delivery_status = $this->input->post('delivery_status'); 

	    $this->load->model('Model_delivery');
	    $delivery = new Model_delivery();

	    if ($delivery_id != '') {
	    	$delivery->delivery_id = $delivery_id;
	    }

	    if($delivery_id == ''){
	    	 $delivery->delivery_date_delivered = date('Y-m-d');
	    } else{
	    	 $delivery->delivery_date_delivered = $delivery_date_delivered; 
	    }


	    $delivery->delivery_no = $delivery_no;
	    $delivery->delivery_category = $delivery_category;
	    $delivery->delivery_end_user = $delivery_end_user;
	    $delivery->delivered_by = $delivered_by;  	   
	    $delivery->delivery_status = $delivery_status;  
	    // $delivery->save();

	    // ============================================================================

				    	$inventory_id = $this->input->post('inventory_id');
						$item_serial_number = $this->input->post('item_serial_number');
						$delivery_item_qty = $this->input->post('delivery_item_qty');
						$delivery_warranty = $this->input->post('delivery_warranty');



					    $this->load->model('Model_delivery_item');
					    


		     // ==========================================================================
	   $data = $this->db->query("SELECT SUBSTRING_INDEX(delivery_id,'-',-1)+1 delivery_id FROM poweron_delivery ORDER BY delivery_id DESC LIMIT 1");
	    $row = $data->row();
		$lastID =`echo $row->delivery_id`;
		        
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

			    if ($delivery_id != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message = 'Delivery ID: " ' . $delivery_id . ' " has been successfully updated to Database';
	   			} else {
	   				$system_logs->logs_transaction = 'INSERT';
	   				$system_logs->logs_message = 'New Delivery ID: " ' . $lastID . '" has been successfully imported to Database';
	   			}

  
			    $system_logs->logs_date_time = date('Y-m-d H:i:s');			    	   


			    if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	

			    	  	 

			    	  $delivery->save();

			    	  
			    	  foreach ((array)$inventory_id as $key => $inventory_id) {
			    	  		$delivery_item = new Model_delivery_item();					    	
					    	$delivery_item->delivery_id = $delivery->delivery_id;
							$delivery_item->inventory_id = $inventory_id;

							$data = $this->db->query("UPDATE poweron_inventory SET inventory_item_qty_onhand = inventory_item_qty_onhand - $delivery_item_qty[$key] WHERE inventory_id=$inventory_id");

							$delivery_item->item_serial_number = $item_serial_number[$key];
							$delivery_item->delivery_item_qty = $delivery_item_qty[$key];
							$delivery_item->delivery_warranty = $delivery_warranty[$key];
							$delivery_item->save();
					    }



			    	  $system_logs->save();
			    	  redirect(base_url('admin/delivery/delivery_list'));
			    	
			    } else{
			    	 
			    	$message = "Session Expired";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='../../login';
					</script>";
			    }

	}




  function getDeliveryDetails() {
		$delivery_id = $this->input->post('delivery_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_delivery AS pd  WHERE pd.delivery_id = $delivery_id");
		echo json_encode($data);
	}

	function getDeliveryItemDetails() {
		$delivery_id = $this->input->post('delivery_id');
		$data = $this->fetchRawData("SELECT
											id,
											item_serial_number,
											delivery_item_qty,
											delivery_warranty,
											inventory_item_description,
											inventory_id
										FROM
											poweron_delivery_item
											LEFT JOIN poweron_inventory USING ( inventory_id ) 
										WHERE
											delivery_id = $delivery_id");
		echo json_encode($data);
	}


	function updateDeliveryItems() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");


		$id = $this->input->post('id');
		$field = $this->input->post('field');
		$value = $this->input->post('value'); 
		$delivery_id = $this->input->post('delivery_id');
		$description = $this->input->post('description'); 


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

			    if ($id != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message ='Successfully updated the serial number of "' . $description . '" to "' . $value . '" from Delivery ID: "' . $delivery_id . '" .';
	   			}																								

	   			  $system_logs->logs_date_time = date('Y-m-d H:i:s');	

	   			   if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 
			    	  $system_logs->save();

			    	  $data =  $this->db->query("UPDATE poweron_delivery_item SET $field='$value' WHERE id=$id");
					  echo 1;
			    	
			    }

	}

	function deleteDeliveryItem() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");


		
		$id = $this->input->post('id');
		$inventory_id = $this->input->post('inventory_id');
		$delivery_item_qty = $this->input->post('delivery_item_qty');

		$delivery_id = $this->input->post('delivery_id');
		$description = $this->input->post('description');
		


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

			    if ($id != '') {
	    			$system_logs->logs_transaction = 'DELETE';
	    			$system_logs->logs_message = 'Successfully deleted the Delivery Item: "' . $description . '" from Delivery ID: "' . $delivery_id . '" .';
	   			}																								

	   			  $system_logs->logs_date_time = date('Y-m-d H:i:s');	

	   			   if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 
			    	  $system_logs->save();

			    	  $update_data = $this->db->query("UPDATE poweron_inventory SET inventory_item_qty_onhand = inventory_item_qty_onhand + $delivery_item_qty WHERE inventory_id=$inventory_id");

					  $data = $this->db->query("DELETE FROM poweron_delivery_item WHERE id=$id");
					  echo 1;
			    	
			    }


	}
	
}
