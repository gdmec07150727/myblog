<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize()
    {
    	$this->right();
        $cater = db('cate')->select();
        $this->assign('cater',$cater);
    }

    public function right()
    {
    	$articlea = db('article')->where('state','=','1')->select();
    	$clicker = db('article')->order('click desc')->limit(6)->select();
    	$this->assign('arrt2',$articlea);
    	$this->assign('clicker',$clicker);
    }

}
