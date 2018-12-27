<?php
/**
* 产品管理
*/
namespace app\admins\controller;
use app\admins\controller\BaseAdmin;

class Product extends BaseAdmin{
	// 产品列表
	public function index(){
		$data['pageSize'] = 15;
		$data['page'] = max(1,(int)input('get.page'));

		$data['wd'] = trim(input('get.wd'));
		$where = array();
		$data['wd'] && $where = 'title like "%'.$data['wd'].'%"';
		$data['data'] = $this->db->table('product')->where($where)->order('id desc')->pages($data['pageSize']);
		$cids = [];
		$fids = [];
		foreach ($data['data']['lists'] as &$item) {
			$img = explode(';',$item['img']);
			$item['img'] = $img[0];
			!in_array($item['cid'],$cids) && $cids[] = $item['cid'];
			!in_array($item['fid'],$fids) && $fids[] = $item['fid'];
		}
		$cids && $data['cates'] = $this->db->table('product_cates')->where('id in('.implode(',',$cids).')')->cates('id');
		$fids && $data['fates'] = $this->db->table('product_cates')->where('id in('.implode(',',$fids).')')->cates('id');
		$this->assign('data',$data);
		return $this->fetch();
	}
	// 添加产品
	public function add(){
		$data['cates'] = $this->db->table('product_cates')->where(array('pid'=>0))->lists();
		$product_id = (int)input('get.id');
		// 商品信息
		$data['product'] = $this->db->table('product')->where(array('id'=>$product_id))->item();

		if($product_id){
			$data['fates'] = $this->db->table('product_cates')->where(array('pid'=>$data['product']['cid']))->lists();	
		}else{
			$data['fates'] = array();
		}

		if($data['product']['img']){
			$img = explode(';',$data['product']['img']);
			$data['product']['imgs'] = $img;
		}
		return $this->fetch('',$data);
	}
	// 商品保存
	public function save(){
		$id = (int)input('post.id');
		$data['cid'] = (int)input('post.cid');
		$data['fid'] = (int)input('post.fid');
		$data['title'] = trim(input('post.title'));
		$data['desc'] = trim(input('post.desc'));
		$data['status'] = (int)input('post.status');
		$data['price'] = input('post.price');
		$data['hot'] = trim(input('post.hot'));
		$img = trim(input('post.img'));
		$img = ltrim($img,';');
		$data['img'] = $img;
		// 保存商品到product
		if($id){
			$product_id = $this->db->table('product')->where(array('id'=>$id))->update($data);
		}else{
			$data['add_time'] = time();
			$product_id = $this->db->table('product')->insert($data);
		}
		if($product_id){
			exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
		}else{
			exit(json_encode(array('code'=>1,'msg'=>'保存失败')));
		}
	}
	// 图片上传
	public function upload_img(){
		$file = request()->file('file');
		if($file==null){
			exit(json_encode(array('code'=>1,'msg'=>'没有文件上传')));
		}
		$info = $file->move(APP_PATH.'../public/uploads');
		$ext = ($info->getExtension());
		if(!in_array($ext,array('jpg','jpeg','gif','png'))){
			exit(json_encode(array('code'=>1,'msg'=>'文件格式不支持')));
		}
		$img = '/uploads/'.$info->getSaveName();
		exit(json_encode(array('code'=>0,'msg'=>$img)));
	}
	// 删除
	public function delete(){
		$id = (int)input('post.id');
		$this->db->table('product')->where(array('id'=>$id))->delete();
		exit(json_encode(array('code'=>0,'msg'=>'删除成功')));
	}
	// 获取二级分类
	public function cat_two(){
		$id = (int)input('post.id');
		$data = $this->db->table('product_cates')->where(array('pid'=>$id))->lists();
		exit(json_encode(array('code'=>0,'data'=>$data)));
	}
}