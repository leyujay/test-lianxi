<?php
/**
* 标签管理
*/
namespace app\admins\controller;
use app\admins\controller\BaseAdmin;

class Cates extends BaseAdmin{

	// 分类管理
	public function index(){
		$data = $this->db->table('product_cates')->where(array('pid'=>0))->lists();
		$this->assign('data',$data);
		return $this->fetch();
	}
	// 添加分类
	public function save(){
		$ords = input('post.ords/a');
		$titles = input('post.titles/a');

		foreach ($ords as $key => $value) {
			// 新增
			$data['ord'] = $value;
			$data['title'] = $titles[$key];

			if($key==0 && $data['title']){
				$this->db->table('product_cates')->insert($data);
			}
			if($key > 0){
				if($data['title']==''){
					// 删除
					$this->db->table('product_cates')->where(array('id'=>$key))->delete();
				}else{
					// 修改
					$this->db->table('product_cates')->where(array('id'=>$key))->update($data);
				}
			}
		}
		exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
	}
	// 二级分类
	public function index_two(){
		$pid = (int)input('get.pid');
		$data = $this->db->table('product_cates')->where(array('pid'=>$pid))->lists();
		$this->assign('data',$data);
		$this->assign('pid',$pid);
		return $this->fetch();
	}
	// 添加二级分类
	public function index_two_add(){
		$id = (int)input('get.id');
		$pid = (int)input('get.pid');
		$slide = $this->db->table('product_cates')->where(array('id'=>$id))->item();
		$this->assign('data',$slide);
		$this->assign('pid',$pid);
		return $this->fetch();
	}
	// 保存二级分类
	public function index_two_save(){
		$id = (int)input('post.id');
		$data['pid'] = (int)input('post.pid');
		$data['ord'] = (int)input('post.ord');
		$data['title'] = trim(input('post.title'));
		$data['img'] = input('post.img');

		if($data['title']=='' || $data['img']==''){
			exit(json_encode(array('code'=>1,'msg'=>'数据不能为空')));
		}
		if($id>0){
			$this->db->table('product_cates')->where(array('id'=>$id))->update($data);
		}else{
			$this->db->table('product_cates')->insert($data);
		}
		
		exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
	}
}