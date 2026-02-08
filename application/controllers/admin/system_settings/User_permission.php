<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_permission extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['user_permission'] = $this->getUsers();  
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/system_settings/user_permission.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 

	function getUsers() {
		$data = $this->fetchRawData("SELECT * FROM poweron_users_permissions ORDER BY users_account_type ASC");
		return $data;
	}
 

	function saveDetail() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");


		$permission_id = $this->input->post('permission_id');
		$users_account_type = $this->input->post('users_account_type');
		$p_edit = $this->input->post('p_edit');
		$p_delete = $this->input->post('p_delete');  
		$p_supplier = $this->input->post('p_supplier');
		$p_manage = $this->input->post('p_manage');
		$p_inventory = $this->input->post('p_inventory');
		$p_onhand = $this->input->post('p_onhand');
		$p_delivery = $this->input->post('p_delivery');
		$p_purchase_order = $this->input->post('p_purchase_order');
		$p_distributor = $this->input->post('p_distributor');
		$p_agency = $this->input->post('p_agency');
		$p_system_settings = $this->input->post('p_system_settings');
		$p_user_permission = $this->input->post('p_user_permission');
		$p_change_password = $this->input->post('p_change_password');
		$p_user_list = $this->input->post('p_user_list');
		$p_system_log = $this->input->post('p_system_log');  
 
	    $this->load->model('Model_poweron_users_permissions');
	    $users_permissions = new Model_poweron_users_permissions();
	    if ($permission_id != '') {
	    	$users_permissions->permission_id = $permission_id;
	    }
	     
	    $users_permissions->users_account_type = $users_account_type;
	    $users_permissions->p_edit = $p_edit;
	    $users_permissions->p_delete = $p_delete;
	    $users_permissions->p_supplier = $p_supplier;
	    $users_permissions->p_manage = $p_manage;
	    $users_permissions->p_inventory = $p_inventory; 
	    $users_permissions->p_onhand = $p_onhand;
	    $users_permissions->p_delivery = $p_delivery;
	    $users_permissions->p_purchase_order = $p_purchase_order;
	    $users_permissions->p_distributor = $p_distributor;
	    $users_permissions->p_agency = $p_agency;
	    $users_permissions->p_system_settings = $p_system_settings;
	    $users_permissions->p_user_permission = $p_user_permission;
	    $users_permissions->p_change_password = $p_change_password;
	    $users_permissions->p_user_list = $p_user_list;
	    $users_permissions->p_system_log = $p_system_log;
	    // $users_permissions->save();


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

			    if ($permission_id != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message = 'Updating Account Type: "' . $users_account_type . '" to Database';
	   			} else {
	   				$system_logs->logs_transaction = 'INSERT';
	   				$system_logs->logs_message = 'Inserting Account type: "' . $users_account_type . '" to Database';
	   			}

	    		 $system_logs->logs_date_time = date('Y-m-d H:i:s');			    	   


			    if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 

			    	  $users_permissions->save();
			    	  $system_logs->save();
			    	  redirect(base_url('admin/system_settings/user_permission'));
			    	
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


	function getUserPermissionDetails() {
		$permission_id = $this->input->post('permission_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_users_permissions WHERE permission_id = $permission_id");
		echo json_encode($data);
	}
  
	
}
