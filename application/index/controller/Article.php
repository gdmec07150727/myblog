<?php
namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;
class Article extends Base
{
    public function index()
    {
    	$arid = input('arid');
    	$arrtt = db('article')->find($arid);
    	$ca = db('cate')->find($arrtt['cateid']);
    	db('article')->where('id','=',$arid)->setInc('click');
        $tui = db('article')->where(array('cateid'=>$ca['id'],'state'=>1))->limit(5)->select();
        $this->assign(array(
            'ca'=>$ca,
            'arrtt'=>$arrtt,
            'tui'=>$tui,
        ));

        return $this->fetch('article');
    }
}
