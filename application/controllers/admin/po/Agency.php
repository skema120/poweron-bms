<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agency extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['agency'] = $this->getUsers();  
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/po/agency.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 


	// ====================================
	// ==========HOME PRODUCE========
	// ====================================
	function getUsers() {
		$data = $this->fetchRawData("SELECT * FROM poweron_agency ORDER BY  agency_date_received DESC");
		return $data;
	}

	
	function getAgencyDetails() {
		$agency_id = $this->input->post('agency_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_agency WHERE agency_id = $agency_id");
		echo json_encode($data);
	}


	function getAgencyFileDetails() {
		$agency_id = $this->input->post('agency_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_agency_file WHERE agency_id = $agency_id");
		echo json_encode($data);
		
	}


	function saveDetail() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");


		$agency_id = $this->input->post('agency_id');
		$agency_po_number = $this->input->post('agency_po_number');
		$agency_name = $this->input->post('agency_name'); 
		$agency_date_received = $this->input->post('agency_date_received'); 
		$agency_person_received = $this->input->post('agency_person_received'); 
		$agency_due_date = $this->input->post('agency_due_date'); 
		$agency_delivery_term = $this->input->post('agency_delivery_term'); 
		$agency_amount = $this->input->post('agency_amount'); 
		$agency_status = $this->input->post('agency_status'); 
		$agency_remarks = $this->input->post('agency_remarks');
 
	    $this->load->model('Model_poweron_agency');
	    $agency = new Model_poweron_agency();

	    if ($agency_id != '') {
	    	$agency->agency_id = $agency_id;
	    }
	    $agency->agency_po_number = $agency_po_number; 
	    $agency->agency_name = $agency_name;
	    $agency->agency_date_received = $agency_date_received; 
	    $agency->agency_person_received = $agency_person_received; 
	    $agency->agency_due_date = $agency_due_date; 
	    $agency->agency_delivery_term = $agency_delivery_term; 
	    $agency->agency_amount = $agency_amount;   
	    $agency->agency_status = $agency_status;   
	    $agency->agency_remarks = $agency_remarks;   
	    // $agency->save();




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

			    if ($agency_id != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message = 'Updating Agency PO Number: "' . $agency_po_number . '" to Database';
	   			} else {
	   				$system_logs->logs_transaction = 'INSERT';
	   				$system_logs->logs_message = 'Inserting Agency PO Number: "' . $agency_po_number . '" to Database';
	   			}


	    		$system_logs->logs_date_time = date('Y-m-d H:i:s');			    	   


			    if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 

			    	  $agency->save();

			    	  // ==============================================================================
		    
						    	if (isset($_FILES['agency_file'])) {
							    	$this->load->model('Model_poweron_agency_file');

								    	$files = is_array($_FILES['agency_file']['name']); 
								    	if ($files) { 
								    		for ($i=0; $i < count($_FILES['agency_file']['name']); $i++) { 
								    			if($_FILES['agency_file']['size'][$i] > 0)
												{
													 $agency_file = $_FILES['agency_file']['name'][$i];
													 // echo $image;
													 if (strpos($agency_file, 'pdf') !== false)
													 {
														$filen = $i.'_'.date('YmdHis').'.pdf';
													 }
													 else
													 {
													 	$filen = $i.'_'.date('YmdHis').'.pdf';
													 }

											 		$agency_file = $filen;

													if(!empty($_FILES['agency_file']['name'][$i])){
											            $filetmp = $_FILES["agency_file"]["tmp_name"][$i];
											            $filename = $_FILES["agency_file"]["name"][$i];
											            $filetype = $_FILES["agency_file"]["type"][$i];
											            $filepath = "assets/file/pdf/agency/".$filen;

											            move_uploaded_file($filetmp, $filepath); 
											    	}
											    } else {
											    	$agency_file = 'default.pdf';
											    }

											    $poweron_agency_file = new Model_poweron_agency_file(); 
											    $poweron_agency_file->agency_id = $agency->agency_id;
											    $poweron_agency_file->agency_file = $agency_file;
											    $poweron_agency_file->save(); 
								    		}
								    	} else { 
								    		if($_FILES['agency_file']['size'] > 0)
											{
												 $agency_file = $_FILES['agency_file']['name'];
												 // echo $image;
												 if (strpos($file, 'pdf') !== false)
												 {
													$filen = date('YmdHis').'.pdf';
												 }
												 else
												 {
												 	$filen = date('YmdHis').'.pdf';
												 }

										 		$agency_file = $filen;

												if(!empty($_FILES['agency_file']['name'])){
										            $filetmp = $_FILES["agency_file"]["tmp_name"];
										            $filename = $_FILES["agency_file"]["name"];
										            $filetype = $_FILES["agency_file"]["type"];
										            $filepath = "assets/file/pdf/agency/".$filen;

										            move_uploaded_file($filetmp, $filepath); 
										    	}
										    } else {
										    	$agency_file = 'default.pdf';
										    }
										    $poweron_agency_file = new Model_poweron_agency_file(); 
										    $poweron_agency_file->agency_id = $agency->agency_id;
										    $poweron_agency_file->agency_file = $agency_file;
										    $poweron_agency_file->save(); 
								    	}					   					    
								   
							    }
			    	  
			    	  $system_logs->save();
			    	  redirect(base_url('admin/po/agency'));
			    	
			    } else{
			    	 
			    	$message = "Session Expired";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='../../login';
					</script>";
			    }

	}

	function deleteFile() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");

		$agency_po_number = $this->input->post('agency_po_number');
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
	    			$system_logs->logs_message = 'Successfully deleted the file "' . $file . '" from Agency PO No: "' . $agency_po_number . '" .';
	   			}																								

	   			  $system_logs->logs_date_time = date('Y-m-d H:i:s');	

	   			   if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 
			    	  $system_logs->save();

			    	  $data = $this->db->query("DELETE FROM poweron_agency_file WHERE id=$id");
					  echo 1;
			    	
			    } 


		
	}
  
	
}
