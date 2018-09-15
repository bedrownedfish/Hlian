<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	private $mnemonicWord = "";
	
	public function __construct(){
		
		parent::__construct();

		$this->load->model('Publics');

		$this->load->model('Dbmodel');

		$this->load->library('session');
		//echo 121;exit;
		$this->load->helper('url');
		
		if(!$this->session->mnemonicWord){
			//echo $this->session->user_id;exit;
			redirect('/home/setout','refresh');

		}elseif (!$this->session->userid) {

			$this->session->set_userdata(array('userid'=>$this->Dbmodel->ci_find(array('mnemonicword'=>$this->session->mnemonicWord),'members','id')['id']));

		}

	}
	//首页
	public function index() {

		$this->Publics->verifySession();

		$data = $this->Publics->property();

		$data['bases'] = "index";

		$this->load->view('index',$data);

	}
	public function exchange(){

		$this->Publics->verifySession();

		$data['kinds'] = $this->Publics->property()['kinds'];

		$data['bases'] = 'exchange';

		// echo json_encode($data);exit;

		$this->load->view('exchange',$data);

	}
	public function news(){

		$this->Publics->verifySession();

		$data = $this->Publics->setNews();

		// echo json_encode($data);exit;

		$data['bases'] = 'news';

		$this->load->view('news',$data);

	}
	public function us(){

		$this->Publics->verifySession();

		$data = $this->Publics->setUserInfo();

		$data['bases'] = 'us';

		// echo json_encode($data);exit;

		$this->load->view('us',$data);

	}
	//币种详细页
	public function bizhong_neiye(){ 

		$this->Publics->verifySession();

		$id = $this->input->get('id');

		$data['cuarr'] = $this->Publics->setcurr($id);

		$data['usdrate'] = $this->Dbmodel->select()->where(array('id'=>1))->get('ratio',1)['ratio'];

		$chart = $this->Publics->getKinds();

		$a = [];

		$b = [];

		foreach ($chart as $key => $value) {

			$a['year'] = $key;

			$a['moneys'] = (float)$value;

			array_unshift($b,$a);

		}

		$data['chart'] = $b;

		$this->load->view('bizhong_neiye',$data);

	}
	//意见反馈
	public function feedback(){

		$this->Publics->verifySession();

		$this->load->view('feedback');

	}
	public function assets(){
		
		$this->Publics->verifySession();

		$data['bases'] = "";

		$data['assets'] = $this->Publics->assets();

		$this->load->view('assets',$data);

	}
	public function assets1(){

		$this->Publics->verifySession();

		$data['bases'] = "";

		$this->load->view('assets1',$data);
	}
	public function send(){

		$this->Publics->verifySession();

		$id = $this->input->get('id');

		$data['arr'] = $this->Publics->setSend($id);

		$data['bases'] = "";

		// echo json_encode($data);exit;

		$this->load->view('send',$data);

	}
	public function new_go(){

		$this->Publics->verifySession();

		$id = $this->input->get('id');

		$data = $this->Publics->setNewsGo($id);

		// echo json_encode($data);exit();

		$this->load->view('new_go',$data);

	}
	public function ment(){

		$this->Publics->verifySession();

		$this->load->view('ment');

	}
	public function ment_go(){

		$this->Publics->verifySession();

		$data = $this->Publics->setUserInfo();

		$this->load->view('ment_go',$data);
	}
	public function history(){

		$this->Publics->verifySession();

		$data = $this->Publics->historyData();

		$this->load->view('history',$data);

	}
	public function message(){

		$this->Publics->verifySession();

		$data['code'] = $this->Publics->setReceives();

		$this->load->view('message',$data);

	}
	public function rate(){

		$this->Publics->verifySession();

		$data = $this->Publics->setRate();

		$this->load->view('rate',$data);

	}
	public function fqa(){

		$this->Publics->verifySession();

		$data = $this->Publics->setCommon();

		$this->load->view('fqa',$data);

	}
	public function about_us(){

		$this->Publics->verifySession();

		$data = $this->Publics->setSys();

		$this->load->view('about_us',$data);

	}
	public function findpass(){

		$this->load->view('findpass');

	}
	public function setting(){

		$this->Publics->verifySession();

		$this->load->view('setting');

	}
	public function head(){

		$this->Publics->verifySession();

		$data['images'] = $this->Publics->setUserInfo()['users']['portrait'];

		// echo json_encode($data);exit;

		$this->load->view('head1',$data);

	}
	public function logOut(){

		$this->session->unset_userdata('mnemonicWord');
      	
      	$this->session->unset_userdata('userid');

		redirect('/index/index','refresh');
	}

}
