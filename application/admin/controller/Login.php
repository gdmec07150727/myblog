<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function index()
    {
    	if(request()->isPost())
    	{
    		$user = new Admin();
    		$data = input('post.');
    		if($user->login($data)==3)
    		{
    			return $this->success("验证成功，登录中....",'admin\index');
    		}else if($user->login($data)==2)
    		{
    			return $this->error("密码错误，重新输入");
    		}else if($user->login($data)==1)
    		{
    			return $this->error("没有此账号");
    		}else if($user->login($data)==4)
            {
                return $this->error("验证码错误");
            }
    		
    		
    		
    	}
        return $this->fetch('login');
    }
}
