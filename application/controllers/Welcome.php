<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('poweron/admin/login');
	}

/*	function test() {
		$string = 'Did you have considered Italian cooking for dessert';
		$ex_string = explode(' ', $string);

		$new_arr = array();
		for ($i=0; $i < count($ex_string); $i++) { 
			// echo $ex_string[$i];
			$word = $ex_string[$i];
			$word_count = strlen($word);
			// echo $word_count;
			if ($word_count > 4) {
				array_push($new_arr, $ex_string[$i]);
			}
		}

		$im_string = implode('-', $new_arr);
		echo $im_string;
	}*/
}
