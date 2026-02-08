<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_logs extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['system_logs'] = $this->getUsers();  
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/system_settings/system_logs.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 

	function getUsers() {
		$data = $this->fetchRawData("SELECT logs_id,( SELECT CONCAT( pu.first_name, ' ', pu.last_name ) ) AS fullname,
										logs_message,
										logs_local_ip,
										logs_date_time,
										logs_transaction 
										FROM
											system_logs
											LEFT JOIN poweron_users AS pu USING ( users_id ) 
										ORDER BY
											logs_date_time DESC");
		return $data;
	}
 }