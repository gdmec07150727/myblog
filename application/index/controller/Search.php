<?php
namespace app\index\controller;
use think\Controller;
class Search extends Base
{
    public function index()
    {
    	$title = input('q');
    	$cateid = input('cateid');
    	$ca = db('cate')->find($cateid);
    	
    	if($title)
    	{
    		$map['title'] = ['like','%'.$title.'%'];
    		$searcher = db('article')->where($map)->paginate($listRows=3,$simple=false,$config=[
    			'query'=>array('q'=>$title),
    		]);
    		$this->assign('searcher',$searcher);
    	}else{
    		$this->assign('searcher',null);
    	}

    	$this->assign('ca',$ca);
    	return $this->fetch();
    }
}
