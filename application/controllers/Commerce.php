<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commerce extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->library('session');
		//echo 121;exit;
		$this->load->helper('url');

	}
	public function usertrue(){

		$posts =  file_get_contents("php://input");

		$posts = json_decode($posts, true);

		$data = $this->typetrue($posts);

		if($posts && !$data['error_code']){

			$datas = $this->Dbmodel->select()->where(array('username'=>$posts['mobile']))->get('members',1);

			if($datas){

				$balan = $this->Dbmodel->select('hlink')->where(array('userid'=>$datas['id']))->get('balance',1);

				$data['result'] = $balan;

			}else{

				$data['error_code'] = 1;

			}

		}

		echo json_encode($data);exit;

	}

	private function typetrue($code){

		$pcode = md5(md5(substr($code['time'],3)));

		$data['error_code'] = $pcode == $code['token']? 0 : 1;

		$data['result'] = [];

		return $data;

	}
	//后台 获取用户余额数据

	/*
	
	*/
	public function getBalances(){

		$posts =  file_get_contents("php://input");

		$posts = json_decode($posts, true);

		$data = $this->typetrue($posts);

		if($posts && !$data['error_code']){

			$codes = [];

			foreach ($posts['mobile'] as $k => $v) {

				$balance = $this->Dbmodel->select()->where(array('username'=>$v))->join('balance','members.id = balance.userid')->get('members',1);

				$codes[$posts['mobile'][$k]] = $balance['hlink']!=""?$balance['hlink']:$posts['notice'];

			}

			$data['result'] = $codes;

		}
		echo json_encode($data);

	}
	//后台 获取用户交易记录数据

	/*
	
	*/
	public function getDeal(){

		$posts =  file_get_contents("php://input");

		$posts = json_decode($posts, true);

		$data = $this->typetrue($posts);

		if($posts && !$data['error_code']){

			$num = (int)$posts['num'] *((int)$posts['page']-1);

			$user = $this->Dbmodel->select()->where(array('username'=>$posts['mobile']))->get('members',1);

			$code = $this->Dbmodel->select()->where(array('userid'=>$user['id']))->or_where(array('accounts'=>$user['eth_accounts']))->limit((int)$posts['num'],$num)->order_by('addtime')->get('dealrecord');

			$pagenum = $this->Dbmodel->select()->where(array('userid'=>$user['id']))->or_where(array('accounts'=>$user['eth_accounts']))->get('dealrecord',3);

			$codes = [];

			foreach ($code as $k => $v) {
				
				$codes[$k]['balance'] = $v['userid'] == $user['id']?"-".$v['moneys']:$v['moneys'];

				$codes[$k]['addtime'] = $v['addtime'];

				$codes[$k]['remark'] = $v['remark'];

			}

			$data['result']['codes'] = $codes;

			$data['result']['pagenum'] = ceil($pagenum/$posts['num']);

		}

		echo json_encode($data);

	}
	//获取详细信息
	public function getUserKind(){

		$posts =  file_get_contents("php://input");

		$posts = json_decode($posts, true);

		$data = $this->typetrue($posts);
	
		if($posts && !$data['error_code']){		

			$arr = $this->Dbmodel->ci_find(array('id'=>2),'kinds');

			$users = $this->Dbmodel->select()->where(array('username'=>$posts['username']))->get('members',1);
			
			$arr['eth_accounts'] = $users['eth_accounts'];

			$where = "(userid = ".$users['id'].' or accounts = "'.$arr['eth_accounts'].'") and kid = 2';
			//$arr['deal'] = $this->Dbmodel->select()->order_by('addtime')->where(array('userid'=>$this->session->userid))->or_where(array('accounts'=>$arr['eth_accounts']))->limit(10,0)->get('dealrecord');

			$arr['deal'] = $this->Dbmodel->select()->order_by('addtime')->where($where,'',false)->limit(10,0)->get('dealrecord');
			//echo $this->db->last_query() ;exit;

			foreach ($arr['deal'] as $k => $v) {

				if($v['accounts']==$arr['eth_accounts']){

					$arr['deal'][$k]['useraccounts'] = $this->Dbmodel->select('eth_accounts')->where(array('id'=>$v['userid']))->get('members',1)['eth_accounts'];

				}
			}

			$arr['page'] = floor($this->Dbmodel->select()->where($where,'',false)->get('dealrecord',3)/10);

			$arr['moneys'] = $this->Dbmodel->ci_find(array('userid'=>$users['id']),'balance')[$arr['tokname']];

			$data['result'] = $arr;

		}

		echo json_encode($data);

	}
	public function setBalance(){

		$posts =  file_get_contents("php://input");

		$posts = json_decode($posts, true);

		$data = $this->typetrue($posts);

		$codes = explode(',',base64_decode($posts['code']));

		$data['result'] = 1;

		if($posts && !$data['error_code']){

			$type = (int)$posts['type'];

			$users = $this->Dbmodel->select()->where(array('username'=>$codes[0]))->get('members',1);

			if($users['id']){

				$config = $this->Dbmodel->select()->get('config',1);

				$hos = $this->Dbmodel->select()->where(array('eth_accounts'=>$config['host']))->get('members',1);

				$a = $this->Dbmodel->ci_num(array('hlink'=>$codes[1]),'balance',array('userid'=>$type==1?$users['id']:$hos['id']));

				$b = $this->Dbmodel->ci_num(array('hlink'=>'-'.$codes[1]),'balance',array('userid'=>$type==1?$hos['id']:$users['id']));

				if($a && $b){

					$datas = array(
                        'userid' => $type==1?$hos['id']:$users['id'],
                        'moneys' => $codes[1],
                        'addtime' => time(),
                        'accounts' => $type==1?$users['eth_accounts']:$config['host'],
                        'remark' => $posts['remark'],
                        'kid' => 2
                    );
					$this->Dbmodel->ci_insert($datas,'dealrecord');
				}else{

					$data['error_code'] = 1;

					$data['result'] = 2;

				}

			}else{

				$data['error_code'] = 1;

				$data['result'] = 3;

			}

		}
		echo json_encode($data);
	}
}