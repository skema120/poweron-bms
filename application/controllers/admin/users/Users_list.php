<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_list extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['users'] = $this->getUsers();  
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/users/users_list.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 

	function getUsers() {
		$data = $this->fetchRawData("SELECT * FROM poweron_users");
		return $data;
	}
 

	function saveDetail() {
		$userdata = $this->session->userdata('admin_user_data');
		date_default_timezone_set("Asia/Manila");


		$users_id = $this->input->post('users_id');
		$image = $this->input->post('image'); 
		$first_name = $this->input->post('first_name'); 
		$last_name = $this->input->post('last_name'); 
		$users_account_type = $this->input->post('users_account_type');
		$password = $this->input->post('password'); 
		$username = $this->input->post('username');
		$users_date_created = $this->input->post('users_date_created'); 

		 	 
		
	    $this->load->model('Model_poweron_users');
	    $poweron_users = new Model_poweron_users();
	    if ($users_id != '') {
	    	$poweron_users->users_id = $users_id;
	    } 

	    // if ($users_account_type == 'Administrator') {
	    // 	$poweron_users->username = 'admin';
	    // } else if($users_account_type == 'Purchaser'){
	    // 	$poweron_users->username = 'purchaser';
	    // } else if($users_account_type == 'Admin Staff'){
	    // 	$poweron_users->username = 'poweron';
	    // }  else if($users_account_type == 'Manager'){
	    // 	$poweron_users->username = 'poweronadmin';
	    // }

	    if ($users_date_created == '') {
	    	$poweron_users->users_date_created = date('Y-m-d');
	    } else{
	    	$poweron_users->users_date_created = $users_date_created;
	    }

	    if ($password == ''){
	    	$poweron_users->password = 'poweron123';
	    } else{
	    	$poweron_users->password = $password;
	    }


	    $poweron_users->username = $username;
	    $poweron_users->users_account_type = $users_account_type;
	    $poweron_users->first_name = $first_name;
	    $poweron_users->last_name = $last_name;
	    // $poweron_users->save();

	    // ==============================================================================
   			//  $message = $_FILES['file']['name'] ;
			// echo "<script type='text/javascript'>alert('$message');
			// </script>";

  



	    	if($_FILES['file']['size'] > 0)
				{
					 $file = $_FILES['file']['name'];
					 
					 if (strpos($file, 'png') !== false)
					 {
						$filen = date('YmdHis').'.png';
					 }
					 else
					 {
					 	$filen = date('YmdHis').'.jpg';
					 }

			 		$file = $filen;

					if(!empty($_FILES['file']['name'])){
			            $filetmp = $_FILES["file"]["tmp_name"];
			            $filename = $_FILES["file"]["name"];
			            $filetype = $_FILES["file"]["type"];
			            $filepath = "assets/images/users/".$filen;

			            move_uploaded_file($filetmp, $filepath); 
			    	}

			    	$poweron_users->image = $file;


			    } else {

			    	if($image != ''){ 
			    		$poweron_users->image = $image;
			    	} else{
			    	  $file = 'user_default.png';
			    	  $poweron_users->image = $file;
			    	}
			    	
			    }

											   					    
		   
		


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

			    if ($users_id != '') {
	    			$system_logs->logs_transaction = 'UPDATE';
	    			$system_logs->logs_message = 'Updating User: "' . $username . '" to Database';
	   			} else {
	   				$system_logs->logs_transaction = 'INSERT';
	   				$system_logs->logs_message = 'Inserting User: "' . $username . '" to Database';
	   			}

	    		 $system_logs->logs_date_time = date('Y-m-d H:i:s');			    	   


			    if(isset($userdata['users_id']) !=''){
			    	  $system_logs->users_id = $userdata['users_id'];	 

			    	  $poweron_users->save();
			    	  $system_logs->save();
			    	  redirect(base_url('admin/users/users_list'));			    	
			    } else{
			    	 
			    	$message = "Session Expired";
					echo "<script type='text/javascript'>alert('$message');
					window.location.href='../../login';
					</script>";
			    }

	}

	function checkIfUsernameExist() {
		$username = $this->input->post('username');
		$data = $this->fetchRawData("SELECT * FROM poweron_users WHERE username='$username'");
		echo count($data); 
	}


	function getUsersDetails() {
		$users_id = $this->input->post('users_id');
		$data = $this->fetchRawData("SELECT * FROM poweron_users WHERE users_id = $users_id");
		echo json_encode($data);
	}
  
	
}
