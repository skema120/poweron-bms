<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/Change_password.php');
		$this->load->view('admin/includes/footer.php',$userdata);
	} 


	function updatePassword() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");


		$users_id = $this->input->post('users_id');
		$password = $this->input->post('confirm_password'); 

		

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

			    if (isset($userdata['users_id']) != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message = 'User: "' . $userdata['username'] . '" Password Changed Successfully to Database';
	   			} 
	   			// else {
	   			// 	$system_logs->logs_transaction = 'INSERT';
	   			// 	$system_logs->logs_message = 'Inserting Delivery No: "' . $delivery_no . '" to Database';
	   			// }

  
			    $system_logs->logs_date_time = date('Y-m-d H:i:s');			    	   


			    if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 
			    	  $system_logs->save();

			    	  $update = $this->db->query("UPDATE poweron_users SET password='$password' WHERE users_id=$users_id");
					  redirect(base_url('admin/change_password'));
			    	
			    } else{
			    	 
			    	$message = "Session Expired";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='../login';
					</script>";
			    }
	}

	function checkIfoldpasswordExist() {
		$oldpassword = $this->input->post('oldpassword');
		$users_id = $this->input->post('users_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_users WHERE users_id='$users_id' AND password='$oldpassword'");
		echo count($data); 
	}


	
	
}
