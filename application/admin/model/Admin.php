<?php
namespace app\admin\model;
use think\Model;

class Admin extends Model
{
    public function login($data){

    	$user = db('admin')->where('username','=',$data['username'])->find();
        $captcha = new \think\captcha\Captcha();
        
    	if($user)
    	{
    		if($user['password']==md5($data['password']))
    		{
                if ($captcha->check($data['code'])) {
                    session('username',$user['username']);
                    session('uid',$user['id']);
                    return 3;//信息正确
                }else
                {
                    return 4;//验证码错误
                } 
    		}else
    		{
    			return 2;//密码错误
    		}
    	}else{
    		return 1;//用户不存在
    	}
    }
}
