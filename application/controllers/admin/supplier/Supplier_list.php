<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_list extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['supplier'] = $this->getUsers();  
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/supplier/supplier_list.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 

	function getUsers() {
		$data = $this->fetchRawData("SELECT supplier_id
											,supplier_name
											,supplier_address
											,supplier_contact_person
											,supplier_contact_number
											FROM poweron_supplier 
											ORDER BY supplier_name ASC");
		return $data;
	}
 

	function saveDetail() {
		$userdata = $this->session->userdata('admin_user_data');


		$supplier_id = $this->input->post('supplier_id');
		$supplier_name = $this->input->post('supplier_name');
		$supplier_address = $this->input->post('supplier_address');
		$supplier_contact_person = $this->input->post('supplier_contact_person');  
		$supplier_contact_number = $this->input->post('supplier_contact_number');  
 
	    $this->load->model('Model_supplier');
	    $supplier = new Model_supplier();
	    if ($supplier_id != '') {
	    	$supplier->supplier_id = $supplier_id;
	    }
	     
	    $supplier->supplier_name = $supplier_name;
	    $supplier->supplier_address = $supplier_address;
	    $supplier->supplier_contact_person = $supplier_contact_person;
	    $supplier->supplier_contact_number = $supplier_contact_number; 
	    // $supplier->save();


	    // ==========================================================================
	    		
		        date_default_timezone_set("Asia/Manila");
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

			    if ($supplier_id != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message = 'Updating Supplier: "' . $supplier_name . '" to Database';
	   			} else {
	   				$system_logs->logs_transaction = 'INSERT';
	   				$system_logs->logs_message = 'Inserting Supplier: "' . $supplier_name . '" to Database';

	   			}
	    

	    		$system_logs->logs_date_time = date('Y-m-d H:i:s');			    	   


			    if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 

			    	  $supplier->save();
			    	  $system_logs->save();
			    	  redirect(base_url('admin/supplier/supplier_list'));
			    	
			    } else{
			    	 
			    	$message = "Session Expired";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='../../login';
					</script>";
			    }

	}

	// function checkIfCategoryExist() {
	// 	$category_name = $this->input->post('category_name');
	// 	$data = $this->fetchRawData("SELECT * FROM categories WHERE category_name='$category_name'");
	// 	echo count($data); 
	// }


	function getSupplierDetails() {
		$supplier_id = $this->input->post('supplier_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_supplier WHERE supplier_id = $supplier_id");
		echo json_encode($data);
	}
  
	
}
