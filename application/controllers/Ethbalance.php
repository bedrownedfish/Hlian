<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ethbalance extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Dbmodel');
		$this->load->model('Publics');
		$this->load->library('session');
		//echo 121;exit;
		$this->load->helper('url');
	}
 	public function ethsynss(){

 		$userArray = $this->Dbmodel->select()->get('members');
 		$this->load->library('ethereum');

		$timeStamp = time();

		//echo date('Y-m-d H:i:s',$timeStamp).'中心账号ETH余额：--'.$this->ethereum->balanceOf('0x95140bf555c71912bb6c756369d839e5be6dabce')."</br>";

 		if($userArray && count($userArray)) {

 			$arr = [];

			$ethwile = function($v,$k) use (&$arr){

				$arr[$k] = $v;

			};

			array_walk($userArray, $ethwile);

		}

 	}
	public function ethSyns(){

		$userArray = $this->Dbmodel->select()->get('members');

		if($userArray && count($userArray)) {

			$this->load->library('ethereum');

			$timeStamp = time();

			echo date('Y-m-d H:i:s',$timeStamp).'中心账号ETH余额：--'.$this->ethereum->balanceOf('0x95140bf555c71912bb6c756369d839e5be6dabce')."</br>";

			foreach($userArray as $key=>$val){

				$lock = false;

				if($val['pending_hax']) {

					$t_result = $this->ethereum->checkTransactioning($val['pending_hax']);

					if (!$t_result) {

						echo $val['username'] . '有交易正在执行,交易号:'. $val['pending_hax']. "\n";

						$lock = true;

					}else{

						//echo $val['user_sn'] . '无交易正在执行'. "\n";

					}

				}
				if(!$lock){

					$HLIANBalance = $this->ethereum->balanceOfHLIAN($val['eth_accounts']);

					if ($HLIANBalance > 0) {

						$transferHLIAN = $this->ethereum->transferHLIANtoCoinbase($val['eth_accounts'], $HLIANBalance, $val['eth_password']);

						if ($transferHLIAN) {

							$config = $this->Dbmodel->select('fee,host')->get('config',1);

							$fee = $HLIANBalance * $config['fee'];

							$mum = $HLIANBalance - $fee;

							$uid = $this->Dbmodel->select('id')->where(array('eth_accounts'=>$config['host']))->get('members',1);

							$this->Dbmodel->ci_num(array($posts['tokname']=>$HLIANBalance),'balance',array('userid'=>$val('id')));

							$hdata = array(
		                    	 'userid' => $uid['id'],
		                         'moneys' => $HLIANBalance,
		                         'fee'	  => $fee,
		                         'addtime' => time(),
		                         'accounts' => $val['eth_accounts'],
		                         'remark' => '转',
		                         'kid' => 2,
		                      	 'blockchain' => 1,
		                    );

							$this->Dbmodel->ci_insert($data,'dealrecord');

							echo '试着成功地将HLIAN转移到中心钱包, hash=' . $transferHLIAN . '. ';exit;

						}else{

							if($this->ethereum->balanceOf($val['eth_accounts'])<0.0005){

								$transfer = $this->ethereum->transferGas($val['eth_accounts']);

								echo $transfer."</br>";

								if($transfer){

									$this->Dbmodel->ci_update(array('pending_hax'=>$transfer),'members',array('id'=>$val['id']));

									echo '试着将油费转移到.'.$val['pending_hax'].' hash=' . $transfer . '. HLIAN:'.$transferHLIAN."</br>";

								}

							}

						}

					}else{

						echo '用户：'.$val['username'].'--------'.$val['eth_accounts'].'------区块链余额为空'."</br>";

					}
					//echo $key."</br>";
				}

			}

			//echo json_encode($userArray);
		}

	}
	
}