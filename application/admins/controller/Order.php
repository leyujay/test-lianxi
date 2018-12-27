<?php
/**
* 订单管理
*/
namespace app\admins\controller;
use app\admins\controller\BaseAdmin;

class Order extends BaseAdmin{
	// 订单列表
	public function index(){
		$data['pageSize'] = 15;
		$data['page'] = max(1,(int)input('get.page'));

		$data['wd'] = trim(input('get.wd'));
		$where = array();
		$data['wd'] && $where = 'order_no like "%'.$data['wd'].'%"';
		$list = $this->db->table('Orders')->where($where)->order('id desc')->pages($data['pageSize']);
		if($list['lists']){
			foreach($list['lists'] as &$v){
				$v['user'] = $this->db->table('User')->where(array('uid'=>$v['uid']))->item();
			}
		}
		$data['data'] = $list;
		$this->assign('data',$data);
		return $this->fetch();
	}
	// 添加产品
	public function add(){
		$id = (int)input('get.id');
		$data = $this->db->table('Orders')->where(array('id'=>$id))->item();
		$this->assign('data',$data);
		return $this->fetch();
	}
	// 修改用户
	public function save(){
		$id = (int)input('post.pid');
		$data['ship_no'] = trim(input('post.ship_no'));
		$data['ship_status'] = (int)input('post.ship_status');
		if($data['ship_status'] == 1){
			$data['ship_time'] = time();
		}

		$product_id = $this->db->table('Orders')->where(array('id'=>$id))->update($data);
		if($product_id){
			exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
		}else{
			exit(json_encode(array('code'=>1,'msg'=>'保存失败')));
		}
	}
	// 查看订单商品
	public function product(){
		$id = (int)input('get.id');
		$data['pageSize'] = 15;
		$data['page'] = max(1,(int)input('get.page'));

		$list = $this->db->table('Order_product')->where(array('order_id'=>$id))->order('id desc')->pages($data['pageSize']);
		if($list['lists']){
			foreach($list['lists'] as &$v){
				$v['product'] = $this->db->table('Product')->where(array('id'=>$v['product_id']))->item();
			}
		}
		$data['data'] = $list;
		$this->assign('data',$data);
		return $this->fetch();
	}
}