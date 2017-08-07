<?php
namespace app\index\controller;

class Index extends Base
{
    public function index()
    {
    	$artres = \think\Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.id,a.title,a.pic,a.time,a.desc,a.click,a.keywords,c.catename')->order('a.id desc')->paginate(8);
    	$linkres = \think\Db::name('link')->select();
    	$this->assign('artres',$artres);
    	$this->assign('linkres',$linkres);
        return  $this->fetch();
    }
}
