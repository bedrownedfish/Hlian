<?php
class Publics extends CI_Model{

	//获取验证码
	public function securityCode(){

		$this->load->helper('captcha');

		$code = rand(100000, 1000000);

		$this->load->library('session');

		$session['securityCode'] = $code;

		$this->session->set_userdata($session);

		$vals = array(
		    'word'      => $code,
		    'img_path'  => './captcha/',
		    'img_url'   => 'http://'.$_SERVER['SERVER_NAME'].'/captcha/',
		    //'font_path' => '',
		    'img_width' => '150',
		    'img_height'    => '30',
		    'expiration'    => 7200,
		    'word_length'   => 3,
		    //'font_size' => 16,
		    'img_id'    => 'tyCode',
		    // 'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		    // White background and border, black text and red grid
		    /*'colors'    => array(
		        'background' => array(255, 255, 255),
		        'border' => array(255, 255, 255),
		        'text' => array(0, 0, 0),
		        'grid' => array(255, 40, 40)
		    )*/
		);

		$cap = create_captcha($vals);

		return $cap['image'];exit;

	}
	public function uploadOne($file){

	    header('Content-type:text/html;charset=utf-8');

	    $base64_image_content = trim($file);
	    //正则匹配出图片的格式
	    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {

	        $type = $result[2];//图片后缀
	 
	        $dateFile = date('Y-m-d', time()) . "/";  //创建目录

	        $new_file = 'uploads/head/'. $dateFile;

	        if (!file_exists($new_file)) {
	            //检查是否有该文件夹，如果没有就创建，并给予最高权限
	            mkdir($new_file, 0700);

	        }
	 
	        $filename = time() . '_' . uniqid() . ".{$type}"; //文件名

	        $new_file = $new_file . $filename;
	         
	        //写入操作
	        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {

	            return $new_file;  //返回文件名及路径

	        } else {

	            return false;

	        }
	    }
	}
	//检查登陆状态
	public function checkLogin(){

		if(!$this->session->adminId){

			redirect('manage/login','refresh');

		}

	}
	//币种详细页面
	public function setcurr($id){

		$arr = $this->Dbmodel->ci_find(array('id'=>$id),'kinds');
		
		$arr['eth_accounts'] = $this->Dbmodel->ci_find(array('id'=>$this->session->userid),'members','eth_accounts')['eth_accounts'];

		$where = "(userid = ".$this->session->userid.' or accounts = "'.$arr['eth_accounts'].'") and kid = '.$id;
		//$arr['deal'] = $this->Dbmodel->select()->order_by('addtime')->where(array('userid'=>$this->session->userid))->or_where(array('accounts'=>$arr['eth_accounts']))->limit(10,0)->get('dealrecord');

		$arr['deal'] = $this->Dbmodel->select()->order_by('addtime')->where($where,'',false)->limit(10,0)->get('dealrecord');
		//echo $this->db->last_query() ;exit;

		foreach ($arr['deal'] as $k => $v) {

			if($v['accounts']==$arr['eth_accounts']){

				$arr['deal'][$k]['useraccounts'] = $this->Dbmodel->select('eth_accounts')->where(array('id'=>$v['userid']))->get('members',1)['eth_accounts'];

			}
		}

		$arr['page'] = floor($this->Dbmodel->select()->where($where,'',false)->get('dealrecord',3)/10);

		$arr['moneys'] = $this->Dbmodel->ci_find(array('userid'=>$this->session->userid),'balance')[$arr['tokname']];

		return $arr;

	}
	//获取助记词字符串用   & 连接
	public function mnemonicWord(){

		$word = array();

		$a = 0;
		
		while($a<12){

			$strings = rtrim(file('./public/en.txt')[rand(0,838)]);
			
			array_push($word,$strings);

			$a++;

		}

		$words = implode('&',$word);

		// $arr = $this->db->where('mnemonicword',$words)->get('members')->row_array();
		$arr = $this->Dbmodel->select('mnemonicword')->where(array('mnemonicword'=>$words))->get('members');

		if($arr['mnemonicword']) $this->mnemonicWord();

		return $words;

	}
	//密码函数
	public function encryptionCode($code){

		return md5(md5(base64_decode(base64_decode($code))));

	}
	//ajax返回
	public function jsonReturned($message,$type=1){

		$data['message'] = $message;

		$data['types'] = $type;

		echo json_encode($data);return false;

	}
	//验证密码
	public function validatePass($code){

		$passWord = $this->encryptionCode($code);

		$type = false;

		if($passWord == $this->Dbmodel->ci_find(array('id'=>$this->session->userid),'members','mak')['mak']){

			$type = true;

		}

		return $type;

	}
	//助记词重组
	public function wordRegroup($code){

		$arrayWord = explode(',',$code);

		array_pop($arrayWord);

		return implode("&",$arrayWord);

	}
	//返回所有币种
	public function assets(){

		$a = $this->Dbmodel->ci_select("type=1","kinds");

		$b = $this->Dbmodel->ci_find(array('mnemonicword'=>$this->session->mnemonicWord),'members','currency');

		foreach ($a as $key => $value) {
			
			if(!in_array($a[$key]['id'],explode(',',$b['currency']))){

				$a[$key]['type'] =0;

			}

		}

		return $a;

	}

	//组织交易历史数据
	public function historyData (){

		// $arr = $this->Dbmodel->ci_select(array('userid'=>$this->session->userid),'dealrecord','*','addtime');
		$accounts = $this->Dbmodel->select('eth_accounts')->where(array('id'=>$this->session->userid))->get('members',1)['eth_accounts'];

		$arr = $this->Dbmodel->select()->order_by('addtime')->where(array('userid'=>$this->session->userid))->or_where(array('accounts'=>$accounts))->get('dealrecord');
      
      	$b=[];
      
      	if(!$arr) return $b;

      	$arrs = $this->arrSort($arr,'addtime',SORT_ASC);

		$a = $this->setMonth($arrs[0]['addtime']);

		foreach ($a as $key => $value) {

			$b[$value] = [];
			
		}

		foreach ($arr as $key => $value) {

			if($v['accounts']==$accounts){

				$arr[$key]['useraccounts'] = $this->Dbmodel->select('eth_accounts')->where(array('id'=>$value['userid']))->get('members',1)['eth_accounts'];

			}

			array_push($b[date('Y-m',$value['addtime'])],$value);
			
		}
		$b['code'] = array_filter($b);//清除月份空数组

		return $b;

	}
	//获取时间戳到当前时间    月的数组
	public function setMonth($date = "1512727526"){

		$timeArr = [];

		$month = date('Y-m',$date);

		while (strtotime($month) <= strtotime(date('Y-m',time()))) {

			array_unshift($timeArr,$month);

			$m = strlen(date('m',$date)+1)==1?'0'.(date('m',$date)+1):date('m',$date)+1;

			$month = date('m',$date) != 12 ? date('Y',$date).'-'.$m:(date('Y',$date)+1).'-01';

			$date = strtotime($month);
			
		}
		return $timeArr;
	}
	//获取当前时间之前的周的数组
	public function getDate(){

		$date = time();

		$datearr = [];

		for($i=1; $i <=7 ; $i++) {

			$date -= 86400;

			array_push($datearr, date('m-d',$date));
			//array_push($datearr, $date);
			
		}
		return $datearr;

	}
	//组织折线图的数据
	public function getKinds(){

		$date = $this->getDate();

		$kinds = $this->Dbmodel->select()->order_by('addtime')->where(array('kid'=>2))->limit(7,0)->get('kprice');

		$datas = [];

		$message = [];

		foreach ($date as $key => $value) {
			
			foreach ($kinds as $k => $v) {

				if($value == date('m-d',$v['addtime'])){

					$message[$value] = $v['price'];

				}

			}
			if(!$message[$value]){

				$message[$value] = $message[$date[$key-1]];

			}
			if(!$message[$date[$key-1]] && !$message[$value]){

				$message[$value] = $kinds[0]['price'];

			}

		}

		return $message;

	}
	//获取tok信息
	public function setSend($id){

		$a = $this->Dbmodel->ci_find(array('id'=>$id),'kinds');

		$b = $this->Dbmodel->ci_find(array('userid'=>$this->session->userid),'balance',$a['tokname']);

		$a['fee'] = $this->Dbmodel->select()->get('config',1)['fee'];

		$a['moneys'] = $b[$a['tokname']];

		return $a;

	}
	//验证登陆状态
	public function verifySession(){

		if(!$this->session->mnemonicWord) 

			redirect('/home/setout','refresh');

	}

	//全部资金
	public function moneys($id,$kinds){

		$a = $this->Dbmodel->ci_find(array('userid'=>$id),'balance');

		$data = [];
		$data['moneys'] = '';

		foreach ($kinds as $key => $value) {
			
			$data[$value['tokname']] = $value['price']*$a[$value['tokname']];

			$data['moneys'] += $data[$value['tokname']]; 

		}
		return $data;

	}
	//新闻公告页面
	public function setNews(){

		$data['slideshow'] = $this->Dbmodel->ci_select(array('type'=>1),'slideshow');

		$data['news'] = $this->Dbmodel->ci_select(array('type'=>1),'news');

		return $data;

	}
	//增加后台操作日志
	public function setOption($code){

		$data=array(
			'staff'=>'admin',
			'addtime'=>time(),
			'code'=>$code,
			'ip'=>$this->input->ip_address(),
		);
		$this->Dbmodel->ci_insert($data,'option');

	}
	public function setNewsGo ($id){

		$data['news'] = $this->Dbmodel->ci_find(array('id'=>$id),'news');

		return $data;

	}
	//交易记录
	public function dealRecord($id){

		$a = $this->Dbmodel->ci_select(array('userid'=>$id),'dealrecord');

		$c = "";$r = "";
		

		foreach ($a as $key => $value) {

			if($value['moneys'] > 0){

				$r +=$value['moneys'];

			}else{

				$c += $value['moneys'];

			}

		}
		$b['income'] = $r !="" ? $r : number_format(0,2);
		$b['expend'] = $c != "" ? $c : number_format(0,2);

		return $b;

	}
	//获取个人资料
	public function setUserInfo(){

		$data['users'] = $this->Dbmodel->ci_find(array('id'=>$this->session->userid),'members');

		$datas = $this->setReceive();

		foreach ($datas as $key => $value) {

			if ($value['moneys'] < 0 || $value['examine'] == 1) {

				unset($datas[$key]);

			}

		}

		$data['numbers'] = count($datas) + (int)$this->Dbmodel->select()->where(array('username'=>$data['users']['username'],'examine'=>0,'reply!='=>""))->get('opinion',3);

		return $data;

	}
	//获取资产变动记录信息
	public function setReceive(){

		$accounts = $this->Dbmodel->select('eth_accounts')->where(array('id'=>$this->session->userid))->get('members',1)['eth_accounts'];

		$datas = $this->Dbmodel->ci_select(array('accounts'=>$accounts),'dealrecord','*','addtime');

		return $datas;

	}
	//获取接收到的资产变动记录信息
	public function setReceives(){

		$a = $this->assets();

		$udata = [];

		$datas = $this->setReceive();

		foreach ($datas as $key => $value) {

			foreach ($a as $k => $v) {

				if ($v['id'] == $value['kid']) $datas[$key]['kname'] = $v['tokname'];
				
			}

			if ($value['moneys'] < 0) {

				unset($datas[$key]);

			}elseif($value['moneys'] >= 0 &&$value['examine'] == 0){

				$udatas['id'] = $value['id'];

				$udatas['examine'] = 1;

				array_push($udata, $udatas);

			}

		}

		$this->Dbmodel->ci_updateAll($udata,'dealrecord','id');

		$username = $this->Dbmodel->select('username')->where(array('id'=>$this->session->userid))->get('members',1)['username'];

		$fdata = $this->Dbmodel->select()->order_by('id')->where(array('username'=>$username,'reply!='=>""))->get('opinion');

		$odata = [];

		foreach ($fdata as $ke => $va) {
			
			$arr = [];

			$arrs = [];

			$arr['accounts'] = $va['title'];

			$arr['addtime'] = $va['addtime'];

			$arr['reply'] = $va['reply'];

			$arr['examine'] = $va['examine'];

			$arr['types'] = 1;

			$arrs['id'] = $va['id'];

			$arrs['examine'] = 1;

			array_push($datas, $arr);

			array_push($odata, $arrs);

		}

		$this->Dbmodel->ci_updateAll($odata,'opinion','id');

		return $datas;

	}
	//统计全部资产
	public function property(){

		$this->verifySession();

		$data['mnemonicword'] = $this->session->mnemonicWord;

		$arr = $this->Dbmodel->ci_find($data,'members');

		$datas =[];

		foreach (explode(",",$arr['currency']) as $key => $value) {
			
			array_push($datas, "id=".$value);

		}

		$c = $this->dealRecord((int)$arr['id']);
		//echo json_encode($c);exit;

		$kinds = $this->Dbmodel->ci_select(implode(" or ", $datas),'kinds');

		$a['moneys'] = $this->moneys((int)$arr['id'],$kinds);

		$a['userarr'] = $arr;

		$a['deal'] = $c;

		$a['kinds'] = $kinds;

		return $a;

	}
	//获取汇率影响
	public  function setRate(){

		$data['code'] = $this->Dbmodel->ci_select('type=1','ratio');

		$data['rate'] = $this->Dbmodel->ci_find('id=1','config','rate');

		return $data;

	}
	//获取系统信息
	public function setSys(){

		$data['code'] = $this->Dbmodel->ci_find('id=1','config','sysemname,asrega,sysico,edition');

		return $data;

	}
	//获取常见问题页面数据
	public function setCommon(){

		$data['code'] = $this->Dbmodel->ci_select('type=1','common');

		return $data;

	}
	/*	
		@@:   二维数组排序
		*$arrays			数组

		*$sort_key		键名

		*$sort_order		SORT_ASC    升序(默认)	SORT_DESC 		降序

		*$sort_type		SORT_REGULAR - 默认。将每一项按常规顺序排列。SORT_NUMERIC - 将每一项按数字顺序排列。SORT_STRING - 将每一项按字母顺序排列
	*/
	public function arrSort($arrays,$sort_key,$sort_order=SORT_DESC,$sort_type=SORT_NUMERIC ){

        if(is_array($arrays)){

            foreach ($arrays as $array){

                if(is_array($array)){
 
                    $key_arrays[] = $array[$sort_key];

                }else{

                    return false;

                }

            }
 
        }else{
 
            return false;
  
        }

        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);

        return $arrays;

	}
}
?>