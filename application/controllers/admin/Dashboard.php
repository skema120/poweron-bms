<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller { 
	
	public function index()
	{
		$this->PoweroncheckLogAdmin(); 
		$userdata['userdata'] = $this->session->userdata('admin_user_data');
		$data['supplier'] = $this->getCountSupplier();
		$data['users'] = $this->getCountUsers(); 
		$data['delivery'] = $this->getCountDelivery();
		$data['onhand'] = $this->getCountOnhandItem();
		$data['pending_delivery_status'] = $this->getDelivery();
		$data['open_po_status'] = $this->getPO();
		$data['today_item'] = $this->getTodayItemDeliveryIN();
		$data['open_agency_status'] = $this->getAgency();	
		$this->load->view('admin/includes/header.php',$userdata);
		$this->load->view('admin/includes/nav-left.php',$userdata);
		$this->load->view('admin/includes/nav-top.php',$userdata);
		$this->load->view('admin/Dashboard.php',$data);
		$this->load->view('admin/includes/footer.php',$userdata);
	} 

		// ====================================
	// ==========HOME PRODUCE========
	// ====================================
	function getCountSupplier() {
		$data = $this->fetchRawData("SELECT count(supplier_id) supplier FROM poweron_supplier");
		return $data;
	}

	function getCountUsers() {
		$data = $this->fetchRawData("SELECT count(users_id) users FROM poweron_users WHERE NOT users_account_type = 'SuperUser'");
		return $data;
	}

	function getCountDelivery() {
		$data = $this->fetchRawData("SELECT count(delivery_id) delivery FROM poweron_delivery");
		return $data;
	}

	function getCountOnhandItem() {
		$data = $this->fetchRawData("SELECT sum(inventory_item_qty_onhand) onhand FROM poweron_inventory");
		return $data;
	}

	function getDelivery() {
		$data = $this->fetchRawData("SELECT (@row_number:=@row_number + 1) AS row_num  ,delivery_no,delivery_category,delivery_end_user,delivery_status FROM poweron_delivery, (SELECT @row_number:=0) as temp WHERE delivery_status = 'PENDING' OR delivery_status = 'CHECKING' ORDER BY delivery_date_delivered DESC,delivery_no DESC");
		return $data;
	}

	function getPO() {
		$data = $this->fetchRawData("SELECT (@row_number:=@row_number + 1) AS row_num  ,po_number,po_end_user,po_status FROM poweron_purchase_order, (SELECT @row_number:=0) as temp WHERE po_status = 'OPEN' ORDER BY  po_number DESC");
		return $data;
	}

	function getAgency() {
		$data = $this->fetchRawData("SELECT (@row_number:=@row_number + 1) AS row_num  ,agency_po_number,agency_name,agency_status FROM poweron_agency, (SELECT @row_number:=0) as temp WHERE agency_status = 'OPEN' OR agency_status = 'PENDING' ORDER BY  agency_id DESC");
		return $data;
	}

	function getTodayItemDeliveryIN() {
		$data = $this->fetchRawData("SELECT (@row_number:=@row_number + 1) AS row_num  ,inventory_item_brand,inventory_item_description,inventory_item_qty_received FROM poweron_inventory, (SELECT @row_number:=0) as temp WHERE DATE(inventory_item_date_created) = CURDATE()  ORDER BY  inventory_id DESC");
		return $data;
	}
	
}
