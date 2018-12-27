<?php
/**
* 用户管理
*/
namespace app\admins\controller;
use app\admins\controller\BaseAdmin;

class User extends BaseAdmin{
	// 用户列表
	public function index(){
		$data['pageSize'] = 15;
		$data['page'] = max(1,(int)input('get.page'));

		$data['wd'] = trim(input('get.wd'));
		$where = array();
		$data['wd'] && $where = 'nickname like "%'.$data['wd'].'%"';
		$data['data'] = $this->db->table('User')->where($where)->order('uid desc')->pages($data['pageSize']);
		$this->assign('data',$data);
		return $this->fetch();
	}
	// 修改用户
	// public function save(){
	// 	$status = input('post.status/a');
	// 	$ords = input('post.ords/a');
	// 	if($ords){
	// 		foreach ($ords as $key => $value) {
	// 			$data['status'] = $status[$key] ? 1 : 0;
	// 			$this->db->table('User')->where(array('uid'=>$key))->update($data);			
	// 		}
	// 	}
	// 	exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
	// }
}