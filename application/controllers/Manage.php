<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

	public $pagenum = 15;
	
	public function __construct(){

		parent::__construct();

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->library('session');
		//echo 121;exit;
		$this->load->helper('url');

	}
	//检查登陆状态
	public function checkLogin(){

		if(!$this->session->adminId){

			redirect('manage/login','refresh');

		}

	}
  	public function logOut(){

		$this->session->unset_userdata('adminId');

		redirect('/manage/login','refresh');
	}
	public function msLogin(){

		if($_POST){

			$posts = $this->input->post();

			if($posts['code'] !=$this->session->securityCode){$this->Publics->jsonReturned('验证码不正确',0);exit;}

			$a = $this->Dbmodel->ci_find(array('username'=>$posts['users']),'manage');

			if(!$a){$this->Publics->jsonReturned('账号密码不匹配',0);exit;}

			if($a['pasword']!=$this->Publics->encryptionCode($posts['pass'])){$this->Publics->jsonReturned('账号密码不匹配',0);exit;}

			$this->session->set_userdata(array('adminId'=>$a['id']));

			$this->Publics->setOption('后台登陆!');

			$this->Publics->jsonReturned('登陆成功');exit;

		}

	}
	public function geteth(){

		$this->load->library('ethereum');
      
      	$Ethcode = $this->ethereum->createWallet();

      	echo json_encode($Ethcode);

	}
	public function login(){

		$data['securityCode'] = $this->Publics->securityCode();

		$this->load->view('manage/login',$data);

	}
	public function index(){

		$this->checkLogin();

		$this->load->view('manage/index',$data);

	}
	public function main(){

		$this->checkLogin();

		$newDate = strtotime(date('Y-m-d',time()));

		$data['membersCont'] = $this->db->count_all('members');

		$data['newMembCont'] = $this->Dbmodel->where('addtime>=',$newDate)->counts('members');

		$data['freezeMembCont'] = $this->Dbmodel->where('type',0)->counts('members');

		$data['issueMembCont'] = $this->Dbmodel->where('eth_accounts',"")->counts('members');

		$this->load->view('manage/main',$data);

	}
	public function table(){

		$this->checkLogin();

		$posts = $this->input->get();

		$pagenum = 5;

		if($posts){

			if($posts['code']){

				$posts['page'] = $posts['page']?$posts['page']:0;

				$b = $posts['page']?($posts['page']-1)*$pagenum:0;

				$data = $this->Dbmodel->page('members',$pagenum,'',$b,'eth_accounts',$posts['code']);

				// echo json_encode($data['codes']);exit;

			}
			if(!$data && $posts['page']){

				$data = $this->Dbmodel->page('members',$pagenum,'',$posts['page']!=1?($posts['page']-1)*$pagenum:0);

				echo json_encode($data['codes']);exit;
			}

		}

		// $data['codes'] = $this->db->select('*')->from('members a')->join('balance b', 'b.userid=a.id')->get()->result_array();
		if(!$data)$data = $this->Dbmodel->page('members',$pagenum);

		$data['pagenum'] = $pagenum;

		// echo json_encode($data);exit();

		$this->load->view('manage/table',$data);

	}
	//系统设置
	public function setConfig(){

		$this->checkLogin();

		$posts = $this->input->post();

		if($posts){

			unset($posts['file']);

			$posts['addtime'] = strtotime($posts['addtime']);

			$a = $this->Dbmodel->ci_update($posts,'config',array('id'=>1));

			$data['message'] = $a?"修改完成！":"修改失败！";	

			$a?$this->Publics->setOption('修改系统设置'):"";		

			echo json_encode($data);exit;

		}

		$data['codes'] = $this->Dbmodel->select()->get('config',1);

		$this->load->view('manage/setConfig',$data);

	}
	public function table_1(){

		$this->checkLogin();

		$posts = $this->input->get();

		if($posts['nickname']){

			$balan = $this->Dbmodel->select()->where(array('userid'=>(int)$posts['id']))->get('balance',1);

			$balData = "";

			foreach ($balan as $key => $value) {
				
				if($key=='id' || $key == 'userid'){

					continue;

				}

				$balData[$key] = $posts[$key];

			}

			$a  = $this->Dbmodel->ci_update($balData,'balance',array('id'=>$posts['id']));

			$gdata['nickname'] = $posts['nickname'];

			$mak = $this->Publics->encryptionCode($posts['mak']);

			$posts['mak'] ? $gdata['mak']= $mak:"" ;

			$b= $this->Dbmodel->ci_update($gdata,'members',array('id'=>$posts['id']));

			$accounts = $this->Dbmodel->select('eth_accounts')->where(array('id'=>$posts['id']))->get('members',1)['eth_accounts'];

			$edat = "aaa";

			if($a&&$b){

				$this->Publics->setOption('修改用户'.$posts['id'].'信息');
				
				// $this->load->view('manage/table_1?id='.$accounts,$edat);
				redirect('manage/table_1?id='.$accounts."&msg=".$edat,'refresh');exit;

			}

		}

		$id = $posts['id'];

		$data['codes'] = $this->Dbmodel->select()->where(array('eth_accounts'=>$id))->join('balance','balance.userid = members.id')->get('members',1);

		$data['kinds'] = $this->Dbmodel->select('*')->get('kinds');

		$this->load->view('manage/table_1',$data);

	}
	public function uploads(){

		$config['upload_path'] = 'uploads/';
	    // 允许上传哪些类型
	    $config['allowed_types'] = 'gif|png|jpg|jpeg';
	    // 上传后的文件名，用uniqid()保证文件名唯一
	    $config['file_name'] = uniqid();	            
	    // 加载上传库
	    $this->load->library('upload', $config);
	    // 上传文件，这里的pic是视图中file控件的name属性
	    $result = $this->upload->do_upload('file');

	    //echo json_encode($result);exit;
	    // 如果上传成功，获取上传文件的信息
	    $mage = [];

	    $mage['type'] = 0;
	    
	    if ($result){

	    	$img = $this->upload->data();

	    	$id = $this->input->get('id');

	    	if($id){

	    		$code = "uploads/".$img['file_name'];

	    		$a = $this->Dbmodel->ci_update(array('portrait'=>$code),'members',array('id'=>$id));

	    		if($a){

	    			$mage['message'] = '头像更新完成';

	    			$this->Publics->setOption('用户'.$id.'头像更新!');

	    			$mage['code'] = $code;

	    			$mage['type'] = 1;

	    		}else{

	    			$mage['message'] = '上传出错';

	    		}

	    	}else{

	    		$mage['message'] = '系统故障，请联系维护人员';

	    	}	        

	    }else{

	    	$mage['message'] = '文件错误';

	    }

	    echo json_encode($mage);exit;

	}
	public function myloginfo(){

		$this->checkLogin();
		
		$count = 10;

		$number = 0;

		$posts = $this->input->post();

		if($posts['number']){

			$number = ($posts['number']-1)*$count;

		}

		$data['codes'] = $this->Dbmodel->order_by('addtime')->select()->limit($count,$number)->get('option');

		if($posts){

			echo json_encode($data['codes']);exit;

		}

		$data['number'] = ceil($this->db->count_all('option')/$count);

		$this->load->view('manage/myloginfo',$data);
	}
	public function dealrecordSend(){

		$this->checkLogin();
		
		$count = $this->pagenum;

		$number = 0;

		$posts = $this->input->post();

		if($posts['number']){

			$number = ($posts['number']-1)*$count;

		}

		$data['codes'] = $this->Dbmodel->select()->order_by('id')->where(array('blockchain'=>0))->limit($count,$number)->get('dealrecord');

		foreach ($data['codes'] as $k => $v) {
			
			$data['codes'][$k]['useraccounts']=$this->Dbmodel->select('eth_accounts')->where(array('id'=>$v['userid']))->get('members',1)['eth_accounts'];
			
			$data['codes'][$k]['nickname'] = $this->Dbmodel->select('nickname')->where(array('id'=>$v['kid']))->get('kinds',1)['nickname'];

		}

		if($posts){

			echo json_encode($data['codes']);exit;

		}

		$data['number'] = ceil($this->Dbmodel->select()->where(array('blockchain'=>0))->get('dealrecord',3)/$count);

		$this->load->view('manage/dealrecordSend',$data);
	}

	public function dealrecordReceive(){

		$this->checkLogin();
		
		$count = $this->pagenum;

		$number = 0;

		$posts = $this->input->post();

		if($posts['number']){

			$number = ($posts['number']-1)*$count;

		}

		$data['codes'] = $this->Dbmodel->select()->order_by('id')->where(array('blockchain'=>1))->limit($count,$number)->get('dealrecord');

		foreach ($data['codes'] as $k => $v) {
			
			$data['codes'][$k]['useraccounts']=$this->Dbmodel->select('eth_accounts')->where(array('id'=>$v['userid']))->get('members',1)['eth_accounts'];
			
			$data['codes'][$k]['tokname'] = $this->Dbmodel->select('tokname')->where(array('id'=>$v['kid']))->get('kinds',1)['tokname'];

		}

		if($posts){

			echo json_encode($data['codes']);exit;

		}

		$data['number'] = ceil($this->Dbmodel->select()->where(array('blockchain'=>1))->get('dealrecord',3)/$count);

		$this->load->view('manage/dealrecordReceive',$data);
	}

	public function kindsK(){
		
		$this->checkLogin();

		$get = $this->input->get();

		if($get){

			$kinds = $this->Dbmodel->select('currency')->where(array('id'=>$get['id']))->get('members',1);

			$kinda = explode(',',$kinds['currency']);

			foreach ($kinda as $key => $value) {

				if((int)$get['dtype'] == 0){
					
					if($get['kid'] == $value) unset($kinda[$key]);

				}
				elseif((int)$get['dtype'] == 1){

					array_push($kinda, $get['kid']);

					break;

				}

			}

			$data['currency'] = implode(',',$kinda);

			$a['codes'] = $this->Dbmodel->ci_update($data,'members',array('id'=>$get['id']));

			if($a['codes'] ){

				$this->Publicsset->setOption('关闭用户'.$get['id'].'H链');

			}

			echo json_encode($a);
		}
	}
	public function memberType(){

		$this->checkLogin();

		$get = $this->input->get();

		if($get){

			$a['codes'] = $this->Dbmodel->ci_update(array('type'=>(int)$get['type']),'members',array('id'=>$get['id']));

			echo json_encode($a);

		}

	}
	public function changepwd(){

		$this->checkLogin();

		$data['adName']=$this->Dbmodel->select()->get('manage',1);

		$posts = $this->input->post();

		if($posts){

			if($data['adName']['pasword'] == $this->Publics->encryptionCode($posts['pas'])){
				if($data['adName']['username'] != $posts['username']){

					if($this->Dbmodel->ci_update(array('username'=>$posts['username']),'manage',array('id'=>1))){

						$data['success'] = '登陆名修改成功';

						$this->Publics->setOption('登陆名修改成功!');

					}else{

						$data['error'] = '登陆名修改失败';

					}

				}
				if($posts['newps'] != ""){
					if($data['adName']['pasword'] != $this->Publics->encryptionCode($posts['newps'])){

						if($this->Dbmodel->ci_update(array('pasword'=>$this->Publics->encryptionCode($posts['newps'])),'manage',array('id'=>1))){

							$data['success'] = '密码修改成功';

							$this->Publics->setOption('登陆密码修改成功!');

						}else{

							$data['error'] = "密码修改失败！";

						};

					}else{

						$data['error'] = "与原密码一致";

					}
				}

			}else{

				$data['error'] = "系统密码错误";

			}
			$data['error']=="" && $data['success'] == ""?$data['error']="没有进行任何操作":"";

			echo json_encode($data);exit;

		}

		$this->load->view('manage/changepwd',$data);

	}

}