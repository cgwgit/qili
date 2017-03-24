<?php
namespace Admin\Controller;
use Think\Controller;
class ManagerController extends Controller {
	//登录
    public function login(){ 
	    if(IS_AJAX){
	           $post = I('post.');
	           !empty($post['name']) ? $name = trim($post['name']) : $err = '用户名格式不正确';
	           !empty($post['pwd']) ? $pwd = trim($post['pwd']) : $err = '密码格式不正确';
	           if($err){
	            echo json_encode(array('code' =>0,'msg' => $err));exit;
	           }
	           $data = array(
	                 'uname' => $name,
	                 'upwd' => $pwd,
	            );
	           $rst = M('user')->where($data)->find();
	           if($rst){
	           	$token = time();
	            $rst1 = M('user')->where(array('id' => $rst['id']))->save(array('token' => $token));
	            if($rst1){
	                session('uid', $rst['id']);
		            session('uname', $rst['uname']);
		            session('utype' , $rst['utype']);
		            setcookie("token", $token, time()+2592000);
		            // cookie('token',$token,2592000);
		            echo json_encode(array('code' =>1,'msg' => '登录成功'));exit;
	            }else{
	            	echo json_encode(array('code' =>0,'msg' => '更新token失败'));exit;
	            }
	           }else{
	            echo json_encode(array('code' =>0,'msg' => '用户名或密码不正确'));exit;
	           }
	    }else{
	          $token = cookie('token');
		      $rst = M('user')->where(array('token' => $token))->find();
		      if($rst){
		      	session('uid', $rst['id']);
		        session('uname', $rst['uname']);
		        session('utype' , $rst['utype']);
		        $this->redirect('Index/index');
		      }else{
		      	$this->display();
		      }
	    }
  }
	//退出按钮
	public function loginout(){
        session(null);
        cookie('token',null);
		$this->display('login');
	}
}