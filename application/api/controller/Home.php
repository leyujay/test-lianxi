<?php
namespace app\api\controller;
use think\Controller;
use Util\data\Sysdb;

class Home extends Base
{
	# 首页
	public function index(){
		# 获取banner图
		$banner = $this->db->table('slide')->where(array('type'=>0))->lists();
		if($banner){
			foreach($banner as &$banner_v){
				$banner_v['img'] = str_replace('\\','/',$banner_v['img']);
				$banner_img[] = 'http://'.$_SERVER['HTTP_HOST'].$banner_v['img'];
			}
		}
		# 获取商品
		$product = $this->db->table('product')->where(array('status'=>1,'hot'=>1))->lists();
		if($product){
			foreach($product as &$new_v){
				$new_imgs = explode(';', $new_v['img']);
				$new_img  = str_replace('\\','/',$new_imgs[0]);
				$new_v['img'] = 'http://'.$_SERVER['HTTP_HOST'].$new_img;
				$new_v['add_time_s'] = date('Y-m-d H:i',$new_v['add_time']);
			}
		}
		$arr = array(
			'img' => $banner_img,
			'product' => $product,
		);
		$this->returnCode(0,$arr);
	}
	# 产品分类
	public function shop_index(){
		$cat = $this->db->table('product_cates')->where(array('pid'=>0))->lists();
		if($cat){
			foreach($cat as &$v){
				$list_two = $this->db->table('product_cates')->where(array('pid'=>$v['id']))->lists();
				if($list_two){
					foreach ($list_two as &$value) {
						if($value['img']){
							$new_imgs = explode(';', $value['img']);
							$new_img  = str_replace('\\','/',$new_imgs[0]);
							$value['img'] = 'http://'.$_SERVER['HTTP_HOST'].$new_img;
						}
					}
				}
				$list[] = $list_two;
			}
		}
		$arr = array(
			'list' => $list,
			'cat'  => $cat,
		);
		$this->returnCode(0,$arr);
	}
	# 产品列表
	public function shop_list(){
		$page = (int)input('post.page');
		$fid = (int)input('post.fid');
		$order = (int)input('post.order');
		if($order == 1){
			$orders = 'sales DESC';
		}else if($order == 2){
			$orders = 'price';
		}else{
			$orders = 'id DESC';
		}
		$product = $this->db->table('product')->order($orders)->where(array('status'=>1,'fid'=>$fid))->pages_api(4,$page);
		if($product['lists']){
			foreach($product['lists'] as &$product_v){
				$product_imgs = explode(';', $product_v['img']);
				$product_img  = str_replace('\\','/',$product_imgs[0]);
				$product_v['img'] = 'http://'.$_SERVER['HTTP_HOST'].$product_img;
			}
		}
		$this->returnCode(0,$product);
	}
	# 产品详情
	public function shop_details(){
		$id = (int)input('post.id');
		$product = $this->db->table('product')->where(array('id'=>$id))->item();
		if($product){
			$img = explode(';', $product['img']);
			foreach($img as $img_v){
				$product_img  = str_replace('\\','/',$img_v);
				$product['imgs'][] = 'http://'.$_SERVER['HTTP_HOST'].$product_img;
			}
		}else{
			$product = [];
		}
		$this->returnCode(0,$product);
	}
	# 加入购物车
	public function add_car(){
		$id = (int)input('post.id');
		$uid = (int)input('post.uid');;
		$cart = $this->db->table('cart')->where(array('uid'=>$uid,'product_id'=>$id))->item();
		if($cart){
			$data = array(
				'count' => $cart['count']+1
			);
			$insert = $this->db->table('cart')->where(array('id'=>$cart['id']))->update($data);
		}else{
			$data = array(
				'uid' => $uid,
				'product_id' => $id,
				'count' => 1,
				'add_time' => time()
			);
			$insert = $this->db->table('cart')->insert($data);
		}
		$this->returnCode(0,$insert);
	}
	# 下单页面
	public function shop_order(){
		$id = input('post.id');
		$total_price = 0;
		$product = $this->db->table('product')->where(array('id'=>$id))->item();
		$img = explode(';', $product['img']);
		$product_img  = str_replace('\\','/',$img[0]);
		$product['imgs'] = 'http://'.$_SERVER['HTTP_HOST'].$product_img;
		$product['car']['count'] = 1;
		$arr = array(
			'car' => array($product),
			'total_price' => sprintf("%.2f",$product['price']),
			'product_id' => $id
		);
		$this->returnCode(0,$arr);
	}
	# 登录、注册接口
	public function login(){
		$nickname = input('post.nickname');
		$imgs = input('post.imgs');
		$gender = input('post.gender');
		$unionid = input('post.unionid');
		$user = $this->db->table('user')->where(array('unionid'=>$unionid))->item();
		if($user){
			$data = array(
				'nickname'=> $nickname,
				'img'	  => $imgs,
				'sex'  	  => $gender,
				'last_time'=> time(),
			);
			$save_user = $this->db->table('user')->where(array('unionid'=>$unionid))->update($data);
		}else{
			$data = array(
				'unionid' => $unionid,
				'nickname'=> $nickname,
				'img'	  => $imgs,
				'sex'  	  => $gender,
				'add_time'=> time(),
			);
			$save_user = $this->db->table('user')->insert($data);
		}
		if($save_user){
			if($user){
				$data['uid'] = $user['uid'];
			}else{
				$data['uid'] = $save_user;
			}
			$this->returnCode(0,$data);
		}else{
			$this->returnCode(0);
		}
	}
	# 购物车
	public function car_list(){
		$uid = (int)input('post.uid');
		$user = $this->db->table('user')->where(array('uid'=>$uid))->item();
		if(empty($user)){
			$this->returnCode(1,'未找到用户');
		}else{
			$count = $this->db->table('cart')->where(array('uid'=>$uid))->count();
			if(empty($count)){
				$this->returnCode(2,'购物车没有商品！');
			}
			$cart = $this->db->table('cart')->order('add_time DESC')->where(array('uid'=>$uid))->lists();
			foreach($cart as $k=>$v){
				$shop = $this->db->table('product')->where(array('id'=>$v['product_id']))->item();
				$img = explode(';', $shop['img']);
				$product_img  = str_replace('\\','/',$img[0]);
				$shop['imgs'] = 'http://'.$_SERVER['HTTP_HOST'].$product_img;
				$cart[$k]['shop'] = $shop;
			}
		}
		$arr = array(
			'count' => $count,
			'list'  => $cart,
		);
		$this->returnCode(0,$arr);
	}
	# 购物车更新数量
	public function car_count(){
		$id = (int)input('post.id');
		$count = (int)input('post.count');
		$update = $this->db->table('cart')->where(array('id'=>$id))->update(array('count'=>$count));
		if($update){
			$this->returnCode(0);
		}else{
			$this->returnCode(1,'更新失败！');
		}
	}
	# 购物车订单页面
	public function car_order(){
		$id = input('post.id');
		$ids= explode(',',$id);
		$tmp_arr = [];
		$total_price = 0;
		$product_id = '';
		foreach($ids as $k=>$v){
			if(empty($v)){
				unset($ids[$k]);
				continue;
			}else{
				$tmp_car = $this->db->table('cart')->where(array('id'=>$v))->item();
				$product = $this->db->table('product')->where(array('id'=>$tmp_car['product_id']))->item();
				$img = explode(';', $product['img']);
				$product_img  = str_replace('\\','/',$img[0]);
				$product['imgs'] = 'http://'.$_SERVER['HTTP_HOST'].$product_img;
				$product['car'] = $tmp_car;
				$total_price = $total_price + $product['price']*$tmp_car['count'];
			}
			$tmp_arr[] = $product;
			if(!$product_id){
				$product_id = $tmp_car['product_id'];
			}else{
				$product_id = $product_id.','.$tmp_car['product_id'];
			}
		}
		$arr = array(
			'car' => $tmp_arr,
			'total_price' => sprintf("%.2f",$total_price),
			'car_id' => implode(',',$ids),
			'product_id' => $product_id
		);
		$this->returnCode(0,$arr);
	}
	# 生成订单
	public function go_pay(){
		$uid = (int)input('post.uid');
		$car_id = input('post.car_id');
		$desc = input('post.desc');
		$product_id = input('post.product_id');
		$phone = input('post.phone');
		$user = input('post.user');
		$address = input('post.address');
		$car_id_s = explode(',', $car_id);
		# 购物车进入购买商品
		# 商品详情进入购买商品
		if(!empty($car_id)){
			$price = 0;
			# 循环获取购物车和商品
			foreach ($car_id_s as $key => $value) {
				$car_item = $this->db->table('cart')->where(array('id'=>$value))->item();
				$product_item = $this->db->table('product')->where(array('id'=>$car_item['product_id']))->item();
				$price = $price+$car_item['count']*$product_item['price'];
				$arr[] = array(
					'car_item' => $car_item,
					'product_item' => $product_item,
				);
			}
			# 增加订单
			$data = array(
				'order_no' => time().str_pad($uid,4,"0",STR_PAD_LEFT).rand(100,599).rand(600,999),
				'uid' => $uid,
				'desc' => $desc,
				'money' => $price,
				'add_time' => time(),
				'phone' => $phone,
				'name' => $user,
				'address' => $address
			);
			$product_insert = $this->db->table('orders')->insert($data);
			# 添加订单商品
			if($product_insert){
				foreach($arr as $k=>$v){
					$p_data = array(
						'order_id' => $product_insert,
						'product_id' => $v['product_item']['id'],
						'price' => $v['product_item']['price'],
						'count' => $v['car_item']['count'],
					);
					$order_insert = $this->db->table('order_product')->insert($p_data);
					# 添加成功，删除购物车商品
					if($order_insert){
						$this->db->table('cart')->where(array('id'=>$v['car_item']['id']))->delete();
					}
				}
			}
			$this->returnCode(0);
		}else{
			$product_item = $this->db->table('product')->where(array('id'=>$product_id))->item();
			# 增加订单
			$data = array(
				'order_no' => time().str_pad($uid,4,"0",STR_PAD_LEFT).rand(100,599).rand(600,999),
				'uid' => $uid,
				'desc' => $desc,
				'money' => $product_item['price'],
				'add_time' => time(),
				'phone' => $phone,
				'name' => $user,
				'address' => $address
			);
			$product_insert = $this->db->table('orders')->insert($data);
			# 添加订单商品
			if($product_insert){
				$p_data = array(
					'order_id' => $product_insert,
					'product_id' => $product_item['id'],
					'price' => $product_item['price'],
					'count' => 1,
				);
				$order_insert = $this->db->table('order_product')->insert($p_data);
			}
			$this->returnCode(0);
		}
	}
	# 订单列表
	public function order_list(){
		$status = (int)input('post.status');
		$page = (int)input('post.page');
		$uid = (int)input('post.uid');
		$orders = $this->db->table('orders')->order('add_time DESC')->where(array('status'=>$status,'uid'=>$uid))->pages_api(6,$page);
		if($orders['lists']){
			foreach($orders['lists'] as $k=>$v){
				// print_r($v);
				$product = $this->db->table('order_product')->order('id DESC')->where(array('order_id'=>$v['id']))->lists();
				foreach($product as $kk=>$vv){
					$shop = $this->db->table('product')->where(array('id'=>$vv['product_id']))->item();
					$img = explode(';', $shop['img']);
					$shop_img  = str_replace('\\','/',$img[0]);
					$shop['imgs'] = 'http://'.$_SERVER['HTTP_HOST'].$shop_img;
					$product[$kk]['shop'] = $shop;
				}
				$orders['lists'][$k]['order'] = $product;
			}
		}
		$this->returnCode(0,$orders);
	}
	# 订单详情
	public function order_details(){
		$id = input('post.id');
		$item = $this->db->table('orders')->order('add_time DESC')->where(array('id'=>$id))->item();
		$product = $this->db->table('order_product')->order('id DESC')->where(array('order_id'=>$item['id']))->lists();
		foreach($product as $k=>$v){
			$shop = $this->db->table('product')->where(array('id'=>$v['product_id']))->item();
			$img = explode(';', $shop['img']);
			$shop_img  = str_replace('\\','/',$img[0]);
			$shop['imgs'] = 'http://'.$_SERVER['HTTP_HOST'].$shop_img;
			$product[$k]['shop'] = $shop;
		}
		$arr = array(
			'orders' => $item,
			'product' => $product,
		);
		$this->returnCode(0,$arr);
	}
	# 取消订单
	public function cancel_order(){
		$id = input('post.id');
		$data = array(
			'status' => '99'
		);
		$save_orders = $this->db->table('orders')->where(array('id'=>$id))->update($data);
		$this->returnCode(0);
	}
}