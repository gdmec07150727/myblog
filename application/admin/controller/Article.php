<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Article as ArticleModel;
use app\admin\controller\Base;
class Article extends Base
{
    public function add()
    {
        if(request()->isPost())
        {
            //dump($_POST);die;
            $data = [
                'title' => input('title'),
                'author' => input('author'),
                'keywords' => input('keywords'),
                'desc' => input('desc'),
                'cateid' => input('cateid'),
                'content' => input('content'),
                'time' => time(),
            ];
            if(input('state')=='on'){
                $data['state'] = 1;
            }else{
                $data['state'] = 0;
            }
            if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
                $data['pic'] = $info->getSaveName();
            }
            $validate = \think\Loader::validate('Article');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());die;
            }
            if(db('article')->insert($data))
            {
                return $this->success("添加文章成功","lst");
            }else{
                return $this->error("添加文章失败");
            }
        }
    	
        $catee = db('cate')->select();
        $this->assign('catee',$catee);
        return $this->fetch('add');
    }
    public function lst()
    {
    	$lst = ArticleModel::paginate(5);
    	//$lst = db('admin')->select();
        //$lst = db('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.author,c.catename,a.pic,a.state')->paginate(5);
    	$this->assign('lst',$lst);
        return $this->fetch('lst');
    }

    public function edit(){
    	$id=input('id');
    	$ll=db('article')->find($id);
    	if(request()->isPost()){
    		$data=[
                'id' => input('id'),
    			'title' => input('title'),
                'author' => input('author'),
                'keywords' => input('keywords'),
                'desc' => input('desc'),
                'cateid' => input('cateid'),
                'content' => input('content'),
                'time' => time(),
    		];
            if(input('state')=='on'){
                $data['state'] = 1;
            }else{
                $data['state'] = 0;
            }
            if($_FILES['picc']['tmp_name']){
                $file = request()->file('picc');
                $info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
                $data['pic'] = $info->getSaveName();
            }else{
                $data['pic'] = input('pic');
            }
			$validate = \think\Loader::validate('Article');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
            $save=db('article')->update($data);
    		if($save !== false){
    			$this->success('修改文章成功！','lst');
    		}else{
    			$this->error('修改文章失败！');
    		}
    		return;
    	}
        
        $this->assign('ll',$ll);
        $catee = db('cate')->select();
        $this->assign('catee',$catee);
        return $this->fetch();
    	
    }

    public function del(){
    	$id = input('id');
    	if(db('Article')->delete($id)){
    			$this->success('删除链接成功！','lst');
    	}else{
    			$this->error('删除链接失败！');
    	}
    }
}
