<?php
namespace app\index\controller;

class Search extends Base
{
    public function index()
    {  
         //接收输入的关键字
    	$keywords = input('keywords');
    	if ($keywords) {   //又关键字，进行批量查询；否则为空
    		$map['title'] = ['like','%'.$keywords.'%'];
    		$seares = \think\Db::name('article')->where($map)->order('id desc')->paginate(2);
    		$this->assign('seares',$seares);
    		$this->assign('keywords',$keywords);
    	}else{
    		$this->assign('keywords','没有关键词');
    		$this->assign('seares',null);

    	}
        return  $this->fetch('search');
    }
}
