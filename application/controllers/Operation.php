<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->library('session');
		//echo 121;exit;
		$this->load->helper('url');
		
		if(!$this->session->mnemonicWord){
			//echo $this->session->user_id;exit;
			echo json_encode(array('msg'=>"登陆失效"));exit;

		}

	}
	//头像保存
	public function sendCurrs(){

		$posts = $this->input->post();

		$data['dtype'] = 0;

		$data['message'] = '上传失败';

		if($posts){

			$images = $this->Publics->uploadOne($posts['images']);

			if($images){

				$a = $this->Dbmodel->ci_update(array('portrait'=>$images),'members',array('id'=>$posts['id']));

				if($a){

					$data['types'] = 1;

					$data['message'] = '头像修改成功';

				}

			}

		}

		echo json_encode($data);

	}
	
	//交易记录
	public function dealPage(){

		$posts = $this->input->post();

		if($posts){

			$id = $posts['id'];

			$arr['eth_accounts'] = $this->Dbmodel->ci_find(array('id'=>$this->session->userid),'members','eth_accounts')['eth_accounts'];

			$where = "(userid = ".$this->session->userid.' or accounts = "'.$arr['eth_accounts'].'") and kid = '.$id;

			$arr['deal'] = $this->Dbmodel->select()->order_by('addtime')->where($where,'',false)->limit(10,($posts['page'])*10)->get('dealrecord');
			
			if($arr['deal']){
				foreach ($arr['deal'] as $k => $v) {

					$arr['deal'][$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);

					$arr['deal'][$k]['moneys'] = number_format($v['moneys'],2);

					if($v['accounts']==$arr['eth_accounts']){

						$arr['deal'][$k]['useraccounts'] = $this->Dbmodel->select('eth_accounts')->where(array('id'=>$v['userid']))->get('members',1)['eth_accounts'];

					}
					$arr['deal'][$k]['accountstr'] = substr_replace($v['accounts']!=$arr['deal'][$k]['useraccounts']?$v['accounts']:$arr['deal'][$k]['useraccounts'], "***",5,25);
				}
			}

			echo json_encode($arr);exit;

		}


	}
	//货币发送 
	public function sendCurr(){

		if($_POST){

			$posts = $this->input->post();

			if(!$this->Publics->validatePass($posts['code'])){
			
				$this->Publics->jsonReturned('请输入正确密码！',0);

				return false;
			}
          
          	//echo json_encode($posts);exit;
          	$moneys = abs($posts['moneys']);
		
			$number = $this->Dbmodel->ci_find(array('userid'=>$this->session->userid),'balance');

			$caccounts = $this->Dbmodel->select('eth_accounts')->where(array('id'=>$this->session->userid))->get('members',1)['eth_accounts'];

			if($caccounts == $posts['accounts']){

				$this->Publics->jsonReturned('不能给自己发送！',0);

				return false;

			}

			if($moneys>$number[$posts['tokname']] || $moneys<=0){

				$this->Publics->jsonReturned('交易数量错误！',0);

				return false;

			}

			$rusersId = $this->Dbmodel->ci_find(array('eth_accounts'=>$posts['accounts']),'members','id')['id'];

          	if($rusersId){

                $a = $this->Dbmodel->ci_num(array($posts['tokname']=>$moneys),'balance',array('userid'=>$rusersId));

                if($a){

                    $this->Dbmodel->ci_num(array($posts['tokname']=>-$moneys),'balance',array('userid'=>$this->session->userid));

                    $kid = $this->Dbmodel->ci_find(array('tokname'=>$posts['tokname']),'kinds','id')['id'];

                    $data = array(
                        'userid' => $this->session->userid,
                        'moneys' => $moneys,
                        'addtime' => time(),
                        'accounts' => $posts['accounts'],
                        'remark' => $posts['remark'],
                        'kid' => $kid
                    );

                    $this->Dbmodel->ci_insert($data,'dealrecord');

                }

                $this->Publics->jsonReturned('发送成功！');return false;

            }else{
            	$block = $this->Dbmodel->select('block')->get('config',1)['block'];
            	if($block == 0){$this->Publics->jsonReturned('区块交易繁忙，请联系管理员处理交易！',0);return false;};
                $this->load->library('ethereum');

              	if($posts['tid'] != 1){
					
                  	$a = $this->Dbmodel->ci_find(array('id'=>$posts['tid']),'kinds','contract')['contract'];
                  
                	$hax = $this->ethereum->transferSGV($posts['accounts'],$moneys,$a);
                  
                  	if(!$hax){
                    	
                      	$this->Publics->jsonReturned('系统维护，请稍后重试!',0);return false;
                      
                    }
                  
                  	$this->ci_update(array('pending_hax'=>$hax),'members',array('id'=>$this->session->userid));
                  
                  	$hdata = array(
                    	 'userid' => $this->session->userid,
                         'moneys' => -$moneys,
                         'addtime' => time(),
                         'accounts' => $posts['accounts'],
                         'remark' => $posts['remark'],
                         'kid' => $posts['tid'],
                      	 'blockchain' => 1,
                    );

                    $this->Dbmodel->ci_insert($data,'dealrecord');

                }

              	$this->Publics->jsonReturned('发送成功！将挖矿到账',0);return false;

            }

		}

	}
	//修改钱包名称
	public function upPortrait(){

		if($_POST){

			$nickname = $this->input->post('nickname');

			// echo json_encode($posts);exit();

			$a = $this->Dbmodel->ci_update(array('nickname'=>$nickname),'members',array('id'=>$this->session->userid));

			if(!$a){
				
				$this->Publics->jsonReturned('修改失败！',0);return false;
			}

			$this->Publics->jsonReturned('修改成功！');return false;

		}

	}
	//重置密码
	public function resetPass(){

		if($_POST){

			$posts = $this->input->post();

			$wordRegroup = $this->Publics->wordRegroup($posts['mnemonicWord']);//助记词重组

			if($this->session->mnemonicWord !=$wordRegroup){

				$this->Publics->jsonReturned('助记词不正确！',0);return false;

			}
			$passWord = $this->Publics->validatePass($posts['code']);//验证原密码

			$passWords = $this->Dbmodel->ci_find(array('id'=>$this->session->userid),'members','mak')['mak'];//获取数据库密码

			if($passWord){

				$this->Publics->jsonReturned('不能与原密码一致',0);return false;

			}
			if(!$this->Dbmodel->ci_update(array('mak'=>$this->Publics->encryptionCode($posts['code'])),'members',array('id'=>$this->session->userid))){$this->Publics->jsonReturned('重置密码出错,请稍后重试',0);return false;}//更新
			$this->Publics->jsonReturned('密码已重置,请妥善保管！');return false;
			// $this->Dbmodel->mnemonicWord
		}

	}
	public function category(){


		if($_POST){

			$posts = $this->input->post();
			
			$where['mnemonicword'] = $this->session->mnemonicWord;

			$a = $this->Dbmodel->ci_find($where,'members','currency');

			$b = $posts['type'] == "-1" ? str_replace(",".$posts['cid'], "", $a['currency']) : $a['currency'].",".$posts['cid'];

			// $b = str_replace(",".$posts['cid'], "", $a);

			$data['currency'] = $b;

			$c = $this->Dbmodel->ci_update($data,'members',$where);

			echo json_encode($b);exit;
			
		}

	}
	//意见反馈
	public function opinion(){

		$posts = $this->input->post();

		if($posts){

			$posts['username'] = $this->Dbmodel->select('username')->where(array('id'=>$this->session->userid))->get('members',1)['username'];

			$a = $this->Dbmodel->ci_insert($posts,'opinion');

			if($a){

				$this->Publics->jsonReturned('感谢您的反馈,将于24小时内给您回复');return false;

			}

			$this->Publics->jsonReturned('系统故障,提交失败');return false;

		}

	}

}
	

?>