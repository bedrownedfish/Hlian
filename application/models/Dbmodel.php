<?php 

	class Dbmodel extends CI_Model{
		//新增数据

		public function __construct(){

			// parent::__construct();

			$this->load->database();

		}
		//查询指定字段  data为空查询所有
		public function select($data='*'){

			$this->db->initialize();

			$this->db->select($data);

			return $this;

		}
		//查询条件   array数组格式
		public function where($data,$key="null",$type = 'true'){

			$this->db->where($data,$key,$type);

			return $this;

		}

		// or 查询条件   array数组格式
		public function or_where($data,$key="null",$type = 'true'){

			$this->db->or_where($data,$key,$type);

			return $this;

		}

		public function join($data,$join){

			$this->db->join($data,$join);

			return $this;

		}
		//排序查询，￥data数组  sc  desc大到小  asc小到大
		public function order_by($data,$sc = 'DESC'){

			$this->db->order_by($data,$sc);

			return $this;

		}
		//查询表
		public function from($data){

			$this->db->from($data);

			return $this;

		}
		// ￥type  before 为 %match   after 为match%   both 为 %match%
		public function like($data,$key,$type= 'both'){

			$this->db->like($data,$key,$type);

			return $this;

		}
		public function or_like($data,$key,$type= 'both'){

			$this->db->or_like($data,$key,$type);

			return $this;

		}
		//分页查询 a为条数  b为位置
		public function limit($a,$b){

			$this->db->limit($a,$b);

			return $this;

		}
		//查询 返回查询结果  data表名  type为1的时候单条查询结果一维数组 2 多条查询结果二维数组 3返回查询的数组条数

		public function get($data,$type=2){

			$a = $this->db->get($data);

			if($type == 1){

				$b = $a->row_array();

			}elseif($type == 2){

				$b = $a->result_array();

			}elseif($type == 3){

				$b = $a->num_rows();

			}

			$this->db->close();

			return $b;

		}
		public function counts($data){

			return $this->db->count_all_results($data);

		}
		public function ci_insert($data,$table){

			$this->db->initialize();

			$this->db->insert($table,$data);

			$a = $this->db->insert_id();

			$this->db->close();

			return $a;

		}
		public function ci_inserts($data,$table){

			$this->db->initialize();

			$this->db->insert_batch($table,$data);

			$a = $this->db->insert_id();

			$this->db->close();

			return $a;

		}
		//查询单条数据 $table   表名 ,$where 查询条件,   $field = '*'字段
		public function ci_find($where,$table,$field = '*'){

			$this->db->initialize();

			$a = $this->db->select($field)->where($where)->get($table)->row_array();

			$this->db->close();

			return $a;
		}
		//查询二维数组数据 $table   表名 ,$where 查询条件,   $field = '*'字段
		public function  ci_select($where="",$table,$field = '*',$tile = "", $ttype = 'DESC'){

			$this->db->initialize();

			$this->db->select($field);

			if($where) $this->db->where($where);

			if($tile!="") $this->db->order_by($tile, $ttype);

			$a = $this->db->get($table)->result_array();

			$this->db->close();

			return $a;

		}
		//修改  $data  修改的数据     ,$table, 表名          $where 条件
		public function ci_update($data,$table,$where){

			$this->db->initialize();

			$a = $this->db->where($where)->update($table,$data);

			$this->db->close();

			return $a;

		}
		//批量更新
		public function ci_updateAll($data,$table,$where){

			$this->db->initialize();

			$a = $this->db->update_batch($table,$data,$where);

			$this->db->close();

			return $a;

		}
		//自增  输入负数即为自减
		public function ci_num($data,$table,$where){

			$this->db->initialize();

			$this->db->where($where);

			foreach ($data as $key => $value) {

				$this->db->set($key,$key."+".$value,FALSE);

			}
			$a = $this->db->update($table);

			$this->db->close();

			return $a;
		}
		//删除某条数据
		public function ci_del($where,$table){

			$this->db->initialize();

			$a = $this->db->where($where)->delete($table);

			$this->db->close();

			return $a;
		}

		public function page($tablename,$per_nums,$data="",$start_position = 0,$skey="",$svalue=""){//传入3个参数，表名字，每页的数据量，其实位置 where数据

			$this->db->initialize();

			$this->db->order_by('addtime','desc');

			$this->db->limit($per_nums,$start_position);

			if($skey)$this->db->like($skey, $svalue, 'both');

			if($data){

				$query=$this->db->get_where($tablename,$data);

			}else{

				$query=$this->db->from('members a')->join('balance b', 'b.userid=a.id')->get();

			}

			$data=$query->result_array();

			$data2['total_nums']=$skey?count($this->db->like($skey, $svalue, 'both')->get('members')->result_array()):$this->db->count_all($tablename);

			$data2['codes']=$data; //这里大家可能看的优点不明白，可以分别将$data和$data2打印出来看看是什么结果。

			$this->db->close();

			return $data2;

		}

	}
?>