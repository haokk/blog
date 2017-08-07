<?php
namespace app\index\controller;

class Article extends Base
{
    public function index()
    {
    	$id = input('artid');
    	db('article')->where('id', $id)->setInc('click');		//通过id来对click字段自增
    	$arts = \think\Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.title,a.content,a.time,a.click,a.keywords,a.cateid,c.catename')->find($id);

    	//通过id比较来对相同栏目中的文章进行上一页和下一页的查询
    	$prev = \think\Db::name('article')->where('id','<',$id)->where('cateid','=',$arts['cateid'])->order('id desc')->limit(1)->value('id');
    	$next = \think\Db::name('article')->where('id','>',$id)->where('cateid','=',$arts['cateid'])->order('id asc')->limit(1)->value('id');

    	//调用本类方法获取相关的关键字文章
    	$ralateres = $this->ralate($arts['keywords']);

        $guestres = \think\Db::name('guest')->order('id desc')->paginate(5);
     

		//把数据分配到模板中
    	$this->assign('arts',$arts);
    	$this->assign('prev',$prev);
    	$this->assign('next',$next);
    	$this->assign('ralateres',$ralateres);
        $this->assign('guestres',$guestres);
        return  $this->fetch('article');
    }

    // 通过关键字来进行相关文章的查询
    public function ralate($keywords){
    	$arr = explode(',',$keywords);		//返回一个关键字数组
    	static $ralateres = array();
    	foreach ($arr as $k => $v){

            //找到关键字中包含$v的数组
    		$map['keywords'] = ['like','%'.$v.'%'];   
    		$artres = \think\Db::name('article')->order('id desc')->where($map)->limit(5)->field('id,title,time')->select();

    		$ralateres = array_merge($ralateres,$artres);		//把两个数组合并为一个数组
    		$ralateres = arr_unique($ralateres);		//通过common.php中的去重函数去掉重复数组
    	}
    	return $ralateres;
    }
}
