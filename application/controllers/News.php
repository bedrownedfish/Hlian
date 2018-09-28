<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	
	public function __construct(){
		
		parent::__construct();

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->library('session');

		$this->load->helper('url');

	}
	public function checkLogin(){

		if(!$this->session->adminId){

			redirect('manage/login','refresh');

		}

	}

	//轮播图列表
	public function slide(){

		$this->checkLogin();

		$data['slide'] = $this->Dbmodel->select()->get('slideshow');

		$this->load->view('manage/slide',$data);
		
	}	
	//获取详细轮播图
	public function setSlide(){

		$this->checkLogin();

		$get = $this->input->get('id');

		if($get){

			$data['codes'] = $this->Dbmodel->select()->where(array('id'=>$get))->get('slideshow',1);

		}
		$this->load->view('manage/setSlide',$data);

	}
	//修改轮播图
	public function slideUpload(){

		$this->checkLogin();

		$config['upload_path'] = 'uploads/';
	    // 允许上传哪些类型
	    $config['allowed_types'] = 'gif|png|jpg|jpeg';
	    // 上传后的文件名，用uniqid()保证文件名唯一
	    $config['file_name'] = uniqid();	            
	    // 加载上传库
	    $this->load->library('upload', $config);
	    // 上传文件，这里的pic是视图中file控件的name属性
	    $result = $this->upload->do_upload('file');
	    // 如果上传成功，获取上传文件的信息
	    $mage = [];

	    $mage['type'] = 0;
	    
	    if ($result){

	    	$img = $this->upload->data();

	    	$id = $this->input->get('id');

	    	

	    	if($id){

	    		$code = "uploads/".$img['file_name'];

	    		$a = $this->Dbmodel->ci_update(array('imgs'=>$code,'addtime'=>time()),'slideshow',array('id'=>$id));

	    		if($a){

	    			$mage['message'] = '轮播图更新完成';

	    			$this->Publics->setOption('第'.$id.'张轮播图');

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
	//新闻列表
	public function newList(){

		$this->checkLogin();

		$data['codes'] = $this->Dbmodel->select()->get('news');

		$this->load->view('manage/newList',$data);

	}
	//新闻状态更改
	public function newsCheck(){

		$this->checkLogin();

		$get = $this->input->get();

		if($get){

			$this->Publics->setOption($get['id'].'新闻状态更改');

			$a['codes'] = $this->Dbmodel->ci_update(array('type'=>$get['type']),'news',array('id'=>$get['id']));

			echo json_encode($a);

		}

	}
	//修改新闻
	public function setNews(){

		$this->checkLogin();

		$get = $this->input->get('id');

		$data['codes'] = $this->Dbmodel->select()->where(array('id'=>$get))->get('news',1);

		$this->load->view('manage/setNews',$data);

	}
	//新增新闻
	public function newsAdd(){

		$this->checkLogin();

		$this->load->view('manage/newsAdd');

	}
	//添加新闻
	public function newsInset(){

		$posts = $this->input->post();

		$code['types'] = 0;

		$code['message'] = "添加出错，系统错误";
		
		if($posts){

			unset($posts['file']);

			$posts['content'] = trim($posts['content']);

			$posts['addtime'] = strtotime($posts['addtime']);
			
			$a = $this->Dbmodel->ci_insert($posts,'news');
			if($a){

				$code['types'] = 1;

				$code['message'] = "添加成功！";

				$this->Publics->setOption('新闻'.$a.'添加成功');

			}else{

				$code['message'] = "上传出错!";

			}

		}

		echo json_encode($code);

	}
	//修改缩略图
	public function newUploads(){

		$this->checkLogin();

		$config['upload_path'] = 'uploads/';
	    // 允许上传哪些类型
	    $config['allowed_types'] = 'gif|png|jpg|jpeg';
	    // 上传后的文件名，用uniqid()保证文件名唯一
	    $config['file_name'] = uniqid();	            
	    // 加载上传库
	    $this->load->library('upload', $config);
	    // 上传文件，这里的pic是视图中file控件的name属性
	    $result = $this->upload->do_upload('file');
	    // 如果上传成功，获取上传文件的信息
	    $mage = [];

	    $mage['type'] = 0;
	    
	    if ($result){

	    	$img = $this->upload->data();

	    	$id = $this->input->get('id');

	    	

	    	if($id){

	    		$code = "uploads/".$img['file_name'];

	    		$a = $this->Dbmodel->ci_update(array('images'=>$code),'news',array('id'=>$id));

	    		if($a){

	    			$mage['message'] = '缩略图上传完成';

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
	//添加新闻图片
	public function newsImagInset(){

		$this->checkLogin();

		$config['upload_path'] = 'uploads/';
	    // 允许上传哪些类型
	    $config['allowed_types'] = 'gif|png|jpg|jpeg';
	    // 上传后的文件名，用uniqid()保证文件名唯一
	    $config['file_name'] = uniqid();	            
	    // 加载上传库
	    $this->load->library('upload', $config);
	    // 上传文件，这里的pic是视图中file控件的name属性
	    $result = $this->upload->do_upload('file');

		$mage = [];

	    $mage['type'] = 0;

	    if ($result){

	    	$img = $this->upload->data();

	    	$code = "uploads/".$img['file_name'];

	    	$mage['message'] = '上传完成';
	    	
	    	$mage['code'] = $code;

	    	$mage['type'] = 1;

	    }else{

	    	$mage['message'] = '上传出错';

	    }
	    echo json_encode($mage);exit;
	}

	//修改新闻
	public function upNews(){

		$this->checkLogin();

		$posts = $this->input->post();

		unset($posts['file']);

		$posts['content'] = trim($posts['content']);

		$a['dtype'] = $this->Dbmodel->ci_update($posts,'news',array('id'=>$posts['id']));

		$a['message'] = $a['dtype']?"修改完成":"修改失败";

		$a['dtype']?$this->Publics->setOption('新闻'.$posts['id'].'修改完成'):"";

		echo json_encode($a);exit;

	}
	public function layditImg(){

		$data['code'] = 1;

		$data['msg'] = "上传失败！";

		$data['data']['src'] = '';

		$data['data']['title'] = time();

		$config['upload_path'] = 'uploads/news/';
	    // 允许上传哪些类型
	    $config['allowed_types'] = 'gif|png|jpg|jpeg';
	    // 上传后的文件名，用uniqid()保证文件名唯一
	    $config['file_name'] = uniqid();
	    // 加载上传库
	    $this->load->library('upload', $config);
	    // 上传文件，这里的pic是视图中file控件的name属性
	    $result = $this->upload->do_upload('file');

	    if ($result){

	    	$img = $this->upload->data();

	    	$code = "/uploads/news/".$img['file_name'];

	    	$data['code'] = 0;

	    	$data['msg'] = "上传成功！";

	    	$data['data']['src'] = $code;

	    }
	    echo json_encode($data);

	}

}

?>