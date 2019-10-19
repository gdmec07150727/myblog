<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\Base;
class Admin extends Base
{
    public function add()
    {
    	if(request()->isPost()){
    		$data = [
    		'username' => input('username'),
    		'password' => md5(input('password')),
    		];
    		$validate = \think\Loader::validate('Admin');
    		if(!$validate->scene('add')->check($data)){
    			$this->error($validate->getError());die;
    		}
    		if(db('admin')->insert($data)){
    			return $this->success("添加成功","lst");
    		}else{
    			return $this->error("添加失败");
    		}
    	}
        return $this->fetch('add');
    }
    public function lst()
    {
    	$lst = AdminModel::paginate(5);
    	//$lst = db('admin')->select();
    	$this->assign('lst',$lst);
        return $this->fetch('lst');
    }

    public function edit(){
    	$id=input('id');
    	$ll=db('admin')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
    			'username'=>input('username'),
    		];
    		if(input('password')){
				$data['password']=md5(input('password'));
			}else{
				$data['password']=$ll['password'];
			}
			$validate = \think\Loader::validate('Admin');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
            $save=db('admin')->update($data);
    		if($save !== false){
    			$this->success('修改管理员成功！','lst');
    		}else{
    			$this->error('修改管理员失败！');
    		}
    		return;
    	}
    	$this->assign('ll',$ll);
    	return $this->fetch();
    }

    public function del(){
    	$id = input('id');
    	if(db('admin')->delete($id)){
    			$this->success('删除管理员成功！','lst');
    	}else{
    			$this->error('删除管理员失败！');
    	}
    }
    public function logout(){
        session(null);
        $this->success('退出成功！','Login/index');
    }
}
