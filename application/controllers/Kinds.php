<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kinds extends CI_Controller {
	
	public function __construct(){
		
		parent::__construct();

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->library('session');
		//echo 121;exit;
		$this->load->helper('url');

	}
	public function kindList(){

		$this->Publics->checkLogin();

		$data['codes'] = $this->Dbmodel->select()->get('kinds');

		

		$this->load->view('manage/kindList',$data);

	}
	public function setKinds(){

		$this->Publics->checkLogin();

		$get = $this->input->get();

		$posts = $this->input->post();

		if($posts){

			$posts['addtime'] = strtotime($posts['addtime']);

			$a = $this->Dbmodel->ci_update($posts,'kinds',array('id'=>$posts['id']));

			$a?$this->Publics->setOption('币种'.$posts['id'].'修改完成'):"";

			echo json_encode($a);exit;

		}

		$data['codes'] = $this->Dbmodel->select()->where(array('contract'=>$get['id']))->get('kinds',1);

		$this->load->view('manage/setKinds',$data);

	}
	public function price(){

		$this->Publics->checkLogin();

		$data['codes'] = $this->Dbmodel->select()->order_by('id')->get('kinds');

		$this->load->view('manage/price',$data);

	}
	public function addprice(){

		$this->Publics->checkLogin();

		$posts = $this->input->post();

		if($posts){

			$data['kid'] = $posts['id'];

			$data['price'] = $posts['price'];

			$data['addtime'] = strtotime($posts['addtime']);

			$a = $this->Dbmodel->ci_insert($data,'kprice');

			if($a){
				$this->Dbmodel->ci_update(array('price'=>$data['price']),'kinds',array('id'=>$data['kid']));

				$this->Publics->setOption('币种价格添加--'.$data['price']);

				$this->Publics->jsonReturned('添加成功',0);return false;

			}else{

				$this->Publics->jsonReturned('添加失败',0);return false;

			}

		}

	}
	public function opinion(){
		
		$this->Publics->checkLogin();

		$data['codes'] = $this->Dbmodel->select()->order_by('id')->get('opinion');

		$this->load->view('manage/opinion',$data);

	}
	public function opinion_1(){

		$this->Publics->checkLogin();

		$posts = $this->input->post();

		if($posts){

			$a = $this->Dbmodel->ci_update(array('reply'=>$posts['reply']),'opinion',array('id'=>$posts['id']));

			if($a){

				$this->Publics->jsonReturned('回复成功');return false;

				$this->Publics->setOption('回复用户反馈'.$posts['id'].'成功');

			}
			$this->Publics->jsonReturned('回复失败',0);return false;
		}

		$get = $this->input->get('id');

		$data['codes'] =$this->Dbmodel->select()->where(array('id'=>$get))->get('opinion',1);

		$this->load->view('manage/opinion_1',$data);

	}
	public function common(){

		$this->Publics->checkLogin();

		$data['codes'] = $this->Dbmodel->select()->get('common');

		$this->load->view('manage/common',$data);

	}
	public function common_1(){

		$this->Publics->checkLogin();

		$posts = $this->input->post();

		if($posts){

			$posts['addtime'] = strtotime($posts['addtime']);

			$a = $posts['id']?$this->Dbmodel->ci_update($posts,'common',array('id'=>$posts['id'])):$this->Dbmodel->ci_insert($posts,'common');

			$a?$this->Publics->setOption('常见问题'.$posts['id']?$posts['id']:$a.$posts['id']?"修改"："添加"):"";

			$this->Publics->jsonReturned($a?"添加成功":"添加失败",0);return false;

		}

		$get = $this->input->get();

		if($get){

			$data['codes'] = $this->Dbmodel->select()->where(array('id'=>$get['id']))->get('common',1);

		}
		
		$this->load->view('manage/common_1',$data);

	}
	public function setRatio(){

		$this->Publics->checkLogin();

		$posts = $this->input->post();

		if($posts){

			$posts['addtime'] = strtotime($posts['addtime']);

			$a = $this->Dbmodel->ci_update($posts,'ratio',array('id'=>1));

			if($a){

				$this->Publics->setOption('汇率修改完成--'.$posts['ratio']);

				$this->Publics->jsonReturned('修改成功');return false;

			}
			$this->Publics->jsonReturned('修改失败',0);return false;

		}

		$data['codes'] = $this->Dbmodel->select()->get('ratio',1);

		$this->load->view('manage/setRatio',$data);

	}
}