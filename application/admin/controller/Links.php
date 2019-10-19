<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Links as LinksModel;
use app\admin\controller\Base;
class Links extends Base
{
    public function add()
    {
    	if(request()->isPost()){
    		$data = [
    		'title' => input('title'),
    		'url' => input('url'),
            'desc' => input('desc'),
    		];
    		$validate = \think\Loader::validate('Links');
    		if(!$validate->scene('add')->check($data)){
    			$this->error($validate->getError());die;
    		}
    		if(db('links')->insert($data)){
    			return $this->success("添加成功","lst");
    		}else{
    			return $this->error("添加失败");
    		}
    	}
        return $this->fetch('add');
    }
    public function lst()
    {
    	$lst = LinksModel::paginate(5);
    	//$lst = db('admin')->select();
    	$this->assign('lst',$lst);
        return $this->fetch('lst');
    }

    public function edit(){
    	$id=input('id');
    	$ll=db('links')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
    			'title'=>input('title'),
                'url'=>input('url'),
                'desc'=>input('desc'),
    		];
			$validate = \think\Loader::validate('Links');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
            $save=db('links')->update($data);
    		if($save !== false){
    			$this->success('修改链接成功！','lst');
    		}else{
    			$this->error('修改链接失败！');
    		}
    		return;
    	}
    	$this->assign('ll',$ll);
    	return $this->fetch();
    }

    public function del(){
    	$id = input('id');
    	if(db('links')->delete($id)){
    			$this->success('删除链接成功！','lst');
    	}else{
    			$this->error('删除链接失败！');
    	}
    }
}
