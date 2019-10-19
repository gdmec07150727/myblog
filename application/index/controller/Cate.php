<?php
namespace app\index\controller;
use think\Controller;
class Cate extends Base
{
    public function index()
    {
    	$cateid = input('cateid');
    	$arrt = db('article')->where('cateid','=',$cateid)->paginate(3);
    	$ca = db('cate')->where('id','=',$cateid)->find();
    	$this->assign('arrt',$arrt);
    	$this->assign('ca',$ca);
        return $this->fetch('cate');
    }
}
