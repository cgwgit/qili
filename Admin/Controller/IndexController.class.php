<?php 
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
   // 初始化，判断用户是否登录
	public function _initialize() {
        if ($_SESSION['uname'] == NULL) {
            $this->success('请先登陆', U('Manager/login'));
            exit();
        }
     }
     //前台主页
     public function index(){
      if(session('utype') == 2){
        $count = M('hetong')->where(array('uid' => session('uid')))->count();
      }else{
        $count = M('hetong')->count();
      }
      $this->assign('count', $count);
     	$this->display();
     }
      //显示列表
  public function showList(){
    $where = '2>1';
    $post = I('post.');
    if(!empty($post['qname'])){
      $huixian['qname'] = $post['qname'];
      $where .= " AND `qname` like '{$post['qname']}%'";
    }
    if(session('utype') == 2){
      $where .= " AND `tp_qiye`.`uid` =".session('uid');
    }
     $model = M('hetong');
     $count = $model->join('tp_qiye on tp_hetong.qid=tp_qiye.id')->where($where)->count();
     $Page = new \Think\Page($count,4);
     $Page -> setConfig('prev','上一页');
     $Page -> setConfig('next','下一页');
     $Page -> setConfig('first','首页');
     $Page -> setConfig('last','末页');
     $Page -> lastSuffix = false;  //将末页从数字的显示方式切换成汉字提示
     $show = $Page->show();
     $list = $model->alias('hetong')->field('hetong.id as hid,hetong.*,tp_qiye.*')->join('tp_qiye on hetong.qid=tp_qiye.id')->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('hetong.id desc')->select();
     $this->assign('huixian', $huixian);
     $this->assign('count', $count);
     $this->assign('info', $list);
     $this->assign('page', $show);
     $this->display();
}
     //添加信息
	public function addInfo(){
		if(IS_AJAX){
			$post = I('post.');
			!empty($post['qname']) ? $name = trim($post['qname']) : $err = '请填写企业名称';
			!empty($post['qaddr']) ? $qaddr = trim($post['qaddr']) : $err = '请填写企业地址';
			!empty($post['yunying']) ? $yunying = trim($post['yunying']) : $err = '请填写运营人姓名';
			preg_match("/^1[3578][0-9]{9}$/", $post['yunyingtel']) ? $yunyingtel = trim($post['yunyingtel']) : $err = '运营人手机号格式不正确';
      if(!empty($post['farentel'])){
         preg_match("/^1[3578][0-9]{9}$/", $post['farentel']) ? $farentel = trim($post['farentel']) : $err = '法人手机号格式不正确';
      }
			!empty($post['weimeng']) ? $weimeng = trim($post['weimeng']) : $err = '请填写微盟用户名';
      !empty($post['pwd']) ? $pwd = trim($post['pwd']) : $err = '请填写微盟密码';
      !empty($post['qq']) ? $qq = trim($post['qq']) : $err = '请填写qq号码';
      !empty($post['wechat']) ? $wechat = trim($post['wechat']) : $err = '请填写微信公众号';
      !empty($post['pwd1']) ? $wechatpwd = trim($post['pwd1']) : $err = '请填写公众号密码';
      !empty($post['leibie']) ? $leibie = trim($post['leibie']) : $err = '请填写开通类别';
      !empty($post['bianhao']) ? $bianhao = trim($post['bianhao']) : $err = '请填写合同编号';
      !empty($post['banben']) ? $banben = trim($post['banben']) : $err = '请选择开通版本';
      !empty($post['shenqingren']) ? $shenqingren = trim($post['shenqingren']) : $err = '请填写申请人信息';
      !empty($post['money']) ? $money = trim($post['money']) : $err = '请填写合同金额';
      !empty($post['realmoney']) ? $realmoney = trim($post['realmoney']) : $err = '请填写合同真实金额';
      !empty($post['nianxian']) ? $nianxian = trim($post['nianxian']) : $err = '请填写开通年限';
      !empty($post['dept']) ? $dept = trim($post['dept']) : $err = '请选择所属部门';
      !empty($post['jingli']) ? $jingli = trim($post['jingli']) : $err = '请选择所属部门经理';
      !empty($post['laiyuan']) ? $laiyuan = trim($post['laiyuan']) : $err = '请选择客户来源';
      !empty($post['status']) ? $status = trim($post['status']) : $err = '请选择开通状态';

      if($err){
      	echo json_encode(array('code' => 0,'msg' => $err));exit;
      }
      //企业表里的一些字段信息
			$data = array(
                  'uid' => session('uid'), 
                  'qname' => $name, 
                  'qaddr' => $qaddr, 
                  'faren' => !empty($post['faren']) ? $post['faren'] : '', 
                  'yunying' => $yunying,
                  'yunyingtel' => $yunyingtel,
                  'farentel' => !empty($post['farentel']) ? $post['farentel'] : '',
                  'weimeng' => $weimeng,
                  'weimengpwd' => $pwd,
                  'qq' => $qq,
                  'email' => !empty($post['email']) ? $post['email'] : '',
                  'wechat' => $wechat,
                  'wechatpwd' => $wechatpwd,
                  'status' => $status,
                  'leibie' => $leibie,
                  'detail' => !empty($post['detail']) ? $post['detail'] : ''
				);
			  //添加内容到企业表
			  $id = M('qiye')->add($data);
			  if($id){
            //合同表里的字段信息
            $data1 = array(
                      'uid' => session('uid'),
                      'qid' => $id,
                      'bianhao' => $bianhao,
                      'date' => !empty($post['date']) ? strtotime($post['date']) : time(),
                      'money' => $money,
                      'realmomey' => $realmoney,
                      'shenqingren' => $shenqingren,
                      'banben' => $banben,
                      'nianxian' => $nianxian,
                      'daiyunyingdate' => !empty($post['daiyunyingdate']) ? $post['daiyunyingdate'] : '',
                      'dept' => $dept,
                      'jingli' => $jingli,
                      'laiyuan' => $laiyuan,
                      'addtime' => time()
              );
			  	$rst = M('hetong')->add($data1);
			  	if($rst){
			  		echo json_encode(array('code' => 1,'msg' => '添加成功'));exit;
			  	}else{
            echo json_encode(array('code' => 0,'msg' => '添加失败'));exit;
          }
			  }else{
			  	 echo json_encode(array('code' => 0,'msg' => '添加失败'));exit;
			  }
		}else{
      $banben = M('banben')->select();
      $dept = M('dept')->select();
      $this->assign('banben', $banben);
      $this->assign('dept', $dept);
			$this->display();
		}
		
	}

  //编辑活动
  public function editInfo(){
    if(IS_AJAX){
      $post = I('post.');
      !empty($post['qname']) ? $name = trim($post['qname']) : $err = '请填写企业名称';
      !empty($post['qaddr']) ? $qaddr = trim($post['qaddr']) : $err = '请填写企业地址';
      !empty($post['yunying']) ? $yunying = trim($post['yunying']) : $err = '请填写运营人姓名';
      preg_match("/^1[3578][0-9]{9}$/", $post['yunyingtel']) ? $yunyingtel = trim($post['yunyingtel']) : $err = '运营人手机号格式不正确';
      if(!empty($post['farentel'])){
         preg_match("/^1[3578][0-9]{9}$/", $post['farentel']) ? $farentel = trim($post['farentel']) : $err = '法人手机号格式不正确';
      }
      !empty($post['weimeng']) ? $weimeng = trim($post['weimeng']) : $err = '请填写微盟用户名';
      !empty($post['pwd']) ? $pwd = trim($post['pwd']) : $err = '请填写微盟密码';
      !empty($post['qq']) ? $qq = trim($post['qq']) : $err = '请填写qq号码';
      !empty($post['wechat']) ? $wechat = trim($post['wechat']) : $err = '请填写微信公众号';
      !empty($post['pwd1']) ? $wechatpwd = trim($post['pwd1']) : $err = '请填写微信密码';
      !empty($post['leibie']) ? $leibie = trim($post['leibie']) : $err = '请填写开通类别';
      !empty($post['bianhao']) ? $bianhao = trim($post['bianhao']) : $err = '请填写合同编号';
      !empty($post['banben']) ? $banben = trim($post['banben']) : $err = '请选择开通版本';
      !empty($post['shenqingren']) ? $shenqingren = trim($post['shenqingren']) : $err = '请填写申请人信息';
      if(trim($post['money']) > 0){
         $money = trim($post['money']);
      }else{
        $err = '合同金额格式不正确';
      }
      if(trim($post['realmoney']) > 0){
         $realmoney = trim($post['realmoney']);
      }else{
        $err = '实收金额格式不正确';
      }
      !empty($post['nianxian']) ? $nianxian = trim($post['nianxian']) : $err = '请填写开通年限';
      !empty($post['dept']) ? $dept = trim($post['dept']) : $err = '请选择所属部门';
      !empty($post['jingli']) ? $jingli = trim($post['jingli']) : $err = '请选择所属部门经理';
      !empty($post['laiyuan']) ? $laiyuan = trim($post['laiyuan']) : $err = '请选择客户来源';
      if($err){
        echo json_encode(array('code' => 0,'msg' => $err));exit;
      }
      //企业表里的一些字段信息
        $data = array( 
                  'qname' => $name, 
                  'qaddr' => $qaddr, 
                  'faren' => !empty($post['faren']) ? $post['faren'] : '', 
                  'yunying' => $yunying,
                  'yunyingtel' => $yunyingtel,
                  'farentel' => !empty($post['farentel']) ? $post['farentel'] : '',
                  'weimeng' => $weimeng,
                  'weimengpwd' => $pwd,
                  'qq' => $qq,
                  'email' => !empty($post['email']) ? $post['email'] : '',
                  'wechat' => $wechat,
                  'wechatpwd' => $wechatpwd,
                  'status' => !empty($post['status']) ? $post['status'] : '1',
                  'leibie' => $leibie,
                  'detail' => !empty($post['detail']) ? $post['detail'] : ''
        );
        //编辑内容到企业表
        $rst = M('qiye')->where(array('id' => $post['qid']))->save($data);
        //合同表里的字段信息
        $data1 = array(
                  'bianhao' => $bianhao,
                  'date' => !empty($post['date']) ? strtotime($post['date']) : time(),
                  'money' => $money,
                  'realmomey' => $realmoney,
                  'shenqingren' => $shenqingren,
                  'banben' => $banben,
                  'nianxian' => $nianxian,
                  'daiyunyingdate' => !empty($post['daiyunyingdate']) ? $post['daiyunyingdate'] : '',
                  'dept' => $dept,
                  'jingli' => $jingli,
                  'laiyuan' => $laiyuan,
                  'updatetime' => time()
          );
      $rst1 = M('hetong')->where(array('qid' => $post['qid']))->save($data1);
      if($rst1 && $rst){
        echo json_encode(array('code' => 1,'msg' => '编辑成功'));exit;
      }else{
        echo json_encode(array('code' => 1,'msg' => '编辑成功'));exit;
      }
    }else{
     $id = I('get.id');
     $p = I('get.p');
     $list = M('qiye')->alias('qiye')->join('tp_hetong on qiye.id=tp_hetong.qid')->where(array('qiye.id'=> $id))->find();
     $banben = M('banben')->select();
     $dept = M('dept')->select();
     $this->assign('p',$p);
     $this->assign('banben', $banben);
     $this->assign('dept', $dept);
     $this->assign('list', $list);
     $this->display();
    }
  }

  //删除信息
  public function delInfo(){
      $aid = I('get.aid');
      //删除多个活动
      $where['qid'] = array('in', $aid);
      $result = M('hetong')->where($where)->delete();
      if($result){
        $result1 = M('qiye')->where(array('id' => array('in',$aid)))->delete();
        if($result1){
           echo json_encode(array('code' => 1));exit;
        }else{
           echo json_encode(array('code' => 0));exit;
        }
      }else{
         echo json_encode(array('code' => 0));exit;
      }
  }

    //显示详情信息
  public function detail(){
    $id = I('get.id');
    $list = M('qiye')->alias('qiye')->join('tp_hetong on qiye.id=tp_hetong.qid')->where(array('qiye.id'=> $id))->find();
    // var_dump($list);die;
    $this->assign('list', $list);
    $this->display();
  }

  //下拉加载数据
  public function jiazai(){
    $where = '2>1';
    if(session('utype') == 2){
      $where .= " AND `tp_qiye`.`uid` =".session('uid');
    }
    $post = I('post.');
    if(!empty($post['huixian'])){
      $where .= " AND `qname` like '{$post['huixian']}%'";
    }
    $page = $post['page'];
    $pagenum = 4;
    $count = M('hetong')->count();
    $start = ($page-1)*$pagenum;
    $list = M('hetong')->alias('hetong')->field('hetong.*,tp_qiye.*')->join('tp_qiye on hetong.qid=tp_qiye.id')->where($where)->limit($start,$pagenum)->order('hetong.id desc')->select();
    if(empty($list['0']['qid'])){
      echo json_encode(array('code' =>0));exit;
    }
    if($list){
      foreach ($list as $key => $value) {
        $list[$key]['date'] = date('Y-m-d', $value['date']);
      }
    }
    echo json_encode($list);exit;
  }
 }