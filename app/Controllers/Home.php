<?php namespace App\Controllers;

use App\Models\Member_model;

class Home extends BaseController
{
	public function index()
	{
		// return view('welcome_message');
		helper(['form', 'url']);
		$this->Member_model = new Member_model();
		$data['member'] = $this->Member_model->get_all_member();
		return view('member_view', $data);
	}

	//--------------------------------------------------------------------

}
