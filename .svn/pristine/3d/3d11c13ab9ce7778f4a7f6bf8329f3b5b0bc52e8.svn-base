<?php
namespace Home\Controller;
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
	                 'upwd' => $pwd
	            );
	           $rst = M('user')->where($data)->find();
	           if($rst){
	            session('uid', $rst['id']);
	            session('uname', $rst['uname']);
	            session('utype' , $rst['utype']);
	            echo json_encode(array('code' =>1,'msg' => '登录成功'));exit;
	           }else{
	            echo json_encode(array('code' =>0,'msg' => '用户名或密码不正确'));exit;
	           }
	    }else{
	      $this->display();
	    }
  }
	//退出按钮
	public function loginout(){
        session(null);
		$this->display('login');
	}

	//添加用户
	public function member_add(){
		if(IS_AJAX){
          $post = I('post.');
          $data = array(
             'uname' => $post['username'],
             'upwd' => $post['password'],
             'xingming' => $post['adminName'],
             'addtime' => time()
          	);
          $rst = M('user')->add($data);
          if($rst){
          	echo json_encode(array('code' => 1,'msg' => '添加成功'));exit;
          }else{
          	echo json_encode(array('code' => 0,'msg' => '添加失败'));exit;
          }
		}else{
		$this->display();	
		}
		
	}
	//用户列表
	public function member_list(){
		$users = M('user')->where(array('utype' => '2'))->select();
		$this->assign('user', $users);
		$this->display();
	}
	//删除用户
	public function member_del(){
		$id = I('get.id');
		M('qiye')->where(array('uid' => $id))->delete();
		M('hetong')->where(array('uid' => $id))->delete();
		$rst = M('user')->delete($id);
		if($rst){
			echo json_encode(array('code' => 1,'msg' => '删除成功'));exit;
		}else{
			echo json_encode(array('code' => 0,'msg' => '删除失败'));exit;
		}
	}
	//编辑用户
	public function member_edit(){
	  if(IS_AJAX){
       $post = I('post.');
       $data = array(
             'uname' => $post['adminName'],
             'upwd' => $post['password'],
             'addtime' => time()
       	);
       $rst = M('user')->where(array('id' => $post['id']))->save($data);
       if($rst){
           echo json_encode(array('code' => 1,'msg' => '编辑成功'));exit;
       }else{
           echo json_encode(array('code' => 0,'msg' => '编辑失败'));exit;
       }
	  }else{
	  $id = I('get.id');
      $user = M('user')->find($id);
      $this->assign('user', $user);
      $this->display();
	  }
 
	}
}
