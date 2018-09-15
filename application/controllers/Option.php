<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->library('session');
		//echo 121;exit;
		$this->load->helper('url');

	}

	public function forget(){

		$this->load->view('login/forget');

	}
	//手机号注册
	public  function register(){

		$posts = $this->input->post();

		if($posts){

			if($posts['mobiles']!=$this->session->tempdata('remobile') || $posts['vcodes']!=$this->session->tempdata('recode')){

				$this->Publics->jsonReturned('验证码错误！',0);return false;

			}

			$configss = $this->Dbmodel->select()->get('config',1);

			$this->load->library('ethereum');
      
      		$Ethcode = $this->ethereum->createWallet();
			
			$a = $this->Dbmodel->select('username')->where(array('username'=>$posts['mobiles']))->get('members',1);
			
			if($a['username']){

				$this->Publics->jsonReturned('账号已存在',0);return false;

			}

			$data['mnemonicword'] = $this->Publics->mnemonicWord();

			$data['mak'] = $this->Publics->encryptionCode($posts['password']);

			$data['nickname'] = $configss['defaultnick'];

			$data['addtime'] = time();

			$data['username'] = $posts['mobiles'];

			$data['currency'] = implode(',',array(1,2));

			$data['eth_accounts'] = $Ethcode['address']?$Ethcode['address']:"";
	      
	      	$data['eth_password'] = $Ethcode['password']?$Ethcode['password']:"";
	      
	      	$data['portrait'] = "public/images/icon_hc_03.png";

			$this->session->unset_tempdata('recode');

			$id = $this->Dbmodel->ci_insert($data,'members');

			$this->Dbmodel->ci_insert(array('userid'=>$id),'balance');

			$this->session->set_userdata(array('mnemonicWord'=>$data['mnemonicword'],'userid'=>$id));

			if($id){

				$this->Publics->jsonReturned('注册成功');return false;

			}else{

				$this->Publics->jsonReturned('注册失败，请联系管理员',0);return false;

			}

		}

	}
	//手机验证码
	public function getCode(){

		$posts = $this->input->post();

		if($posts){

			if($this->session->tempdata('recode') && $this->session->tempdata('remobile') == $posts['mobile']){

				$this->Publics->jsonReturned('验证码有效期为5分钟，无需重复发送');return false;

			}

			$code = rand(1000, 9999);

			$this->load->library('juhe');

			$a = $this->juhe->noteTrue($posts['mobile'],$code);

			if($a == 1){

				$codes['recode'] = $code;

				$codes['remobile'] = $posts['mobile'];

				$this->session->set_tempdata($codes, '', 3000);

				$this->Publics->jsonReturned('发送成功');return false;

			}else{

				$this->Publics->jsonReturned($a);return false;

			}

			

		}

	}
	//登陆
	public function login(){

		$posts = $this->input->post();
		
		if($posts){

			$user = $this->Dbmodel->select()->where(array('username'=>$posts['names']))->get('members',1);

			$word = $this->Publics->encryptionCode($posts['pasword']);

			if($user['mak']!=$word){

				$this->Publics->jsonReturned('账号密码不匹配！',0);return false;

			}

			$this->session->set_userdata(array('mnemonicWord'=>$user['mnemonicword'],'userid'=>$user['id']));

			$this->Publics->jsonReturned('登陆成功！');return false;

		}

	}
	//密码重置
	public function forgets(){

		$posts = $this->input->post();

		if($posts){

			$user = $this->Dbmodel->select()->where(array('username'=>$posts['mobiles']))->get('members',1);

			if(!$user){

				$this->Publics->jsonReturned('账号不存在！',0);return false;

			}
			$pasword = $this->Publics->encryptionCode($posts['password']);

			if($user['mak']== $pasword){

				$this->Publics->jsonReturned('不要与原密码相同',0);return false;

			}			

			$a = $this->Dbmodel->ci_update(array('mak'=>$pasword),'members',array('id'=>$user['id']));

			if($a){

				$this->session->unset_userdata(array('userid','mnemonicword'));

				$this->Publics->jsonReturned('密码重置成功');return false;

			}
			$this->Publics->jsonReturned('密码重置失败',0);return false;

		}		

	}
	public function session(){

		// echo json_encode($this->session->tempdata());

		echo json_encode($_SESSION);
	}
}