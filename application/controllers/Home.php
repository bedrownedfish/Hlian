<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('Publics');

		$this->load->library('session');

		// $this->session->unset_userdata('mnemonicWord');

		$this->load->model('Dbmodel');
		//echo 121;exit;
		$this->load->helper('url');
		// echo $this->session->mnemonicWord;exit;
		if($this->session->mnemonicWord && !$this->session->mak){
			// $this->session->set_tempdata(array('user_id'=>'a1'),"",300);
			// echo $this->session->user_id;exit;
			redirect('/index/index','refresh');
			exit;
		}
	}
	public function index(){

		redirect('/home/setout','refresh');

	}
	//注册首页
	public function setout(){

		$this->load->view('setout');

	}
	//手机登陆
	public function login(){

		$this->load->view('login/login');

	}
	//密码找回
	public function forget(){
		$this->load->view('login/forget');
	}
	//手机注册
	public function resiter(){

		$this->load->view('login/resiter');

	}
	//特别提醒
	public function hint(){

		$this->load->view('hint');

	}
	//设置密码
	public function setPass(){

		$this->load->view('setpass');

	}
	//恢复密码
	public function backupsword1(){

		$this->load->view('backupsword1');

	}
	//助记词
	public function mnemonicWord(){

		$password = $this->input->get('code');

		//$this->session->set_userdata(array('mak'=>$password));

		$this->session->unset_userdata('mnemonicWord');

		if(!$this->session->mnemonicWord){

			$this->session->set_userdata(array('mnemonicWord'=>$this->Publics->mnemonicWord(),'mak'=>$password));

		}

		$string = $this->session->mnemonicWord;

		$data['arrays'] = $string; 

		$this->load->view('mnemonicword',$data);

	}
	//验证助记词
	public function backupsWord(){

		$mnemonicWord = $this->input->get();

		$arrayWord = explode(',',$mnemonicWord['mnemonicWord']);

		array_pop($arrayWord);

		if(implode("&",$arrayWord) == $this->session->mnemonicWord){

			$data['arrays'] = $this->session->mnemonicWord;

			$this->load->view('backupsword',$data);

		}

	}
	//恢复账号
	public function restAccount(){

		if($_POST){

			$posts = $this->input->post();

			$wordRegroup = $this->Publics->wordRegroup($posts['mnemonicWord']);//助记词重组

			$arr = $this->Dbmodel->ci_find(array('mnemonicword'=>$wordRegroup),'members');

			if(!$arr){$this->Publics->jsonReturned('助记词或密码错误！',0);return false;};

			if($arr['mak'] !=$this->Publics->encryptionCode($posts['code'])){$this->Publics->jsonReturned('助记词或密码错误！',0);return false;};

			$this->session->set_userdata(array('mnemonicWord'=>$arr['mnemonicword'],'userid'=>$arr['id']));

			$this->Publics->jsonReturned('账号恢复成功');return false;

		}

	}
	//注册eth
	public function createSite(){

		$this->Publics->verifySession();
      
      	$this->load->library('ethereum');
      
      	$Ethcode = $this->ethereum->createWallet();

		$arr = $this->db->where('mnemonicword',$this->session->mnemonicWord)->get('members')->row_array();

		if($arr['mnemonicword']) {redirect('/home/setout','refresh');exit;};

		$data['mnemonicword'] = $this->session->mnemonicWord;

		$data['mak'] = $this->Publics->encryptionCode($this->session->mak);

		$data['nickname'] = "会链钱包";

		$data['addtime'] = time();

		$data['currency'] = implode(',',array(1,2));

		$data['eth_accounts'] = $Ethcode['address'];
      
      	$data['eth_password'] = $Ethcode['password'];
      
      	$data['portrait'] = "public/images/icon_hc_03.png";

		$id = $this->Dbmodel->ci_insert($data,'members');

		$this->Dbmodel->ci_insert(array('userid'=>$id),'balance');

		$this->session->unset_userdata('mak');//清密码

		$this->session->unset_userdata('code');//清密码

		redirect('/index/index','refresh');

	}

}
?>