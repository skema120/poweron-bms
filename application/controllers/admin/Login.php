<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller {

	public function index()
	{
		$this->PoweroncheckLogAdmin();
		$this->load->view('admin/login');
	}



	function system_logs() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$status = $this->input->post('data');
		$data = $this->db->query("SELECT users_id FROM poweron_users WHERE username = '$username' AND password='$password'");
		$row = $data->row();
		$data1 =`echo $row->users_id`;

				// $userdata = $this->session->userdata('admin_user_data');
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
			    	
			    if($status == 'Valid'){
			    	$system_logs->users_id = $data1;
				    $system_logs->logs_message = 'User Have Successfully Logged in';
				    $system_logs->logs_date_time = date('Y-m-d H:i:s');
				    $system_logs->logs_transaction = 'LOGIN';
				    $system_logs->save();
			    }else{
			    	$system_logs->users_id = $data1;
				    $system_logs->logs_message = 'Failed to Logged in';
				    $system_logs->logs_date_time = date('Y-m-d H:i:s');
				    $system_logs->logs_transaction = 'LOGIN';
				    $system_logs->save();
			    }

		
	}


	function PowerOnloginAdmin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->fetchRawData("SELECT * FROM poweron_users as pu LEFT JOIN poweron_users_permissions USING (users_account_type) WHERE username='$username' AND password='$password'");
		$count = count($data);

		// =============================================================
		if($count != 0 ){
			if($username==$data[0]['username'] && $password==$data[0]['password']){ 
			echo "Valid";
		 	$data_session=array(
		 	  'image'=> $data[0]['image'],
		      'username'=> $data[0]['username'],
		      'first_name' => $data[0]['first_name'],
		      'last_name' => $data[0]['last_name'],
		      'users_id' => $data[0]['users_id'],

		       'p_edit' => $data[0]['p_edit'],
		       'p_delete' => $data[0]['p_delete'],
		       'p_supplier' => $data[0]['p_supplier'],
		       'p_manage' => $data[0]['p_manage'],
		       'p_inventory' => $data[0]['p_inventory'],
		       'p_onhand' => $data[0]['p_onhand'],
		       'p_delivery' => $data[0]['p_delivery'],
		       'p_purchase_order' => $data[0]['p_purchase_order'],
		       'p_distributor' => $data[0]['p_distributor'],
		       'p_agency' => $data[0]['p_agency'],
		       'p_system_settings' => $data[0]['p_system_settings'],
		       'p_user_permission' => $data[0]['p_user_permission'],
		       'p_change_password' => $data[0]['p_change_password'],
		       'p_user_list' => $data[0]['p_user_list'],
		       'p_system_log' => $data[0]['p_system_log'],
		       'users_account_type' => $data[0]['users_account_type'],

		      'admin_logged_in' => true


		
		      
	      	);
		      $this->session->set_userdata(array('admin_user_data' => $data_session));
		      
			}

		}
		else
		{ 
			echo ($count);
		}
		// =============================================================

	}
  	function logout(){
  		if (!$this->session->userdata('admin_logged_in'))
  		{
		  		 $this->session->unset_userdata('admin_user_data');
		  		// $this->session->sess_destroy();
		  		//session_destroy();
		    	redirect(base_url('admin/login'));
  		}
  		
  	}
}