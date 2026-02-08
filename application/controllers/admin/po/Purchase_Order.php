<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_Order extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['po'] = $this->getUsers();  
		$data['supplier'] = $this->getSupplier();
		$data['lastpo'] = $this->getLastPONumber(); 
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/po/purchase_order.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 


	// ====================================
	// ==========HOME PRODUCE========
	// ====================================
	function getUsers() {
		$data = $this->fetchRawData("SELECT 
									po_id
									,po_number
									,supplier_id
									,(SELECT supplier_name FROM poweron_supplier WHERE supplier_id = po.supplier_id) AS supplier_name
									,po_classification
									,po_payment_terms
									,po_end_user
									,po_status
									,po_created_by
									, DATE_FORMAT(po_date,'%M %d, %Y') AS po_date 
									FROM 
									poweron_purchase_order AS po
									ORDER BY  po_number DESC");
		return $data;
	}

	function getSupplier() {
		$data = $this->fetchRawData("SELECT * FROM poweron_supplier ORDER BY supplier_name ASC");
		return $data;
	}

	function getLastPONumber() {
		$data = $this->fetchRawData("SELECT MAX(SUBSTRING_INDEX(po_number,'-',-1)) po_number FROM poweron_purchase_order ORDER BY po_number DESC");
		return $data;
	}

	
	function getPODetails() {
		$po_id = $this->input->post('po_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_purchase_order AS po INNER JOIN poweron_supplier USING (supplier_id) LEFT JOIN poweron_purchase_order_items USING (po_id) WHERE po.po_id = $po_id");
		echo json_encode($data);
	}


	function getDetailFromPOitems() {
		$po_id = $this->input->post('po_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_purchase_order_items WHERE po_id=$po_id");
		echo json_encode($data);
		
	}

	function getPOFileDetails() {
		$po_id = $this->input->post('po_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_purchase_order_file WHERE po_id=$po_id");
		echo json_encode($data);
		
	}


	// ====================================
	// ==========FOR PRINT FUNCTION========
	// ====================================
	function getDetailFromPOitems_Print() {
		$po_id = $this->input->post('po_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_purchase_order_items WHERE po_id=$po_id");
		echo json_encode($data);
		
	}


	function getPrintPODetails() {
		$po_id = $this->input->post('po_id');
		$data = $this->fetchRawData("SELECT MAX(po_number) po_number, MAX(supplier_name) supplier_name, MAX(supplier_address) supplier_address, MAX(po_classification) po_classification, MAX(po_payment_terms) po_payment_terms, MAX(po_end_user) po_end_user, MAX(DATE_FORMAT(po_date,'%M %d, %Y')) po_date FROM poweron_purchase_order AS po INNER JOIN poweron_supplier USING (supplier_id) LEFT JOIN poweron_purchase_order_items USING (po_id) WHERE po.po_id = $po_id");
		echo json_encode($data);
	}

	function getSum_Print() {
		$po_id = $this->input->post('po_id');
		$data = $this->fetchRawData("SELECT
											SUM( CASE WHEN po_id = $po_id THEN qty*unit_cost ELSE 0 END ) sum 
										FROM
											poweron_purchase_order_items 
										WHERE
											po_id =$po_id");
		echo json_encode($data);
		
	}

 	// ====================================
	// ==========FOR PRINT FUNCTION END HERE========
	// ====================================




	function saveDetail() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");

		$po_id = $this->input->post('po_id');
		$po_number = $this->input->post('po_number');
		$supplier_id = $this->input->post('supplier_id'); 
		$po_date = $this->input->post('po_date'); 
		$po_status = $this->input->post('po_status'); 
		$po_classification = $this->input->post('po_classification'); 
		$po_payment_terms = $this->input->post('po_payment_terms'); 
		$po_end_user = $this->input->post('po_end_user');
		$po_created_by = $this->input->post('po_created_by'); 
 
	    $this->load->model('Model_purchase_order');
	    $purchase_order = new Model_purchase_order();

	    if ($po_id != '') {
	    	$purchase_order->po_id = $po_id;
	    }
	    if ($po_date != '') {
	    	$purchase_order->po_date = $po_date;
	    }

	      

	    if ($po_created_by == '') {
	    	if(isset($userdata['users_id']) !=''){
		    	$first_name = $userdata['first_name'];
		      	$last_name = $userdata['last_name'];
		     	$fullname = $first_name .' '. $last_name;

		    	$purchase_order->po_created_by =  $fullname;
	   		 }
	    } else {
	    	$purchase_order->po_created_by = $po_created_by;
	    }

	    $currentdate = date('Y-md');
	    $data = $this->db->query("SELECT SUBSTRING_INDEX(po_number,'-',-1)+1 po_number FROM poweron_purchase_order ORDER BY po_number DESC LIMIT 1 ");
	    $row = $data->row();
		$lastpo =`echo $row->po_number`;


	    $po_number1 = $currentdate .'-'. $lastpo;

	    if ($po_id == '') {
	    	$purchase_order->po_number = $po_number1;
	    } else{
	    	$purchase_order->po_number = $po_number;
	    }

	     
	    $purchase_order->supplier_id = $supplier_id;
	    $purchase_order->po_status = $po_status; 
	    $purchase_order->po_classification = $po_classification; 
	    $purchase_order->po_payment_terms = $po_payment_terms; 
	    $purchase_order->po_end_user = $po_end_user;   
	    // $purchase_order->save();

// ============================================================================

			$unit = $this->input->post('unit');
			$qty = $this->input->post('qty');
			$unit_cost = $this->input->post('unit_cost');
			$description = $this->input->post('description');

		    $this->load->model('Model_purchase_order_items');
		    
		    

		    // ==========================================================================
	    		
		        
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

			    if ($po_id != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message = 'Updating Distributor PO No: "' . $po_number . '" to Database';
	   			} else {
	   				$system_logs->logs_transaction = 'INSERT';
	   				$system_logs->logs_message = 'Inserting Distributor PO No: "' . $po_number1 . '" to Database';
	   			}


	    		$system_logs->logs_date_time = date('Y-m-d H:i:s');			    	   


			    if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 

			    	  $purchase_order->save();

					    foreach ((array)$description as $key => $description) {
					    		$purchase_order_items = new Model_purchase_order_items();			    	
						    	$purchase_order_items->po_id = $purchase_order->po_id;
								$purchase_order_items->description = $description;

								$purchase_order_items->unit = $unit[$key];
								$purchase_order_items->qty = $qty[$key];
								$purchase_order_items->unit_cost = $unit_cost[$key];
								$purchase_order_items->save();
				    	}

				    	// ==============================================================================
				    	
				    		if (isset($_FILES['file'])) {
						    	$this->load->model('Model_purchase_order_file');

							    	$files = is_array($_FILES['file']['name']); 
							    	if ($files) { 
							    		for ($i=0; $i < count($_FILES['file']['name']); $i++) { 
							    			if($_FILES['file']['size'][$i] > 0)
											{
												 $file = $_FILES['file']['name'][$i];
												 // echo $image;
												 if (strpos($file, 'pdf') !== false)
												 {
													$filen = $i.'_'.date('YmdHis').'.pdf';
												 }
												 else
												 {
												 	$filen = $i.'_'.date('YmdHis').'.pdf';
												 }

										 		$file = $filen;

												if(!empty($_FILES['file']['name'][$i])){
										            $filetmp = $_FILES["file"]["tmp_name"][$i];
										            $filename = $_FILES["file"]["name"][$i];
										            $filetype = $_FILES["file"]["type"][$i];
										            $filepath = "assets/file/pdf/distributor/".$filen;

										            move_uploaded_file($filetmp, $filepath); 
										    	}
										    } else {
										    	$file = 'default.pdf';
										    }

										    $purchase_order_file = new Model_purchase_order_file(); 
										    $purchase_order_file->po_id = $purchase_order->po_id;
										    $purchase_order_file->file = $file;
										    $purchase_order_file->save(); 
							    		}
							    	} else { 
							    		if($_FILES['file']['size'] > 0)
										{
											 $file = $_FILES['file']['name'];
											 // echo $image;
											 if (strpos($file, 'pdf') !== false)
											 {
												$filen = date('YmdHis').'.pdf';
											 }
											 else
											 {
											 	$filen = date('YmdHis').'.pdf';
											 }

									 		$file = $filen;

											if(!empty($_FILES['file']['name'])){
									            $filetmp = $_FILES["file"]["tmp_name"];
									            $filename = $_FILES["file"]["name"];
									            $filetype = $_FILES["file"]["type"];
									            $filepath = "assets/file/pdf/distributor/".$filen;

									            move_uploaded_file($filetmp, $filepath); 
									    	}
									    } else {
									    	$file = 'default.pdf';
									    }
									    $purchase_order_file = new Model_purchase_order_file(); 
									    $purchase_order_file->po_id = $purchase_order->po_id;
									    $purchase_order_file->file = $file;
									    $purchase_order_file->save(); 
							    	}					   					    
							   
						    }


			    	  $system_logs->save();
			    	  redirect(base_url('admin/po/purchase_order'));
			    	
			    } else{
			    	 
			    	$message = "Session Expired";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='../../login';
					</script>";
			    }

	}


function updatePurchaseOrderItems() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");

		$id = $this->input->post('id');
		$field = $this->input->post('field');
		$value = $this->input->post('value');
		$po_number = $this->input->post('po_number'); 

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
	    			$system_logs->logs_message ='Successfully updated the value of "' . $field . '" to "' . $value . '" from Distributor PO No: "' . $po_number . '" .';
	   			}																								

	   			  $system_logs->logs_date_time = date('Y-m-d H:i:s');	

	   			   if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 
			    	  $system_logs->save();

			    	  $data = $this->db->query("UPDATE poweron_purchase_order_items SET $field='$value' WHERE id=$id");
					  echo 1;
			    	
			    } 


		
		
	}

	function deletePO() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");

		$id = $this->input->post('id');
		$description = $this->input->post('description');
		$po_number = $this->input->post('po_number');

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
	    			$system_logs->logs_message = 'Successfully deleted the PO Item: "' . $description . '" from Distributor PO No: "' . $po_number . '" .';
	   			}																								

	   			  $system_logs->logs_date_time = date('Y-m-d H:i:s');	

	   			   if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 
			    	  $system_logs->save();

			    	  $data = $this->db->query("DELETE FROM poweron_purchase_order_items WHERE id=$id");
					  echo 1;
			    	
			    } 

	}

	function deleteFile() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");

		$po_number = $this->input->post('po_number');
		$id = $this->input->post('id');
		$file = $this->input->post('file');
		

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
	    			$system_logs->logs_message = 'Successfully deleted the file "' . $file . '" from Distributor PO No: "' . $po_number . '" .';
	   			}																								

	   			  $system_logs->logs_date_time = date('Y-m-d H:i:s');	

	   			   if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 
			    	  $system_logs->save();

			    	  $data = $this->db->query("DELETE FROM poweron_purchase_order_file WHERE id=$id");
					  echo 1;
			    	
			    } 

	}
  
	
}
