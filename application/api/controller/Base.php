<?php
namespace app\api\controller;
use think\Controller;
use Util\Sysdb;

/**
* 公共文件
*/
class Base extends Controller
{
	public function __construct(){
		$this->db = new Sysdb;
	}
	# 出错代码 0 成功
    public function returnCode($code=0,$result=array(),$error_msg='')
    {
        header("Content-type: application/json");
        if ($code == 0) {
            $array = array(
                'errorCode' => 0,
                'errorMsg' => 'success',
                'result' => $result
            );
        } elseif (!empty($result)) {
            $array = array(
                'errorCode' => $code,
                'errorMsg' => 'error',
                'result' => $result
            );
        }
        echo json_encode($array);
        exit();
    }
}