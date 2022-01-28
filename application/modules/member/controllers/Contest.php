<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends Admin_Controller {

	public function item($contestId='')
	{
		if(empty($contestId)){
			redirect($this->mModule.'/profile/card');
		}
		$this->load->model('contests_model','contests');
		$this->mViewData['contest']=$this->contests->get($contestId);
		$this->render($this->mCtrler.'/'.$this->mAction,'mobile');
	}

}
