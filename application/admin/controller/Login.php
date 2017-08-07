<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Login as Log;
class Login extends Controller
{
    public function index()
    {
    	if(request()->isPost()){
    		$login = new Log;
    		$status = $login->login(input('username'),input('password'));
    		if ($status == 1) {
    			return $this->success('登录成功，正在跳转！','Index/index');
    		}elseif($status == 2){
    			return $this->error('账号或密码错误！');
    		}else{
    			return $this->error('用户不存在！');
    		}
    	}

        return  $this->fetch('login');
    }

     public function logout(){
    	session(null);
    	$this->success('退出成功',url('index'));
    }
}


