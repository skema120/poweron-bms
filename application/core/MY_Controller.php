<?php

/**
* 
*/
#[AllowDynamicProperties]
class MY_Controller extends CI_Controller
{
  
  public function __construct()
  {
    parent::__construct(); 
  }

  public function pprint($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
  }

  public function fetchRawData($query) {
    $query = $this->db->query($query);
    return $query->result_array();
  }

    
    /*checklog for Admin START HERE!*/
    function PoweroncheckLogAdmin()
  {
    $userdata = $this->session->userdata('admin_user_data');

    if(!empty($userdata) && $this->uri->segment(2) == 'login')
    {
      if($this->uri->segment(1) == 'admin')
      {
        redirect(base_url('admin/dashboard'));
      }

    } 


    else if(empty($userdata) && $this->uri->segment(2) != 'login')
    {
      if($this->uri->segment(1) == 'admin')
      {
        redirect(base_url('admin/login'));
      }
    }


  }/*checklog for Admin END HERE!*/
  

  

} /*CLASS MY_Controller END HERE*/
 