<?php
namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {
    	$articlee = db('article')->order('id desc')->paginate(5);
    	$this->assign("articlee",$articlee);
        return $this->fetch('index');
    }

    public function test()
    {
    	$agg = array('a','b','c','d');
    	$this->assign("agg",$agg);
    	return $this->fetch('test');
    }
}
