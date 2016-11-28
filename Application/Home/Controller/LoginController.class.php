<?php
//登录控制器
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
		$this->display('index');
    }
	//登录验证
	public function login(){
		$ModelLogin = D('Login');
		$rs_check = $ModelLogin->check(I('post.'));
		//保存登录信息
		cookie('type',I('post.type'),3600*24*15);
		cookie('user',I('post.user'),3600*24*15);
		if($rs_check==-1){
			$this->assign('error','验证码错误！');
			$this->display('index');
		}else if($rs_check==0){
			$this->assign('error','登录失败！');
			$this->display('index');
		}else if($rs_check==1){
			//通过
			//如果是老师，检查教师的类型(普通，系主任，院长)
			$ttype=1;
			if(I('post.type')=='2'){
				$model = M('user_teacher');
				$rsType = $model->field('type')->where("user='".I('post.user')."'")->select();
				$ttype = $rsType[0]['type'];
			}
			//保存用户身份到session
			$session=array(
				'type'=>I('post.type'),
				'user'=>I('post.user'),
				'ttype'=>$ttype,
				'ctime'=>NOW_TIME	//创建时间
			);
			session('telanx',$session);
			switch(I('post.type')){
				case '3':$m = 'Admin';break;
				case '2':$m = 'Teacher';break;
				case '1':$m = 'Student';
			}
			//管理员则记录登录时间
			if(I('post.type')=='3')$ModelLogin->admin_login_time(I('post.user'));
			//检查是否第一次登录
			if (I('post.type')=='2') {
				$userinfo = M('UserTeacher')->where(array('user'=>I('post.user')))->find();
				if (empty($userinfo['qq']) && empty($userinfo['cellphone']) && empty($userinfo['officephone'])) {
					$this->error('登录成功', U('Teacher/User/edit'));
				}
			}
			if (I('post.type')=='1') {
				$userinfo = M('UserStudent')->where(array('user'=>I('post.user')))->find();
				if (empty($userinfo['qq']) && empty($userinfo['email']) && empty($userinfo['cellphone'])) {
					$this->error('登录成功', U('Student/User/edit'));
				}
			}
			$this->success('登录成功', U($m.'/Index/index'));	
		}
	}
	public function verifycode(){
		$config =    array(
				'fontSize'    =>    50,    // 验证码字体大小
				'length'      =>    4,     // 验证码位数
				'useNoise'    =>    false, // 关闭验证码杂点
				'fontttf'	=>'4.ttf'
			);
		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}

	public function forget_pwd()
	{
		if (IS_POST) {
			if (empty($_POST['type'])) {
				$this->assign('error','请选择用户类型!');
				$this->display();
				return;
			}
			if ($_POST['type'] == '1') {
				$model = M('user_student');
				$model_pwd = M('user_student_pwd');
			}else if ($_POST['type'] == '2') {
				$model = M('user_teacher');
				$model_pwd = M('user_teacher_pwd');
			}
			$email = trim($_POST['email']);
			$userinfo = $model->where(array('email'=>$email))->find();
			if ($userinfo) {
				$pwdinfo = $model_pwd->where(array('user'=>$userinfo['user']))->find();
				$code = md5($userinfo['user'].$pwdinfo['pwd']);
				$url = 'http://'.$_SERVER['HTTP_HOST'].U('Home/Login/reset_pwd').'?email='.urlencode($email).'&type='.trim($_POST['type']).'&token='.$code;
				$time = date('Y-m-d H:i:s');
				$result = $this->sendmail($time,$email,$url);
				if ($result) {
					$this->success('邮件发送成功', U('Home/Login/index'));	
				}else{
					$this->assign('error','邮件发送失败!');
					$this->display();
				}
			}else{
				$this->assign('error','邮箱不存在!');
				$this->display();
			}
		}else{
			$this->display();
		}
	}

	public function reset_pwd()
	{
		if (empty($_GET['email']) || empty($_GET['type']) || empty($_GET['token'])) {
			$this->error('请求错误！',U('Home/Index/index'),3);
			return;
		}
		if (IS_POST) {
			if (empty($_POST['pwd']) || strlen(trim($_POST['pwd'])) < 6) {
				$this->error('密码长度至少6位');
				return;
			}else{
				if ($_GET['type'] == '1') {
					$model = M('user_student');
					$model_pwd = M('user_student_pwd');
				}else if ($_GET['type'] == '2') {
					$model = M('user_teacher');
					$model_pwd = M('user_teacher_pwd');
				}else{
					$this->error('参数错误');
				}
				$userinfo = $model->where(array('email'=>$_GET['email']))->find();
				if ($userinfo) {
					$pwdinfo = $model_pwd->where(array('user'=>$userinfo['user']))->find();
					if(trim($_GET['token']) == md5($userinfo['user'].$pwdinfo['pwd'])){
						$result = $model_pwd->where(array('id'=>$pwdinfo['id']))->save(array('pwd'=>md5(trim($_POST['pwd']))));
						if ($result) {
							$this->success('密码更改成功！',U('Home/Login/index'),3);
							return;
						}else{
							$this->error('密码更改失败！');
							return;
						}
					}else{
						$this->error('参数错误');
						return;
					}
				}else{
					$this->error('邮箱错误');
					return;
				}
			}
		}
		$this->display();
	}

	//发送邮件 
	private function sendmail($time,$email,$url){
		$emailbody = "亲爱的".$email."：<br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码 
	。<br/><a href='".$url."'target='_blank'>".$url."</a>"; 
		import('ORG.PHPMailer');
		$mailer = new \PHPMailer();
		$mailer->CharSet = 'UTF-8'; //设置中文编码 
		$mailer->IsSMTP(); //设置采用SMTP方式发送邮件 
		$mailer->Host = "smtp.163.com"; //设置邮件服务器的地址 
		$mailer->Port = 25; //设置邮件服务器的端口，默认为25 
		$mailer->From = '18162330070@163.com'; //设置发件人的邮箱地址 
		$mailer->FromName = "系统管理员"; //设置发件人的姓名 
		$mailer->SMTPAuth = true; //设置SMTP是否需要密码验证，true表示需要 
		$mailer->Username = '18162330070@163.com'; //设置发送邮件的邮箱 
		$mailer->Password = "km123456"; //设置邮箱的密码 
		$mailer->Subject = '找回密码'; //设置邮件的标题 
		$mailer->AltBody = "text/html"; // optional, comment out and test 
		$mailer->Body = $emailbody; //设置邮件内容 
		$mailer->IsHTML(true); //设置内容是否为html类型
		$mailer->AddReplyTo("18162330070@163.com","系统管理员");//回复地址  
		$mailer->AddAddress($email); //设置收件的地址
		$mailer->SMTPDebug = false;
		return $mailer->Send();
	} 
	
	//退出登录操作
	public function logout(){
		//销毁session
		session(null);
		$this->success('退出登录成功！',U('Home/Index/index'),3);
		
	}
	//加密
	private function encrypt($str){
		$skey = 'telanx';
		$key = substr(md5($skey), 5, 8);
        $str = substr(md5($str), 8, 10);
        return md5($key . $str);
	}
}