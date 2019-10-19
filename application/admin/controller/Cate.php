<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Cate as CateModel;
use app\admin\controller\Base;
class Cate extends Base
{
    public function add()
    {
    	if(request()->isPost()){
    		$data = [
    		'catename' => input('catename'),
    		];
    		$validate = \think\Loader::validate('Cate');
    		if(!$validate->scene('add')->check($data)){
    			$this->error($validate->getError());die;
    		}
    		if(db('cate')->insert($data)){
    			return $this->success("添加成功","lst");
    		}else{
    			return $this->error("添加失败");
    		}
    	}
        return $this->fetch();
    }
    public function lst()
    {
    	$lst = CateModel::paginate(5);
    	//$lst = db('admin')->select();
    	$this->assign('lst',$lst);
        return $this->fetch('lst');
    }

    public function edit(){
    	$id=input('id');
    	$ll=db('cate')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
    			'catename'=>input('catename'),
    		];
			$validate = \think\Loader::validate('Cate');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
            $save=db('cate')->update($data);
    		if($save !== false){
    			$this->success('修改栏目成功！','lst');
    		}else{
    			$this->error('修改栏目失败！');
    		}
    		return;
    	}
    	$this->assign('ll',$ll);
    	return $this->fetch();
    }

    public function del(){
    	$id = input('id');
    	if(db('cate')->delete($id)){
    			$this->success('删除栏目成功！','lst');
    	}else{
    			$this->error('删除栏目失败！');
    	}
    }
}
