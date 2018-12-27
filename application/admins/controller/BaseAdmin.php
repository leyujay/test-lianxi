<?php
namespace app\admins\controller;
use think\Controller;
use Util\Sysdb;

/**
* 权限控制
*/
class BaseAdmin extends Controller
{
	public function __construct(){
		parent::__construct();
		$this->_admin = session('admin');
		// 未登录的用户不允许访问
		if(!$this->_admin){
			header('Location: /index.php/admins/Account/login');
			exit;
		}
		$this->assign('admin',$this->_admin);
		// 判断用户是否有权限
		$this->db = new Sysdb;
		$group = $this->db->table('admin_groups')->where(array('gid'=>$this->_admin['gid']))->item();
		if(!$group){
			$this->request_error('对不起，您没有权限');
		}
		$rights = json_decode($group['rights']);
		// 当前访问菜单
		$controller = request()->controller();
		$action = request()->action();
		$res = $this->db->table('admin_menus')->where(array('controller'=>$controller,'method'=>$action))->item();
		if(!$res){
			$this->request_error('对不起，您访问的功能不存在');
		}
		if($res['status']==1){
			$this->request_error('对不起，该功能已禁止使用');
		}
		if(!in_array($res['mid'],$rights)){
			$this->request_error('对不起，您没有权限');
		}
	}

	private function request_error($msg){
		if(request()->isAjax()){
			exit(json_encode(array('code'=>1,'msg'=>$msg)));
		}
		exit($msg);
	}
}